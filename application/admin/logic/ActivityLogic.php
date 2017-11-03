<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 上午 10:53
 */
namespace app\admin\Logic;
use app\admin\logic\UserLogic;
class ActivityLogic{
    /**
     * 获取活动安排表
     * @return mixed
     */
    public function getActivityTime(){
        //获取记录
        $ActivityTime = model('ActivityTime');
        $res = $ActivityTime->alias('t')
            ->field('t.*,a.a_title,u.name')
            ->join('mfw_activity a','t.aid=a.aid','LEFT')
            ->join('mfw_admin_user u','t.head=u.id','LEFT')
            ->select();
        return $res;
    }

    /**
     * 添加或修改订单
     * @param $data
     * @return array
     */
    public function save_order($data){
        //修改
        if(!empty($data['order_id'])){
           $res = db('activity_order')->update($data);
           if($res){
               return array('status'=>200,'msg'=>'更新成功');
           }else{
               return array('status'=>-1,'msg'=>'更新失败');
           }
        }

        //扣费
        if($data['uid']>0 & $data['order_price']>0 & $data['pay_way'] == 4) {
            $user = model('user')->find($data['uid']);
            $user->balance = $user['balance'] - $data['order_price'];
            if ($user->balance < 0) {
                return array('status' => -1, 'msg' => '余额不足');
            }else{
                $user->save();
                //记录扣费
                $model = new UserLogic();
                $set_data['uid'] = $data['uid'];
                $set_data['type'] = 2;
                $set_data['money'] = $data['order_price'];
                $set_data['balance'] = $user->balance;
                $set_data['uid'] = $data['uid'];
                //记录活动
                $activity = model('activity')->find($data['aid']);
                $set_data['remark'] =   "参加".$activity->a_title."活动,管理员手动添加";
                $res = $model->saveDetail($set_data);
                if($res === false){
                    return array('status'=>-1,'msg'=>'扣费失败');
                }
            }
        }
        //添加
        $res = db('activity_order')->insert($data);
        if($res){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }


    }
}