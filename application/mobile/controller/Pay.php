<?php
namespace app\mobile\controller;

use think\Exception;
use wxpay\database\WxPayRefund;
use wxpay\database\WxPayResults;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\JsApiPay;
use wxpay\NativePay;
use wxpay\PayNotifyCallBack;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
use \think\Session;
use wxpay\wechatAppPay;

class Pay extends Base
{

    //选择支付
    public function pay_way(){
        //用户id
        $uid = session('userInfo.uid');
        //订单号
        $orderId = input('get.orderId');
        //支付方式1：支付宝 2：微信 3：银联 4:余额
        $bank_type = input('get.bank_type');

        $order = model('ActivityOrder')->find($orderId);

        //如果会员没选择余额支付，按原价支付
        $userInfo = model('User')->find($uid);
        if($userInfo['member_grade'] == 1 && $bank_type != 4){
            $activityInfo = model('Activity')->find($order['aid']);
            $price = $activityInfo['a_adult_price']*$order['adult_num'] + $activityInfo['a_child_price']*$order['child_num'];
            $order->order_price = $price;
            $order->save();
        }

        if($order['uid'] != $uid){
            $this->error("无效订单");
        }
        if($bank_type == 1){
            //订单号
            $params['out_trade_no'] = $order->order_sn;
            //订单标题
            $params['subject'] = '玩翫碗活动报名';
            //订单金额
            $params['total_amount'] = $order->order_price;
            \alipay\Wappay::pay($params);
        }else if($bank_type == 2){

            $this->redirect('pay/wxWapPay',['orderId'=>$orderId]);

        }else if($bank_type == 4){

           $this->redirect('pay/balance_pay',['orderId'=>$orderId]);

        }else{
            $this->error("请求异常");
        }
    }

    //微信浏览器选择支付
    public function wx_pay_way(){
        //用户id
        $uid = session('userInfo.uid');
        //订单号
        $orderId = input('get.orderId');

        //支付方式 2：微信 4：余额
        $bank_type = input('get.bank_type');

        //检查订单
        $orderInfo = model('ActivityOrder')->get($orderId);
        if(empty($orderInfo) || $uid != $orderInfo['uid']){
            $this->error('订单错误');
        }

        //支付处理过回到活动详情
        if($orderInfo->order_status != 2){
            $this->redirect('activity/detail',['aid'=>$orderInfo['aid']]);
        }

        if($bank_type == 2){
            $this->redirect('activity/wx_browser_pay');
        }elseif($bank_type = 4) {
            return $this->balance_pay($uid,$orderId);
        }
    }

    //订单号选择支付
    public function orderIdPay($orderId){
        $uid = session('userInfo.uid');
        $userInfo = model('user')->find($uid);
        $orderInfo = model('ActivityOrder')->find($orderId);
        if(empty($orderInfo) || $orderInfo['uid'] != $uid){
            $this->error('请求异常');
        }
        $ActivityInfo = model('Activity')->find($orderInfo['aid']);
        //微信浏览器只支持js支付，单独一个界面
        $this->assign('orderId',$orderId);
        $this->assign('userInfo',$userInfo);
        $this->assign('activityInfo',$ActivityInfo);
        $this->assign('orderInfo',$orderInfo);
        $this->assign('title','选择支付');
        if(is_weixin()){
            return $this->fetch('pay/wx_select_pay');
        }else{
            return $this->fetch('pay/select_pay');
        }
    }

    //余额支付
    public function balance_pay($orderId=''){
        if(empty($orderId)){
            return false;
        }
        $uid = session('userInfo.uid');
        $userInfo = model('user')->find($uid);
        $orderInfo = model('ActivityOrder')->find($orderId);
        $ActivityInfo = model('Activity')->find($orderInfo['aid']);
        if(empty($userInfo) || $uid != $orderInfo['uid'] ){
            $this->error('请求异常');
        }

        //检查余额够不够
        if($orderInfo['order_price'] > $userInfo['balance']){
            $this->error('余额不足，可以去会员中心进行充值哦');
        }

        //记账
        $add_detail = [
            'uid' => $uid,
            'type' => 3,
            'money' => $orderInfo['order_price'],
            'balance' => $userInfo->balance,
            'addtime' => time(),
            'remark'  => "参加".$ActivityInfo['a_title']."活动",
        ];
        try{
            model('UserDetail')->insert($add_detail);
        } catch (\Exception $e){
            $this->error('数据异常');
        }
        //扣费
        $userInfo->balance = $userInfo->balance - $orderInfo->order_price;
        $userInfo->save();

        //更改订单状态
        $data = [
            'order_status' => 3,
            'pay_way'   => 4,
            'pay_time'  => time(),
        ];

        $res = model('ActivityOrder')->save($data,['order_id'=>$orderId]);

        //修改成功，进入报名成功界面
        if($res) {
//            $this->sendMobileMsg($orderInfo['order_sn']);
//            $this->setActivityNum($orderInfo['order_sn']);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$orderInfo);
            $this->assign('title','报名成功');
            return $this->fetch('pay/pay_success');
        }else{
            $this->error('支付失败，若发现余额已扣费请联系客服！');
        }
    }

