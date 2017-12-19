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
            'activity_order_num' => $activityOrder->count(),    //订单总数
            'last_week_order' => $activityOrder::scope('LastWeekSuccessOrder')->sum('child_num'),  //上周报名人数
            'week_order'    => $activityOrder::scope('WeekSuccessOrder')->sum('child_num'),  //这周报名人数
            'last_week_order_price' => $activityOrder::scope('LastWeekSuccessOrder')->sum('order_price'),  //上周成交金额
            'week_order_price'  => $activityOrder::scope('WeekSuccessOrder')->sum('order_price'),  //这周成交金额
            'today_order_price'   => $activityOrder::scope('ToDaySuccessOrder')->sum('order_price'),  //这天成交金额
            'month_order_price' => $activityOrder::scope('MonthSuccessOrder')->sum('order_price'),  //这月成交金额
        ];

        $result['activity'] = [
            'activity_num' => $activity->count(),   //活动总数
        ];

        $result['recharge'] = [
            'last_week_recharge' => $rechargeRecord::scope('LastWeek')->sum('amount'),  //上周充值金额
            'week_recharge' => $rechargeRecord::scope('Week')->sum('amount'),  //本周充值金额
        ];

        foreach($result as $k=>$v){
            if(empty($v['week_order_price'])){
                $result['order']['week_order_price'] = 0;
            }

            if(empty($v['today_order_price'])){
                $result['order']['today_order_price'] = 0;
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
