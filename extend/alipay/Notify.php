<?php

namespace alipay;

use think\Loader;

Loader::import('alipay.pay.service.AlipayTradeService');

/**
* 支付回调处理类
*
* 用法建议:
* 1.$_POST获取参数
* 2.调用 \alipay\Notify::checkSign($params) 进行签名校检
* 3.调用 \alipay\Notify::checkParams($orginParams, $orginParams) 进行参数验证
* 4.根据 $_POST['trade_status'] 判断订单状态
* 5.echo "success"; 或者 echo "fail";
*
*/
class Notify
{
    /**
     * 检查签名
     */
    public static function checkSign($params)
    {
        $config = config('alipay');
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($params);
        return $result;
    }

    /**
     * 判断两个数组是否一致, 两个数组的参数可以为如下（建议）：
     * $params['out_trade_no'] 商户单号
     * $params['total_amount'] 订单金额
     * $params['app_id']       app_id号
     */
//    public static function checkParams($orginParams, $orginParams)
//    {
//        $result = array_diff($orginParams, $orginParams);
//        if (empty($result)) {
//            return true;
//        } else {
//            return false;
//        }
//    }
}