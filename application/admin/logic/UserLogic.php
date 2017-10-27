<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 2:29
 */
namespace app\admin\Logic;

class UserLogic{

    /**
     * 登录逻辑
     * @param $username
     * @param $password
     */
    public function login($username,$password){
        
    }

    /**
     * 增加一个用户
     * @param $data
     */
    public function addUser($data = array()){
        //昵称不能为空
        if(empty($data['nickname'])){
            return array('status'=>-1,'msg'=>'昵称不能为空');
        }
        //密码不能为空
        if(empty($data['password'])){
            return array('status'=>-1,'msg'=>'密码不能为空');
        }
        //检查手机号
        if(!isMobile($data['mobile'])){
            return array('status'=>-1,'msg'=>'手机号格式错误');
        }
        //检查余额是否为整数
        if(!is_numeric($data['balance'])){
            return array('status'=>-1,'msg'=>'金额必须为整数');
        }
        //添加数据
        $add_data = array(
            'mobile' => $data['mobile'],
            'password' => $data['password'],
            'status' => 1,
            'reg_time' => time(),
            'province' => $data['province'],
            'city' => $data['city'],
            'district' => $data['district'],
            'sex' => $data['sex'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
            'balance' => $data['balance'],
            'member_grade' => 1
        );
        $res = model('user')->saveUser($add_data);
        if($res !== false){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }
    }
}