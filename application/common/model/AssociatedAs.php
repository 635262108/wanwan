<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:50
 */

namespace app\common\model;


use think\Model;

class AssociatedAs extends Base
{
    //获取某个店的活动id
    public function getBySId($sid = 0){
        return $this->where('sid',$sid)->select();
    }
}