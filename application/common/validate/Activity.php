<?php
    namespace app\common\validate;
    use think\Validate;
    
    /**
     * 活动验证器
     */
    class Activity extends Validate{
        
        //规则
        protected $rule =   [
        'aid'  => 'integer',
        'adult_num'   => 'integer|between:1,2',
        'child_num' => 'integer|between:1,2',
        'remark' => 'max:50',
        ];
        //错误信息
        protected $message  =   [
            'aid.integer' => '非法参数',
            'adult_num.integer'     => '非法参数',
            'adult_num.between'   => '非法参数',
            'child_num.integer'  => '非法参数',
            'child_num.between'        => '非法参数', 
            'remark.max'        => '描述不能超过50个字符', 
        ];
        //场景
        protected $scene = [
            'add'  =>  ['aid','adult_num','child_num','remark'],
        ];
    }
?>