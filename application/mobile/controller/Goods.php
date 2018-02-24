<?php
namespace app\mobile\controller;
use app\home\logic\GoodsLogic;
use think\Controller;

class Goods extends Base
{
    private $goods;

    public function _initialize(){
        $this->goods = model('Goods');
    }

    //商品详情
    public function goods_detail($id){
    	$result = $this->goods->find($id);
    	return $this->fetch('',[
    	    'result'=>$result
        ]);
    }

    //选择支付方式
    public function goods_select_pay(){

    }
}
