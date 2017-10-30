<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 下午 7:33
 */

namespace app\admin\controller;
use app\admin\Logic\AdminUserLogic;
class Admin extends Base
{

    //首页
    public function index(){
        //获取数据
        $userInfo = model('AdminUser')->alias('u')->field('u.*,r.role_name')->join('mfw_role r','u.role_id=r.id')->select();
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }

    //显示添加
    public function dis_add_user(){
        //获取角色数据
        $role = model('role')->getRoleAll();
        $this->assign('role',$role);
        return $this->fetch();
    }

    //添加管理员
    public function add_user(){
        //接收数据
        $data['name'] = input('post.name');
        $data['mobile'] = input('post.mobile');
        $data['role_id'] = input('post.role');
        $data['password'] = input('post.password');
        //添加
        $model = new AdminUserLogic();
        $res = $model->save_admin_user($data);

        if($res['status'] == 200){
            $this->success($res['msg'],'admin/index');
        }else{
            $this->error($res['msg']);
        }
    }

    //删除管理员
    public function del_user(){
        $id = input('post.id');
        $res = model('AdminUser')->delete($id);
        if ($res){
            return array('status'=>200,'msg'=>'删除成功');
        }else{
            return array('status'=>-1,'msg'=>'删除失败');
        }
    }

    //显示修改管理员
    public function dis_save_user($id){
        //获取管理员信息
        $map['id'] = $id;
        $userInfo = model('role')->getRole($map);
        //获取角色数据
        $role = model('role')->getRoleAll();
        $this->assign('role',$role);
        $this->assign('userInfo',$userInfo);
        $this->fetch();
    }

    //修改管理员
    public function save_user(){
        //接收数据
        $data['id']  = input('post.id');
        $data['name'] = input('post.name');
        $data['mobile'] = input('post.mobile');
        $data['role_id'] = input('post.role');
        $data['password'] = input('post.password');
        //修改
        $model = new AdminUserLogic();
        $res = $model->save_admin_user($data);

        if($res['status'] == 200){
            $this->success($res['msg'],'admin/index');
        }else{
            $this->error($res['msg']);
        }
    }

    //权限列表
    public function role(){
        return $this->fetch();
    }

}