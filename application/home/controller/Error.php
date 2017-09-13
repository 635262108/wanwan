<?php
namespace app\home\controller;

class Error
{
    public function _empty()
    {
    	echo request()->url()."<br/>"; //当前地址
    	echo request()->module()."-".request()->controller()."-".request()->action(); //模型、控制器、方法
    }

}
