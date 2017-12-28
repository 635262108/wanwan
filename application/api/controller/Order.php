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
        $orderInfo = model('ActivityOrder')->get($data);
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
}