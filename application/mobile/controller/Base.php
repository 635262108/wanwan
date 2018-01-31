<?php
namespace app\mobile\controller;
use think\Controller;

class Base extends Controller
{
    public function _initialize() {
        //是否维护
        if(config('maintenance')){
            $arrayIp = [
                '127.0.0.1',
                '1.192.241.219'
            ];
           $ip = request()->ip();
           if(!in_array($ip,$arrayIp)){
                $this->error('系统维护中...请稍后访问');
           }
        }
        $this->public_assign();
    }
    /**
     * 公共赋值
     */
    public function public_assign(){
        $ActivityType = model('ActivityType');
        //获取标题
        $title = $ActivityType->getTitle();
        $this->assign('title',$title);
    }
    /**
     * 检验用户是否登录
     * @param type $noLogin 检测的操作
     */
    public function checkUserLogin($noLogin = array()) {
        if(in_array(request()->action(),$noLogin)){
            if(!session('?userInfo')){
                //return $this->redirect("public/select_login");
                echo $this->fetch('public/select_login');die;
            }
        }
    }

    //报名成功，更新活动表，安排表，发短信
    public function signSuccessOperation($order){
        model('Activity')->setIncNumById($order->aid,$order->child_num);
        model('ActivityTime')->where('t_id', $order->t_id)->setDec('ticket_num', $order->child_num);
        model('ActivityTime')->where('t_id', $order->t_id)->setInc('sold_num', $order->child_num);
        $activity = model('Activity')->find($order->aid);
        $timeInfo = model('ActivityTime')->find($order->t_id);
        $content = "恭喜您已成功报名".$activity['a_title'].",活动地点：".$activity['a_address'].",参加时间:".$timeInfo['begin_time']."到".$timeInfo['end_time']."，大人".$order['adult_num']."个,小孩".$order['child_num']."个,请您准时参加,有问题请联系客服：400-611-2731,感谢您的支持。";
        \Sms::single_send($order->mobile,$content);
    }
    
}
