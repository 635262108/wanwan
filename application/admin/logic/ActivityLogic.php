<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 上午 10:53
 */
namespace app\admin\Logic;
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
}