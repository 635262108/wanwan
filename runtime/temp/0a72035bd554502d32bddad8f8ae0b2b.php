<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"/var/www/html/wanwan/application/mobile/view/public/error.html";i:1508125376;s:63:"/var/www/html/wanwan/application/mobile/view/public/header.html";i:1508125376;s:60:"/var/www/html/wanwan/application/mobile/view/public/nav.html";i:1508914023;}*/ ?>
<!DOCTYPE html>
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

<?php if(empty(session('userInfo')) || ((session('userInfo') instanceof \think\Collection || session('userInfo') instanceof \think\Paginator ) && session('userInfo')->isEmpty())): ?>
<div class="into_page">
    <span><a href="<?php echo url('mobile/user/login'); ?>">登录</a></span>
    <span><a href="<?php echo url('mobile/user/register'); ?>">注册</a></span>
</div>
<?php endif; ?>
<!--头部图片-->
<div class="textAlign header">
    <div class="header_img">
        <img src="__MobileImg__/logo.png" />
    </div>
</div>
<!--导航栏tab-->
<div class="textAlign nav">
    <ul>
            <li <?php if(\think\Request::instance()->action() == 'new_activity'): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/new_activity'); ?>">首页</a></li>

            <?php if(is_array($title) || $title instanceof \think\Collection || $title instanceof \think\Paginator): if( count($title)==0 ) : echo "" ;else: foreach($title as $key=>$vo): ?>
            <li <?php if(\think\Request::instance()->param('set') == $vo['id']): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/index',['set'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li <?php if(\think\Request::instance()->action() == 'freeplay'): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/freeplay'); ?>">免费玩儿</a></li>
            <li><a href="<?php echo url('mobile/Activity/about'); ?>">关于我们</a></li>
    </ul>
</div>
	
	    <div class="erro_img">
	    	<img src="__MobileImg__/erro_img.png" />
	    </div>
	    <div class="erro_word"><?php echo $msg; ?></div>
	</body>
</html>

