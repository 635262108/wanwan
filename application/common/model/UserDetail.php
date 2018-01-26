<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1 0001
 * Time: 下午 4:09
 */

namespace app\common\model;


use think\Model;

class UserDetail extends Model
{
    //获取某个用户明细
    public function getAnyUserDetail($uid=0){
        $map = [
            'uid'=>$uid,
            'type'=> ['neq',0],
        ];
        return $this->where($map)->select();
    }

    //根据操作获取用户明细
    public function getTypeUserDetail($uid = 0, $type = 0){
        $map = [
            'uid' => $uid,
            'type' => $type,
        ];
        return $this->where($map)->select();
    }
}