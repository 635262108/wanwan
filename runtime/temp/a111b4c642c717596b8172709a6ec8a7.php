<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"D:\chuangzhixing\wanwan/application/mobile\view\user\my_collect.html";i:1508752767;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1508840840;}*/ ?>
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

<body>
<!--头部导航-->
<!--<div class="comeback textAlign" id="second_page">
    <div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
        <div class="comeback_img">
            <img src="__MobileImg__/second_back.png"/>
        </div>

    </div>

    <div class="title_word second_activity">全部收藏</div>

</div>-->
</div>

    <!--我的推荐-->
    <div class="five_organs almost">
        <div class="myActivity_content" id="my_collectMore">
            <div class="myActivity_big">
                <?php if(is_array($collectionData) || $collectionData instanceof \think\Collection || $collectionData instanceof \think\Paginator): if( count($collectionData)==0 ) : echo "" ;else: foreach($collectionData as $key=>$vo): ?>
                <div class="activity_part">
                    <ul>
                        <li>
                            <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                        </li>
                        <li>
                            <p><span><?php echo $vo['a_title']; ?></span></p>
                            <!--<p>2017.09.12--2017.09.16</p>-->
                            <p><?php echo $vo['a_remark']; ?></p>
                        </li>
                        <li>
                            <div><span href="javascript:void(0)" aid="<?php echo $vo['aid']; ?>" class="cancel_collect">取消收藏</span></div>
                            <div><a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>"  class="sign_up">我要报名</a></div>
                        </li>
                    </ul>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

    </div>

    <script src="__MobileJs__/jquery.min.js"></script>
    <script src="__MobileJs__/idangerous.swiper.min.js"></script>
    <script src="__MobileJs__/jquery.bxslider.js"></script>
    <script type="text/javascript" src="__MobileJs__/index.js" ></script>
</body>
</html>

