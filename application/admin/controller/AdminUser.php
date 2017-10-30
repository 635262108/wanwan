<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 下午 7:33
 */

namespace app\admin\controller;


class AdminUser extends Base
{

    //首页
    public function index(){
        return $this->fetch();
    }

    //权限列表
    public function role(){
        return $this->fetch();
    }
}