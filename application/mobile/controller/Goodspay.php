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

class Goodspay extends Base
{

    private $goods;
    private $user;
    public function _initialize(){
        $this->goods = model('Goods');
        $this->user = model('User');
    }

    //选择了支付方式
    public function pay_way(){
        //用户id
        $uid = session('userInfo.uid');
        //订单号
        $orderId = input('get.orderId');
        //支付方式1：支付宝 2：微信 4:余额支付
        $bank_type = input('get.bank_type');

        $order = $this->goods->find($orderId);

        if($order['uid'] != $uid){
            $this->error("无效订单");
        }

        //支付处理过回到活动详情
        if($order->order_status == 1){
            $this->redirect('goods/goods_detail',['aid'=>$order['aid']]);
        }

        if($bank_type == 1){

        }else if($bank_type == 2){

            $this->redirect('goodspay/wxJsPay',['orderId'=>$orderId]);

        }else if($bank_type == 4){

            $this->redirect('goodspay/balance_pay',['orderId'=>$orderId]);

        }else{
            $this->error("请求异常");
        }
    }

   //商品js支付
    public function wxJsPay($orderId){
        $uid = session('userInfo.uid');

        //检查订单
        $order  = $this->goods->find($orderId);
        if(empty($order) || $uid != $order['uid']){
            $this->error('订单错误');
        }
        //获取用户openid
        $openId = session('openid');

        //统一下单
        $tools = new JsApiPay();
        $money = $order['order_price'];
        $input = new WxPayUnifiedOrder();
        $input->setBody("玩翫碗玩具购买");
        $input->setAttach("玩翫碗玩具购买");
        $input->setOutTradeNo($order['order_sn']);   //订单号
        $input->setTotalFee($money * 100);  //价格
        $input->setTimeStart(date("YmdHis"));   //生成时间
        $input->setTradeType("JSAPI");
        $input->setOpenid($openId);
        $input->setNotifyUrl("http://www.baobaowaner.com/mobile/goodspay/wx_goods_notify/"); //设置回调地址

        $orders = WxPayApi::unifiedOrder($input);
        //订单失败是因为商户订单号重复，浏览器终止支付的订单再次使用微信公众号js支付会报订单号重复错误，暂时先让用户重新下单
        if(isset($orders['err_code'])){
            if($orders['err_code'] == 'INVALID_REQUEST'){
                model('ActivityOrder')->delete($orderId);
                $this->error('已过有效支付时间，请重新下单');
            }
        }
        $jsApiParameters = $tools->getJsApiParameters($orders);
        $this->assign('orderId',$orderId);
        $this->assign('jsApiParameters', $jsApiParameters);
        return $this->fetch('pay/enter_wx_pay');
    }

    //余额支付
    public function balance_pay($orderId=''){
        if(empty($orderId)){
            return false;
        }
        $uid = session('userInfo.uid');
        $userInfo = $this->user->find($uid);
        $orderInfo = $this->goods->find($orderId);

        if(empty($userInfo) || $uid != $orderInfo['uid'] ){
            $this->error('请求异常');
        }

        //检查余额够不够
        if($orderInfo['order_price'] > $userInfo['balance']){
            $this->error('余额不足，可以去会员中心进行充值哦');
        }


        try{
            //扣费
            $userInfo->balance = $userInfo->balance - $orderInfo->order_price;
            $userInfo->save();
        } catch (\Exception $e){
            $this->error('数据异常');
        }

        //记账
        $add_detail = [
            'uid' => $uid,
            'type' => 3,
            'money' => $orderInfo['order_price'],
            'balance' => $userInfo->balance,
            'addtime' => time(),
            'remark'  => "玩具购买",
        ];
        $res1 = model('UserDetail')->insert($add_detail);

        //更改订单状态
        $data = [
            'order_status' => 1,
            'pay_way' => 4,
            'pay_price'=> $orderInfo->order_price,
            'pay_time' => time()
        ];

        $res2 = $this->goods->save($data,['order_id'=>$orderId]);

        //修改成功，进入报名成功界面
        if($res1 && $res2) {
            return $this->fetch('pay/goods_pay_success');
        }else{
            $this->error('支付失败，若发现余额已扣费请联系客服！');
        }
    }

    //微信支付回调
    public function wx_goods_notify(){
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

        //订单处理失败通知微信服务器
        if($weixinData['return_code'] === 'FAIL' || $weixinData['result_code'] !== 'SUCCESS') {
            $resultObj->setData('return_code', 'FAIL');
            $resultObj->setData('return_msg', 'error');
            return $resultObj->toXml();
        }

        //订单已处理，通知微信服务器
        $order = model('GoodsOrder')->get(['order_sn' => $order_sn]);
        if($order->order_status == 1) {
            $resultObj->setData('return_code', 'SUCCESS');
            $resultObj->setData('return_msg', 'OK');
            return $resultObj->toXml();
        }

        //更新订单表,记日志
        try{
            $data = [
                'order_status' => 1,
                'pay_way' => 2,
                'pay_price'=> $weixinData['total_fee'] / 100,
                'pay_time' => time()
            ];
            $this->goods->save($data,['order_sn'=>$order_sn]);

            $resultObj->setData('return_code', 'SUCCESS');
            $resultObj->setData('return_msg', 'OK');
            return $resultObj->toXml();

        }catch (\Exception $e){
            $resultObj->setData('return_code', 'FAIL');
            $resultObj->setData('return_msg', 'error');
            return $resultObj->toXml();
        }
    }
}
