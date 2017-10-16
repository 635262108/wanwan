<?php
namespace app\mobile\controller;
use think\Controller;

class Base extends Controller
{
    public function _initialize() {
        $this->public_assign();
    }
    /**
     * 公共赋值
     */
    public function public_assign(){
        $ActivityType = model('ActivityType');
        //获取标题
        $title = $ActivityType->getTitle();
        $this->assign('title',$title);
    }
    /**
     * 检验用户是否登录
     * @param type $noLogin 检测的操作
     */
    public function checkUserLogin($noLogin = array()) {
        if(in_array(request()->action(),$noLogin)){
            if(!session('?userInfo')){
                //return $this->redirect("public/select_login");
                echo $this->fetch('public/select_login');die;
            }
        }
    }
    
}
