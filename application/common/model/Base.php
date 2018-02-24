<?php


namespace app\common\model;

use think\Model;
use think\Db;

class Base extends Model
{
    //更新数据
	public function updateByMap($data,$map){
        return $this->allowField(true)->save($data,$map);
    }
}