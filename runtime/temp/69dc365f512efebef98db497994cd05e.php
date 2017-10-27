<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/var/www/html/wanwan/application/mobile/view/activity/detail_list.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/header.html";i:1508125376;s:70:"/var/www/html/wanwan/application/mobile/view/public/second_header.html";i:1508914023;}*/ ?>
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

        <!--头部图片-->
        <!--<div class="comeback textAlign" id="second_page">
            <div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
                <div class="comeback_img">
                    <img src="__MobileImg__/second_back.png"/>
                </div>

            </div>

            <div class="title_word second_activity">活动详情</div>

        </div>-->
        <!--导航栏tab-->


        <!--轮播图-->

        <!--玩宝总体内容部分-->
        <div class="playBaby_content almost" id="detail_last">

            <div class="content">
                <div class="baby_img">
                    <img src="__AdminIMG__/<?php echo $einfo['extension_img']; ?>" />
                </div>
                <div class="baby_detail">
                    <ul>
                        <li><?php echo $einfo['extension_title']; ?></li>
                        <li></li>
                        <li><?php echo $einfo['extension_remark']; ?></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="eyesContent">
            <?php echo $einfo['extension_content']; ?>
        </div>

        <script src="__MobileJs__/jquery.min.js"></script>

    </body>
    
    <script>
       
    $(".eyesContent p img").attr("style","width: 100%");

    $(".eyesContent p").attr("style","text-align: center;");
    </script>
</html>

