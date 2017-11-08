<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 下午 7:34
 */

namespace app\admin\Logic;
use think\model;
use think\Session;

class AdminLogic
{
    /**
     * 添加或修改管理员信息
     * @param $data
     * @return array
     */
    public function save_admin_user($data){
        //姓名不为空
        if(empty($data['name'])){
            return array('status'=>-1,'msg'=>'姓名不能为空');
        }

        //检查手机号
        if(!isMobile($data['mobile'])){
            return array('status'=>-1,'msg'=>'手机号格式错误');
        }

        $model = model('AdminUser');
        if(!empty($data['id'])){
            //修改
            if($model->update($data)){
                return array('status'=>200,'msg'=>'更新成功');
            }else{
                return array('status'=>-1,'msg'=>'更新失败');
            }
        }
        //添加
        $add_data = array(
            'mobile'=>$data['mobile'],
            'name'=>$data['name'],
            'role_id'=>$data['role_id'],
            'password'=>md5($data['password'])
        );

        if($model->insert($add_data)){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }
    }

    /**
     * 更新角色
     * @param $data
     * @return array
     */
    public function save_role($data){
        //修改
        if(isset($data['id'])){
            $res = db('role')->update($data);
            if($res){
                return array('status'=>200,'msg'=>'更新成功');
            }else{
                return array('status'=>-1,'msg'=>'更新失败');
            }
        }
        //添加
        $res = db('role')->insert($data);
        if($res){
            return array('status'=>200,'msg'=>'添加成功');
        }else{
            return array('status'=>-1,'msg'=>'添加失败');
        }
    }

    /**
     * 检查用户名和密码
     * @param $name
     * @param $pwd
     * @return array
     */
    public function check_login($name,$pwd){
        $map['mobile'] = $name;
        $map['password'] = md5($pwd);
        $user = db('admin_user')->where($map)->find();
        if (!empty($user)){
            //记录登录信息
            $data['id'] = $user['id'];
            $data['login_ip'] = request()->ip();
            $data['login_time'] = time();
            db('admin_user')->update($data);
            //存储用户信息
            Session::set('adminInfo',$user);
            return array('status'=>200,'msg'=>'登录成功');
        }else{
            return array('status'=>-1,'msg'=>'账号或密码错误');
        }
    }
}