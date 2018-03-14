<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\seller\controller;

class Activity extends Base
{
    private $AssociatedAs;
    private $Activity;
    public function _initialize(){
        parent::_initialize();
        $this->AssociatedAs = model('AssociatedAs');
        $this->Activity = model('Activity');
    }

    //活动首页
    public function index(){
        $sid = $this->store_info->id;
        $activityInfo = $this->AssociatedAs->getActivityIndexList($sid);

        return $this->fetch('',[
            'activityInfo' => $activityInfo
        ]);
    }

    //添加活动
    public function add(){
        return $this->fetch();
    }

    //修改关联表信息
    public function saveAssociatedAs(){
        $data = input('post.');
        if(empty($data['id'])){
            return_info(-1,'id不能为空');
        }
        $res = $this->AssociatedAs->allowField(true)->save($data,['id'=>$data['id']]);
        if($res){
            return_info(200,'更新成功');
        }else{
            return_info(-1,'更新失败');
        }
    }

    //删除活动
    public function delAssociatedAs(){
        $data = input('post.');
        if(empty($data['id'])){
            return_info(-1,'id不能为空');
        }
        $res = $this->AssociatedAs->destroy($data['id']);
        if($res){
            return_info(200,'删除成功');
        }else{
            return_info(-1,'删除失败');
        }
    }
}