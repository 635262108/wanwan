<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityCollection extends Model
{
    /**
     * 收藏
     * @param type $aid 活动id
     * @param type $uid 用户id
     * @return type 
     */
    public function addCollection($aid,$uid){
    	$data['aid'] = $aid;
        $data['uid'] = $uid;
        $data['time'] = time();
    	$this->insert($data);
    }
    
    /**
     * 取消收藏
     * @param type $aid 活动id
     * @param type $uid 用户id
     */
    public function delCollection($aid,$uid){
    	$map['aid'] = $aid;
        $map['uid'] = $uid;
    	$this->where($map)->delete();
    }
    
    /**
     * 查看是否收藏
     * @param type $aid 活动id
     * @param type $uid 用户id
     */
    public function isCollection($aid,$uid){
    	$map['aid'] = $aid;
        $map['uid'] = $uid;
    	$data = $this->where($map)->find();
        return $data;
    }
    
    /**
     * 查看我的收藏（带活动）
     * @param type $uid
     */
    public function myCollection($uid){
        $map['c.uid'] = $uid;
        $data = $this->alias('c')->join('mfw_activity a','a.aid = c.aid')->where($map)->select();
        return $data;
    }
    
    //查看我的收藏
    public function myCollections($uid){
        $map['uid'] = $uid;
        return $this->where($map)->select();
    }
}