    //手机端H5支付（非微信浏览器）
    public function wxWapPay($orderId=''){
        $uid = session('userInfo.uid');
        $order = model('ActivityOrder')->find($orderId);
        if(empty($order) || $uid != $order['uid']){
            $this->error('请求异常');
        }
        $appid =  config('wxpay.app_id');
        $mch_id = config('wxpay.mch_id');//商户号
        $key = config('wxpay.key');//商户key
        $notify_url = "http://test.baobaowaner.com/mobile/pay/wx_notify/";//回调地址
        $wechatAppPay = new wechatAppPay($appid, $mch_id, $notify_url, $key);
        $params['body'] = '玩翫碗活动报名';                       //商品描述
        $params['out_trade_no'] = $order['order_sn'];    //自定义的订单号
        $params['total_fee'] = $order['order_price']*100;                       //订单金额 只能为整数 单位为分
        $params['trade_type'] = 'MWEB';                   //交易类型 JSAPI | NATIVE | APP | WAP
        $params['scene_info'] = '{"h5_info": {"type":"Wap","wap_url": "https://api.lanhaitools.com/wap","wap_name": "玩翫碗活动报名"}}';
        $result = $wechatAppPay->unifiedOrder( $params );
        //订单失败是因为商户订单号重复，浏览器终止支付的订单再次使用微信公众号js支付会报订单号重复错误，暂时先让用户重新下单
        if(isset($result['err_code'])){
            if($result['err_code'] == 'INVALID_REQUEST'){
                model('ActivityOrder')->delete($orderId);
                $this->error('已过有效支付时间，请重新下单');
            }
        }
        $url = $result['mweb_url'].'&redirect_url=http://test.baobaowaner.com/mobile/pay/pay_success/orderId/'.$orderId;//redirect_url 是支付完成后返回的页面
        $this->redirect($url);
    }

    //微信js支付
    public function wxJsPay($orderId){
        $uid = session('userInfo.uid');
        $order  = model('ActivityOrder')->get($orderId);

        //检查订单
        $orderInfo = model('ActivityOrder')->get($orderId);
        if(empty($orderInfo) || $uid != $orderInfo['uid']){
            $this->error('订单错误');
        }
        //获取用户openid
        $openId = session('openid');

        //统一下单
        $tools = new JsApiPay();
        $money = $order['order_price'];
        $input = new WxPayUnifiedOrder();
        $input->setBody("玩翫碗活动报名");
        $input->setAttach("玩翫碗活动报名");
        $input->setOutTradeNo($order['order_sn']);   //订单号
        $input->setTotalFee($money * 100);  //价格
        $input->setTimeStart(date("YmdHis"));   //生成时间
        $input->setTradeType("JSAPI");
        $input->setOpenid($openId);
        $input->setNotifyUrl("http://www.baobaowaner.com/mobile/Activity/notify/id/".$orderId); //设置回调地址
        $orders = WxPayApi::unifiedOrder($input);
        //订单失败是因为商户订单号重复，浏览器终止支付的订单再次使用微信公众号js支付会报订单号重复错误，暂时先让用户重新下单
        if(isset($orders['err_code'])){
            if($orders['err_code'] == 'INVALID_REQUEST'){
                model('ActivityOrder')->delete($orderId);
                $this->error('已过有效支付时间，请重新下单');
            }
        }
        $jsApiParameters = $tools->getJsApiParameters($orders);
        $this->assign('order_sn',$orderId);
        $this->assign('jsApiParameters', $jsApiParameters);
        return $this->fetch('pay/enter_wx_pay');
    }

    //微信支付返回url
    public function pay_success($orderId){
        $orderInfo = model('ActivityOrder')->find($orderId);
        $activityInfo = model('Activity')->find($orderInfo['aid']);

        //延迟三秒，等待微信支付流程结束，时间原因，暂时这样，体验不好，以后优化
        usleep(3000000);

        //查询订单
        $notify = new PayNotifyCallBack();
        $notify->handle(true);
        $result = $notify->queryTradeOrder($orderInfo['order_sn']);
        if($result){
            $this->assign('activityInfo',$activityInfo);
            $this->assign('orderInfo',$orderInfo);
            $this->assign('title','报名成功');
            return $this->fetch();
        }else{
            $this->error('支付失败,有疑问请联系客服');
        }


    }

