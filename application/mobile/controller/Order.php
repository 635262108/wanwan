<?php
namespace app\mobile\controller;

use think\Exception;

class Order extends Base
{

    public function _initialize() {
        parent::_initialize();
        $noLogin = array('sign_up','order_detail');
        $this->checkUserLogin($noLogin);
    }

    //活动报名
    public function sign_up(){
        //接收参数
        $uid = session('userInfo.uid');
        $aid = input('get.aid/d');
        $adult_num = input('get.adult_num/d');
        $child_num = input('get.child_num/d');
        $time = input('get.time/d');
        if(!$aid || !$child_num || !$time){
            $this->error('请求异常');
        }

        //检查参加时间是否还有票
        $ActivityTime = model('ActivityTime');
        $timeInfo = $ActivityTime->getAnyTime($time);
        if($timeInfo['ticket_num'] <= 0) {
            $this->error('您选择的时间段已无名额');
        }

        //价格
        $ActivityInfo = model('Activity')->find($aid);
        $userInfo = model('user')->find($uid);
        if($userInfo['member_grade'] == 1){
            $price = $adult_num*$ActivityInfo['member_adult_price']+$child_num*$ActivityInfo['member_child_price'];
        }else{
            $price = $adult_num*$ActivityInfo['a_adult_price']+$child_num*$ActivityInfo['a_child_price'];
        }

        //免费活动不能重复报名
        if($price == 0){
            $map = [
                'uid' => $uid,
                'aid' => $aid,
                'order_status'=> array('neq',3)
            ];
            $check_activity = model('ActivityOrder')->where($map)->order('order_id desc')->find();
            $check_time = $ActivityTime->getAnyTime($check_activity['t_id']);

            if(!empty($check_activity) &&  $check_time['is_display'] == 1){
                $this->error('名额有限，不能重复报名噢');
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

        try{
            $orderId = model('ActivityOrder')->add($add_order_data);
        } catch (\Exception $e){
            $this->error('订单处理失败');
        }

        //免费活动不需要支付，直接报名成功，付费活动进入选择支付界面
        if($price > 0){
            $this->assign('orderId',$orderId);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$add_order_data);
            $this->assign('userInfo',$userInfo);
            $this->assign('title','选择支付');
            //微信浏览器只支持js支付，单独一个界面
            if(is_weixin()){
                //跳转到wx_browser_pay
                return $this->fetch('pay/wx_select_pay');
            }else{
                return $this->fetch('pay/select_pay');
            }
        }else{
            //报名成功，减少总名额和时间名额，增加报名人数，人员数量以小孩数量为准
            $this->signSuccessOperation(model('ActivityOrder')->find($orderId));
            $add_order_data['order_id'] = $orderId;
            $this->assign('price',$price);
            $this->assign('activityInfo',$ActivityInfo);
            $this->assign('orderInfo',$add_order_data);
            $this->assign('title','报名成功');
            return $this->fetch('pay/pay_success');
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

    //查看订单详情
    public function order_detail($orderId){
        //用户id
        $uid = session('userInfo.uid');
        //获取订单信息
        $ActivityOrder = model('ActivityOrder');
        $orderInfo = $ActivityOrder->get($orderId);
        if($orderInfo['uid'] != $uid){
            $this->error('订单异常');
        }
        //获取活动信息
        $Activity = model('Activity');
        $field = 'aid,a_title,a_img,a_address,a_begin_time,a_end_time';
        $ActivityInfo = $Activity->getIdActivity($orderInfo['aid'],$field);
        if(empty($ActivityInfo)){
            $this->error('活动结束,订单已失效');
        }

        //参与时间
        $timeInfo = model('ActivityTime')->getAnyTime($orderInfo['t_id']);

        $this->assign('timeInfo',$timeInfo);
        $this->assign('orderInfo',$orderInfo);
        $this->assign('ActivityInfo',$ActivityInfo);
        $this->assign('url',url('user/my_activity',['a'=>1]));
        $this->assign('title','订单详情');
        return $this->fetch();
    }
}
