<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Cache;
/**
*对象转数组
*@data 对象数据
*/
function objectArray($data=array()){
	return json_decode(json_encode($data),true);
}

/**
*验证手机号是否正确
*/
function isMobile($mobile){
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}

/**
*返回值
*state_code:状态码 msg:状态信息 data:数据
*/
function return_info($state_code = '',$msg = '',$data = array()){
	$info = array(
			'state_code' => $state_code,
			'msg'		 => $msg,
			'data'		 => $data
		);
	header('Content-Type: application/json; charset=utf-8');
	exit(json_encode($info));
}

/**
*第三方手机验证码获取
*mobile:手机号
*/
function getMobileVerify($mobile){
  $ch = curl_init();
  // 必要参数
  $apikey = "18e38978462c146b837c43e92eee92cc"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
  $rand = rand(100000,999999);
  $text="【玩宝小助手】您的验证码是".$rand;
  // 发送短信
  $data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
  curl_setopt ($ch, CURLOPT_URL, 'http://sms.yunpian.com/v2/sms/single_send.json');
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  $json_data = curl_exec($ch);
  //解析返回结果（json格式字符串）
  $array = json_decode($json_data,true);
  //验证码放缓存
  $array = array('code'=>0);
  Cache::set($mobile,$rand,60);
  return $array;
}

/**
 * 发送手机短信
 * @param $mobile
 * @param $text
 */
function sendSMS($mobile,$text){
    $ch = curl_init();
    // 必要参数
    $apikey = "18e38978462c146b837c43e92eee92cc"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
    $rand = rand(100000,999999);
    $text="【玩宝小助手】".$text;
    // 发送短信
    $data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
    curl_setopt ($ch, CURLOPT_URL, 'http://sms.yunpian.com/v2/sms/single_send.json');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $json_data = curl_exec($ch);
    //解析返回结果（json格式字符串）
    $array = json_decode($json_data,true);
}

/**
*返回随机昵称
*@$length 长度 arr 随即字符串
*/
function get_nick_name(){
  //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
  $length = 10;
    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++){
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
    return "mfw_".$str;
}

/**
 * 字符串截取
 * @param type $text  字符
 * @param type $length  长度
 * @return type
 */
function subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length) 
    return mb_substr($text, 0, $length, 'utf8').'...';
    return $text;
}

//判断是否为微信浏览器
function is_weixin() { 
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) { 
        return true; 
    } return false; 
}
/**
 *生成订单号
 *规则：当前时间+aid+uid
 *uid 用户id
 *aid 活动id
 */
function getOrderSn($uid,$aid){
    $time = date('YmdHis');
    return $time.$aid.$uid;
}
/**
 * 支付方式转义
 * @param $payWay
 * @return string
 */
function payWay($code){
    switch ($code){
        case 1:
            return '支付宝';
            break;
        case 2:
            return '微信';
            break;
        case 3:
            return '现金';
            break;
        case 4:
            return '余额';
        case 5:
            return '机构';
        default:
            return '未付款';
    }
}

/**
 * 用户明细type转义
 */
function user_detail_type($type){
    switch ($type){
        case 1:
            return '充值';
            break;
        case 2:
            return '扣费';
            break;
        case 3:
            return '付费';
            break;
        default:
            return '';
    }
}

//状态转义
function getStatus($status){
    switch ($status){
        case 0:
            return '待审核';
            break;
        case 1:
            return '审核通过';
            break;
        case -1:
            return '已删除';
            break;
        default:
            return '';
    }
}

//会员等级转义
function getUserGrade($code){
    switch ($code){
        case 0:
            return '否';
            break;
        case 1:
            return '是';
            break;
        default:
            return '';
    }
}

//获取时间段
function getTimePeriod($time = ''){
    switch ($time){
        case 'BeginThisWeek':
            return mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
            break;
        case 'EndThisWeek':
            return mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
            break;
        case 'BeginLastWeek':
            return mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
            break;
        case 'EndLastWeek':
            return mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
            break;
        case 'BeginThisMonth':
            return mktime(0,0,0,date('m'),1,date('Y'));
            break;
        case 'EndThisMonth':
            return mktime(23,59,59,date('m'),date('t'),date('Y'));
            break;
        default:
            return '';
    }
}

//加密函数
function str_encode($str){
    return base64_encode($str);
}

//解密函数
function str_decode($str){
    return base64_decode($str);
}

//检查token
function checkToken($token){
    if ($token == session('TOKEN')) {
        session('TOKEN', NULL);
        return TRUE;
    } else {
        return FALSE;
    }
}

