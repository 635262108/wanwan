<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityType extends Model
{
    /**
     * 获取标题
     */
    public function getTitle(){
        $map['fid'] = 0;
        $map['is_dis'] = 1;
        return $this->where($map)->order('sort asc')->select();
    }
    
    /**
     * 获取标题信息
     * @param type $id
     */
    public function getAnyTitle($id){
        return $this->where('id',$id)->find();
    }
    
    /**
     * 获取标题的子标题
     * @param type $fid
     */
    public function getTitleSon($fid){
        $map['fid'] = $fid;
        return $this->where($map)->order('sort asc')->select();
    }
    /**
     * 获取标题详细信息
     * @param type $title_id
     */
    public function getTitleInfo($title_id){
        $map['t.id'] = $title_id;
        return $this->alias('t')->join('mfw_activity_type_extension e','t.id=e.type_id')->where($map)->find();
    }
    
    //获取所有标题
    public function getAllTitle(){
        return $this->select();
    }
    
    /**
     * 增加分类
     * @param type $name 名称
     * @param type $sort 排序
     * @param type $fid  上级id
     * @return type
     */
    public function addTitle($name,$sort = 0,$fid = 0){
        $data['name'] = $name;
        $data['sort'] = $sort;
        $data['fid'] = $fid;
        return $this->insert($data);
    }
    
    //修改分类
    public function saveTitle($data){
        return $this->update($data);
    }
    
    //删除分类
    public function delTitle($id){
        return $this->where('id',$id)->delete();
    }
}