    //微信支付回调
    public function wx_notify(){
        $weixinData = file_get_contents("php://input");

        //实例化失败通知微信服务器
        try{
            $resultObj = new WxPayResults();
            $weixinData = $resultObj->Init(($weixinData));
        }catch (\Exception $e){
            $resultObj->setData('return_code', 'FAIL');
            $resultObj->setData('return_msg', $e->getMessage());
            return $resultObj->toXml();
        }
        $order_sn = $weixinData['out_trade_no'];

        $logData = [
            'pay_way' => 2,
            'pay_status' => 0,
            'order_sn' => $order_sn,
            'content' => json_encode($weixinData),
            'addtime' => time()
        ];

        //订单处理失败通知微信服务器
        if($weixinData['return_code'] === 'FAIL' || $weixinData['result_code'] !== 'SUCCESS') {
            db('pay_log')->insert($logData);
            $resultObj->setData('return_code', 'FAIL');
            $resultObj->setData('return_msg', 'error');
            return $resultObj->toXml();
        }

        //订单已处理，通知微信服务器
        $order = model('ActivityOrder')->get(['order_sn' => $order_sn]);
        if($order->order_status != 2) {
            db('pay_log')->insert($logData);
            $resultObj->setData('return_code', 'SUCCESS');
            $resultObj->setData('return_msg', 'OK');
            return $resultObj->toXml();
        }

        //更新订单表,记日志
        try{
            $data = [
                'order_status' => 3,
                'pay_way' => 2,
                'pay_time' => time()
            ];
            model('ActivityOrder')->save($data,['order_sn'=>$order_sn]);
            //报名成功需要进行的操作
            $this->signSuccessOperation($order);

            $logData['pay_status'] = 1;
            db('pay_log')->insert($logData);

            $resultObj->setData('return_code', 'SUCCESS');
            $resultObj->setData('return_msg', 'OK');
            return $resultObj->toXml();

        }catch (\Exception $e){
            $resultObj->setData('return_code', 'FAIL');
            $resultObj->setData('return_msg', 'error');
            return $resultObj->toXml();
        }
    }

    //支付宝支付返回url
    public function ali_pay_url(){
        //本站订单号
        $out_trade_no = input('get.out_trade_no');
        //支付宝订单号
        $trade_no = input('get.trade_no');

        //获取信息
        $order = model('ActivityOrder')->getSnOrderInfo($out_trade_no);
        $activityInfo = model('Activity')->find($order['aid']);
        if(empty($order)){
            $this->error('参数错误');
        }
        $result = \alipay\Query::exec($trade_no);
        if($result['trade_status'] == 'TRADE_SUCCESS'){
            $this->assign('activityInfo',$activityInfo);
            $this->assign('orderInfo',$order);
            $this->assign('title','支付成功');
            return $this->fetch('activity/pay_success');
        }else{
            $this->error('支付失败,有疑问请联系客服');
        }
    }

    //支付宝支付回调
    public function alipay_notify(){
        $params = input('post.');
        $order_sn = $params['out_trade_no'];

        //定义日志信息
        $logData = [
            'pay_way' => 1,
            'pay_status' => 0,
            'order_sn' => $order_sn,
            'content' => json_encode($params),
            'addtime' => time()
        ];

        //验签
        $check_sign = \alipay\Notify::checkSign($params);
        if(!$check_sign){
            $logData['content'] = '签名未通过';
            db('pay_log')->insert($logData);
            exit('failure');
        }

        //获取订单信息
        $order = model('ActivityOrder')->getSnOrderInfo($order_sn);
        if(empty($order) && $order['order_price'] != $params['total_amount']){
            $logData['content'] = '订单信息不正确';
            db('pay_log')->insert($logData);
            exit('failure');
        }

        $logData['content'] = '签名未通过';
        db('pay_log')->insert($logData);

        //更新订单表，记录日志
        try{
            $data = [
                'order_status' => 3,
                'pay_way' => 2,
                'pay_time' => time()
            ];
            model('ActivityOrder')->save($data,['order_sn'=>$order_sn]);

            //报名成功需要进行的操作
            $this->signSuccessOperation($order);

            $logData['pay_status'] = 1;
            db('pay_log')->insert($logData);
            exit('success');
        }catch (\Exception $e){
            $logData['content'] = '记录失败';
            db('pay_log')->insert($logData);
            exit('failure');
        }


    }

    //报名成功，更新活动表，安排表，发短信
    public function signSuccessOperation($order){
        model('Activity')->setIncNumById($order->aid,$order->child_num);
        model('ActivityTime')->where('t_id', $order->t_id)->setDec('ticket_num', $order->child_num);
        model('ActivityTime')->where('t_id', $order->t_id)->setInc('sold_num', $order->child_num);
        $activity = model('Activity')->find($order->aid);
        $timeInfo = model('ActivityTime')->find($order->t_id);
        $content = "恭喜您已成功报名".$activity['a_title'].",活动地点：".$activity['a_address'].",参加时间:".$timeInfo['begin_time']."到".$timeInfo['end_time']."，大人".$order['adult_num']."个,小孩".$order['child_num']."个,请您准时参加,有问题请联系客服：400-611-2731,感谢您的支持。";
        \Sms::single_send($order->mobile,$content);
    }
}
