<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
    public function _initialize() {
        /*if(request()->action() != 'login'){
            if(!session('?adminInfo')){
                $this->redirect("user/login");
            }
        }*/
    }
}
