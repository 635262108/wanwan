<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\seller\controller;

class Activity extends Base
{
    //活动首页
    public function index(){
        return $this->fetch();
    }

    //添加活动
    public function add(){
        return $this->fetch();
    }
}