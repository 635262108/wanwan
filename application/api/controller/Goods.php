<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\api\controller;

class Goods extends Base
{
    private $goods;

    public function _initialize(){
       $this->goods = model('Goods');
    }

    //获取商品列表
    public function getGoods(){
        $data = input('get.');
        $field = 'title,img,inventory,sold_num,price';

        $map = array();
        $map['status'] = 1;
        $data['search'] != '' ? $map['title'] = ['like',"%".$data['search']."%"] : false;

        $result = $this->goods->field($field)
                ->where($map)
                ->paginate(10);
        return_info(200,'成功',$result);
    }
}