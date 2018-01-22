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

        $this->assign('source',$source);
        $this->assign('activityInfo',$activityInfo);
        return $this->fetch();
    }

    //ajax订单首页
    public function ajax_activity_order(){
        $data = input('get.');

        $where = array();
        if(isset($data['aid'])){
            $data['aid'] == 0 ? $where['o.aid'] = array('>',0) : $where['o.aid'] = $data['aid'];
            $data['begin_time'] != '' ? $where['o.addtime'] = array('between',[strtotime($data['begin_time']),strtotime($data['end_time'])+3600*12]) : false;
            $data['pay_way'] != '' ? $where['o.pay_way'] = $data['pay_way'] : false;
            $data['order_status'] != '' ? $where['o.order_status'] = $data['order_status'] : false;
            $data['source'] != '' ? $where['o.source'] = $data['source'] : false;
        }
        $orderInfo = model('ActivityOrder')
            ->alias('o')->field('o.*,a.a_title,s.name as source_name,t.begin_time,t.end_time')
            ->join('mfw_activity a','o.aid=a.aid','left')
            ->join('mfw_activity_time t','t.t_id=o.t_id','left')
            ->join('mfw_source s','o.source=s.id','left')
            ->where($where)
            ->select();

        $this->assign('orderInfo',$orderInfo);
        return $this->fetch();
    }
}