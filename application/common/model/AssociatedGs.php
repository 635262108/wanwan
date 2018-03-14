<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30 0030
 * Time: 下午 2:50
 */

namespace app\common\model;


use think\Model;

class AssociatedGs extends Base
{
    //获取分店商品首页数据
    public function getSellerGoodsIndexList($sid = 0){
        $map = [
            'sid' => $sid,
        ];
        $field = 's.id,title,s.inventory,s.sold_num,price,s.status';
        return $this->where($map)->alias('s')
            ->field($field)
            ->join('__GOODS__ g','g.id = s.gid')
            ->select();
    }
}