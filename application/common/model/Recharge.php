<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/18 0018
 * Time: 上午 10:44
 */

namespace app\common\model;
use think\Model;

class Recharge extends Model
{
    //上周充值
    protected function scopeLastWeek($query){
        $query->whereTime('pay_time','last week')->where('status',1);
    }

    //本周充值
    protected function scopeWeek($query){
        $query->whereTime('pay_time','week')->where('status',1);
    }
}