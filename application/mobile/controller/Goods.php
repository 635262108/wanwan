<?php
namespace app\mobile\controller;
use app\home\logic\GoodsLogic;
use think\Controller;
use wxpay\JsApiPay;

class Goods extends Base
{
    private $goods;
    private $activity;
    public function _initialize(){
        $this->goods = model('Goods');
        $this->activity = model('Activity');
    }

    //商品首页
    public function goods_list(){
        //微信浏览器先获取openid
        if(is_weixin()) {
            if (Session::get('openid') == null) {
                //获取openId
                $tools = new JsApiPay();
                $openId = $tools->getOpenid();
                session::set('openid', $openId);
            }
        }
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
    	$result = $this->goods->find($id);
    	return $this->fetch('',[
    	    'result'=>$result
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
