<?php


namespace app\common\model;

use think\Model;
use think\Db;

class Goods extends Base
{
    //根据标题搜索商品
	public function getGoodsBySearch($search = ''){
        $map['status'] = 1;
        $search != '' ? $map['title'] = ['like',"%".$search."%"] : false;
        $field = 'id,title,img,inventory,sold_num,price';
        $result = $this->field($field)
            ->where($map)
            ->paginate(10);
        return objectArray($result);
    }

    //增加出售数量
    public function addSoldNum($id = 0,$num = 1){
	    return $this->where('id',$id)->setInc('sold_num',$num);
    }
}