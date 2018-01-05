<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 5:51
 */

namespace app\common\validate;
use think\Validate;

class Order extends Validate
{

    protected $rule = [
        'mobile' => 'require|max:11',
        'name'  =>  'require|max:25',
        'aid' => 'require|integer',
        't_id' => 'integer',
        'adult_num' => 'require|integer',
        'child_num' => 'require|integer',
        'pay_way' => 'integer',
        'source' => 'require|integer',
        'sign_time' => 'require|integer',
    ];

    protected $message = [
        'mobile.require' => '手机号不能为空',
        'mobile.mobile' => '手机号格式不正确',
        'name' => '姓名格式不正确',
        'aid' => '活动格式不正确',
        't_id' => '活动时间不正确',
        'adult_num' => '大人数量不正确',
        'child_num' => '小孩数量不正确',
        'pay_way' => '支付方式格式不正确',
        'source' => '来源格式不正确',
        'sign_time' => '签到时间格式不正确',
    ];

    protected $scene = [
        'addOrder' => 'mobile,name,aid,t_id,adult_num,child_num,pay_way,source,sign_time'
    ];
}