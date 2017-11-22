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
        $noLogin = array();
        $this->checkUserLogin($noLogin);
    }

    //最新活动
    public function new_activity(){
        //获取活动信息
        $actInfo = model('Activity')->getActivityAll('*','0','10');
        $this->assign('actInfo',$actInfo);
        return $this->fetch();
    }

    //活动界面
    public function index($set = 26){
        
        $ActivityType = model('ActivityType');
        //获取标题
        $titleSon = $ActivityType->getTitleSon($set);
        
        //获取字段
    	$field = 'aid,a_index_img,a_title,a_remark,a_type,a_begin_time,a_end_time,a_address,a_price,a_sold_num,a_num';
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
    	$Goods = model('Goods');
    	$ActivityExtension = model('ActivityExtension');
    	//获取活动信息
    	$a_field = 'aid,a_title,a_index_img,a_remark,a_price,a_img,a_address,a_begin_time,a_end_time,a_adult_price,a_child_price,a_status,a_content';
    	$activityInfo = $Activity->getIdActivity($aid,$a_field);
    	//获取活动评论
    	$commentInfo = $ActivityComments->getActivityComment($aid);

    	//获取活动扩展信息
    	$extensionInfo = $ActivityExtension->getExtensionInfo($aid);
        //查看是否收藏
        $uid = Session::get("userInfo.uid");
        $activityCollection = model('ActivityCollection');
        $isCollection = $activityCollection->isCollection($aid,$uid);

        //时间信息
        $map = [
            'aid' => $aid,
            'is_display'=> 1,
        ];
        $timeInfo = model('ActivityTime')->where($map)->select();

        $this->assign('timeInfo',$timeInfo);
        $this->assign('activityInfo',$activityInfo);
        $this->assign('isCollection',$isCollection);
    	$this->assign('commentInfo',$commentInfo);
    	$this->assign('extensionInfo',$extensionInfo);
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
        $aid = input('post.aid');
        //大人数量
        $adult_num = input('post.adult_num');
        //小孩数量
        $child_num = input('post.child_num');
        //参加时间
        $time = input('post.time');

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

        //订单入库
        $price = $adult_num*$ActivityInfo['a_adult_price']+$child_num*$ActivityInfo['a_child_price'];
        if(!empty(cookie('orderInfo'))){//存在
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',cookie('orderInfo'));
            $this->assign('title','选择支付');
            return $this->fetch('activity/select_pay');
        }
        $add_oreder_data = array();
        $add_oreder_data['order_sn'] = getOrderSn($uid,$aid);
        $add_oreder_data['aid'] = $aid;
        $add_oreder_data['uid'] = $uid;
        $add_oreder_data['mobile'] = $userInfo['mobile'];
        $add_oreder_data['name'] = $userInfo['nickname'];
        $add_oreder_data['adult_num'] = $adult_num;
        $add_oreder_data['child_num'] = $child_num;
        if($price > 0){//免费活动不需要支付,订单状态为已付款
            $add_oreder_data['order_status'] = 2;
        }else{
            $add_oreder_data['order_status'] = 3;
        }

        $add_oreder_data['addtime'] = time();
        $add_oreder_data['t_id'] = $time;
        $add_oreder_data['source'] = 1;
        $add_oreder_data['order_price'] = $price;
        model('ActivityOrder')->insert($add_oreder_data);

        //存cookie,防止用户刷新重复提交
        cookie('orderInfo',$add_oreder_data,60*60*5);

        //免费活动不需要支付，直接报名成功，付费活动进入选择支付界面
        if($price > 0){
            //微信浏览器只支持js支付，单独一个界面
            if(is_weixin()){
                //session记录订单
                session::set($uid,$add_oreder_data['order_sn']);
                //跳转到wx_browser_pay
                $this->redirect('activity/wx_browser_pay');
            }
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$add_oreder_data);
            $this->assign('title','选择支付');
            return $this->fetch('activity/select_pay');
        }else{
            //报名成功，减少总名额和时间名额，增加报名人数，人员数量以小孩数量为准
            model('acticity')->where('aid', $aid)->setDec('a_num', $child_num);
            model('acticity')->where('aid', $aid)->setInc('a_sold_num', $child_num);
            $ActivityTime->where('t_id', $time)->setInc('ticket_num', $child_num);
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$add_oreder_data);
            return $this->fetch('activity/pay_success');
        }
    } 

    //使用订单id付款
    public function orderIdPay(){
        $uid = Session::get('userInfo.uid');
        $orderId = input('id');
        $map['uid'] = $uid;
        $map['order_id'] = $orderId;
        $orderInfo = model('ActivityOrder')->where($map)->find();
        if(empty($orderInfo)){
            $this->error('订单错误');
        }
        $aid = $orderInfo['aid'];
        $ActivityInfo = model('Activity')->find($aid);
        //微信浏览器只支持js支付，单独一个界面
        if(is_weixin()){
            //session记录订单
            session::set($uid,$orderInfo['order_sn']);
            //跳转到wx_browser_pay
            $this->redirect('activity/wx_browser_pay');
        }
        $this->assign('price',$orderInfo['order_price']);
        $this->assign('activityInfo',$ActivityInfo);
        $this->assign('orderInfo',$orderInfo);
        $this->assign('title','选择支付');
        return $this->fetch('activity/select_pay');
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
            $child_gender[] = input('post.child_gender1');
            $child_gender[] = input('post.child_gender2');
            //小孩姓名
            $child_name = input('post.child_name/a');
            //小孩生日
            $year = input('post.year/a');
            $month = input('post.month/a');
            $day = input('post.day/a');
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
            }else{
                $time = 0;
            }
            //检查活动名额
            if($activityInfo['a_num'] > 0){
                //算订单价格
                $order_price = $adult_num*$activityInfo['a_adult_price']+$child_num*$activityInfo['a_child_price'];

//                //相同的活动中一个手机号只能报一次
                $ActivityOrder = model('ActivityOrder');
//                $map['aid'] = $aid;
//                $map['mobile'] = $mobile;
//                $map['order_status'] = array('or','2,3');
//                $check_order = $ActivityOrder->getOrder($map);
//                if(!empty($check_order)){
//                    $this->error('相同的手机号不能重复报名哦,如果已报名请去会员中心进行下一步操作');
//                }
                //增加订单
                $result = $ActivityOrder->addActivityOrder($uid,$aid,$realname,$mobile,$order_price,$adult_num,$child_num,$remark,$time);

                //增加孩子
                $ActivityOrderPersonnel = model('ActivityOrderPersonnel');
                $personnelIds = '';
                //如果填写的有孩子的信息就保存
                for($i=0;$i<$child_num;$i++){
                    if(!empty($child_name[$i])){
                        $child_birthday = $year[$i]."/".$month[$i]."/".$day[$i];
                        $personnelId = $ActivityOrderPersonnel->addChild($child_name[$i],$child_birthday,$child_gender[$i],$result['activityOrderId'],$uid);
                        $personnelIds .= $personnelId.",";
                    }
                }

                //免费活动直接条支付成功
                if($order_price == 0){
                    $order['aid'] =  $aid;
                    $order['child_num'] = $child_num;
                    $order['adult_num'] = $adult_num;
                    $order['order_price'] = $order_price;
                    $order['order_sn'] = $result['order_sn'];
                    //库存-1
                    $Activity->DecActivity($aid);
                    //报名人员+1
                    $Activity->IncActivity($aid);
                    //时间库存票数-1
                    $ActivityTime = model('ActivityTime');
                    $ActivityTime->DecTicketNum($time);
                    //给用户发送一条消息
                    $aid = $order['aid'];
                    $url = url('home/activity/free_detail',['aid'=>$aid]);
                    $content = "您报名的<a href='".$url."'>".$activityInfo['a_title']."</a>活动付款成功,请您注意活动参与时间!";
                    $message = model('Message');
                    $message->sendMessage($uid,$content,1);

                    $this->assign('order',$order);
                    $this->assign('activityInfo',$activityInfo);
                    $this->assign('title','报名成功');
                    return $this->fetch('activity/pay_success');
                }

                //微信浏览器支付
                if(is_weixin()){
                    //session记录订单
                    session::set($uid,$result['order_sn']);
                    //跳转到wx_browser_pay
                    $this->redirect('activity/wx_browser_pay');
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

            //微信浏览器支付
            if(is_weixin()){
                //session记录订单
                session::set($uid,$order_sn);
                //跳转到wx_browser_pay
                $this->redirect('activity/wx_browser_pay');
            }
            //获取订单信息
            $ActivityOrder = model('ActivityOrder');
            $field = 'aid,uid,adult_num,child_num,order_price';
            $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$field);
            if($order_info['uid'] != $uid){
                $this->error("无效订单");
            }
            $this->assign('order_sn',$order_sn);
        }
        $this->assign('title','选择支付');
        return $this->fetch('activity/select_pay');
    }
       
    //微信浏览器支付
    public function wx_browser_pay(){
        //获取订单信息
        $uid = Session::get('userInfo.uid');
        $order_sn = Session::get($uid);
        $ActivityOrder = model('ActivityOrder');
        $order = $ActivityOrder->getSnOrderInfo($order_sn);

        //获取活动信息
        $Activity = model('Activity');
        $activityInfo = $Activity->getIdActivity($order['aid'],'aid,a_title,a_address,a_begin_time,a_end_time');

        //获取用户openid
        $openId = session::get('openid');

        //统一下单
        $tools = new JsApiPay();
        $money = $order['order_price'];
        $input = new WxPayUnifiedOrder();
        $input->setBody("玩翫碗活动报名");
        $input->setAttach("玩翫碗活动报名");
        $input->setOutTradeNo($order_sn);   //订单号
        $input->setTotalFee($money * 100);  //价格
        $input->setTimeStart(date("YmdHis"));   //生成时间
        $input->setTradeType("JSAPI");
        $input->setOpenid($openId);
        $input->setNotifyUrl("http://www.baobaowaner.com/home/Activity/notify/order_sn/".$order_sn); //设置回调地址
        $orders = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->getJsApiParameters($orders);
        $this->assign('jsApiParameters', $jsApiParameters);
        $this->assign('order', $order);
        $this->assign('activityInfo', $activityInfo);
        $this->assign('title','微信支付');
        return $this->fetch('activity/wx_cli_pay');
    }
    
    /**
    *支付
    */
    public function payWay(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input('post.order_sn');
        //支付方式1：支付宝 2：微信 3：银联
        $bank_type = input('post.bank_type');

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

            $this->redirect($code_url);
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
        $notify_url = "http://www.baobaowaner.com/home/Activity/notify/order_sn/".$order_sn;//回调地址
        $wechatAppPay = new wechatAppPay($appid, $mch_id, $notify_url, $key);
        $params['body'] = '玩翫碗活动报名';                       //商品描述
        $params['out_trade_no'] = $order_sn;    //自定义的订单号
        $params['total_fee'] = $order['order_price']*100;                       //订单金额 只能为整数 单位为分
        $params['trade_type'] = 'MWEB';                   //交易类型 JSAPI | NATIVE | APP | WAP 
        $params['scene_info'] = '{"h5_info": {"type":"Wap","wap_url": "https://api.lanhaitools.com/wap","wap_name": "玩翫碗活动报名"}}';
        $result = $wechatAppPay->unifiedOrder( $params );
        $url = $result['mweb_url'].'&redirect_url=http://www.baobaowaner.com/mobile/Activity/pay_success/order_sn/'.$order_sn;//redirect_url 是支付完成后返回的页面
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

    //微信支付跳转
    public function pay_success($order_sn = ''){
        //获取活动信息
        $activityOrder = model('ActivityOrder');
        $order = $activityOrder->getSnOrderInfo($order_sn,'order_sn,aid,child_num,adult_num,order_price,order_status');
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
            $this->assign('order',$order);
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
