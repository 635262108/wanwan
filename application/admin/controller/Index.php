<?php
namespace app\admin\controller;
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
