<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\chuangzhixing\wanwan/application/mobile\view\public\error.html";i:1511430973;}*/ ?>
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

	<div class="title_word second_activity">温馨提示</div>

</div>
<div class="new_title">
	<img src="__MobileImg__/new_titleimg.png" />
</div>
<div class="new_background">
	<img src="__MobileImg__/new_background.png" />
	<div class="login_operat">
		<div class="first"><?php echo $msg; ?></div>

	</div>
</div>
</body>
</html>
