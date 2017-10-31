<?php
namespace app\mobile\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Cache;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\JsApiPay;
use wxpay\NativePay;
use wxpay\PayNotifyCallBack;
use think\Log;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
use wxpay\wechatAppPay;


class User extends Base
{
    
    public function _initialize() {
        parent::_initialize();
        $noLogin = array('index','my_activity','myfavorite','my_message','refund','refund_succ','my_info','account','order_detail');
        $this->checkUserLogin($noLogin);
    }
    
    //注册
    public function register(){
        //检测是否为ajax请求
        if(request()->isAjax()){
            //手机号
            $mobile = input('post.mobile');
            if(!isMobile($mobile)){
                return return_info(-1,'请输入正确的手机号');
            }

            //手机号验证码
            $mobileCode = input('post.mobileCode');
            $code = Cache::pull($mobile);
            if($mobileCode != $code){
                return return_info(-1,'验证码输入有误');
            }
            
            //密码
            $password = input('post.password');

            //注册
            $user = model('User');
            $user->register($mobile,$password);
            //存储用户信息
            $userInfo = $user->getMobileUserInfo($mobile,'uid,headIcon,nickname,mobile');
            Session::set('userInfo',$userInfo);
            
            if (!empty(session::get('userurl'))){
                //会话中有要跳转的页面
                $url = session::get('userurl');
            }else{
                //没有要跳转的页面，则转到首页
                $url = url('mobile/activity/index');
            }             
            return return_info(200,'注册成功',array('url'=>$url));
        }else{
            return $this->fetch();
        }
    }

    /**
    *手机验证码获取
    */
    public function getVerify(){
        // 检测是否为ajax请求
        if(request()->isAjax()){
            //接收数据
            $mobile = input('mobile');
            $type = input('type');
            if(empty($type)){
                $type = 0;
            }
            if(!isMobile($mobile)){
                return return_info(-1,"手机号格式不正确！");
            }
            //检查是否存在
            $userInfo = model('user')->getMobileUserInfo($mobile,'uid');
            
            if(!empty($userInfo) & $type == 0){
                return return_info(201,"该手机号已注册,请直接登录！");
            }else{
                $msg = getMobileVerify($mobile);
                if($msg['code'] == 0){
                    return return_info(200,"成功");
                }else{
                    return return_info(-1,$msg['msg']);
                }
            }
        }else{
            return return_info(-1,'非法请求');
        }
        
    }

    //登录
    public function login(){
        // 检测是否为ajax请求
        if(request()->isAjax()){
            //手机号
            $mobile = input('post.mobile');
            if(!isMobile($mobile)){
                return return_info(-1,'请输入正确的手机号');
            }
            //密码
            $password = input('post.password');

            //检查手机号是否注册
            $user = model('user');
            $userInfo = $user->getMobileUserInfo($mobile,'uid,mobile,headIcon,nickname,password');
            if(empty($userInfo)){
                return return_info(-1,'帐号或密码错误');
            }
            //登录验证
            if(md5($password) == $userInfo['password']){
                //存储用户信息
                $data['uid'] = $userInfo['uid'];
                $data['headIcon'] = $userInfo['headIcon'];
                $data['nickname'] = $userInfo['nickname'];
                $data['mobile'] = $userInfo['mobile'];
                Session::set('userInfo',$data);
                
                if (!empty(session::get('userurl'))){
                    //会话中有要跳转的页面
                    $url = session::get('userurl');
                }else{
                    //没有要跳转的页面，则转到首页
                    $url = url('mobile/activity/index');
                } 
                return return_info(200,'登录成功',array('url'=>$url));
            }else{
                return return_info(-1,'帐号或密码错误');
            }
        }else{
//            if(session('?userInfo')){
//                $this->redirect("user/index");
//            }else{
                if(isset($_SERVER['HTTP_REFERER'])){
                    session::set('userurl',$_SERVER['HTTP_REFERER']);
                }
                return $this->fetch();
//            }
        }
    }

