<?php
namespace app\common\exception;

use Exception;
use think\exception\Handle;
use think\exception\HttpException;
class Http extends Handle
{

    public function render(Exception $e)
    {
        if(config('app_debug')){
            return parent::render($e);
        }else{
            if(request()->isMobile()){
                header("location:".url('mobile/error/index'));
            }else{
                header("location:".url('home/error/index'));
            }
        }
    }

}