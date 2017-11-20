<?php
namespace app\admin\controller;
use think\Session;

class Index extends Base
{
    public function index()
    {
        $result['member_num'] = db('user')->where('balance>0')->count();
        $result['user_num'] = db('user')->count();
        $result['activity_order_num'] = db('activity_order')->count();
        $result['activity_num'] = db('activity')->count();
        $this->assign('result',$result);
        return $this->fetch();
    }
    
    public function about() {
        return $this->fetch();
    }
}
