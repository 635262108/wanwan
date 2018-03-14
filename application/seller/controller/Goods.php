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
    private $AssociatedGs;

    public function _initialize(){
        parent::_initialize();
       $this->goods = model('Goods');
       $this->AssociatedGs = model('AssociatedGs');
    }

    //商品首页
    public function index(){
        $sid = $this->store_info->id;
        $goodsInfo = $this->AssociatedGs->getSellerGoodsIndexList($sid);

        return $this->fetch('',[
            'goodsInfo' => $goodsInfo
        ]);
    }

    //修改关联表信息
    public function saveAssociatedGs(){
        $data = input('post.');
        if(empty($data['id'])){
            return_info(-1,'id不能为空');
        }
        $res = $this->AssociatedGs->allowField(true)->save($data,['id'=>$data['id']]);
        if($res){
            return_info(200,'更新成功');
        }else{
            return_info(-1,'更新失败');
        }
    }

    //删除分店商品
    public function delAssociatedGs(){
        $data = input('post.');
        if(empty($data['id'])){
            return_info(-1,'id不能为空');
        }
        $res = $this->AssociatedGs->destroy($data['id']);
        if($res){
            return_info(200,'删除成功');
        }else{
            return_info(-1,'删除失败');
        }
    }
}