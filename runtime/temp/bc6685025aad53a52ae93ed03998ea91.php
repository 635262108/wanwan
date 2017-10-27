<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"/var/www/html/wanwan/application/home/view/activity/freeplay.html";i:1505724287;s:61:"/var/www/html/wanwan/application/home/view/public/header.html";i:1508914023;}*/ ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>玩翫碗~不一样的玩儿</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit">
        <link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit">
        <style type="text/css">		
        </style>
    </head>
    <body>
        <header>
            <!--logo-->
            <div id="logo">
                <a href="/"><img src="__IMG__/logo.png" /></a>
            </div>
            <div class="navbar">
                <ul class="nav_left">
                    <?php if(is_array($title) || $title instanceof \think\Collection || $title instanceof \think\Paginator): if( count($title)==0 ) : echo "" ;else: foreach($title as $key=>$vo): ?>
                    <li>
                        <a href="<?php echo url('home/Activity/index',['set'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <li>
                        <a href="<?php echo url('home/Activity/freeplay'); ?>">免费玩儿</a>
                    </li>
                    <li>
                        <a href="<?php echo url('home/index/about'); ?>">关于我们</a>
                    </li>
                </ul>
                <ul class="nav_right">
                    <li style="color: white;">400-611-2731</li>
                    <?php if(empty(session('userInfo')) || ((session('userInfo') instanceof \think\Collection || session('userInfo') instanceof \think\Paginator ) && session('userInfo')->isEmpty())): ?>
                    <li>
                        <a href="<?php echo url('home/user/register'); ?>">注册</a>
                    </li>
                    <li>
                        <a href="<?php echo url('home/user/login'); ?>">登录</a>
                    </li>
                    <?php else: ?>
                    <li style="border: 1.5px solid white;padding: 2px 9px;border-radius: 5px;">
                        <a href="<?php echo url('home/User/index'); ?>" style="padding: 2px 9px;">会员中心</a>
                    </li>
                    <?php endif; ?>


                </ul>
            </div>
        </header>
<div class="begin_wrap">
    <div class="content">
        <!--简介-->
        <div class="info">
            <div class="wrap_img">
                <img src="__IMG__/freeplay.png" />
            </div>
            <!--简介内容-->
            <div class="info_main">
                <div class="info_title">
                    免费玩儿
                </div>
                <div class="info_content">
                    玩宝简介内容玩起简介内容玩起简介内容玩玩起简 介内容玩起简介内容玩起简介内容玩起简介内容玩玩 起简介内容玩起简介内容玩起简介内容玩玩起简介内 容玩起简介内容玩起简介内容玩玩起简 介内容玩起 简介内容玩起简介内容玩起简介内容玩玩
                </div>
            </div>
            <!--轮播图-->
            <div class="banner">
                <div class="banner-btn">
                    <a href="javascript:;" class="prevBtn"><i></i></a>
                    <a href="javascript:;" class="nextBtn"><i></i></a>
                </div>
                <ul class="banner-img">
                    <li>
                        <a href="#">
                            <img src="__IMG__/begin_ban.jpg">
                            <span class="f-tag">玩翫碗玩翫碗玩翫碗玩翫碗</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="__IMG__/begin_ban.jpg">
                            <span class="f-tag">玩翫碗玩翫碗玩翫碗玩翫碗</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="__IMG__/begin_ban.jpg">
                            <span class="f-tag">玩翫碗玩翫碗玩翫碗玩翫碗</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="__IMG__/begin_ban.jpg">
                            <span class="f-tag">玩翫碗玩翫碗玩翫碗玩翫碗</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="__IMG__/begin_ban.jpg">
                            <span class="f-tag">玩翫碗玩翫碗玩翫碗玩翫碗</span>
                        </a>
                    </li>
                </ul>
                <!--<ul class="banner-circle"></ul>-->						
            </div>
        </div>
        <!--栏目-->
        <div class="content_one" id="fh">
            <div class="title">
                <p>
                    <!--<a href="" target="_blank">更多></a>-->
                </p>
                <span>最新活动</span>
            </div>
            <?php if(is_array($newest) || $newest instanceof \think\Collection || $newest instanceof \think\Paginator): if( count($newest)==0 ) : echo "" ;else: foreach($newest as $key=>$vo): ?>
            <div class="content_one_wrap">
                <div class="content_one_img">
                    <a href="<?php echo url('home/activity/free_detail',['aid'=>$vo['aid']]); ?>"><img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>" /></a>
                </div>
                <div class="content_one_info">
                    <div class="info_left">
                        <p class="name "><?php echo $vo['a_title']; ?></p>
                        <p class="name_info"><?php echo $vo['a_remark']; ?>
                        </p>
                    </div>
                    <div class="info_right">
                        <a href="<?php echo url('home/activity/free_detail',['aid'=>$vo['aid']]); ?>"><img src="__IMG__/sure.png" /></a>
                    </div>

                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>

        <!--栏目-->
        <div class="content_one" id="zy">
            <div class="title">
                <p>
                    <!--<a href="" target="_blank">更多></a>-->
                </p>
                <span>往期回顾</span>
            </div>
            <?php if(is_array($review) || $review instanceof \think\Collection || $review instanceof \think\Paginator): if( count($review)==0 ) : echo "" ;else: foreach($review as $key=>$vo): ?>
            <div class="content_one_wrap old_activity">
                <div class="content_one_img">
                    <a href="<?php echo url('home/activity/free_detail',['aid'=>$vo['aid']]); ?>"><img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>" /></a>
                </div>
                <div class="content_one_info">
                    <div class="info_left" style="width: 100%;">
                        <p class="name "><?php echo $vo['a_title']; ?></p>
                    </div>
                    <!--<div class="info_right">
                            <a href="buy.html"><img src="__IMG__/sure.png" /></a>
                    </div>-->

                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

    </div>
</div>
</body>
<script src="__JS__/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/main.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/banner.js" type="text/javascript" charset="utf-8"></script>
</html>