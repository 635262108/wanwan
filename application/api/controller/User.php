<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\api\controller;
use think\Controller;
use think\Exception;
use think\Validate;

class User extends Controller
{

    //修改个人信息
    public function saveUser(){
        $data = input('post.');
        if(!empty($data['birthday'])){
            $data['birthday'] = strtotime($data['birthday']);
        }

        $user = model('user');
        $res = $user->save($data,['uid'=>$data['uid']]);
        if($res){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //获取某个用户的孩子信息
    public function getAnyUserChilds(){
        $uid = input('post.uid/d');
        if(!$uid){
            return_info(-1,'error');
        }
        $childInfo = model('UserChild')->getAnyUserChilds($uid);
        return_info(200,'success',$childInfo);
    }

    //获取某个用户的明细
    public function getAnyUserConsumption(){
        $uid = input('post.uid/d');
        if(!$uid){
            return_info(-1,'error');
        }
        $type = input('post.type/d');
        $where = array();
        $where['uid'] = $uid;
        $type != '' ? $where['type'] = $type : false;

        $detailInfo = model('UserDetail')->where($where)->select();

        foreach($detailInfo as $k=>$v){
            $v['type'] = user_detail_type($v['type']);
            $v['addtime'] = date('Y-m-d H:i');
        }
        return_info(200,'success',$detailInfo);
    }

    //请假
    public function askForLeave(){
        if(!request()->isAjax()) {
            return_info(-1,'请求错误');
        }
        $data = input('post.');
        $orderInfo = model('ActivityOrder')->get($data['id']);
        if($orderInfo->uid < 1){
            $userInfo = model('user')->getMobileUserInfo($orderInfo->mobile);
        }else{
            $userInfo = model('user')->get($orderInfo->uid);
        }

        if(empty($orderInfo) || empty($userInfo)){
            return_info(-1,'无效id');
        }
        $orderInfo->order_status = 7;
        $orderInfo->save();

        //恢复名额
        $inc = model('ActivityTime')->IncTicketNum($orderInfo->t_id);

        $add_data = [
            'aid' => $orderInfo->aid,
            'uid' => $orderInfo->uid,
            'order_sn' => $orderInfo->order_sn,
            'reason' => $data['reason'],
            'time' => time(),
            'type' => 2
        ];
        $res = model('ActivityRefund')->insert($add_data);
        if($res & $inc){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //充值
    public function recharge(){
        $data = input('post.');
        $validate = validate('User');
        $check = $validate->scene('recharge')->check($data);
        if(!$check){
            return_info(-1,$validate->getError());
        }

        if(empty($data['pay_time'])){
            $data['pay_time'] = date('Y-m-d H:i:s',time());
        }

        //修改用户余额
        $userInfo = model('User')->get($data['uid']);
        if(empty($userInfo)){
            return_info(-1,'uid不合法');
        }
        $userInfo->balance = $userInfo->balance + $data['amount'];
        $userInfo->save();

        //记录充值订单
        $data['status'] = 1;
        $data['order_sn'] = getOrderSn($data['uid']);
        $data['pay_time'] = strtotime($data['pay_time']);
        $addRecharge = model('RechargeRecord')->insert($data);

        //记录订单明细
        $detail_data = [
            'uid' => $data['uid'],
            'type' => 1,
            'money' => $data['amount'],
            'balance' => $userInfo->balance,
            'addtime' => $data['pay_time'],
        ];

        $addDetail = model('UserDetail')->insert($detail_data);
        if($addDetail & $addRecharge){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //扣费
    public function deductionFee(){
        $data = input('post.');

        $validate = validate('User');
        $check = $validate->scene('deductionFee')->check($data);
        if(!$check){
            return_info(-1,$validate->getError());
        }

        //修改用户余额
        $userInfo = model('User')->get($data['uid']);
        if(empty($userInfo)){
            return_info(-1,'uid不合法');
        }
        $userInfo->balance = $userInfo->balance - $data['money'];
        $saveInfo = $userInfo->save();

        //记录订单明细
        $detail_data = [
            'uid' => $data['uid'],
            'type' => 2,
            'money' => $data['money'],
            'balance' => $userInfo->balance,
            'addtime' => time(),
            'remark' => $data['remark'],
        ];

        $addDetail = model('UserDetail')->insert($detail_data);
        if($addDetail & $saveInfo){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //更新孩子
    public function saveChild(){
        $data = input('post.');
        if(empty($data['id'])){
            $data['addtime'] = time();
            if(!empty($data['birthday'])){
                $data['birthday'] = strtotime($data['birthday']);
            }
            $res = model('UserChild')->insert($data);
        }else{
            if(!empty($data['birthday'])){
                $data['birthday'] = strtotime($data['birthday']);
            }
            $res = model('UserChild')->save($data,['id'=>$data['id']]);
        }
        if($res){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //删除孩子
    public function delChild(){
        $id = input('post.id');
        if(empty($id)){
            return_info(-1,'参数不完整');
        }
        $res = model('UserChild')->destroy($id);
        if($res){
            return_info(200,'success');
        }else{
            return_info(-1,'fail');
        }
    }

    //根据手机号获取用户信息
    public function getUserInfo(){
        $data = input('post.');

        if(!empty($data['field'])){
            $field = $data['field'];
        }else{
            $field = '*';
        }
        //接口与手机号也兼容，try...catch防止客户端调用不存在的字段报错
        if(isMobile($data['uid'])){
            try{
                $userInfo = model('User')->getMobileUserInfo($data['uid'],$field);
            }catch (Exception $e){
                return_info(-1,'字段不存在');
            }
        }else{
            try{
                $userInfo = model('User')->field($field)->get($data['uid']);
            }catch (Exception $e){
                return_info(-1,'字段不存在');
            }
        }
        return_info(200,'success',$userInfo);
    }

    //撤销明细
    public function undoUserConsumeDetail(){
        $id = input('post.id/d');
        if(!$id){
            return_info(-1,'fail');
        }

        $detail = model('UserDetail')->find($id);
        $detail->type = 0;
        //余额更新
        $userInfo = model('User')->find($detail['uid']);
        if($detail['type'] == 1 || $detail['type'] == 3){
            //明细扣费增加余额
            $userInfo->balance = $userInfo->balance + $detail->money;

        }else if($detail['type'] == 2){
            //明细增加扣除余额
            $userInfo->balance = $userInfo->balance - $detail->money;
        }

        try{
            $detail->save();
            $userInfo->save();
            //返回余额
            $result = [
                'balance' => $userInfo->balance,
            ];
            return_info(200,'success',$result);
        }catch (\Exception $e){
            return_info(-1,$e->getMessage());
        }

    }
}