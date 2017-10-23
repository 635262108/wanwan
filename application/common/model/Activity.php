<?php


namespace app\common\model;

use think\Model;
use think\Db;

class Activity extends Model
{

    /**
	* 获取*条玩宝下最新的活动信息(付费活动)
	*@type 2:五官,3:四肢,4:整体,5:性启蒙,6:心理,不传全查
	*@field 需要字段，默认全查
	*@limit 限制条数
    */
    public function getActivity($type = 0,$limit = 0,$field = '*'){
    	if($type > 0){
    		$map['a_type'] = $type;
    	}else{
    		$map = array();
    	}
        $map['a_price'] = array('gt',0);
    	$data = $this->where($map)->field($field)->order('aid desc')->limit($limit)->select();
    	return objectArray($data);
    }

    /**
    * 根据aid获取某条活动信息
    *@aid 活动id
    *@field 需要字段，默认全查
    */
    public function getIdActivity($aid = 0,$field = '*'){
    	$data = $this->field($field)->find($aid);
    	return $data;
    }
    
    /**
    * 根据aid获取某条活动信息(带行级锁)
    *@aid 活动id
    *@field 需要字段，默认全查
    */
    public function getIdActivityForUpdate($aid = 0,$field = '*'){
    	$data = $this->field($field)->lock(true)->find($aid);
    	return $data;
    }

    /**
    * 根据aid获取多条活动信息
    *@aids 活动id
    *@field 需要字段，默认全查
    */
    public function getIdsActivity($aids = 0,$field = '*'){
        $data = $this->field($field)->select($aids);
        return $data;
    }

    /**
	* 获取推荐活动
    */
    public function getRecommendInfo(){
    	$field = 'aid,a_index_img,a_price,a_title';
    	$map['a_is_recommend'] = 1;
    	$data = $this->where($map)->field($field)->select();
    	return $data;
    }

    /**
    *得到活动数量
    */
    public function getActivityNum(){
        return $this->count();
    }
    
    /**
     * 获取某个范围的活动
     * @param type $in
     * @field 需要字段，默认全查
     */
    public function getInActivity($in,$field = '*') {
        $map['a_type'] = array('in',$in);
        return $this->where($map)->select();
    }
    
    /**
     * 减少库存
     * @param type $aid
     */
    public function DecActivity($aid){
        $this->where('aid',$aid)->setDec('a_num');
    }
    
    
    /**
     * 增加报名数量
     * @param type $aid
     */
    public function IncActivity($aid){
        $this->where('aid',$aid)->setInc('a_sold_num');
    }
    
    /**
     * 获取免费活动
     * @return type
     */
    public function getFreeActivity(){
        $map['a_price'] = 0;
        return $this->where($map)->order('aid desc')->select();
    }

    /**获取所有活动
     * @param string $field
     * @param string $offset
     * @param string $limit
     */
    public function getActivityAll($field = '*',$offset = '',$limit = ''){
        return $this->field($field)->limit($offset,$limit)->order('aid desc')->select();
    }
    
    /**
     * 修改活动信息
     * @param type $data 包含主键aid
     */
    public function saveActivity($data){
        return $this->update($data);
    }
    
    /**
     * 删除活动
     * @param type $aid
     * @return type
     */
    public function delActivity($aid){
        return $this->where('aid',$aid)->delete();
    }
    
    //添加活动
    public function addActivity($data){
        return $this->insert($data);
    }
    
    /**
     * 获取活动（带条件）
     * @param type $map 条件
     * @return type
     */
    public function getActivityMap($map){
        return $this->where($map)->select();
    }
    
    //获取出勤表
    public function getAttendance(){
        $sql = 'SELECT
                    a.aid,
                    a.a_title,
                    a.a_num,
                    a.a_sold_num,
                    (
                            SELECT
                                    count(*)
                            FROM
                                    mfw_activity_order
                            WHERE
                                    aid = a.aid
                            AND order_status = 4
                    ) attendance
                FROM
                    mfw_activity AS a';
        return $this->query($sql);
    }
}