<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"D:\chuangzhixing\wanwan/application/mobile\view\user\index.html";i:1511754107;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\footer.html";i:1511259883;}*/ ?>
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

    <div class="title_word second_activity">会员中心</div>
 
</div>
<!--玩宝总体内容部分-->
<div class="playBaby_content almost" id="personal_center">

    <div class="content personal_content" style="margin-top: 0px;">
        <div class="baby_img center_img">
            <img src="__HEADICON__/<?php echo $userInfo['headIcon']; ?>" />
        </div>
        <div class="baby_detail" style="height: 25px;">
            <ul class="ul_first">
                <li><?php echo $userInfo['nickname']; ?></li>
            </ul>

        </div>
    </div>
</div>


<!--我的活动-->
<div class="myActivity_classfy">
	<ul class="personal_center" style="width: 100%;">
		<a href="<?php echo url('/mobile/user/my_activity',['a'=>1]); ?>">
			<li style="margin-bottom: 0px;">
				    <img src="__MobileImg__/activity_two.png"  class="circle_img" style="width: 23px;height: 23px;margin-left: -1.2%;">我的活动
					<span style="color: #c5c5c5;margin-left: 55%;">全部活动</span>
				    <img src="__MobileImg__/dayu.png"  style="width:6px;height:11px;margin-left:2%;">
			</li>
			<div class="line"></div>
		</a>
	</ul>
	
  <div class="textAlign nav" id="personal_href">
	<ul>
		<li class="play_baby">
			<a href="<?php echo url('/mobile/user/my_activity',['a'=>1]); ?>"><span><img src="__MobileImg__/my_activity.png" style="width: 18px;height: 18px;"></span>
				<p>我的活动</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('/mobile/user/my_activity',['a'=>2]); ?>"><span><img src="__MobileImg__/will_pay.png"  style="width: 18px;height: 18px;"></span>
				<p>待付款</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('/mobile/user/my_activity',['a'=>3]); ?>"><span><img src="__MobileImg__/already_pay.png" style="width: 18px;height: 18px;"></span>
				<p>已付款</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('/mobile/user/my_activity',['a'=>4]); ?>"><span><img src="__MobileImg__/will_educt.png" style="width: 18px;height: 18px;"></span>
				<p>待评价</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('/mobile/user/my_activity',['a'=>5]); ?>"><span><img src="__MobileImg__/back_money.png" style="width: 18px;height: 18px;"></span>
				<p>退款/售后</p>
			</a>
		</li>
	</ul>
</div>
	
</div>
<ul class="personal_center">
	<a href="<?php echo url('mobile/user/my_info'); ?>"><li><img src="__MobileImg__/emit.png" class="circle_img">编辑资料<img src="__MobileImg__/dayu.png" class="contect"></li></a>
	<a href="<?php echo url('mobile/user/recharge'); ?>">
	<li>
		<img src="__MobileImg__/over_pay.png"  class="circle_img">余额 <?php echo $userInfo['balance']; ?>
			<span style="color: #c5c5c5;margin-left: 61%;">充值</span>
		    <img src="__MobileImg__/dayu.png"  style="width:6px;height:11px;margin-left:2%;">
	</li>
	</a>
	<a href="my_collect.html">
	<li><img src="__MobileImg__/center_collect.png" class="circle_img">我的收藏<img src="__MobileImg__/dayu.png" class="contect"></li>
	</a>
	<li class="back_login"><img src="__MobileImg__/back_login.png" class="circle_img">退出登录<img src="__MobileImg__/dayu.png" class="contect"></li>
</ul>

<div class="sure_back" style="display: none;">
	  <div class="sure_modal">
	  	  <div style="width: 100%;margin: 35px auto 29px;font-size: 15px;text-align: center;color: #2e2e2e;letter-spacing: 2px;">真的要退出吗?</div>
	  	  <div style="width:220px;margin: 0px auto;border-bottom: 1px solid #dfdbdb;"></div>
	  	  <div class="select_opera">
	  	  	   <div class="cancel">取消</div>
	  	  	   <div class="sure">确认</div>
	  	  </div>
	  </div>
</div>

<div class="whole_bottom">

<div class="bottom">
    <!--<div class="erweima"></div>-->
    <div class="bottom_title">
        <ul>
            <li><a href="<?php echo url('mobile/user/user'); ?>">会员条款</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/disclaimer'); ?>">免责声明</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/copy'); ?>">版权声明</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/privacy'); ?>">隐私保护</a></li>
            <li class="line">|</li>
            <li><a href="#">投诉建议</a></li>
        </ul>
        <div class="tel">联系方式：400-611-2731</div>
    </div>
</div>

<div class="copyright">
    <div class="first">Copyright©版权所有河南创致行企业管理咨询有限公司 (2017-2037)</div>
    <div class="second">豫ICP备13007531号-1</div>
</div>
</div>

<script src="__MobileJs__/jquery.min.js"></script>
<script type="text/javascript" src="__MobileJs__/index.js" ></script>

</body>
</html>

