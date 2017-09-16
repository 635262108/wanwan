<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => false,
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => '',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'home',
    // 禁止访问模块
    'deny_module_list'       => ['common','admin'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => false,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否强制使用路由
    'url_route_must'         => false,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__CSS__'=>'/public/static/css',
        '__IMG__' => '/public/static/img',
        '__JS__' => '/public/static/js',
        '__HEADICON__' => '/public/uploads/headicon',
        '__AdminIMG__' => '/public/uploads/admin_img',
        '__ACSS__'=>'/public/admin_static/css',
        '__AJS__'=>'/public/admin_static/js',
        '__AIMG__'=>'/public/admin_static/img',
        '__FONT-AWESOME__'=>'/public/admin_static/font-awesome/css',
        '__EDITER__' => '/public/admin_static/editer',
        '__MobileJs__'=>'/public/mobile_static/js',
        '__MobileCss__'=>'/public/mobile_static/css',
        '__MobileImg__'=>'/public/mobile_static/images',
    ],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
//    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => 'public/error',
    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    
    //支付宝配置
    'alipay'        =>  [
        //应用ID,您的APPID。
        'app_id' => "2017081508214247",

        //商户私钥
        'merchant_private_key' => "MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCndXPZaAHACd4InmDWbCxx7EujmWwYLuLNzEEodwa+Qq2c7g6yImdnymGUUoi+W/aWrgi5DM9Ny/3sEkYyv9isInZ9VeIvfmAXtvnoOEuzfwzV+t0/isDW23BMMeDMqeanBoJD2XrV0KEoP6OvCE7nPbdwvYEx5ciMW+mcNMiBf4bqacRdNvmVW95EbMxw3Yps4TPF3714BsPCnKvxPIDh9LVsKgu08VBdZ7RYQh7px711GxOEoOxUxqGt+Q9dj/OnzdWubAMbeX/Ocitj3/Jb8zofPvMOWromTGVq3WPp459yPR+U+m2+lynw/YmwY6cMd1u26iKWiYEDvuiFbqrHAgMBAAECggEBAIVewhnRADPWqAPtP+sG1I8XR1bRBopsLS8DEpIL2k8GBAgMgZ/WTs0XHohnA4m47Lgte70GOsUXRvERzN72dLcD66L/F9oDqLy6emc9Du2yrqJt3nCRLezxcIr+3q+iUZWNVYp8V5ybQP8xUEhDMbRyLvuXsqHvBL7lJTXHxDl977tfdkRfSXj6iYygW+XCKY7vZq5ClPDvU2XVx9MJNVHWGMJIXSyF+yWY/tga6S7gs7XVVol7ozZsYhArJ29zkHl96aDvJ/cRCVyr/cfFN2dzcDMeKfIDQO+FExgzVMTvcYWuiloXbeJlJlFo/vRHHMcmGDWNxFXH08I9/BEMfIECgYEA6lZH89is9CmnUtCwYAuw01u4KtEcxt5gPIxPv1A3qpCXaibxtZNXWOxOPmnmGrTLXC4bdqPIdBYCuXgx1zlQmG8B9sA6p1F6BBcnuZY/zO0g3V/CU48YtPfRuCFf4tCVR0vCFNJZqbVa3Z4S/VIO6e/wCJAnSNswWi/kZGfttzECgYEAtvB1xeeuxuVMwE7dH+mWqFkOj9gDtTHoRIYLGLogFdjF8fxA/aXpbCxRGJ7qhJSsy5Opcngcsu7moRI5SEtaDqp0FT1eYNb191y0yJ2a0GdVTAVHADb6XAm+aAIlX7UEE6g3b97Fh9uMkq6xu1QejDEYHIkeLzEOwFTB3TT783cCgYEAxt+wstbJeXG8SkFH3kstp0Jo2xWbCX+CRwCBUYi/pWaOyg0BBytjbtklUjzHhxS2naWXsykunq5rY4IJMnG235ceII5leMhh+AS6tvs3bDA2uwlgv09rFXJYLp9MZA7HEbnOnaMjay65TemwjgJNG+aAXJQScvdqYq/QchHtoZECgYEAmVS+QdxIX6i9RcpUCHVuszfBvsrdgLeN6DE5h8YpMmZ4srQtfOvc06/pYOuBwRIkKpVfRvRpiYg3gfWWUYPmvbgch9jiC+TgUC5B0IxYwCh8E7WwpvttqEr6bo6t6KP+AMPTg06C3bYlAqStj0eYOwTDItfCludVZ9siilfofU0CgYA5Ry1LRTo8FKAHydOlpqkwQBq9d3xSRdGBclLT73tah1HVNm29fWL/zuUAJve5T/6kO8RbVUVKdKrWUP1NZPMF8hz0nb4UwYHe1uskQI89MsBdCVqLD9vT+yrZutY7fJhpWJtYjGRtPupeb4f8sixibhsAU97a6gqE6PzpW5rDbQ==",

        //异步通知地址
        'notify_url' => "",

        //同步跳转
        'return_url' => "",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAh296Hi/T56D2a8QXwXWOoF5iMBeybBBqXPlBp5Jl5Kz9xhFtRQK777mIDp3/pEDxIwZ3eWses2vp9vfM/41+SghzL/1679HmKEdRaEFR1eySLdR9am4zwpV75xXuuwRPhullK8uqa85xPhvF8vlvQqYPXXJ9bEoDvH1TvKPG2W9Rj2oET1MZ3CyZbdXo8JxqQGS394CH189Ge62HRCiD/uyibvGqUvjV89bEgzjgFpM3WHo3SMnu9K2qsOx33lVqpGbLzhqXIE/qSwU0hHGHfax32UFvnlnQcAWNDSKU0RoGjV8gwNAAvnXlIDyvACFSUbkh8MFZVsFJG7y3plh97QIDAQAB",
    ],
    
    //微信支付配置
    'wxpay'        =>  [
        'app_id' => 'wx08a2c3912060777b',
        'mch_id' => '1235594202',
        'key'    => '42128531f65b1a5325b7f06558374e6c',
    ],
];