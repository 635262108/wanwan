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
    
//    public function _initialize() {
//        parent::_initialize();
//        $noLogin = array('activity_sure');
//        $this->checkUserLogin($noLogin);
//    }
    
    //活动界面
    public function index($set = 1){
        
        $ActivityType = model('ActivityType');
        //获取标题
        $titleSon = $ActivityType->getTitleSon($set);
        
        //获取字段
    	$field = 'aid,a_index_img,a_title,a_remark,a_type';
        //获取活动信息
        $Activity = model('Activity');
        $ActivityInfo = array();
        foreach ($titleSon as $k=>$v){
            $ActivityInfo[] = $Activity->getActivity($v['id'],3,$field);
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
        //获取banner图
        $map['type_id'] = $set;
        $banner = Db::table('mfw_activity_type_banner')->where($map)->select();
        
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
        $this->assign('collections',$collections);
        $this->assign('banner',$banner);
        $this->assign('titleInfo',$titleInfo);
        $this->assign('result',$result);
    	$this->assign('titleSon',$titleSon);
    	return $this->fetch();
    }

    //活动详情页（点击报名进入详情页）
    public function detail(){
    	$aid = input('aid');
    	$Activity = model('Activity');
    	$ActivityComments = model('ActivityComments');
    	$Goods = model('Goods');
    	$ActivityExtension = model('ActivityExtension');
    	//获取活动信息
    	$a_field = 'aid,a_img,a_address,a_begin_time,a_end_time,a_adult_price,a_child_price,a_status,a_content';
    	$activityInfo = $Activity->getIdActivity($aid,$a_field);
    	//获取活动评论
    	$commentInfo = $ActivityComments->getActivityComment($aid);
    	//获取活动玩翫答疑
    	$questionCommentInfo = $ActivityComments->getActivityQuestionComment($aid);
        //答疑问题和答案分开
        $question = array();
        $answer = array();
        foreach($questionCommentInfo as $key=>$val){
            if($val['reply_id'] == 0){
                $question[] = $val;
            }else{
                $answer[] = $val;
            }
        }
    	//获取推荐活动
    	$recommendInfo = $Activity->getRecommendInfo();
    	//获取相关活商品
    	$goodsInfo = $Goods->getRelatedGoods($aid);
    	//获取活动扩展信息
    	$extensionInfo = $ActivityExtension->getExtensionInfo($aid);
        //查看是否收藏
        $uid = Session::get("userInfo.uid");
        $activityCollection = model('ActivityCollection');
        $isCollection = $activityCollection->isCollection($aid,$uid);

        $this->assign('activityInfo',$activityInfo);
        $this->assign('isCollection',$isCollection);
    	$this->assign('commentInfo',$commentInfo);
    	$this->assign('question',$question);
        $this->assign('answer',$answer);
    	$this->assign('recommendInfo',$recommendInfo);
    	$this->assign('goodsInfo',$goodsInfo);
    	$this->assign('extensionInfo',$extensionInfo);
    	return $this->fetch();
    }

    //填写订单界面
    public function activity_sure(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //活动id
        $aid = input('get.aid');
        //大人数量
        $adult_num = input('get.adult_num');
        //小孩数量
        $child_num = input('get.child_num');
        //参加时间
        $time = input('get.time');
        if(isset($time)){
            //检查参加时间是否还有票
            $ActivityTime = model('ActivityTime');
            $timeInfo = $ActivityTime->getAnyTime($time);
            if($timeInfo['ticket_num'] <= 0){
                $this->error('您选择的时间段已无名额');
            }
        }
        //检查接收数据
        $checkData['aid'] = $aid;
        $checkData['adult_num'] = $adult_num;
        $checkData['child_num'] = $child_num;
        $check = $this->validate($checkData,'Activity');
        if(true !== $check){
            $this->error($check);
        }
        //检查活动名额
        $Activity = model('Activity');
        $ActivityInfo = $Activity->getIdActivity($aid,'aid,a_title,a_sign_begin_time,a_sign_end_time,a_num,a_index_img,a_adult_price,a_child_price');
        //获取活动时间
        $ActivityTime = model('ActivityTime');
        $timeInfo = $ActivityTime->getAnyTime($time);
        
        if($ActivityInfo->a_num > 0){
            $this->assign('ActivityInfo',$ActivityInfo);
            $this->assign('adult_num',$adult_num);
            $this->assign('child_num',$child_num);
            $this->assign('timeInfo',$timeInfo);
            return $this->fetch();
        }else{
            $this->error("本活动报名已满");
        }
        
    }

    /**
     * 订单提交
     */
    public function creat_order(){
        if(request()->isPost()){
            //用户id
            $uid = Session::get('userInfo.uid');
            //活动id
            $aid = input('post.aid');
            //联系人姓名
            $realname = input('post.realname');
            //联系人电话
            $mobile = input('post.mobile');
            if(!isMobile($mobile)){
                $this->error("手机格式不正确");
            }
            //大人数量
            $adult_num = input('post.adult_num');
            //小孩数量
            $child_num = input('post.child_num');
            //小孩性别
            $child_gender = input('post.child_gender/a');
            //小孩姓名
            $child_name = input('post.child_name/a');
            //小孩生日
            $child_birthday = input('post.child_birthday/a');
            //订单备注
            $remark = input('post.remark');
            //参加时间
            $time = input('post.time');
            //token防止重复提交
            $token = input("post.token");
            if(Session::get('__token__') == $token){
                Session::set('__token__',null);
            }else{
                $this->error("系统异常,请再试一次");
            }
            //检查提交信息
            $checkData['aid'] = $aid;
            $checkData['adult_num'] = $adult_num;
            $checkData['child_num'] = $child_num;
            $checkData['remark'] = $remark;
            $check = $this->validate($checkData,'Activity');
            if(true !== $check){
                $this->error($check);
            }
            //获取活动信息
            $Activity = model('Activity');
            $activityInfo = $Activity->getIdActivity($aid,'a_adult_price,a_child_price,aid,a_title,a_sign_begin_time,a_sign_end_time,a_num,a_index_img,a_price');
            //免费活动time字段必须传
            if($activityInfo['a_price'] == 0){
                if(!isset($time)){
                    $this->error("参数不完整");
                }
            }
            //检查活动名额
            if($activityInfo['a_num'] > 0){
                //算订单价格
                $order_price = $adult_num*$activityInfo['a_adult_price']+$child_num*$activityInfo['a_child_price'];

                //增加订单
                $ActivityOrder = model('ActivityOrder');
                $result = $ActivityOrder->addActivityOrder($uid,$aid,$realname,$mobile,$order_price,$adult_num,$child_num,$remark,$time);

                //增加孩子
                $ActivityOrderPersonnel = model('ActivityOrderPersonnel');
                $personnelIds = '';
                for($i=0;$i<$child_num;$i++){
                    $personnelId = $ActivityOrderPersonnel->addChild($child_name[$i],$child_birthday[$i],$child_gender[$i],$result['activityOrderId'],$uid);
                    $personnelIds .= $personnelId.",";
                }
                
                //免费活动直接条支付成功
                if($order_price == 0){
                    $order['aid'] =  $aid;
                    $order['child_num'] = $child_num;
                    $order['adult_num'] = $adult_num;
                    $order['order_price'] = $order_price;
                    //库存-1
                    $Activity->DecActivity($aid);
                    //报名人员+1
                    $Activity->IncActivity($aid);
                    //时间库存票数-1
                    $ActivityTime = model('ActivityTime');
                    $ActivityTime->DecTicketNum($time);
                    //给用户发送一条消息
                    $aid = $order['aid'];
                    $url = url('activity/free_detail',['aid'=>$aid]);
                    $content = "您报名的<a href='".$url."'>".$activityInfo['a_title']."</a>活动付款成功,请您注意活动参与时间!";
                    $message = model('Message');
                    $message->sendMessage($uid,$content,1);    
                    
                    $this->assign('order',$order);
                    $this->assign('activityInfo',$activityInfo);
                    return $this->fetch('activity/pay_success');
                }
                
                //给用户发送一条消息
                $url = url('activity/detail',['aid'=>$aid]);
                $content = "您报名的<a href='".$url."'>".$activityInfo['a_title']."</a>活动未付款,名额有限,请及时付款!";
                $message = model('Message');
                $message->sendMessage($uid,$content,1);
                                
                $this->assign('adult_num',$adult_num);
                $this->assign('child_num',$child_num);
                $this->assign('order_price',$order_price);
                $this->assign('activityInfo',$activityInfo);
                $this->assign('order_sn',$result['order_sn']);
            }else{
                $this->error("本次活动已报满");
            }
        }else{
            //用户id
            $uid = Session::get('userInfo.uid');
            //活动id
            $order_sn = input('order_sn');
            
            //获取订单信息
            $ActivityOrder = model('ActivityOrder');
            $field = 'aid,uid,adult_num,child_num,order_price';
            $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$field);
            if($order_info['uid'] != $uid){
                $this->error("无效订单");
            }
            $this->assign('order_sn',$order_sn);
        }
        
        return $this->fetch('activity/select_pay');
    }

    /**
    *支付
    */
    public function payWay(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input('order_sn');
        //支付方式1：支付宝 2：微信 3：银联
        $bank_type = input('bank_type');
        
        $ActivityOrder = model('ActivityOrder');
        $order = $ActivityOrder->getSnOrderInfo($order_sn,'uid,order_price,pay_time');
        if($order['uid'] != $uid){
            $this->error("无效订单");
        }
        if($bank_type == 1){
            //订单号
            $params['out_trade_no'] = $order_sn;
            //订单标题
            $params['subject'] = '玩翫碗活动报名';
            //订单金额
            $params['total_amount'] = $order['order_price'];
            \alipay\Wappay::pay($params);
        }
        else if($bank_type == 2){
            //生成支付码
            $code_url = $this->wxpayQRCode($order_sn);

            $this->assign('code_url',$code_url);
            $this->assign('order_sn',$order_sn);
            $this->assign('order_price',$order['order_price']);
            return $this->fetch('wxpay');
        }
        else{
            $this->error("参数错误,请勿刷新页面");
        }
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
            
            //给用户发送一条消息
            $aid = $order['aid'];
            $Activity = model('Activity');
            $activityInfo = $Activity->getIdActivity($aid,'a_title');
            $url = url('activity/detail',['aid'=>$aid]);
            $content = "您报名的<a href='".$url."'>".$activityInfo['a_title']."</a>活动付款成功,请您注意活动参与时间!";
            $message = model('Message');
            $message->sendMessage($order['uid'],$content,1);
            
            //库存-1
            $Activity->DecActivity($aid);
            //报名人员+1
            $Activity->IncActivity($aid);            
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

                    //库存-1
                    $Activity->DecActivity($aid);
                    //报名人员+1
                    $Activity->IncActivity($aid);
                    
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
     * 微信手机端网站支付（H5支付）
     * @param $order_sn
     */
    public function wxpayQRCode($order_sn)
    {
        $activityOrder = model('ActivityOrder');
        $order = $activityOrder->getSnOrderInfo($order_sn,'order_price,pay_time');
        if(empty($order)){
            $this->error('订单号不正确');
        }
        $appid =  config('wxpay.app_id');
        $mch_id = config('wxpay.mch_id');//商户号
        $key = config('wxpay.key');//商户key
        $notify_url = "http://www.baobaowaner.com/public/index.php/home/Activity/notify/order_sn/".$order_sn;//回调地址
        $wechatAppPay = new wechatAppPay($appid, $mch_id, $notify_url, $key);
        $params['body'] = '玩翫碗活动报名';                       //商品描述
        $params['out_trade_no'] = $order_sn;    //自定义的订单号
        $params['total_fee'] = '1';                       //订单金额 只能为整数 单位为分
        $params['trade_type'] = 'MWEB';                   //交易类型 JSAPI | NATIVE | APP | WAP 
        $params['scene_info'] = '{"h5_info": {"type":"Wap","wap_url": "https://api.lanhaitools.com/wap","wap_name": "蓝海工具商城"}}';
        $result = $wechatAppPay->unifiedOrder( $params );
        var_dump($result);die;
        $url = $result['mweb_url'].'&redirect_url=http://www.baobaowaner.com/';//redirect_url 是支付完成后返回的页面
        return $url;
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

    //支付成功
    public function pay_success($order_sn = ''){
        //获取活动信息
        $activityOrder = model('ActivityOrder');
        $order = $activityOrder->getSnOrderInfo($order_sn,'aid,child_num,adult_num,order_price');
        if(!isset($order)){
            exit('参数错误');
        }
        $aid = $order['aid'];
        $activityInfo = model('Activity')->getIdActivity($aid,'a_title,a_sign_begin_time,a_sign_end_time,a_index_img');

        $this->assign('order',$order);
        $this->assign('activityInfo',$activityInfo);
        return $this->fetch();
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
        
        $this->assign('timeInfo',$timeInfo);
        $this->assign('activityInfo',$activityInfo);
        $this->assign('commentInfo',$commentInfo);
        return $this->fetch();
    }
    
    //关于我们
    public function about() {
        return $this->fetch();
    }
}
