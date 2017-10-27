<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 2:39
 */

namespace app\common\model;


class AdminUser extends model
{
    /**
     * 获取单个数据
     * @param array $map
     * @param string $offset
     * @param string $limit
     */
    public function getUser($map = array()){
        return $this->where($map)->find();
    }

    /**
     * 获取一组数据
     * @param array $map
     * @param string $offset
     * @param string $limit
     */
    public function getUsers($map = array(),$offset = '',$limit = ''){
        return $this->where($map)->limit($offset,$limit)->order('id desc')->select();
    }

    /**
     * 根据id获取一条数据
     * @param $id
     * @return mixed
     */
    public function getUserId($id){
        return $this->find($id);
    }
}