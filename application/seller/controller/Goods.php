<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\seller\controller;

class Goods extends Base
{
    private $goods;

    public function _initialize(){
       $this->goods = model('Goods');
    }

    //商品首页
    public function index(){
        return $this->fetch();
    }
}