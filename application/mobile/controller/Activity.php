<?php
namespace app\mobile\controller;

use wxpay\database\WxPayUnifiedOrder;
use wxpay\JsApiPay;
use wxpay\NativePay;
use wxpay\PayNotifyCallBack;
use think\Log;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
use think\Db;
use \think\Validate;
use \think\Session;
use think\Request;
use wxpay\wechatAppPay;

class Activity extends Base
{
    public function _initialize() {
        parent::_initialize();
        $noLogin = array('add_order');
        $this->checkUserLogin($noLogin);
    }

    //最新活动
    public function new_activity(){
        //获取活动信息
        $actInfo = model('Activity')->getNewActivity();
        $this->assign('actInfo',$actInfo);
        return $this->fetch();
    }

    //活动界面
    public function index($set = 26){
        
        $ActivityType = model('ActivityType');
        //获取标题
        $titleSon = $ActivityType->getTitleSon($set);
        
        //获取字段
    	$field = 'aid,a_img,a_title,a_remark,a_type,a_begin_time,a_end_time,a_address,a_child_price,a_adult_price,a_sold_num,a_num';
        //获取活动信息
        $Activity = model('Activity');
        $ActivityInfo = array();
        foreach ($titleSon as $k=>$v){
            $ActivityInfo[] = $Activity->getActivity($v['id'],'',$field);
        }
        
        //降维
        $result = array();
        foreach($ActivityInfo as $key=>$val){
            foreach($val as $k=>$v){
                $result[] = $v;
            }
        }
        
        //获取标题信息
        $titleInfo = $ActivityType->getTitleInfo($set);

        $this->assign('titleInfo',$titleInfo);
        $this->assign('title',$titleInfo['name']);
        $this->assign('result',$result);
    	$this->assign('titleSon',$titleSon);
    	return $this->fetch();
    }

    //活动详情页（点击报名进入详情页）
    public function detail(){
        //微信浏览器先获取openid
        if(is_weixin()) {
            if (Session::get('openid') == null) {
                //获取openId
                $tools = new JsApiPay();
                $openId = $tools->getOpenid();
                session::set('openid', $openId);
            }
        }
    	$aid = input('aid');
    	$Activity = model('Activity');
    	$ActivityComments = model('ActivityComments');

    	//获取活动信息
    	$activityInfo = $Activity->getIdActivity($aid);
    	//获取活动评论
    	$commentInfo = $ActivityComments->getActivityComment($aid);

        //查看是否收藏
        $uid = Session::get("userInfo.uid");
        $userInfo = model('user')->get($uid);
        $activityCollection = model('ActivityCollection');
        $isCollection = $activityCollection->isCollection($aid,$uid);

        //促销品一个人只能报三次，超过三次按原价计算

        //时间信息
        $map = [
            'aid' => $aid,
            'is_display'=> 1,
        ];
        $timeInfo = model('ActivityTime')->where($map)->select();

        $this->assign('userInfo',$userInfo);
        $this->assign('timeInfo',$timeInfo);
        $this->assign('activityInfo',$activityInfo);
        $this->assign('isCollection',$isCollection);
    	$this->assign('commentInfo',$commentInfo);
    	return $this->fetch();
    }
    
    //活动扩展显示
    public function detail_list(){
        $eid = input('eid');
        $ActivityExtension = model('ActivityExtension');
        //获取活动扩展信息
    	$einfo = $ActivityExtension->getAnyInfo($eid);
    	$this->assign('title','详情');
        $this->assign('einfo',$einfo);
        return $this->fetch();
    }
    
    //全部评论
    public function comments_list(){
        $aid = input('aid');
        //获取活动玩翫答疑
        $ActivityComments = model('ActivityComments');
    	$comInfo = $ActivityComments->getActivityComment($aid);
        $this->assign('comInfo',$comInfo);
        $this->assign('title','评论列表');
        return $this->fetch();
    }

