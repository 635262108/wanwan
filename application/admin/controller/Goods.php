<?php
namespace app\admin\controller;
use think\Controller;

class Goods extends Base
{
    private $goods;

    public function _initialize(){
        $this->goods = model('Goods');
    }

    public function index(){
        $data = $this->goods->select();
        return $this->fetch('',[
            'data'=>$data
        ]);
    }

    //显示添加商品界面
    public function dis_add_goods(){
        return $this->fetch();
    }

    //显示更新商品界面
    public function dis_save_goods($gid){
        $data = $this->goods->find($gid);
        if (empty($data)){
            $this->error('商品信息异常');
        }
        return $this->fetch();
    }

    //更新商品
    public function save_goods(){
        $data = input('post.');

        //商品图
        $img = request()->file('img');
        if(!empty($img)){
            $a_img = $img->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'admin_img');
            if($a_img){
                $data['img'] = $a_img->getSaveName();
            }else{
                // 上传失败获取错误信息
                $this->error($a_img->getError());
            }
        }

        if(!empty($data['id'])){
            $res = $this->goods->allowField(true)->save($data,['id'=>$data['id']]);
        }else{
            $data['on_time'] = time();
            $res = $this->goods->insert($data);
        }

        if($res){
            $this->success('操作成功','goods/index');
        }else{
            $this->success('操作失败');
        }
    }
}
