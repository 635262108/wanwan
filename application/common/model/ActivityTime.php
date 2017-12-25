<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityTime extends Model
{

    protected $type = [
        'begin_time' => 'timestamp:Y-m-d H:i',
        'end_time'  =>  'timestamp:H:i'
    ];

    /**
     * 获取某个活动的时间段
     * @param type $aid
     */
    public function getActivityTime($aid){
        return $this->where('aid',$aid)->select();
    }

    //只获取显示的活动时间
    public function  getDisAidTime($aid){
        $map = [
            'aid' => $aid,
            'is_display'=>1
        ];
        return $this->where($map)->select();
    }

    /**
     *获取某个时间 
     * @param type $tid
     */
    public function getAnyTime($tid){
        return $this->where('t_id',$tid)->find();
    }
    
    /**
     * 减少库存
     * @param type $t_id
     */
    public function DecTicketNum($t_id,$num = 1){
        return $this->where('t_id',$t_id)->setDec('ticket_num',$num);
    }

    //增加库存
    public function IncTicketNum($t_id,$num = 1){
        return $this->where('t_id',$t_id)->setInc('ticket_num',$num);
    }
    
    //获取所有时间段(带活动信息）
    public function getAllTime(){
        $field = 't.*,a.a_title';
        return $this->alias('t')->field($field)->join('mfw_activity a','t.aid=a.aid','LEFT')->select();
    }
   
    //删除某个规格
    public function delAnySpe($tid){
        return $this->where('t_id',$tid)->delete();
    }
    
    //增加规格
    public function add($data){
        return $this->insert($data);
    }
}