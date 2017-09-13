<?php


namespace app\common\model;

use think\Model;
use think\Db;
use think\Cache;

class Region extends Model
{
    /**
     * 获取任意等级的地区数据
     * @param type $level
     */
    public function getAnyLevelData($level){
        $map['level'] = $level;
        return $this->where($map)->select();
    }
    /**
     * 获取子级元素
     * @param type $id
     */
    public function getSonData($id){
        $map['parent_id'] = $id;
        return $this->where($map)->select();
    }
    
    /**
     * 获取单个地区信息
     * @param type $id
     */
    public function getAnyData($id){
        return $this->where('id',$id)->find();
    }
}