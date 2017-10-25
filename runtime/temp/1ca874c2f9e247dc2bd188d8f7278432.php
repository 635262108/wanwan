<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"D:\chuangzhixing\wanwan/application/mobile\view\user\refund.html";i:1508752767;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1508840840;}*/ ?>
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
    <div class="click_stroggle">
    	<a href="<?php echo url('mobile/user/index'); ?>"><img src="__MobileImg__/dot_img.png" /></a>
    </div>
    
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
            <li><span>1</span></li>
            <li class="line"></li>
            <li class="change_opacity"><span>2</span></li>
            <li class="line"></li>
            <li class="change_opacity"><span>3</span></li>
        </ul>

        <ul>
            <li>申请退款</li>
            <li class="change_opacity">退款处理中</li>
            <li class="change_opacity">退款成功</li>
        </ul>
    </div>

    <div class="pay_price payOff">
        <ul>
            <li>退款金额</li>
            <li>退款金额：￥<?php echo $order_info['order_price']; ?></li>
        </ul>
    </div>
<form action="<?php echo url('mobile/user/submit_refund'); ?>" method="post">
    <div class="back_cause payOff">
        <input type="hidden" name="order_sn" value="<?php echo $order_info['order_sn']; ?>"/>
        <input type="hidden" name="aid" value="<?php echo $order_info['aid']; ?>"/>
            <ul>
                <li>退款原因</li>
                <li><input type="radio" value="买错了" name="reason"/>&nbsp;买错了</li>
                <li><input type="radio" value="与我参与的其他活动有冲突" name="reason"/> 与我参与的其他活动有冲突</li>
                <li><input type="radio" value="计划有变，改日再去" name="reason"/> 计划有变，改日再去</li>
                <li><input type="radio" value="其他" name="reason"/> 其他</li>
                <p class="please" style="display:none;font-size: 14px;color: #FF4134;margin-top: 10px;">请选择原因！</p>
            </ul>

    </div>
    <div class="title payOff">
        <ul>
            <li>温馨提示</li>
            <li>订单退款成功后无法恢复</li>
            <li>该订单退款金额有人工客服联系返还</li>
        </ul>
    </div>
        <button type="submit" class="step_1">提交</button>

    </form>

</div>


<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<script src="__MobileJs__/emit_information.js"></script>
</body>
</html>

