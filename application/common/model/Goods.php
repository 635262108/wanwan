<?php


namespace app\common\model;

use think\Model;
use think\Db;

class Goods extends Model
{
	/**
	* 获取活相关的商品
	*@aid 活动id
    */
    public function getRelatedGoods($aid = 0){
    	$field = 'gid,g_img,g_title,g_price';
    	$map['aid'] = $aid;
    	$data = $this->where($map)->field($field)->select();
    	return $data;
    }
}