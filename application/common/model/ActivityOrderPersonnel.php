<?php


namespace app\common\model;

use think\Model;
use think\Db;

class ActivityOrderPersonnel extends Model
{

    /**
    *增加
    */
    public function addChild($name,$birthday,$gender,$activityOrderId,$uid){
        $data['personnel_name'] = $name;
        $data['personnel_birthday'] = time($birthday);
        $data['personnel_gender'] = $gender;
        $data['personnel_addtime'] = time();
        $data['order_id'] = $activityOrderId;
        $data['uid'] = $uid;
        $this->insert($data);
        $personnelId = $this->getLastInsID();
        return $personnelId;
    }
}