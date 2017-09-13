<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityTypeBanner extends Model
{
    //查
    public function getAll(){
        return $this->select();
    }
    
    //改
    public function save($data){
        return $this->save($data);
    }
    
    //增
    public function add($data){
        return $this->insert();
    }
    
    //删
    public function delete($id){
        return $this->where('banner_id',$id)->delete();
    }
}