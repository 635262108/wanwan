<?php


namespace app\common\model;

use think\Model;
use think\Db;

class User extends Model
{
	/**
    * 根据uid获取某条用户信息
    *@uid 用户id
    *@field 需要字段，默认全查
    */
    public function getIdUser($uid = 0,$field = '*'){
        $data = $this->field($field)->find($uid);
        return $data;
    }

    /**
    * 根据手机号获取某条用户信息
    *@mobile 用户手机号
    *@field 需要字段，默认全查
    */
    public function getMobileUserInfo($mobile,$field = '*'){
    	$map['mobile'] = $mobile;
        $data = $this->field($field)->where($map)->find();
        return $data;
    }

    /**
	*注册
    */
    public function register($name,$mobile,$password){
        $data['nickname'] = $name;
    	$data['mobile'] = $mobile;
    	$data['password'] = md5($password);
    	$data['status'] = 1;
    	$data['reg_time'] = time();
        $data['last_time'] = time();
    	$this->insert($data);
    }
    
    /**
     *修改用户信息 
     * @param type $uid
     * @param type $data
     */
    public function saveUserInfo($uid,$data){
        $map['uid'] = $uid;
        return $this->where($map)->update($data);
    }
    /*
     * 获取所有用户信息
     */
    public function getAllUser(){
        return $this->order('uid desc')->select();
    }

    /**
     * 新增或更新用户信息
     * @param array $data
     * @return false|int|mixed
     */
    public function saveUser($data = array()){
        return $this->save($data);
    }

}