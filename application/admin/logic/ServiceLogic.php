<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 下午 3:55
 */

namespace app\admin\Logic;


class ServiceLogic
{

    /**
     * 活动预约记录
     * @param $data
     * @return array
     */
    public function saveAccess($data){
        //检查活动是否存在
        $ActivityOrder = model('ActivityOrder');
        $map['order_id'] = $data['oid'];
        $order = $ActivityOrder->getOrder($map);
        if(empty($order)){
            return array('status'=>-1,'msg'=>'活动不存在');
        }
        //检查时间是否正确
        if($data['t_id'] < 0){
            return array('status'=>-1,'msg'=>'时间不正确');
        }

        //更新
        if($data['t_id'] > 0){
            $order->t_id = $data['t_id'];
        }
        $order->record = $data['record'];
        if($order->save()){
            return array('status'=>200,'msg'=>'记录成功');
        }else{
            return array('status'=>-1,'msg'=>'记录失败');
        }
    }
}