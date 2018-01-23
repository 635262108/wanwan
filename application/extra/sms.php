<?php
/**
 * 短信接口相关配置
 */
return [
    'ak' => '18e38978462c146b837c43e92eee92cc',
    //接口地址
    'sms_url' => 'https://sms.yunpian.com/',
    //单条发送接口url
    'single_send' => 'v2/sms/single_send.json',
    //批量发送不同内容url
    'multi_send' => 'v2/sms/multi_send.json'
];