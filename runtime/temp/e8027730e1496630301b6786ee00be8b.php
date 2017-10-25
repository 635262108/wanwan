<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"D:\chuangzhixing\wanwan/application/mobile\view\user\refund2.html";i:1508752767;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1508899980;}*/ ?>
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
            <a onclick="window.location.href=document.referrer"><img src="__MobileImg__/second_back.png"/></a>
        </div>

    </div>

    <div class="title_word second_activity"> <?php echo $title; ?></div>
    <?php if(\think\Request::instance()->controller() != 'User'): ?>
    <div class="click_stroggle">
    	<a href="<?php echo url('mobile/user/index'); ?>"><img src="__MobileImg__/dot_img.png" /></a>
    </div>
    <?php endif; ?>
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

    <div class="title_word second_activity">退款列表</div>

</div>-->

    <div class="playBaby_content almost">
        <div class="pay_content">
            <ul>
                <li class="change_opacity"><span>1</span></li>
                <li class="line"></li>
                <li><span>2</span></li>
                <li class="line"></li>
                <li class="change_opacity"><span>3</span></li>
            </ul>

            <ul>
                <li class="change_opacity">申请退款</li>
                <li>退款处理中</li>
                <li class="change_opacity">退款成功</li>
            </ul>
        </div>

        <div class="pay_price payOff">
            <ul>
                <li>退款金额</li>
                <li>退款金额：￥<?php echo $order_info['order_price']; ?></li>
                <li>订单编号：<?php echo $order_sn; ?></li>
            </ul>
        </div>

        <div class="back_cause payOff">
            <form action="" method="post">
                <ul>
                    <li>退款进度</li>
                    <li>操作人：家长</li>
                    <li>提交时间：<?php echo date('Y.m.d H:i',$addtime); ?></li>
                    <li>处理结束：您的申请已提交，工作人员将在两个工作日内审核</li>

                </ul>
            </form>



        </div>
        <div class="title payOff">
            <ul>
                <li>退款详细信息</li>
                <li>支付方式：<?php switch($order_info['pay_way']): case "1": ?>支付宝<?php break; case "2": ?>微信<?php break; case "3": ?>银联<?php break; endswitch; ?></li>
                <li>退款原因：<?php echo $reason; ?></li>
            </ul>
        </div>

        <div class="last_warn">注意：退款金额由人工客服联系并退还</div>

    </div>
    <br><br>

    <script src="__MobileJs__/jquery.min.js"></script>
    <script src="__MobileJs__/idangerous.swiper.min.js"></script>
    <script src="__MobileJs__/index.js"></script>
</body>
</html>

