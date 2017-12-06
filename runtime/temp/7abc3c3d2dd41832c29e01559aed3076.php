<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\chuangzhixing\wanwan/application/mobile\view\activity\comments_list.html";i:1508318472;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;}*/ ?>
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


        <!--头部图片-->
        <div class="textAlign header">
            <div class="header_img">
                <img src="__MobileImg__/logo.png" />
            </div>
        </div>

        <?php if(is_array($comInfo) || $comInfo instanceof \think\Collection || $comInfo instanceof \think\Paginator): if( count($comInfo)==0 ) : echo "" ;else: foreach($comInfo as $key=>$vo): ?>
        <!--玩伴评论-->
        <div class="playBaby_content almost">
            <div class="title title_img">
                <img src="__MobileImg__/wan_whole.png"/>
                <div class="playBady_word">玩伴评论</div>
            </div>
            <div class="discuss_content">
            <div class="discuss_part">
                <div class="discuss_img">
                    <img src="__HEADICON__/<?php echo $vo['headIcon']; ?>" />
                </div>
                <ul>
                    <li><?php echo $vo['nickname']; ?></li>
                    <li><?php echo htmlentities($vo['content']); ?></li>
                    <li><?php echo date('Y.m.d H:i',$vo['time']); ?></li>
                </ul>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        </div>


        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script src="__MobileJs__/jquery.bxslider.js"></script>
        <script type="text/javascript" src="__MobileJs__/index.js" ></script>
    </body>
</html>

