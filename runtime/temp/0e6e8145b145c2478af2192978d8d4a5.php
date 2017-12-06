<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"D:\chuangzhixing\wanwan/application/mobile\view\user\recharge.html";i:1509099306;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1509329947;}*/ ?>
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

<form action="<?php echo url('mobile/user/enter_recharge'); ?>" method="post">
	<div class="pay_num">
	    <p>充值金额</p>
	    <div class="prompt_num">
	    	<span>￥</span><input name="money" onkeyup="value=value.replace(/[^\-?\d.]/g,'')" type="text" placeholder="0.00"/>
	    </div>
	</div>
	    <p class="warn">提示：账户金额可以用于玩翫碗的所有活动</p>
		<button type="submit" class="user_pay">充值</button>
</form>
