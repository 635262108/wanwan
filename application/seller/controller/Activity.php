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
        $as = $this->AssociatedAs->getBySId($sid);

        foreach($as as $k=>$v){
            $aid[] = $v['aid'];
        }
        $aids = implode(',',$aid);

        $activityInfo = $this->Activity->where('aid','in',$aids)->select();
        return $this->fetch('',[
            'activityInfo' => $activityInfo
        ]);
    }

    //添加活动
    public function add(){
        return $this->fetch();
    }
}