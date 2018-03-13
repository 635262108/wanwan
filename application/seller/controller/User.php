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
    private $adminUser;

    public function _initialize(){
        $this->adminUser = model('adminUser');
    }

    //登录界面
    public function login(){
        if(!request()->isPost()){
            return $this->fetch();
        }

        $mobile = input('post.mobile');
        if(!isMobile($mobile)){
            return_info(-1,'请输入正确的手机号');
        }
        $pwd = input('post.pwd');

        $map = [
            'mobile' => $mobile,
            'password' => md5($pwd)
         ];

        $res = $this->adminUser->where($map)->find();
        if($res){
            $session_data = [
                'name' => $res->name,
                'mobile' => $res->mobile,
                'store' => $res->store,
            ];
            session('userInfo',$session_data);
            return_info(200,'登录成功');
        }else{
            return_info(-1,'账号或密码不正确');
        }

    }
}