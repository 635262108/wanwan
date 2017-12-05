<?php
namespace app\admin\controller;
use think\Session;

class Index extends Base
{
    public function index()
    {
        //获取上周开始和结束时间
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
        //获取本周开始和结束时间
        $beginweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        $endweek=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
        //获取本月
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));

        $result['member_num'] = db('user')->where('member_grade=1')->count();    //会员数量
        $result['month_member'] = db('user')->where("reg_time",['>',$beginThismonth],['<',$endThismonth])->where('member_grade=1')->count();  //本月新增会员
        $result['week_member'] = db('user')->where("reg_time",['>',$beginweek],['<',$endweek])->where('member_grade=1')->count();  //本周新增会员
        $result['user_num'] = db('user')->count();  //客户数量
        $result['month_user'] = db('user')->where("reg_time",['>',$beginThismonth],['<',$endThismonth])->count();  //本月新增客户
        $result['week_user'] = db('user')->where("reg_time",['>',$beginweek],['<',$endweek])->count();  //本周新增客户
        $result['activity_order_num'] = db('activity_order')->count();      //订单总数
        $result['activity_num'] = db('activity')->count();      //活动总数
        $result['last_week_order'] = db('activity_order')->where("addtime",['>',$beginLastweek],['<',$endLastweek])->count(); //上周报名人数
        $result['week_order'] = db('activity_order')->where("addtime",['>',$beginweek],['<',$endweek])->count();        //这周报名人数
        $result['last_week_order_price'] = db('activity_order')->where("addtime",['>',$beginLastweek],['<',$endLastweek])->where('order_status','<>',2)->sum('order_price');//上周成交金额
        $result['week_order_price'] = db('activity_order')->where("addtime",['>',$beginweek],['<',$endweek])->where('order_status','<>',2)->sum('order_price');//这周成交金额
        $result['last_week_recharge'] = db('recharge_record')->where("pay_time",['>',$beginLastweek],['<',$endLastweek])->where('status',1)->sum('amount');//上周充值金额
        $result['week_recharge'] = db('recharge_record')->where("pay_time",['>',$beginweek],['<',$endweek])->where('status',1)->sum('amount');//本周充值金额

        $this->assign('result',$result);
        return $this->fetch();
    }
    
    public function about() {
        return $this->fetch();
    }
}
