<?php
namespace app\admin\controller;

class Index extends Base
{

    public function index()
    {

        $user = model('user');
        $activityOrder = model('ActivityOrder');
        $activity = model('Activity');
        $rechargeRecord = model('RechargeRecord');


        $result['user'] = [
            'member_num' => $user::scope('MemberNum')->count(),    //会员数量
            'month_member' => $user::scope('MemberMonth')->count(),  //本月新增会员
            'week_member' => $user::scope('MemberWeek')->count(),  //本周新增会员
            'today_member' => $user::scope('MemberToday')->count(),  //当天新增会员
            'user_num' => $user->count(),             //客户数量
            'month_user' => $user::scope('UserMonth')->count(),     //本月新增客户
            'week_user' => $user::scope('UserWeek')->count(),     //本周新增客户
            'today_user' => $user::scope('UserToday')->count(),     //当天新增客户
        ];

        $result['order'] = [
//            'activity_order_num' => $activityOrder->count(),    //订单总数
//            'last_week_order' => $activityOrder::scope('LastWeekSuccessOrder')->sum('child_num'),  //上周报名人数
//            'week_order'    => $activityOrder::scope('WeekSuccessOrder')->sum('child_num'),  //这周报名人数
            'order_price'   => $activityOrder::scope('SuccessOrder')->sum('order_price'),       //订单总成交
            'month_order_price' => $activityOrder::scope('MonthSuccessOrder')->sum('order_price'),  //本月订单成交金额
            'week_order_price'  => $activityOrder::scope('WeekSuccessOrder')->sum('order_price'),  //本周订单成交金额
            'today_order_price'   => $activityOrder::scope('ToDaySuccessOrder')->sum('order_price'),  //当天成交金额
        ];

        $result['activity'] = [
            'activity_num' => $activity->count(),   //活动总数
        ];

        $result['recharge'] = [
//            'last_week_recharge' => $rechargeRecord::scope('LastWeek')->sum('amount'),  //上周充值金额
            'recharge_price'    => $rechargeRecord::scope('Success')->sum('amount'),  //所有充值金额
            'month_recharge' => $rechargeRecord::scope('SuccessMonth')->sum('amount'),  //本月充值金额
            'week_recharge' => $rechargeRecord::scope('SuccessWeek')->sum('amount'),  //本周充值金额
            'today_recharge' => $rechargeRecord::scope('SuccessToday')->sum('amount'),  //当天充值金额
        ];

        //sum返回为空时赋值为0，前段用于显示
        foreach ($result['order'] as $k=>&$v){
            if(empty($v)){
                $v = 0;
            }
        }

        foreach ($result['recharge'] as $k=>&$v){
            if(empty($v)){
                $v = 0;
            }
        }

        //获取活动统计信息
        $activityInfo = $activity->getActivityAll('aid,a_title');
        foreach ($activityInfo as $k=>$v){
            $activityInfo[$k]['order_num'] = $activityOrder->anyActivityOrder($v['aid'])->count();
            $activityInfo[$k]['order_success_num'] = $activityOrder->anyActivityJoinOrder($v['aid'])->count();
            $activityInfo[$k]['order_sign_num'] = $activityOrder->anyActivitySuccessSign($v['aid'])->count();
        }

        return $this->fetch('',[
            'result' => $result,
            'activityInfo' => $activityInfo,
        ]);
    }
    
    public function about() {
        return $this->fetch();
    }
}
