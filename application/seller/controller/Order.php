<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\seller\controller;

class Order extends Base
{
    //订单首页
    public function index(){
        return $this->fetch();
    }
}