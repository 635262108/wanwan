<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:50
 */

namespace app\common\model;
use think\Model;

class UserChild extends Model
{
   //获取某个用户的孩子信息
    public function getAnyUserChilds($uid=0){
        $map = [
            'uid' => $uid,
        ];
        return $this->where($map)->select();
    }

    //根据孩子姓名模糊查询数据
    public function getChildNameData($name = ''){
        if($name == ''){
            return '';
        }
        $map = [
            'name' => ['like',"%".$name."%"]
        ];
        return $this->where($map)->select();
    }
}