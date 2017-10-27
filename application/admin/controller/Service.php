<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;

class Service extends Base
{

    //客服首页
    public function index(){
        return $this->fetch();
    }

    //预约记录
    public function access(){
        return $this->fetch();
    }

    //回访记录
    public function  return_visit(){
        return $this->fetch();
    }
}