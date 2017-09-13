<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityRefund extends Model
{
    /**
     * 新增退款信息
     * @param type $uid
     * @param type $aid
     * @param type $reason
     */
    public function addRefund($uid,$aid,$reason,$order_sn){
        $data['uid'] = $uid;
        $data['aid'] = $aid;
        $data['reason'] = $reason;
        $data['order_sn'] = $order_sn;
        $data['time'] = time();
        $data['type'] = 1;
        
        $this->insert($data);
        return $data['time'];
    }
    /**
     * 根据订单号获取任意一条退款信息
     * @param type $order_sn
     * @param type $field
     */
    public function getSnAnyOneRefund($order_sn,$field){
        $map['order_sn'] = $order_sn;
        $data = $this->field($field)->where($map)->find();
        return $data;
    }
    /**
     * 新增请假信息
     * @param type $uid
     * @param type $aid
     * @param type $reason
     */
    public function addLeave($uid,$aid,$reason,$order_sn){
        $data['uid'] = $uid;
        $data['aid'] = $aid;
        $data['reason'] = $reason;
        $data['order_sn'] = $order_sn;
        $data['time'] = time();
        $data['type'] = 2;
        
        $this->insert($data);
    }
    
    //获取请假信息
    public function getAllLeave(){
        $map['type'] = 2;
        $field = 'r.*,a.a_title,u.nickname,u.mobile';
        return $this->alias('r')->field($field)->join('mfw_activity a','r.aid=a.aid')->join('mfw_user u','r.uid=u.uid')->where($map)->select();
    }
    
    //获取退款信息
    public function getAllRefund(){
        $map = 'r.type=1 or r.type=3';
        $field = 'r.*,a.a_title,u.nickname,u.mobile';
        return $this->alias('r')->field($field)->join('mfw_activity a','r.aid=a.aid')->join('mfw_user u','r.uid=u.uid')->where($map)->select();
    }
    
    //获取单个退款信息
    public function getAnyRefund($id){
        return $this->where('id',$id)->find();
    }
    
    //修改退款状态
    public function saveRefund($data){
        return $this->update($data);
    }
}