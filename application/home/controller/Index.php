<?php
namespace app\home\controller;
use app\home\logic\GoodsLogic;
use think\Session;

class Index extends Base
{
    public function index()
    {	
        return $this->fetch();
    }
    
    public function about() {
        return $this->fetch();
    }
}
