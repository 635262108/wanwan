<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:50
 */

namespace app\common\model;


use think\Model;

class Role extends Model
{
    /**
     * 获取所有角色信息
     * @param array $map
     * @param string $limit
     * @param string $field
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function  getRoleAll($map=array(),$limit='',$field='*'){
        return  $this->where($map)->field($field)->limit($limit)->select();
    }

    /**
     * 获取单挑角色信息
     * @param array $map
     * @param string $field
     */
    public function getRole($map=array(),$field='*'){
        return  $this->where($map)->field($field)->find();
    }
}