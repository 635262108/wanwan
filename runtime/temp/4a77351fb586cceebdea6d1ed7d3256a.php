<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\chuangzhixing\wanwan/application/mobile\view\activity\select_pay.html";i:1511522513;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1511167351;}*/ ?>
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

<body style="background: #F6F6F6">

    <!--<div class="title_word second_activity">选择支付</div>-->

    <div class="product_detail">
    	<div class="product_img"><img src="__AdminIMG__/<?php echo $activityInfo['a_index_img']; ?>"></div>
    	<ul>
    		<li>￥<?php echo $price; ?></li>
    		<li>&nbsp;&nbsp;<?php echo $activityInfo['a_title']; ?></li>
    	</ul>
    </div>
    
    <form action="<?php echo url('activity/payWay'); ?>" method="post" class="pay_form">
        <input type="hidden" value="<?php echo $orderInfo['order_sn']; ?>" name="order_sn"/>
    	<ul>
    		<li>
    			<div class="first_li"><img src="__MobileImg__/remaining_img.png" style="margin-right: 9px;">余额支付</div>
    		     <?php if($userInfo['balance'] < $price): ?>
    		    <div class="second_li" >
    		    	   <span style="color:#c5c5c5;" class="remaining_money">余额不足</span>
    		    	 
    		          <input type="radio" name="bank_type" value="4"  class="select_remaining">
    		   
    		    </div>	
    		    <?php else: ?>
    		     
    		     <div class="second_li" style="width: 23.5%;">
    		    	 <span style="color:#c5c5c5;" class="remaining_money">余额&nbsp;<?php echo $userInfo['balance']; ?></span>
    		    	
    		          <input type="radio" name="bank_type" value="4"  class="select_remaining">
    		   
    		    </div>	
    		   
    		 <?php endif; ?>
    		 </li>
    		   
    			
    		<li>
    			<div class="first_li">
    				<img src="__MobileImg__/weixin.png" style="margin-right: 9px;">微信支付
    			</div>
    			<div class="second_li">
    				<input type="radio" name="bank_type" value="2" class="weixin">
    		    </div>
    		</li>
    			
    				
    		<li>
    			<div class="first_li">
    				<img src="__MobileImg__/zhifubao.png" style="margin-right: 9px;">支付宝
    			</div>
    			<div class="second_li">
    				<input type="radio" name="bank_type" value="1">
    			</div>
    		</li>
    	</ul>
    	<button type="submit" class="Sure_pay">确认支付</button>
    </form>
    


    <script src="__MobileJs__/jquery.min.js"></script>
    <script src="__MobileJs__/index.js"></script>
    <script src="__MobileJs__/idangerous.swiper.min.js"></script>

</body>
</html>

