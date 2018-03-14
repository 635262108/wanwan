<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\seller\controller;
use think\Controller;

class Base extends Controller
{
    protected $store_info;

    protected function _initialize(){
        $this->store_info = model('store')->find(session('userInfo.store'));
        $this->assign('store_info',$this->store_info);
    }

}