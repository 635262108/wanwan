<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25 0025
 * Time: 下午 3:21
 */

namespace app\common\model;
use think\Model;

class RechargeRecord extends Model
{

    //所有已成功的订单
    protected function scopeSuccess($query){
        $query->where('status',1);
    }

    //当月已成功的订单
    protected function scopeSuccessMonth($query){
        $query->whereTime('pay_time','month')->where('status',1);
    }

    //当周已成功订单
    protected function scopeSuccessWeek($query){
        $query->whereTime('pay_time','week')->where('status',1);
    }

    //当天已成功订单
    protected function scopeSuccessToday($query){
        $query->whereTime('pay_time','today')->where('status',1);
    }
    /**
     * 添加或更新数据
     * @param $data
     */
    public function saveRecharge($data){
        return $this->save($data);
    }

    /**
     * 根据id获取单条充值记录
     * @param $id
     * @return array|false|\PDOStatement|string|Model
     */
    public function getIdRecharge($id){
        return $this->find($id);
    }

    /**
     * 获取一条充值记录
     * @param $map
     * @return array|false|\PDOStatement|string|Model
     */
    public function getRecharge($map){
        return $this->where($map)->find();
    }

    /**
     * 获取充值记录
     * @param $map
     * @param $limit
     * @param string $field
     */
    public function getRechargeAll($map = array(),$limit = '',$field = '*'){
        return $this->field($field)->where($map)->order('id desc')->limit($limit)->select();
    }

    //获取某个用户已成功的充值
    public function getUserRecharge($uid=0){
        $map = [
            'uid' => $uid,
            'status' => 1
        ];
        return $this->where($map);
    }

    //获取用户的充值记录
    public function getUserRechargeRecord($field='*',$map=array()){
        $res = $this->alias('r')
            ->field($field)
            ->join('mfw_user u','r.uid=u.uid','left')
            ->where($map)
            ->select();
        return $res;
    }

    //获取用户某个时间段充值记录
    public function getUserBetweenTimeRechargeRecord($field='*',$beginTime = 0,$endTime = 0){
        $res = $this->alias('r')
            ->field($field)
            ->join('mfw_user u','r.uid=u.uid','left')
            ->whereTime('pay_time','between', [$beginTime,$endTime])
            ->select();
        return $res;
    }
}