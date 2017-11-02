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
        //密码不能为空
        if(empty($data['password'])){
            return array('status'=>-1,'msg'=>'密码不能为空');
        }
        //检查手机号
        if(!isMobile($data['mobile'])){
            return array('status'=>-1,'msg'=>'手机号格式错误');
        }
        //检查余额是否为整数
        if(!is_numeric($data['balance'])){
            return array('status'=>-1,'msg'=>'金额必须为整数');
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
            'balance' => $data['balance'],
            'member_grade' => 1,
            'source' => $data['source'],
        );
        $uid = model('user')->insertGetId($add_data);

        //有孩子信息添加孩子信息
        if(!empty($data['child_name']) & $uid>0){
            $add_child['uid'] = $uid;
            $add_child['name'] = $data['child_name'];
            $add_child['gender'] = $data['child_gender'];
            $add_child['birthday'] = $data['child_birthday'];
            $add_child['school'] = $data['child_school'];
            $add_child['play_time'] = $data['child_play_time'];
            $add_child['time'] = date("Y-m-d H:i:s");
            db('user_child')->insert($add_child);
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
        $add_data = array(
            'uid' => $data['uid'],
            'amount' => $data['amount'],
            'pay_way' => $data['pay_way'],
            'status' => $data['status'],
            'pay_time' => time(),
            'giveaway' => $data['giveaway'],
            'is_get' => $data['is_get'],
            'remark' => $data['remark'],
            'order_sn' => getOrderSn($data['uid'],000),
        );
        $res = $rechargeRecord->insert($add_data);
        if($res !== false){
            //增加用户余额
            $userInfo->uid = $userInfo['uid'];
            $userInfo->balance = $userInfo['balance'] + $data['amount'];
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
     * 获取充值记录
     * @return mixed
     */
    public function getUseRechargeRecord(){
        //获取记录
        $RechargeRecord = model('RechargeRecord');
        $res = $RechargeRecord->alias('r')
            ->field('r.*,u.nickname,u.mobile,u.balance')
            ->join('mfw_user u','r.uid=u.uid','left')
            ->select();
        return $res;
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
}