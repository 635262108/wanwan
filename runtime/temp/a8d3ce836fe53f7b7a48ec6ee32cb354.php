<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\chuangzhixing\wanwan/application/mobile\view\user\order_detail.html";i:1512123291;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1511167351;}*/ ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>玩翫碗不一样的玩</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <link rel="stylesheet" href="__MobileCss__/bootstrap.min.css" />
        <link rel="stylesheet" href="__MobileCss__/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="__MobileCss__/index.css" />
        <link rel="stylesheet" href="__MobileCss__/reset.css" />
        <link rel="stylesheet" href="__MobileCss__/idangerous.swiper.css" />
        <link rel="stylesheet" href="__MobileCss__/jquery.bxslider.css"/>
        <link rel="stylesheet" href="__MobileCss__/activity.css">
    </head>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="__MobileCss__/bootstrap.min.css" />
    <link rel="stylesheet" href="__MobileCss__/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="__MobileCss__/index.css" />
    <link rel="stylesheet" href="__MobileCss__/reset.css" />
</head>

<div class="comeback textAlign" id="second_page">
    <div class="comeback_whole" >
        <div class="comeback_img">
     
            <?php if(empty($url) || (($url instanceof \think\Collection || $url instanceof \think\Paginator ) && $url->isEmpty())): ?>
                <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/second_back.png"/></a>
            <?php else: ?>
                <a href="<?php echo $url; ?>"><img src="__MobileImg__/second_back.png"/></a>
            <?php endif; ?>
        </div>
    </div>

    <div class="title_word second_activity"> <?php echo $title; ?></div>
    <!--<?php if(\think\Request::instance()->controller() != 'User'): ?>
    <div class="click_stroggle">
    	<a href="<?php echo url('mobile/user/index'); ?>"><img src="__MobileImg__/dot_img.png" /></a>
    </div>
    <?php endif; ?>-->
    <!--<ul class="stroggle_ul display_none">
    	<div class="singel_img">
    		<img src="__MobileImg__/triangle.png" />
    	</div>
    	<li>会员中心</li>
    	<li>我的活动</li>
    	<li>我的收藏</li>
    	<li>退出登录</li>
    </ul>-->

</div>


</html>

<body>
<!--头部导航-->
<!--<div class="comeback textAlign" id="second_page">
    <div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
        <div class="comeback_img">
            <img src="__MobileImg__/second_back.png"/>
        </div>

    </div>

    <div class="title_word second_activity">订单详情</div>

</div>-->

    <div class="playBaby_content almost">

        <div id="orderDetail_content">
            <div class="content">

                <div class="baby_detail">
                    <ul class="detail_information">
                        <li>联系人信息</li>
                        <li>用户名：<?php echo session('userInfo.nickname'); ?></li>
                        <li>联系人姓名：<?php echo $orderInfo['name']; ?></li>
                        <li>联系方式：<?php echo $orderInfo['mobile']; ?></li>
                    </ul>

                </div>

            </div>

            <div class="content">

                <div class="baby_detail">
                    <ul class="detail_information">
                        <li>活动信息</li>
                        <li>主题：<?php echo $ActivityInfo['a_title']; ?></li>
                        <li>活动时间：<?php echo date('Y.m.d',$ActivityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$ActivityInfo['a_end_time']); ?></li>
                        <li>活动地点：<?php echo $ActivityInfo['a_address']; ?></li>
                        <li>参与时间：<?php echo $timeInfo['begin_time']; ?>-<?php echo $timeInfo['end_time']; ?></li>
                    </ul>

                </div>

            </div>

            <div class="content">

                <div class="baby_detail">
                    <ul class="detail_information">
                        <li>订单信息</li>
                        <li>
                        订单状态：
                        <?php if($orderInfo['order_price'] == 0): ?>
                            已报名
                        <?php else: switch($orderInfo['order_status']): case "1": ?>已完成<?php break; case "2": ?>未付款<?php break; case "3": ?>已付款<?php break; case "4": ?>已付款<?php break; case "5": ?>退款中<?php break; case "6": ?>已退款<?php break; case "7": ?>已请假<?php break; endswitch; endif; ?>
                        </li>
                        <li>
                        支付方式：
                            <?php if($orderInfo['order_price'] == 0): ?>
                                免费活动,无需支付
                            <?php else: ?>
                                <?php echo payWay($orderInfo['pay_way']); endif; ?>
                        </li>
                        <li>
                            <?php if($orderInfo['pay_way'] == 0): ?>
                            提交时间：<?php echo date('Y.m.d H:i',$orderInfo['addtime']); else: ?>
                            支付时间：<?php echo date('Y.m.d H:i',$orderInfo['pay_time']); endif; ?>
                            </li>
                        <li>订单编号：<?php echo $orderInfo['order_sn']; ?></li>
                    </ul>

                </div>

            </div>
            

    <script src="__MobileJs__/jquery.min.js"></script>
    <script src="__MobileJs__/idangerous.swiper.min.js"></script>
    <script src="__MobileJs__/index.js"></script>
</body>
</html>

