<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 下午 7:33
 */

namespace app\admin\controller;
use app\admin\logic\AdminLogic;
use app\common\model\AdminUser;

class Admin extends Base
{

    //登录
    public function login(){
        // 检测是否为ajax请求
        if(request()->isAjax()){
            //用户名
            $name = input('post.name');
            //密码
            $password = input('post.pwd');
            if(empty($name) || empty($password)){
                return_info(-1,'账号或密码不能为空');
            }
            //登录验证
            $model = new AdminLogic();
            $res = $model->check_login($name,$password);
            return_info($res['status'],$res['msg']);
        }else{
            return $this->fetch();
        }
    }

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
        $model = new AdminLogic();
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
        $res = db('admin_user')->delete($id);
        if ($res){
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }

    //显示修改管理员
    public function dis_save_user($id){
        //获取管理员信息
        $userInfo = model('AdminUser')->find($id);
        //获取角色数据
        $role = model('role')->getRoleAll();
        $this->assign('role',$role);
        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }

    //修改管理员
    public function save_user(){
        //接收数据
        $data['id']  = input('post.id');
        $data['name'] = input('post.name');
        $data['mobile'] = input('post.mobile');
        $data['role_id'] = input('post.role');
        if(!empty(input('post.password'))){
            $data['password'] = input('post.password');
        }
        //修改
        $model = new AdminLogic();
        $res = $model->save_admin_user($data);

        if($res['status'] == 200){
            $this->success($res['msg'],'admin/index');
        }else{
            $this->error($res['msg']);
        }
    }

    //角色列表
    public function role(){
        $role = db('role')->select();
        $this->assign('role',$role);
        return $this->fetch();
    }

    //显示增加角色
    public function dis_add_role(){
        $node = db('node')->select();
        $this->assign('node',$node);
        return $this->fetch();
    }

    //添加角色
    public function add_role(){
        $data['role_name'] = input('post.role_name');
        $data['rule'] = implode(",",input('post.rule/a'));
        $model = new AdminLogic();
        $res = $model->save_role($data);
        if($res['status'] == 200){
            $this->success($res['msg'],'admin/role');
        }else{
            $this->error($res['msg']);
        }
    }

    //显示编辑角色
    public function dis_save_role($id){
        $role = db('role')->find($id);
        $node = db('node')->select();
        $this->assign('node',$node);
        $this->assign('role',$role);
        return $this->fetch();
    }

    //编辑角色
    public function save_role(){
        $data['id'] = input('post.id');
        $data['role_name'] = input('post.role_name');
        $data['rule'] = implode(",",input('post.rule/a'));
        $model = new AdminLogic();
        $res = $model->save_role($data);
        if($res['status'] == 200){
            $this->success($res['msg'],'admin/role');
        }else{
            $this->error($res['msg']);
        }
    }

    //删除角色
    public function del_role(){
        $id = input('post.id');
        $res = db('role')->delete($id);
        if($res){
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }
    }

    //来源显示
    public function source_list(){
        $model = model('Source');
        $source = $model->all();
        return $this->fetch('',[
            'source' => $source
        ]);
    }

    public function dis_add_source(){
        return $this->fetch();
    }

    public function dis_save_source(){
        return $this->fetch();
    }

    //来源更新
    public function saveSource(){
        $data = input('post.');
        if(isset($data['id'])){
            $res = model('Source')->allowField(true)->save($data,['id'=>$data['id']]);
        }else{
            $res = model('Source')->save($data);
        }

        if($res){
            return_info(200,'成功');
        }else{
            return_info(-1,'失败');
        }

    }

}