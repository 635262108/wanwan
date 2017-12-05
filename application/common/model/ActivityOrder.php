<?php

namespace app\common\model;

use think\Model;
use think\Db;

class ActivityOrder extends Model
{	
	/**
	*增加活动订单
	*uid 用户id
	*aid 活动id
	*realname 联系人姓名
	*mobile 联系人手机号
	*order_price 订单价格
	*remark	订单描述
        *参加时间,免费活动专有
	*/
	public function addActivityOrder($uid,$aid,$realname,$mobile,$order_price,$adult_num,$child_num,$remark,$time = 0){
		$data['uid'] = $uid;
		$data['aid'] = $aid;
		$data['order_sn'] = $this->getOrderSn($uid,$aid);
		$data['name'] = $realname;
		$data['adult_num'] = $adult_num;
		$data['child_num'] = $child_num;
		$data['mobile'] = $mobile;
		$data['order_price'] = $order_price;
		$data['remark'] = $remark;
                $data['t_id'] = $time;
                if($order_price == 0){
                    $data['order_status'] = 3;
                }else{
                    $data['order_status'] = 2;
                }
		$data['addtime'] = time();
		$this->insert($data);
		$activityOrderId = $this->getLastInsID();

		$result['order_sn'] = $data['order_sn'];
		$result['activityOrderId'] = $activityOrderId;

		return $result;
	}

	/**
	*生成订单号
	*规则：当前时间+aid+uid
	*uid 用户id
	*aid 活动id
	*/
	public function getOrderSn($uid,$aid){
		$time = date('YmdHis');
		return $time.$aid.$uid;
	}

    /**
    * 根据订单号获取某条订单信息
    *@order_sn 订单号
    *@field 需要字段，默认全查
    */
    public function getSnOrderInfo($order_sn = 0,$field = '*'){
    	$map['order_sn'] = $order_sn;
    	$data = $this->where($map)->field($field)->find();
    	return $data;
    }
    /**
     * 获取我的订单
     * @param type $uid
     */
    public function getMyOrder($uid){
        $map['uid'] = $uid;
        $field = 'o.*,a.aid,a.a_index_img,a.a_title,a.a_begin_time,a.a_end_time';
        $data = $this->alias('o')->field($field)->join('mfw_activity a','o.aid=a.aid ')->where($map)->order('o.order_id desc')->select();
        return $data;
    }
    /**
     *修改订单状态 
     * @param type $order_sn
     * @param type $status
     */
    public function setOrderStatus($order_sn,$status){
        $map['order_sn'] = $order_sn;
        $data['order_status'] = $status;
        $this->where($map)->update($data);
    }
    
    //获取所有订单,带商品标题
    public function getAllOrder(){
        $field = 'o.*,a.a_title';
        return $this->alias('o')->field($field)->join('mfw_activity a','o.aid=a.aid')->select();
    }
    
    //获取某条(带条件)
    public function getOrder($map){
        return $this->where($map)->find();
    }
    
    //获取多条（带条件）
    public function getOrders($map=array(),$field='*',$limit=''){
        return $this->field($field)->where($map)->limit($limit)->select();
    }

    //获取考情详情数据
    public function getOrderJoinSource($map=array(),$field='*'){
        return $this->alias('o')
            ->join('mfw_source s','o.source=s.id','left')
            ->field($field)
            ->where($map)
            ->select();
    }
}