    //报名
    public function add_order(){
        //用户id
        $uid = Session::get('userInfo.uid');
        $userInfo = model('user')->get($uid);
        if(empty($userInfo)){
            $this->error('用户不存在');
        }
        //活动id
        $aid = input('get.aid');
        //大人数量
        $adult_num = input('get.adult_num');
        //小孩数量
        $child_num = input('get.child_num');
        //参加时间
        $time = input('get.time');
        $token = input('get.token');

        //检查参加时间是否还有票
        $ActivityTime = model('ActivityTime');
        $timeInfo = $ActivityTime->getAnyTime($time);
        if($timeInfo['ticket_num'] <= 0) {
            $this->error('您选择的时间段已无名额');
        }

        //检查活动名额
        $ActivityInfo = model('Activity')->find($aid);
        if($ActivityInfo->a_num <= 0){
            $this->error('您选择的活动已报满');
        }

        //价格
        $price = $adult_num*$ActivityInfo['a_adult_price']+$child_num*$ActivityInfo['a_child_price'];


        //免费活动不能重复报名
        if($price == 0){
            $map = [
                'uid' => $uid,
                'aid' => $aid,
            ];
            $check_acticity = model('ActivityOrder')->where($map)->order('order_id desc')->find();
            $check_time = $ActivityTime->getAnyTime($check_acticity['t_id']);
            if(!empty($check_acticity) & $check_time['is_display'] == 1){
                $this->error('名额有限，不能重复报名噢');
            }
        }
        //防止重复提交
        if(!checkToken($token) & $price>0){
            $this->assign('userInfo',$userInfo);
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',session('orderInfo'));
            $this->assign('title','选择支付');
            //微信浏览器只支持js支付，单独一个界面
            if(is_weixin()){
                //跳转到wx_browser_pay
                return $this->fetch('activity/wx_select_pay');
            }else{
                return $this->fetch('activity/select_pay');
            }
        }

        //订单入库
        if($price > 0){//免费活动不需要支付,订单状态为已付款
            $order_status = 2;
        }else{
            $order_status = 3;
        }
        $add_order_data = [
            'order_sn' => getOrderSn($uid,$aid),
            'aid' => $aid,
            'uid' => $uid,
            'mobile' => $userInfo['mobile'],
            'name' => $userInfo['nickname'],
            'adult_num' => $adult_num,
            'child_num' => $child_num,
            'order_status' => $order_status,
            'addtime' => time(),
            't_id' => $time,
            'source' => 1,
            'order_price' => $price,
        ];

        model('ActivityOrder')->insert($add_order_data);

        session('orderInfo',$add_order_data);
        //免费活动不需要支付，直接报名成功，付费活动进入选择支付界面
        if($price > 0){
            $this->assign('userInfo',$userInfo);
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$add_order_data);
            $this->assign('title','选择支付');
            //微信浏览器只支持js支付，单独一个界面
            if(is_weixin()){
                //跳转到wx_browser_pay
                return $this->fetch('activity/wx_select_pay');
            }else{
                return $this->fetch('activity/select_pay');
            }
        }else{
            //报名成功，减少总名额和时间名额，增加报名人数，人员数量以小孩数量为准
            $this->sendMobileMsg($add_order_data['order_sn']);
            $this->setActivityNum($add_order_data['order_sn']);
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$add_order_data);
            $this->assign('title','报名成功');
            return $this->fetch('activity/pay_success');
        }
    } 


    //交易成功,给用户手机号发送一条短信
    public function sendMobileMsg($order_sn){
        $orderInfo = model('ActivityOrder')->where('order_sn',$order_sn)->find();
        $activity = model('Activity')->find($orderInfo['aid']);
        $timeInfo = model('ActivityTime')->find($orderInfo['t_id']);
        $content = "恭喜您已成功报名".$activity['a_title'].",活动地点：".$activity['a_address'].",参加时间:".$timeInfo['begin_time']."到".$timeInfo['end_time']."，大人".$orderInfo['adult_num']."个,小孩".$orderInfo['child_num']."个,请您准时参加,有问题请联系客服：400-611-2731,感谢您的支持。";
        sendSMS($orderInfo['mobile'],$content);
    }

    //交易成功，减少报名名额
    public function setActivityNum($order_sn){
        $orderInfo = model('ActivityOrder')->where('order_sn',$order_sn)->find();
        //报名成功，减少总名额和时间名额，增加报名人数，人员数量以小孩数量为准
        model('activity')->where('aid', $orderInfo['aid'])->setDec('a_num', $orderInfo['child_num']);
        model('activity')->where('aid', $orderInfo['aid'])->setInc('a_sold_num', $orderInfo['child_num']);
        model('ActivityTime')->where('t_id', $orderInfo['t_id'])->setDec('ticket_num', $orderInfo['child_num']);
        model('ActivityTime')->where('t_id', $orderInfo['t_id'])->setInc('sold_num', $orderInfo['child_num']);
    }

    /**
     * 微信异步接收订单返回信息，订单成功付款后，处理订单状态
     * @param int $order_sn 订单编号
     */
    public function notify($order_sn = '')
    {
        $notify = new PayNotifyCallBack();
        $notify->handle(true);

        //获取订单信息
        $activityOrder = model('ActivityOrder');
        $order = $activityOrder->getSnOrderInfo($order_sn);
        //订单日志
        if (!isset($order)) {
            $data['act'] = 2;
            $data['order_sn'] = $order_sn;
            $data['content'] = '订单不存在';
            $data['pay_way'] = 2;
            $data['time'] = time();
            db::table('mfw_order_log')->insert($data);
            return;
        }
        $succeed = ($notify->getReturnCode() == 'SUCCESS') ? true : false;
        if ($succeed) {
            $data['act'] = 1;
            $data['order_sn'] = $order_sn;
            $data['content'] = '交易成功';
            $data['pay_way'] = 2;
            $data['time'] = time();
            db::table('mfw_order_log')->insert($data);

            //修改订单状态
            unset($map);
            unset($data);
            $data['order_status'] = 3;
            $data['pay_way'] = 2;
            $data['pay_time'] = time();
            $map['order_sn'] = $order_sn;
            $activityOrder->where($map)->update($data);

            //发短信，减名额
            $this->sendMobileMsg($order['order_sn']);
            $this->setActivityNum($order['order_sn']);
        } else {
            $data['act'] = 2;
            $data['order_sn'] = $order_sn;
            $data['content'] = '支付失败';
            $data['pay_way'] = 2;
            $data['time'] = time();
            db::table('mfw_order_log')->insert($data);
        }
    }
    //alipay支付回调
    public function alipay_notify(){
        $params = input('post.');
        //验签
        $checksign = \alipay\Notify::checkSign($params);
        $order_sn = $params['out_trade_no'];
        if($checksign){
            //获取订单信息
            $activityOrder = model('ActivityOrder');
            $order = $activityOrder->getSnOrderInfo($order_sn);
            if(empty($order)){//不存在直接返回
                $data['act'] = 2;
                $data['order_sn'] = $order_sn;
                $data['content'] = '订单不存在';
                $data['pay_way'] = 1;
                $data['time'] = time();
                db::table('mfw_order_log')->insert($data);
                exit('failure');
            }
            //验证接收金额是被篡改
            if($params['total_amount'] == $order['order_price']){
                //交易成功
                if($params['trade_status'] == 'TRADE_SUCCESS'){
                    $data['act'] = 1;
                    $data['order_sn'] = $order_sn;
                    $data['content'] = "交易成功";
                    $data['pay_way'] = 1;
                    $data['time'] = time();
                    db::table('mfw_order_log')->insert($data);
                    
                    //修改订单状态
                    unset($map);
                    unset($data);
                    $data['order_status'] = 3;
                    $data['pay_way'] = 1;
                    $data['pay_time'] = time();
                    $map['order_sn'] = $order_sn;
                    $activityOrder->where($map)->update($data);

                    //给用户发送一条消息
                    $aid = $order['aid'];
                    $Activity = model('Activity');
                    $activityInfo = $Activity->getIdActivity($aid,'a_title');
                    $url = url('activity/detail',['aid'=>$aid]);
                    $content = "您报名的<a href='".$url."'>".$activityInfo['a_title']."</a>活动付款成功,请您注意活动参与时间!";
                    $message = model('Message');
                    $message->sendMessage($order['uid'],$content,1);

                    exit('success');
                }else{
                    $data['act'] = 2;
                    $data['order_sn'] = $order_sn;
                    $data['content'] = '支付失败:'.$params['trade_status'];
                    $data['pay_way'] = 1;
                    $data['time'] = time();
                    db::table('mfw_order_log')->insert($data);
                    exit('failure');
                }
            }else{
                $data['act'] = 2;
                $data['order_sn'] = $order_sn;
                $data['content'] = '金额被篡改:'.$order['order_price']."---".$params['total_amount'];
                $data['pay_way'] = 1;
                $data['time'] = time();
                db::table('mfw_order_log')->insert($data);
                exit('failure');
            }
        }else{
            $data['act'] = 2;
            $data['order_sn'] = $order_sn;
            $data['content'] = '验签失败';
            $data['pay_way'] = 1;
            $data['time'] = time();
            db::table('mfw_order_log')->insert($data);
            exit('failure');
        }
    }
    
    public function settingNum(){
        $Activity = model('Activity');
        $Activity->startTrans();
        $activityInfo = $Activity->getIdActivityForUpdate(11);
        if($activityInfo['a_num'] > 0){
            //库存-1
            $Activity->DecActivity(11);
            //报名人员+1
            $Activity->IncActivity(11);
        }else{
            $data['act'] = 2;
            $data['order_sn'] = '201708211039201131';
            $data['content'] = '没库存';
            $data['pay_way'] = 2;
            $data['time'] = time();
            db::table('mfw_order_log')->insert($data);
        }
        $Activity->commit();
    }

    /**
    * 支付状态查询
    *order_sn 订单号
    */
    public function getPayStatus($order_sn = ''){
        header('Content-Type: application/json; charset=utf-8');
        $map['order_sn'] = $order_sn;
        $order = db::table('mfw_order_log')->where($map)->find();
        if($order['act'] == 1){
            exit(json_encode(array('status'=>1,'msg'=>'支付成功')));
        }else{
            exit(json_encode(array('status'=>2,'msg'=>'未付款')));
        }
    }

    //微信支付跳转
    public function pay_success($order_sn = ''){
        //获取活动信息
        $uid = session('userInfo.uid');
        $activityOrder = model('ActivityOrder');
        $order = $activityOrder->getSnOrderInfo($order_sn,'order_sn,aid,child_num,adult_num,order_price,order_status,mobile');
        if(!isset($order)){
            $this->error('参数错误');
        }
        
        //查询订单
        $notify = new PayNotifyCallBack();
        $notify->handle(true);
        $result = $notify->queryTradeOrder($order_sn);
        if($result){
            $this->assign('url',url('mobile/user/index'));
            $this->assign('title','支付成功');
            $this->assign('orderInfo',$order);
            return $this->fetch();
        }else{
            $this->error('支付失败,有疑问请联系客服');
        }
    }
    
    //支付宝支付跳转
    public function ali_pay_url(){
        //本站订单号
        $out_trade_no = input('get.out_trade_no');
        //支付宝订单号
        $trade_no = input('get.trade_no');
        
        //获取活动信息
        $activityOrder = model('ActivityOrder');
        $order = $activityOrder->getSnOrderInfo($out_trade_no);
        if(!isset($order)){
            $this->error('参数错误');
        }
        $result = \alipay\Query::exec($trade_no);
        if($result['trade_status'] == 'TRADE_SUCCESS'){
            $this->setActivityNum($order['order_sn']);
            $this->sendMobileMsg($order['order_sn']);
            $this->assign('title','支付成功');
            $this->assign('order',$order);
            return $this->fetch('activity/pay_success');
        }else{
            $this->error('支付失败,有疑问请联系客服');
        }
    }
    
    //活动收藏
    public function collection(){
        //检测是否为ajax请求
        if(request()->isAjax()){
            //活动id
            $aid = input('post.aid');
            //属性 1:收藏 2:取消收藏
            $type = input('post.type');
            //用户id
            $uid = Session::get('userInfo.uid');
            if(empty($uid)){
                return return_info(-1,'未登录');
            }
            if($type == 1){
                $activityCollection = model('ActivityCollection');
                $activityCollection->addCollection($aid,$uid);
                return return_info(200,'收藏成功');
            }else if($type == 2){
                $activityCollection = model('ActivityCollection');
                $activityCollection->delCollection($aid,$uid);
                return return_info(200,'取消成功');
            }else{
                return return_info(-1,'非法请求');
            }
        }else{
            return return_info(-1,'非法请求');
        }
    }
    
    //答疑提交
    public function answer_questions () {
        //检测是否为ajax请求
        if(request()->isAjax()){
            //用户id
            $uid = Session::get('userInfo.uid');
            if(empty($uid)){
                return return_info(-1,'未登录');
            }
            //昵称
            $nickname = Session::get('userInfo.nickname');
            //头像
            $headIcon = Session::get('userInfo.headIcon');
            //活动id
            $aid = input('post.aid');
            //评论内容
            $content = input('post.content');

            //添加
            $ActivityComments = model('ActivityComments');
            $ActivityComments->insertAnswerQuestions($nickname,$headIcon,$aid,$content);
            
            $result['nickname'] = $nickname;
            $result['headIcon'] = Config('view_replace_str.__HEADICON__')."/".$headIcon;
            return return_info(200,'提交成功',$result);
        }else{
            return return_info(-1,'非法请求');
        }
    }
    //免费活动列表
    public function freeplay(){
        $Activity = model('Activity');
        $freeData = $Activity->getFreeActivity();
        //数据分离：往期回顾和最新活动
        $review = array();
        $newest = array();
        foreach($freeData as $k=>$v){
            if(time() < $v['a_end_time']){
                $newest[] = $v;
            }else{
                $review[] = $v;
            }
        }
        //获取我的收藏
        $collections = array();
        if(!empty(Session::get('userInfo'))){
            $uid = Session::get('userInfo.uid');    //获取uid
            $ActivityCollection = model('ActivityCollection');  
            $myCollections = $ActivityCollection->myCollections($uid);  //获取我的收藏
            //组合收藏aid
            if(!empty($myCollections)){
                $collections = array();
                foreach($myCollections as $k=>$v){
                    $collections[] = $v['aid'];
                }
            }
        }
        $this->assign('title','免费活动');
        $this->assign('collections',$collections);
        $this->assign('newest',$newest);
        $this->assign('review',$review);
        return $this->fetch();
    }
    //免费活动详情
    public function free_detail($aid){
        $Activity = model('Activity');
        //获取活动信息
        $activityInfo = $Activity->getIdActivity($aid);
        //获取活动评论
        $ActivityComments = model('ActivityComments');
    	$commentInfo = $ActivityComments->getActivityComment($aid);
        //获取活动时间
        $ActivityTime = model('ActivityTime');
        $timeInfo = $ActivityTime->getActivityTime($aid);
        
        //查看是否收藏
        $uid = Session::get("userInfo.uid");
        $activityCollection = model('ActivityCollection');
        $isCollection = $activityCollection->isCollection($aid,$uid);
        
        $this->assign('timeInfo',$timeInfo);
        $this->assign('activityInfo',$activityInfo);
        $this->assign('commentInfo',$commentInfo);
        $this->assign('isCollection',$isCollection);
        return $this->fetch();
    }

    //关于我们
    public function about() {
        $this->assign('title','关于我们');
        return $this->fetch();
    }

     //签到展示页
    public function sign() {
        //活动id
        $aid = input('get.a');
        $activity = model('activity');
        $activityInfo = $activity->getIdActivity(base64_decode($aid));
        $this->assign('activityInfo',$activityInfo);
        return $this->fetch();
    }
    
    //签到
    public function add_sign() {
        $aid = base64_decode(input('post.a'));
        $mobile = input('post.mobile');
        //获取订单信息，如果有多个签到，记录最新的
        $map['aid'] = $aid;
        $map['mobile'] = $mobile;
        $map['order_status'] = 3;
        $order_info = model('ActivityOrder')->where($map)->order('order_id desc')->select();
        $order = $order_info[0];
        //记录
        if(empty($order)){
            return $this->fetch('activity/sign_fail');
        }else{
            //修改签到时间和修改订单状态
            $order->sign_time = time();
            $order->order_status = 4;
            $order->save();
            return $this->fetch('activity/sign_success');
        }
    }
}
