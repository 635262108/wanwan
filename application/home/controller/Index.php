<?php
namespace app\home\controller;
use app\home\logic\GoodsLogic;
use think\Session;

class Index extends Base
{
    public function index()
    {	
        // 如果是手机跳转到 手机模块
        if(true == request()->isMobile()){
            header("Location: ".url('mobile/activity/index'));
            exit;
        }
        return $this->fetch();
    }
    
    public function about() {
        return $this->fetch();
    }
}
