<?php
namespace app\admin\controller;
use think\Controller;
use think\model;
use app\admin\logic\ServiceLogic;
class Service extends Base
{

    //客服首页
    public function index(){
        //获取数据enrol_num报名人数access_num待确认人数visit_num待回访人数
        $res = model('activity')->query("select a_title,aid,
                    (select count(*) from mfw_activity_order where aid=mfw_activity.aid) as enrol_num,
                    (select count(*) from mfw_activity_order where aid=mfw_activity.aid and is_enter=0 ) as access_num,
                    (select count(*) from mfw_activity_order where aid=mfw_activity.aid and t_id>0 and sign_time>0) as visit_num
                    from mfw_activity");
        $this->assign('res',$res);
        return $this->fetch();
    }

    //预约记录
    public function access($aid){
        //获取数据
        $map['is_enter'] = 0;
        $res = model('ActivityOrder')->field('o.*,t.t_content')
                ->alias('o')
                ->join('mfw_activity_time t','o.t_id=t.t_id','left')
                ->where('o.aid',$aid)
                ->select();
        $this->assign('res',$res);
        return $this->fetch();
    }

    //更改订单备注显示
    public function dis_save_access($aid,$oid){
        //获取时间段
        $time = model('ActivityTime')->getActivityTime($aid);
        $this->assign('oid',$oid);
        $this->assign('aid',$aid);
        $this->assign('time',$time);
        return $this->fetch();
    }

    //更改订单时间、备注
    public function save_access(){
        $data['aid'] = input('post.aid');
        $data['record'] = input('post.record');
        $data['t_id'] = input('post.t_id');
        $data['oid'] = input('post.oid');
        $data['is_enter'] = input('post.is_enter');

        //修改
        $model = new ServiceLogic();
        $res = $model->saveAccess($data);
        if($res['status'] == 200){
            $this->success($res['msg'],url('admin/service/access',['aid'=>$data['aid']]));
        }else{
            $this->error($res['msg']);
        }
    }

    //回访记录
    public function  return_visit($aid){
        //获取数据
        $map['o.aid'] = $aid;
        $map['o.sign_time'] = array('gt',0);
        $res = model('ActivityOrder')
                ->alias('o')
                ->field('o.*,s.name source_name,t.t_content')
                ->join('mfw_source s','o.source=s.id')
                ->join('mfw_activity_time t','t.t_id=o.t_id')
                ->where($map)->select();
        $this->assign('res',$res);
        return $this->fetch();
    }

    //添加回访记录显示
    public function dis_save_visit($aid,$oid){
        $this->assign('oid',$oid);
        $this->assign('aid',$aid);
        return $this->fetch();
    }

    //更改订单时间、备注
    public function save_visit(){
        $data['aid'] = input('post.aid');
        $data['record'] = input('post.record');
        $data['t_id'] = input('post.t_id');
        $data['oid'] = input('post.oid');

        //修改
        $model = new ServiceLogic();
        $res = $model->saveAccess($data);
        if($res['status'] == 200){
            $this->success($res['msg'],url('admin/service/return_visit',['aid'=>$data['aid']]));
        }else{
            $this->error($res['msg']);
        }
    }
}