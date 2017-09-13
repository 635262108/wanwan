<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityExtension extends Model
{
    /**
    * 获取活动扩展信息
    *@aid 活动id
    */
    public function getExtensionInfo($aid = 0){
    	$map['aid'] = $aid;
    	$data = $this->where($map)->select();
    	return $data;
    }
    
    /**
     * 获取所有信息
     * @return type
     */
    public function getAll(){
        $field = "e.*,a.a_title";
        return $this->alias('e')->field($field)->join('mfw_activity a','a.aid=e.aid','LEFT')->select();
    }
    
    //获取某个信息
    public function getAnyInfo($eid){
        return $this->where('extension_id',$eid)->find();
    }
    
    //获取某个扩展信息和活动信息
    public function getAnyExtActivity($eid){
        $map['e.extension_id'] = $eid;
        $field = "e.*,a.a_title";
        return $this->alias('e')->field($field)->join('mfw_activity a','a.aid=e.aid','LEFT')->where($map)->find();
    }
    
    //修改扩展
    public function updataExtension($data){
        return $this->update($data);
    }
    
    //新增扩展
    public function addExtension($data){
        return $this->insert($data);
    }
}