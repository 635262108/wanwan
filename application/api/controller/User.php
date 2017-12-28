<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 3:02
 */
namespace app\api\controller;
use think\Controller;
use think\Validate;

class User extends Controller
{
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
        $detaiInfo = model('UserDetail')->getAnyUserDetail($uid);
        foreach($detaiInfo as $k=>$v){
            if($v['type'] == 1){
                $v['type'] = '充值';
            }elseif ($v['type'] == 2){
                $v['type'] = '扣费';
            }else{
                $v['type'] = '付费';
            }
        }
        return_info(200,'success',$detaiInfo);
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
}