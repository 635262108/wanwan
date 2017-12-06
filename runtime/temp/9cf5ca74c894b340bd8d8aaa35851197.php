<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"D:\chuangzhixing\wanwan/application/mobile\view\activity\pay_success.html";i:1512126904;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1511167351;}*/ ?>
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
    <!--<div class="comeback textAlign" id="second_page">
        <div class="comeback_whole" onclick="javascript:window.history.back(-1);window.location.reload()" >
            <div class="comeback_img">
                <img src="__MobileImg__/second_back.png"/>
            </div>

        </div>
        <div class="title_word second_activity">报名成功</div>

    </div>-->

        <div class="new_background">

            <div class="login_operat">
                <div class="first" style="font-size: 14px;">报名成功！请注意活动时间噢!</div>
                <a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$orderInfo['order_sn']]); ?>" style="border: none;color: #565656;font-size: 13px;">订单详情>></a>
                <div style="font-size: 10px;color: #8d8d8d;"><span class="count">3</span>s后自动跳转会员中心</div>
            </div>
        </div>

        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script>
            var count=$(".count").html();

            window.setInterval(function(){
                count--;
                $(".count").html(count)
                if(count<=1){
                    location.href="<?php echo url('mobile/user/order_detail',['order_sn'=>$orderInfo['order_sn']]); ?>";
                    clearInterval();
                }
            },1500);




        </script>

    </body>
</html>

