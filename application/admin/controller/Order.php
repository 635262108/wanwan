<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/22 0022
 * Time: 上午 10:36
 */

namespace app\admin\controller;


class Order extends Base
{
    //活动订单列表
    public function activity_order(){
        $source = model('Source')->all();
        $activityInfo = model('Activity')->getActivityAll('aid,a_title');
        $pay_way = config('other.pay_way');

        return $this->fetch('',[
            'source' => $source,
            'activityInfo' => $activityInfo,
            'pay_way' => $pay_way
        ]);
    }

    //ajax订单首页
    public function ajax_activity_order(){
        $data = input('get.');

        $where = array();

        $data['aid'] == 0 ? $where['o.aid'] = array('>',0) : $where['o.aid'] = $data['aid'];
        $data['begin_time'] != '' ? $where['o.addtime'] = array('between',[strtotime($data['begin_time']),strtotime($data['end_time'])+3600*12]) : false;
        $data['pay_way'] != '' ? $where['o.pay_way'] = $data['pay_way'] : false;
        $data['order_status'] != '' ? $where['o.order_status'] = $data['order_status'] : false;
        $data['source'] != '' ? $where['o.source'] = $data['source'] : false;
        //查询已付款的订单，需要连同未签到的数据一起查出
        if($data['order_status'] != ''){
            if( $data['order_status'] == 3){
                $where['o.order_status'] = array(['=',3],['=',4],'or');
            }else{
                $where['o.order_status'] = $data['order_status'];
            }
        }

        $orderInfo = model('ActivityOrder')
            ->alias('o')->field('o.*,a.a_title,s.name as source_name,t.begin_time,t.end_time')
            ->join('mfw_activity a','o.aid=a.aid','left')
            ->join('mfw_activity_time t','t.t_id=o.t_id','left')
            ->join('mfw_source s','o.source=s.id','left')
            ->where($where)
            ->order('o.order_id desc')
            ->paginate(10);

        $price_sum = model('ActivityOrder')
            ->alias('o')->field('o.*,a.a_title,s.name as source_name,t.begin_time,t.end_time')
            ->join('mfw_activity a','o.aid=a.aid','left')
            ->join('mfw_activity_time t','t.t_id=o.t_id','left')
            ->join('mfw_source s','o.source=s.id','left')
            ->where($where)
            ->order('o.order_id desc')
            ->sum('o.order_price');

        $page = $orderInfo->render();

        return $this->fetch('',[
            'orderInfo' => $orderInfo,
            'page' => $page,
            'price_sum' => $price_sum
        ]);
    }
}