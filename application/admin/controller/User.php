<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Cache;


class User extends Base
{    
    //登录
    public function login(){
        // 检测是否为ajax请求
        if(request()->isAjax()){
            //用户名
            $name = input('post.name');
            //密码
            $password = input('post.pwd');

            //登录验证
            if($password == 'wanwanwan123!@#' & $name=='admin'){
                //存储用户信息
                $data['nickname'] = 'admin';
                Session::set('adminInfo',$data);
                return return_info(200,'登录成功');
            }else{
                return return_info(-1,'帐号或密码错误');
            }
        }else{
            return $this->fetch();
        }
    }
    
    //会员列表
    public function index(){
        $user = model('user');
        $userInfo = $user->getAllUser();
        $this->assign('userInfo',$userInfo);
    	return $this->fetch();
    }
    
    //获取个人用户信息
    public function getUserInfo(){
        //检测是否为ajax请求
        if(request()->isajax()){
            $uid = input("post.uid");
            //获取用户信息
            $user = model('user');
            $userInfo = $user->getIdUser($uid);
            //获取省市区
            $region = model('region');
            $province = $region->getAnyData($userInfo['province']);//省
            $city = $region->getAnyData($userInfo['city']);//市
            $district = $region->getAnyData($userInfo['district']);//区
            //转换数据格式
            $userInfo['reg_time'] = date("Y-m-d H:i:s",$userInfo['reg_time']);
            $userInfo['last_time'] = date("Y-m-d H:i:s",$userInfo['last_time']);
            $userInfo['birthday'] = date("Y-m-d H:i:s",$userInfo['birthday']);
            if($userInfo['status'] == 1){
                $userInfo['status'] = "正常";
            }else{
                $userInfo['status'] = "被禁";
            }
            $userInfo['province'] = $province['name'];
            $userInfo['city'] = $city['name'];
            $userInfo['district'] = $district['name'];
            
            return_info(200,'成功',$userInfo);
        }else{
            return_info(-1,'请求失败');
        }
    }
    
    //修改个人信息展示
    public function saveUserList($uid){
        //获取用户信息
        $user = model('user');
        $userInfo = $user->getIdUser($uid);
        
        //获取所有的省市区
        $region = model('region');
        $provinces = $region->getAnyLevelData(1);
        $citys = $region->getSonData($userInfo['province']);
        $districts = $region->getSonData($userInfo['city']);
        
        //转换数据格式
        $userInfo['reg_time'] = date("Y-m-d H:i:s",$userInfo['reg_time']);
        $userInfo['last_time'] = date("Y-m-d H:i:s",$userInfo['last_time']);
        $userInfo['birthday'] = date("Y-m-d",$userInfo['birthday']);
  
        $this->assign('provinces',$provinces);
        $this->assign('citys',$citys);
        $this->assign('districts',$districts);
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }
    
    //修改个人信息
    public function saveUser(){
        //uid
        $uid = input('post.userId');
        //手机号
        $mobile = input('post.userTel');
        //昵称
        $nickname = input('post.userName');
        //状态
        $status = input('post.status');
        //生日
        $birthday = input('post.userBirthday');
        //爱好
        $hobby = input('post.userLike');
        //省
        $province = input('post.userProvince');
        //市
        $city = input('post.userCountry');
        //区
        $district = input('post.userArea');
        //详细地址
        $province = input('post.detailAddress');
        
        //修改
        $data['mobile'] = $mobile;
        $data['nickname'] = $nickname;
        $data['status'] = $status;
        $data['birthday'] = time($birthday);
        $data['hobby'] = $hobby;
        $data['city'] = $city;
        $data['district'] = $district;
        $data['address'] = $province;
        
        $user = model('user');
        $user->saveUserInfo($uid,$data);
        $this->success('修改成功',"user/index");
    }
}