	//会员中心首页
    public function index(){
        //微信浏览器先获取openid
        if(is_weixin()) {
            if (Session::get('openid') == null) {
                //获取openId
                $tools = new JsApiPay();
                $openId = $tools->getOpenid();
                session::set('openid', $openId);
            }
        }
    	//获取用户信息
        $userInfo = Session::get('userInfo');
    	$uid = $userInfo['uid'];
    	$user = model('user');
    	$activity = model('activity');
    	$userInfo = $user->getIdUser($uid);
        //获取消息数量
        $message = model('message');
        $messageCount = $message->getUnReadMessageCount($uid);
        Session::set('messageCount',$messageCount);
    	
        $activityOrder = model('ActivityOrder');
        $myOrderData = $activityOrder->getMyOrder($uid);
        //订单分类:未付款2 已付款3 待评价4 退款/售后5 6
        $notPay = array();
        $havePay = array();
        $notEvaluate = array();
        $afterSale = array();
        foreach($myOrderData as $k=>$v){
            switch ($v['order_status']) {
                case 2:
                    $notPay[] = $v;
                    break;
                case 3:
                    $havePay[] = $v;
                    break;
                case 4:
                    $notEvaluate [] = $v;
                    break;
                case 5:
                    $afterSale  [] = $v;
                    break;
                case 6:
                    $afterSale  [] = $v;
                    break;
            }
        }
        
        //获取我的收藏
        $ActivityCollection = model('ActivityCollection');
        $myCollection = $ActivityCollection->myCollection($uid);
        
        $this->assign('myCollection',$myCollection);
        $this->assign('notPay',$notPay);
        $this->assign('havePay',$havePay);
        $this->assign('notEvaluate',$notEvaluate);
        $this->assign('afterSale',$afterSale);
        $this->assign('myOrderData',$myOrderData);
        $this->assign('userInfo',$userInfo);
    	return $this->fetch();
    }

    //我的活动
    public function my_activity(){
        //获取我的订单
        $uid = Session::get('userInfo.uid');
        $activityOrder = model('ActivityOrder');
        $myOrderData = $activityOrder->getMyOrder($uid);
        //订单分类:未付款2 已付款3 待评价4 退款/售后5 6
        $notPay = array();
        $havePay = array();
        $notEvaluate = array();
        $afterSale = array();
        foreach($myOrderData as $k=>$v){
            switch ($v['order_status']) {
                case 2:
                    $notPay[] = $v;
                    break;
                case 3:
                    $havePay[] = $v;
                    break;
                case 4:
                    $notEvaluate [] = $v;
                    break;
                case 5:
                    $afterSale  [] = $v;
                    break;
                case 6:
                    $afterSale  [] = $v;
                    break;
            }
        }
        $this->assign('notPay',$notPay);
        $this->assign('havePay',$havePay);
        $this->assign('notEvaluate',$notEvaluate);
        $this->assign('afterSale',$afterSale);
        $this->assign('myOrderData',$myOrderData);
        $this->assign('title','我的活动');
    	return $this->fetch();
    }

    //我的收藏
    public function my_collect(){
        $uid = Session::get('userInfo.uid');
        $activityCollection = model('ActivityCollection');
        //获取我收藏的活动
        $collectionData = $activityCollection->myCollection($uid);
        
        $this->assign('collectionData',$collectionData);
        $this->assign('title','我的收藏');
    	return $this->fetch();
    }

    //订单消息
    public function order_message(){
        $uid = Session::get('userInfo.uid');
        //消息改为已读
        $message = model('message');
        $message->saveStatus($uid);
        
        //清空消息数
        session('messageCount',null);
        
        //获取我的消息
        $map['uid'] = $uid;
        $map['type'] = 1;
        $messageInfo = $message->getMessages($map);
        
        $this->assign('messageInfo',$messageInfo);
    	return $this->fetch();
    }
    
