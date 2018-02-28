<?php
namespace app\mobile\controller;
use app\home\logic\GoodsLogic;
use think\Controller;

class Goods extends Base
{
    private $goods;
    private $activity;
    private $goodsOrder;
    private $user;
    public function _initialize(){
        $this->goods = model('Goods');
        $this->activity = model('Activity');
        $this->goodsOrder = model('goodsOrder');
        $this->user = model('user');
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

        $map = array();
        $map['status'] = 1;
        $data['search'] != '' ? $map['title'] = ['like',"%".$data['search']."%"] : false;

        $result = $this->goods->getGoodsBySearch($data['search']);

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
    	$orderInfo = $this->goodsOrder->find($id);
        $goodsInfo = $this->goods->find($orderInfo->gid);
        $userInfo = $this->user->find($orderInfo->uid);
    	return $this->fetch('',[
    	    'orderInfo'=>$orderInfo,
            'goodsInfo'=>$goodsInfo,
            'userInfo'=>$userInfo,
        ]);
    }

    //搜索界面
    public function search_list(){
        return $this->fetch();
    }

    //搜索界面数据
    public function ajax_search_list(){
        $data = input('get.');

        //type1搜活动2搜商品
        if($data['type'] == 1){
            $map['a_status'] = 1;
            $data['search'] != '' ? $map['a_title'] = ['like',"%".$data['search']."%"] : false;
            $field = 'aid,a_title,a_img,a_begin_time,a_end_time,a_num,a_adult_price,a_child_price,a_address';
            $result = $this->activity->field($field)
                ->where($map)
                ->paginate(10);
            $result = objectArray($result);
            if(!empty($result['data'])){
                $str = $this->fetch('activity/ajax_activity_list',[
                    'result'=>$result['data']
                ]);
                return_info(200,'成功',$str);
            }else{
                return_info(-1,'数据为空');
            }
        }else{
            $result = $this->goods->getGoodsBySearch($data['search']);
            if(!empty($result['data'])){
                $str = $this->fetch('goods/ajax_goods_list',[
                    'result'=>$result['data']
                ]);
                return_info(200,'成功',$str);
            }else{
                return_info(-1,'数据为空');
            }
        }
    }
}
