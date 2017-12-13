<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;

class Base extends Controller
{
    public function _initialize() {
        if(request()->action() != 'login'){
            if(!session('?adminInfo')){
                $this->redirect("admin/login");
            }
        }
        //检查权限
        $map['control_name'] = request()->controller();
        $map['action_name'] = request()->action();
        $auth = db('node')->where($map)->find();

        $role_id = Session::get('adminInfo.role_id');
        $my_auth = db('role')->find($role_id);
        if(!empty($auth) & !empty($my_auth) & $my_auth['rule'] != '*'){
            if(!strpos($my_auth['rule'],(string)$auth['id'])){
                $this->error('没有权限');
            }
        }
    }
}