    //系统消息
    public function systems_message(){
        $uid = Session::get('userInfo.uid');
        //消息改为已读
        $message = model('message');
        $message->saveStatus($uid);
        
        //清空消息数
        session('messageCount',null);
        
        //获取我的消息
        $map['uid'] = $uid;
        $map['type'] = 2;
        $messageInfo = $message->getMessages($map);
        
        $this->assign('messageInfo',$messageInfo);
    	return $this->fetch();
    }
    
    //更新消息条数
    public function messageCount(){
        $uid = Session::get('userInfo.uid');
        $message = model('message');
        $count = $message->getUnReadMessageCount($uid);
        Session::set('messageCount', $count);
        return_info(200,'请求成功',$count);
    }
    
    //评论展示
    public function comments_list(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input("order_sn");

        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $order_field = 'uid,order_sn,aid';
        $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$order_field);
        if($order_info['uid'] != $uid){
            $this->error('订单异常');
        }
        $this->assign('title','评价内容');
        $this->assign('order_info',$order_info);
        return $this->fetch();
    }
    
    //请假展示
    public function leave_list(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input("order_sn");

        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $order_field = 'uid,order_sn,aid';
        $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$order_field);
        if($order_info['uid'] != $uid){
            $this->error('订单异常');
        }
        $this->assign('title','请假列表');
        $this->assign('order_info',$order_info);
        return $this->fetch();
    }
    
    //退款1
    public function refund(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input("order_sn");
        
        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $order_field = 'uid,aid,order_price,order_sn';
        $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$order_field);
        if($order_info['uid'] != $uid){
            $this->error('订单异常');
        }
        $this->assign('title','申请退款');
        $this->assign('order_info',$order_info);
        return $this->fetch();
    }
    
    //退款提交
    public function submit_refund(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input("post.order_sn");
        //活动id
        $aid = input("post.aid");
        //请假理由
        $reason = input("post.reason");            


        $ActivityRefund = model('ActivityRefund');
        //查看订单是否已操作过
        $refundInfo = $ActivityRefund->getSnAnyOneRefund($order_sn);
        if(!empty($refundInfo)){
            $this->error('请勿重复提交订单');
        }
        //插入请假
        $ActivityRefund->addRefund($uid,$aid,$reason,$order_sn);

        //修改订单状态
        $ActivityOrder = model('ActivityOrder');
        $ActivityOrder->setOrderStatus($order_sn,5);

        $this->redirect('/mobile/user/refund2/order_sn/'.$order_sn);
    }
    
    //退款处理中2
    public function refund2(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input("order_sn");

        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $order_field = 'uid,order_price,pay_way,pay_time,order_status,addtime';
        $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$order_field);
        if($order_info['uid'] != $uid){
            $this->error('订单异常');
        }
        //获取退款信息
        $ActivityRefund = model('ActivityRefund');
        $field = 'reason,time';
        $refundData = $ActivityRefund->getSnAnyOneRefund($order_sn,$field);

        $this->assign('order_info',$order_info);
        $this->assign('reason',$refundData['reason']);
        $this->assign('order_sn',$order_sn);
        $this->assign('addtime',$refundData['time']);
        $this->assign('url',url('mobile/user/index'));
        $this->assign('title','退款处理中');
        return $this->fetch();
    }
    
    //新增请假
    public function leave(){
        if(request()->isAjax()){
            //用户id
            $uid = Session::get('userInfo.uid');
            //订单号
            $order_sn = input("post.order_sn");
            //活动id
            $aid = input("post.aid");
            //请假理由
            $reason = input("post.reason");            

            //插入请假
            $ActivityRefund = model('ActivityRefund');
            $addtime = $ActivityRefund->addLeave($uid,$aid,$reason,$order_sn);

            //修改订单状态
            $ActivityOrder = model('ActivityOrder');
            $ActivityOrder->setOrderStatus($order_sn,7);

            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }
    
    //已退款
    public function refund_succ(){
        //用户id
        $uid = Session::get('userInfo.uid');
        //订单号
        $order_sn = input("order_sn");

        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $order_field = 'order_price';
        $order_info = $ActivityOrder->getSnOrderInfo($order_sn,$order_field);
        
        $this->assign('order_info',$order_info);
        $this->assign('order_sn',$order_sn);
        return $this->fetch();
    }
    
    //用户信息展示
    public function my_info(){
        //用户id
        $uid = Session::get('userInfo.uid');
        
        //获取用户信息
        $user = model('user');
        $userInfo = $user->getIdUser($uid);
        
        //获取省级数据
        $region = model('region');
        $province = $region->getAnyLevelData(1);
        
        //获取市级数据
        $city = array();
        if($userInfo['province'] > 0){
            $city = $region->getSonData($userInfo['province']);
        }
        //获取区级数据
        $district = array();
        if($userInfo['city'] > 0){
            $district = $region->getSonData($userInfo['city']);
        }
        $this->assign('userInfo',$userInfo);
        $this->assign('city',$city);
        $this->assign('district',$district);
        $this->assign('province',$province);
        $this->assign('title','用户信息');
        return $this->fetch();
    }
    
    //修改用户信息
    public function saveUserInfo(){
        //接收数据
        $uid = Session::get('userInfo.uid');
        $nickname = input('post.nikename');
        $sex = input('post.sex');
        $birthday = input('post.birthday');
        $email = input('post.email');
        $hobby = input('post.hobby');
        $prov = input('post.prov');
        $city = input('post.city');
        $district = input('post.district');
        $address = input('post.address');

        //数据组合修改
        $data['nickname'] = $nickname;
        $data['sex'] = $sex;
        $data['birthday'] = time($birthday);
        $data['email'] = $email;
        $data['hobby'] = $hobby;
        $data['province'] = $prov;
        $data['city'] = $city;
        $data['district'] = $district;
        $data['address'] = $address;

        $user = model('user');
        $result = $user->saveUserInfo($uid,$data);
        if($result){
            Session::set('userInfo.nickname',$data['nickname']);
            echo "<script>alert('修改成功');window.location.href='index'</script>";
        }else{
            $this->error('数据错误');
        }
    }    

    //帐号管理
    public function account(){
        return $this->fetch();
    }

    //修改绑定手机
    public function bindingPhone(){
        if(request()->isAjax()){
            //获取参数
            $uid = Session::get('userInfo.uid');
            $mobile = input('post.mobile');
            //检查验证码
            $mobileCode = input('post.mobileCode');
            $code = Cache::pull($mobile);
            if($mobileCode != $code){
                return return_info(-1,'验证码输入有误');
            }
            $data['mobile'] = $mobile;
            $user = model('user');
            $user->saveUserInfo($uid,$data);
            session::set('userInfo.mobile',$mobile);
            return_info(200,'修改成功');
        }  else {
            return_info(-1,'非法请求');
        }
    }
    
    //修改绑定手机
    public function savePwd(){
        if(request()->isAjax()){
            //获取参数
            $uid = Session::get('userInfo.uid');
            $newPwd = input('post.newPwd');
            $mobile = input('post.mobile');
            //检查验证码
            $mobileCode = input('post.mobileCode');
            $code = Cache::pull($mobile);
            if($mobileCode != $code){
                return return_info(-1,'验证码输入有误');
            }
            $data['password'] = md5($newPwd);
            $user = model('user');
            $user->saveUserInfo($uid,$data);
            return_info(200,'修改成功');
        }  else {
            return_info(-1,'非法请求');
        }
    }
    
    //订单详情
    public function order_detail($order_sn){
        //用户id
        $uid = Session::get('userInfo.uid');
        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $orderInfo = $ActivityOrder->getSnOrderInfo($order_sn);
        if($orderInfo['uid'] != $uid){
            $this->error('订单异常');
        }
        //获取活动信息
        $Activity = model('Activity');
        $field = 'aid,a_title,a_index_img,a_address,a_begin_time,a_end_time';
        $ActivityInfo = $Activity->getIdActivity($orderInfo['aid'],$field);
        if(empty($ActivityInfo)){
            $this->error('活动结束,订单已失效');
        }
        
        $this->assign('orderInfo',$orderInfo);
        $this->assign('ActivityInfo',$ActivityInfo);
        $this->assign('title','订单详情');
        return $this->fetch();
    }

    //充值
    public function recharge(){
        if(!is_weixin()){
            $this->assign('msg','请在微信下进行充值哦');
            return $this->fetch('public/prompt');
        }
    	$this->assign('title','用户充值');
        return $this->fetch();
    }

    //充值确认
    public function enter_recharge(){
        //金额
        $money = input('post.money');
        //检查金额
        if(!is_numeric($money)){
            $this->error('金额输入不正确');
        }

        $uid = Session::get('userInfo.uid');
        //获取openid
        $openId = session::get('openid');
        //增加订单
        $add_data['uid'] = $uid;
        $add_data['amount'] = $money;
        $add_data['pay_way'] = 2;
        $add_data['pay_time'] = time();
        $add_data['status'] = 0;
        $add_data['order_sn'] = getOrderSn($uid,000);
        $id = model('RechargeRecord')->insertGetId($add_data);
        if($id){
            //微信下单
            $tools = new JsApiPay();
            $input = new WxPayUnifiedOrder();
            $input->setBody("玩翫碗余额充值");
            $input->setAttach("玩翫碗余额充值");
            $input->setOutTradeNo($add_data['order_sn']);   //订单号
            $input->setTotalFee($money * 100);  //价格
            $input->setTimeStart(date("YmdHis"));   //生成时间
            $input->setNotifyUrl("http://www.baobaowaner.com"); //设置回调地址
            $input->setTradeType("JSAPI");
            $input->setOpenid($openId);
            $orders = WxPayApi::unifiedOrder($input);
            $jsApiParameters = $tools->getJsApiParameters($orders);
        }
        $this->assign('order_sn',$add_data['order_sn']);
        $this->assign('jsApiParameters', $jsApiParameters);
        return $this->fetch();
    }

    //充值成功
    public function recharge_success($order_sn){
        //获取充值信息
        $map['order_sn'] = $order_sn;
        $rechargeInfo = model('RechargeRecord')->getRecharge($map);

        //检查用户
        $userInfo = model('user')->getIdUser($rechargeInfo['uid']);

        if(empty($rechargeInfo) || empty($userInfo)){
            $this->error('参数错误');
        }

        //查询订单
        $notify = new PayNotifyCallBack();
        $notify->handle(true);
        $result = $notify->queryTradeOrder($order_sn);
        if($result){
            //增加余额
            $userInfo->balance = $userInfo->balance + $rechargeInfo['amount'];
            $userInfo->save();
            $this->assign('url',url('mobile/user/index'));
            $this->assign('title','充值成功');
            return $this->fetch();
        }else{
            $this->error('支付失败,有疑问请联系客服');
        }
    }
    
    //忘记密码
    public function forget_pwd(){
        return $this->fetch();
    }
    
    //忘记密码2
    public function reset_pwd(){
        return $this->fetch();
    }

    //隐私保护
    public function privacy(){
        return $this->fetch('footer/privacy');
    }

    //免责申明
    public function disclaimer(){
        return $this->fetch('footer/disclaimer');
    }

    //版权声明
    public function copy(){
        return $this->fetch('footer/copy');
    }

    //会员条款
    public function user(){
        return $this->fetch('footer/user');
    }
}
