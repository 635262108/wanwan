<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25 0025
 * Time: 下午 3:21
 */

namespace app\common\model;
use think\Model;

class RechargeRecord extends Model
{

    /**
     * 添加或更新数据
     * @param $data
     */
    public function saveRecharge($data){
        return $this->save($data);
    }

    /**
     * 获取充值记录
     * @param $map
     * @param $limit
     * @param string $field
     */
    public function getRechargeAll($map = array(),$limit = '',$field = '*'){
        return $this->field($field)->where($map)->order('id desc')->limit($limit)->select();
    }
}