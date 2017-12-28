<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\api\controller;
use think\Controller;

class Order extends Controller
{
    //修改订单状态
    public function saveOrderStatus(){
        $data = input('post.');
        $orderInfo = model('ActivityOrder')->get($data['id']);
        if(empty($orderInfo)){
            return_info(-1,'订单号错误');
        }
        //修改状态为签到时，记录签到时间
        if($data['order_status'] == 4){
            $orderInfo->sign_time = time();
        }

        $orderInfo->order_status = $data['order_status'];
        $res = $orderInfo->save();
        if($res){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //添加订单
    public function addOrder(){
        $data = input('post.');
        $validate = validate('Order');
        $check = $validate->scene('addOrder')->check($data);
        if (!$check) {
            return_info(-1,$validate->getError());
        }
        //检查手机号是否已注册，未注册需要注册
        $userInfo = model('User')->getMobileUserInfo($data['mobile']);
        if(empty($userInfo)){
            $user_data = [
                'mobile' => $data['mobile'],
                'nickname' => $data['name'],
                'reg_time' => time(),
                'source' => $data['source'],
            ];
            $uid = model('User')->insertGetId($user_data);
        }else{
            $uid = $userInfo->uid;
        }
        $activityInfo = model('Activity')->get($data['aid']);
        if(empty($activityInfo)){
            return_info(-1,'活动不存在');
        }
        $data['order_price'] = $data['adult_num']*$activityInfo['a_adult_price'] + $data['child_num']*$activityInfo['a_child_price'];
        //签到时间存在时记录签到时间,订单状态为已签到
        if($data['sign_time'] == 1){
            $data['sign_time'] = time();
            $data['order_status'] = 4;
        }else{
            $data['order_status'] = 3;
        }
        //支付方式为余额支付时，记录支付信息
        if($data['pay_way'] == 4){
            //检查余额够不够
            if($userInfo->balance < $data['order_price']){
                return_info(-1,'余额不足');
            }
            $userInfo->balance = $userInfo->balance - $data['order_price'];
            $saveInfo = $userInfo->save();

            //记录订单明细
            $detail_data = [
                'uid' => $uid,
                'type' => 3,
                'money' => $data['order_price'],
                'balance' => $userInfo->balance,
                'addtime' => time(),
                'remark' => '参加'.$activityInfo['a_title'],
            ];

            $addDetail = model('UserDetail')->insert($detail_data);

            if(!$saveInfo || !$addDetail){
                return_info(-1,'扣费失败');
            }
        }
        $data['order_sn'] = getOrderSn($uid,$data['aid']);
        $data['uid'] = $uid;
        $data['pay_time'] = time();
        $data['addtime'] = time();
        $addOrder = model('ActivityOrder')->insert($data);
        if($addOrder){
            return_info(200,'success');
        }else{
            return_info(-1,'记录订单失败');
        }
    }
}