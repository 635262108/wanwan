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
     * 登录逻辑
     * @param $username
     * @param $password
     */
    public function login($username,$password){
        
    }

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
            'mobile' => $data['mobile'],
            'password' => $data['password'],
            'status' => 1,
            'reg_time' => time(),
            'province' => $data['province'],
            'city' => $data['city'],
            'district' => $data['district'],
            'sex' => $data['sex'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
            'balance' => $data['balance'],
            'member_grade' => 1
        );
        $res = model('user')->saveUser($add_data);
        if($res !== false){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }
    }

    /**
     * 增加用户充值
     * @param $data
     */
    public function addRecharge($data){
        //查看用户是否存在
        $user = model('user');
        $userInfo = $user->getIdUser($data['uid']);
        if(empty($userInfo)){
            return array('status'=>-1,'msg'=>'用户不存在');
        }
        //检查余额是否为整数
        if(!is_numeric($data['amount'])){
            return array('status'=>-1,'msg'=>'金额必须为整数');
        }
        //添加数据
        $add_data = array(
            'uid' => $data['uid'],
            'amount' => $data['amount'],
            'pay_way' => $data['pay_way'],
            'status' => $data['status'],
            'pay_time' => time()
        );

        $rechargeRecord = model('RechargeRecord');
        $res = $rechargeRecord->saveRecharge($add_data);
        if($res !== false){
            //增加用户余额
            $userInfo->uid = $userInfo['uid'];
            $userInfo->balance = $userInfo['balance'] + $data['amount'];
            $result = $userInfo->save();
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
     * 获取用户消费明细
     * @param $uid
     */
    public function getUserRecord($uid){
        //获取消费记录
        $ActivityOrder = model('ActivityOrder');
        $reaharge = $ActivityOrder->alias('o')
            ->field('o.order_price,o.pay_way,o.pay_time,a.a_title')
            ->join('mfw_activity a','o.aid=a.aid','left')
            ->where('o.uid ='.$uid)
            ->where('o.order_status=1 or  o.order_status=3 or o.order_status=4')
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
}