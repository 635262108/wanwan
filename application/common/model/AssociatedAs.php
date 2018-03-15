<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:50
 */

namespace app\common\model;


use think\Model;

class AssociatedAs extends Base
{
    //获取分店活动首页数据
    public function getSellerActivityIndexList($sid = 0){
        $map = [
            'sid' => $sid,
        ];
        $field = 's.id,a_title,a_img,a_begin_time,a_end_time,a_adult_price,a_child_price,member_child_price,s.status,member_adult_price,a.aid';
        return $this->where($map)->alias('s')
                ->field($field)
                ->join('__ACTIVITY__ a','a.aid = s.aid')
                ->select();
    }

    //获取分店商品首页数据
    public function getSellerGoodsIndexList($sid = 0){
        $map = [
            'sid' => $sid,
        ];
        $field = 's.id,a_title,a_img,a_begin_time,a_end_time,a_adult_price,a_child_price,member_child_price,s.status,member_adult_price';
        return $this->where($map)->alias('s')
            ->field($field)
            ->join('__ACTIVITY__ a','a.aid = s.aid')
            ->select();
    }
}