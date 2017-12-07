<?php
namespace app\mobile\controller;

class Error extends Base
{
    public function _empty()
    {
    	return $this->error('页面错误');
    }

}
