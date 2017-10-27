<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"/var/www/html/wanwan/application/home/view/index/about.html";i:1505556820;s:61:"/var/www/html/wanwan/application/home/view/public/header.html";i:1508914023;}*/ ?>
<!DOCTYPE html>
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
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<title>关于我们</title>
		<style type="text/css">
			.about_con{
				padding: 80px 0;
				margin: 20px 0;
			}
			.about_con_txt{
				padding-top: 20px;
				width: 760px;
				float: left;
				padding-left: 70px;
			}
			.about_con_txt p{
				color: #666666;
				width: 760px;
			}
			.about_con_img img{
				float: left;
				width: 145px;
			}
			.about_bottom{
				margin-top: 100px;
				background-color: #2c2f34;
			}
			.about_bottom img{
				width: 980px;
			}
			@media screen and (max-width: 1000px) {
				.about_top{
					width: 1020px;
				}
				
				.about_top img{
					height: 420px;
					width: 1020px;
				}
			}
		</style>
	</head>
		<div class="about_top">
			<img src="__IMG__/about1.png"/ style="width: 100%;"id="topImg">
		</div>
		
		<div class="about_content">
			<div class="content">
				<div class="about_con">
					<div class="about_con_img">
					<img src="__IMG__/about21.png"/>
				    </div>
				   <div class="about_con_txt">
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;玩，是一种探索的形式，一种拥有幸福的能力。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;玩翫碗，致力于通过不一样的玩，让孩子像沐浴在日光下的小鸟一样，通过欢快的玩耍练习，
					       探索世界，从而了解事物本来的样子。在自得其乐中，成为她自己，拥有属于自己的生活方式，获得满足与愉悦。</p>
				   </div>
				</div>
				<div class="about_con">
					<div class="about_con_img">
					<img src="__IMG__/about22.png"/>
				    </div>
				   <div class="about_con_txt">
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;玩翫碗，隶属河南创致行企业管理咨询有限公司旗下。由2015年4月23日开通运营的免费玩儿平台，在2017年5月31日更名而来。当前在郑州已拥有450多家合作机构，原创设计组织活动500多场。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;目前玩翫碗主要以“翫”为核心，用“玩”的形式，以“中心店+社区店”的模式，为郑州5-8岁左右的孩子提供服务。</p>
				   </div>
				</div>
				
			</div>
		</div>
		
		<div class="about_bottom">
			<div class="content">
				<img src="__IMG__/about3.png"/>
			</div>
		</div>
		<script src="js/jquery-2.2.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
