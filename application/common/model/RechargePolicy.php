<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/18 0018
 * Time: 上午 11:14
 */

namespace app\common\model;


use think\Model;

class RechargePolicy extends Model
{

    //根据rechargeid获取数据
    public function getRechargeIdData($rid,$filed='*'){
        $map = [
            'recharge_id' => $rid
        ];

        return $this->field($filed)->where($map)->select();
    }
}