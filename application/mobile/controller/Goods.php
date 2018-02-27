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

    //商品首页
    public function goods_list(){
        $data = input('get.');
        $field = 'title,img,inventory,sold_num,price';

        $map = array();
        $map['status'] = 1;
        $data['search'] != '' ? $map['title'] = ['like',"%".$data['search']."%"] : false;

        $result = $this->goods->field($field)
            ->where($map)
            ->paginate(10);
        return $this->fetch('',[
            'result'=>$result
        ]);
    }

    //商品列表
    public function ajax_goods_list(){
        $data = input('get.');
        $field = 'title,img,inventory,sold_num,price';

        $map = array();
        $map['status'] = 1;
        $data['search'] != '' ? $map['title'] = ['like',"%".$data['search']."%"] : false;

        $result = $this->goods->field($field)
            ->where($map)
            ->paginate(10);
        $result = objectArray($result);
        if(!empty($result['data'])){
            $str = $this->fetch('',[
                'result'=>$result['data']
            ]);
            return_info(200,'成功',$str);
        }else{
            return_info(-1,'数据为空');
        }
    }

    //商品详情
    public function goods_detail($id = 0){
    	$result = $this->goods->find($id);
    	return $this->fetch('',[
    	    'result'=>$result
        ]);
    }

    //搜索界面
    public function search_list(){
        return $this->fetch();
    }
}
