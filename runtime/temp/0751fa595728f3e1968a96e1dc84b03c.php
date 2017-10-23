<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\public\select_login.html";i:1508309656;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="__MobileCss__/bootstrap.min.css" />
		<link rel="stylesheet" href="__MobileCss__/bootstrap-theme.min.css" />
		<link rel="stylesheet" href="__MobileCss__/index.css" />
		<link rel="stylesheet" href="__MobileCss__/reset.css" />
		<title></title>
	</head>
	<body style="background: #F6F6F6;">

	    <div class="comeback textAlign" id="second_page">
			<div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
			<div class="comeback_img">
				<img src="__MobileImg__/second_back.png"/>
			</div>
				
			</div>
			
			<div class="title_word second_activity">登录/注册</div>
			
		</div>
		<div class="new_title">
			 <img src="__MobileImg__/new_titleimg.png" />
		</div>
		<div class="new_background">
			<img src="__MobileImg__/new_background.png" />
			<div class="login_operat">
				<div class="first">您需要先登录或者注册噢！</div>
				<a href="<?php echo url('mobile/user/login'); ?>">登录</a>
				<a href="<?php echo url('mobile/user/register'); ?>">注册</a>
				
			</div>
		</div>
	</body>
</html>
