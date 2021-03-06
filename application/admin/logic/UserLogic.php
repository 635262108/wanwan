<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 2:29
 */
namespace app\admin\Logic;

class UserLogic{
    /**
     * 增加一个用户
     * @param $data
     */
    public function addUser($data = array()){
        //昵称不能为空
        if(empty($data['nickname'])){
            return array('status'=>-1,'msg'=>'昵称不能为空');
        }
        //检查手机号
        if(!isMobile($data['mobile'])){
            return array('status'=>-1,'msg'=>'手机号格式错误');
        }
        //检查余额是否为整数
        if(!is_numeric($data['balance'])){
            return array('status'=>-1,'msg'=>'金额必须为整数');
        }
        $userInfo = model('user')->where('mobile',$data['mobile'])->find();
        if(!empty($userInfo)){
            return array('status'=>-1,'msg'=>'此用户已存在客户表中，请勿重复添加');
        }
        //添加数据
        $add_data = array(
            'nickname' => $data['nickname'],
            'mobile' => $data['mobile'],
            'password' => md5($data['password']),
            'status' => 1,
            'reg_time' => time(),
            'province' => $data['province'],
            'city' => $data['city'],
            'district' => $data['district'],
            'sex' => $data['sex'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
            'source' => $data['source'],
        );
        $uid = model('user')->insertGetId($add_data);

        //有充值增加余额
        if($uid > 0 & $data['pay_way'] > 0 &  $data['balance'] > 0){
            $set_data['uid'] = $uid;
            $set_data['amount'] = $data['balance'];
            $set_data['pay_way'] = $data['pay_way'];
            $set_data['status'] = 1;
            $set_data['giveaway'] = $data['giveaway'];
            $set_data['is_get'] = $data['is_get'];
            $set_data['remark'] = $data['remark'];
            $set_data['pay_time'] = strtotime($data['pay_time']);

            $this->saveRecharge($set_data);
        }

        //有孩子信息添加孩子信息
        if(!empty($data['child_name']) & $uid>0){
            $num = count($data['child_name']);
            for($i=0;$i<$num;$i++){
                $add_child[$i]['uid'] = $uid;
                $add_child[$i]['name'] = $data['child_name'][$i];
                $add_child[$i]['gender'] = $data['child_gender'][$i];
                $add_child[$i]['birthday'] = $data['child_birthday'][$i];
                $add_child[$i]['school'] = $data['child_school'][$i];
                $add_child[$i]['play_time'] = $data['child_play_time'][$i];
                $add_child[$i]['time'] = date("Y-m-d H:i:s");
            }

            db('user_child')->insertAll($add_child);
        }

        if($uid > 0){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }
    }

    /**
     * 增加或修改用户充值
     * @param $data
     */
    public function saveRecharge($data){

        $rechargeRecord = model('RechargeRecord');
        //修改
        if(!empty($data['id'])){
            $res = $rechargeRecord->update($data);
            if($res !== false){
                return array('status'=>200,'msg'=>'更新成功');
            }else{
                return array('status'=>-1,'msg'=>'更新失败');
            }
        }

        //检查余额是否为整数
        if(!is_numeric($data['amount'])){
            return array('status'=>-1,'msg'=>'金额必须为整数');
        }

        //查看用户是否存在
        $user = model('user');
        $userInfo = $user->getIdUser($data['uid']);
        if(empty($userInfo)){
            return array('status'=>-1,'msg'=>'用户不存在');
        }

        //添加数据
        $data['order_sn'] = getOrderSn($data['uid'],000);
        $res = $rechargeRecord->insert($data);
        if($res !== false){
            //增加用户余额
            $userInfo->uid = $userInfo['uid'];
            $userInfo->balance = $userInfo['balance'] + $data['amount'];
            $userInfo->member_grade = 1;
            $result = $userInfo->save();
            //记录到用户金额明细
            $add_detail = array(
                'uid' =>   $data['uid'],
                'type' => 1,
                'money' =>   $data['amount'],
                'balance' =>   $userInfo->balance,
            );
            $this->saveDetail($add_detail);
            if($result !== false){
                return array('status'=>200,'msg'=>'充值成功');
            }else{
                return array('status'=>-1,'msg'=>'充值失败');
            }
        }else{
            return array('status'=>-1,'msg'=>'充值记录失败');
        }
    }

    /**
     * 获取用户金额消细
     * @param $uid
     */
    public function getUserRecord($uid){
        $reaharge = model('UserDetail')->alias('d')
            ->field('d.*,u.uid,u.nickname,u.mobile')
            ->join('mfw_user u','d.uid=u.uid','left')
            ->where('d.uid',$uid)
            ->select();
        return $reaharge;
    }

    /**
     * 增加或修改成单记录
     * @param $data
     */
    public function addDealRecord($data){
        //获取uid
        if(empty($data['uid'])){
            if(isMobile($data['mobile'])){
                $user = model('user')->getMobileUserInfo($data['mobile']);
                if(empty($user)){
                    return array('status'=>-1,'msg'=>'请先添加该会员');
                }
                $data['uid'] = $user['uid'];
            }else{
                return array('status'=>-1,'msg'=>'手机号输入错误');
            }
        }

        //检查金额是否为整数
        if(!is_numeric($data['money'])){
            return array('status'=>-1,'msg'=>'金额必须为整数');
        }
        //修改
        if(!empty($data['id'])){
            $res = model('DealRecord')->update($data);
            if($res){
                return array('status'=>200,'msg'=>'更新成功');
            }else{
                return array('status'=>-1,'msg'=>'更新失败');
            }
        }
        //添加
        $add_data = array(
            'uid' => $data['uid'],
            'aid' => $data['aid'],
            'tid' => $data['tid'],
            'money' => $data['money'],
            'time' => time(),
            'remark' => $data['remark']
        );
        $res = model('DealRecord')->insert($add_data);

        if($res){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }

    }

    /**
     * 新增或修改用户金额明细
     * @param $data
     * @return array
     */
    public function saveDetail($data){
        //修改
        if(!empty($data['id'])){
            $res = model('DealRecord')->update($data);
            if($res){
                return array('status'=>200,'msg'=>'更新成功');
            }else{
                return array('status'=>-1,'msg'=>'更新失败');
            }
        }
        //检查字段是否完整
        if(!isset($data['uid']) || !isset($data['type']) || !isset($data['money']) || !isset($data['balance'])){
            return array('status'=>-1,'msg'=>'字段不完整');
        }

        //描述默认为空
        if(empty($data['remark'])){
            $data['remark'] = '';
        }

        //添加
        $add_data = array(
            'uid' => $data['uid'],
            'type' => $data['type'],
            'money' => $data['money'],
            'balance' => $data['balance'],
            'addtime' => time(),
            'remark' => $data['remark'],
        );

        $res = model('UserDetail')->insert($add_data);
        if($res){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }
    }

    /**
     * 更新小孩信息
     * @param $data
     * @return array
     */
    public function saveChild($data){

    }
}