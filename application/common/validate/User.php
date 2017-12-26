<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 下午 5:51
 */

namespace app\common\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'uid' => 'require|integer',
        'name'  =>  'require|max:25',
        'email' =>  'email',
        'amount' => 'require|number',
        'pay_way' => 'number',
        'is_get' => 'require',
        'money' => 'require|number',
        'gender' => '',
    ];

    protected $scene = [
        'recharge' => 'uid,amount,pay_way,is_get',
        'deductionFee' => 'uid,money'
    ];
}