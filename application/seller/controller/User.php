<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\seller\controller;
use think\Controller;
use think\Exception;
use think\Validate;

class User extends Base
{
    //登录界面
    public function login(){
        return $this->fetch();
    }
}