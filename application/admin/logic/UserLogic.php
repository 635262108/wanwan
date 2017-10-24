<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 2:29
 */
namespace app\admin\Logic;
use think\Model;
class User extends model{
    protected  $admin_user;

    public function _initialize(){
        parent::_initialize();
        $this->admin_user = model('AdminUser');
    }
    /**
     * 登录逻辑
     * @param $username
     * @param $password
     */
    public function login($username,$password){
        
    }
}