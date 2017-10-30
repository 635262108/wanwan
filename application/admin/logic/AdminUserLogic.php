<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26 0026
 * Time: 下午 7:34
 */

namespace app\admin\Logic;
use think\model;

class AdminUserLogic
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
}