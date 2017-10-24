<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"D:\chuangzhixing\wanwan/application/home\view\index\index.html";i:1508318472;s:64:"D:\chuangzhixing\wanwan/application/home\view\public\header.html";i:1508391782;s:64:"D:\chuangzhixing\wanwan/application/home\view\public\footer.html";i:1508318472;}*/ ?>
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
<style type="text/css">
    .bg {
        background: url(__IMG__/bg2.jpg) no-repeat top center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 975px;
    }

    .content_ul li {
        z-index: 10;
        position: absolute;
    }

    .content_ul li:nth-child(1) {
        top: 110px;
        left: 350px;
    }

    .content_ul li:nth-child(2) {
        top: 270px;
        left: 220px;
    }

    .content_ul li:nth-child(3) {
        top: 450px;
        left: 150px;
    }

    .content_ul li:nth-child(4) {
        top: 630px;
        left: 220px;
    }

    .content_ul li:nth-child(5) {
        top: 770px;
        left: 360px;
    }

    .text_center {
        width: 1800px;
        position: absolute;
        top: 370px;
        width: 420px;
        text-align: end;
        margin-left: 23%;
    }

    .text_center h2 {
        font-size: 48px;
        font-weight: 700;
        color: white;
    }

    .text_center p {
        margin-top: 20px;
        color: white;
        font-size: 28px;
    }

    .content_ul li:hover img {
        -ms-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -ms-transition: all 0.5s;
        -o-transition: all 0.5s;
    }

    @media screen and (max-width: 1700px) {
        .navbar {
            width: 1300px;
        }
        .nav_right {
            margin-left: 5px;
        }
        .nav_left {
            margin-left: 8px;
        }
        .content_ul li img {
            width: 80%;
        }
        .content_ul li:nth-child(1) {
            top: 100px;
            left: 340px;
        }
        .content_ul li:nth-child(2) {
            top: 230px;
            left: 210px;
        }
        .content_ul li:nth-child(3) {
            top: 390px;
            left: 140px;
        }
        .content_ul li:nth-child(4) {
            top: 540px;
            left: 210px;
        }
        .content_ul li:nth-child(5) {
            top: 650px;
            left: 330px;
        }

        .bg {
            background: url(__IMG__/bg2.jpg) no-repeat top center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 880px;
        }	
    }

    @media screen and (max-width: 1280px) {
        .text_center {
            width: 700px;
            margin-left: 0px;
            top: 350px;
        }
    }
</style>
<!--背景-->
<div class="wrap">
    <div class="bg">
    </div>
    <div class="content_txt">
        <ul class="content_ul">
            <li>
                <a href="<?php echo url('home/activity/index',['set'=>26]); ?>"><img src="__IMG__/begin.png" /></a>
            </li>
            <li>
                <a href="<?php echo url('home/activity/index',['set'=>27]); ?>"><img src="__IMG__/start.png"/></a>
            </li>
            <li>
                <a href="<?php echo url('home/activity/index',['set'=>28]); ?>"><img src="__IMG__/play.png" /></a>
            </li>
            <li>
                <a href="<?php echo url('home/activity/index',['set'=>29]); ?>"><img src="__IMG__/artisan.png" /></a>
            </li>
            <li>
                <a href="<?php echo url('home/activity/index',['set'=>30]); ?>"><img src="__IMG__/study.png" /></a>
            </li>
        </ul>
        <div class="text_center">
            <div class="text_content">
                <h2 style="display: none;">不一样的玩？</h2>
                <p style="display: none;">＜点击了解玩翫碗怎么不一样</p>
            </div>
        </div>
    </div>
</div>
<!--底部-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			body{
				font-family: "微软雅黑";
			}
			li{
				list-style: none;
			}
			a{
			      text-decoration: none;
			}
			#footer {
				padding: 10px 0;
				width: 100%;
				height: 190px;
				background-color: #ebeded;
				margin-top: 30px;
			}
			
			#footer .nav {
				clear: both;
				font-size: 16px;
				padding-top: 20px;
				height: 18px;
			}
			
			
			#footer li a {
				color: #666666;
			}
			
			#footer .nav li,
			#footer .group li {
				float: left;
				margin: 0 15px;
			}
			
			#footer .nav a {
				color: #666666;
			}
			
			#footer .nav a:hover {
				text-decoration: underline;
			}
			
			#footer .group,
			#footer p {
				font-size: 12px;
				color: #666666;
			}
			
			#footer .group {
				clear: both;
				height: 30px;
				line-height: 30px;
			}
			
			#footer .group,
			#footer p {
				margin-top: 20px;
			}
			
			#footer p {
				margin-left: 15px;
			}
			
			#footer .img {
				width: 140px;
				height: 140px;
				position: absolute;
				top: 50%;
				right: 0;
				margin-top: -70px;
			}
                        #content{
                            width:1000px;
                            margin: 0 auto;
                        }
		</style>
	</head>
	<body>
		<!--底部-->
		<div id="footer">
                    <div id="content">
				<div class="main-2" style="height:190px;position:relative;">
					<ul class="nav">
						<li>
							<a href="" target="_blank" title="关于我们">会员条款</a>
						</li>
						<li>
							<a href="" target="_blank" title="诚聘英才">免责声明</a>
						</li>
						<li>
							<a href="" target="_blank" title="网站地图">加入我们</a>
						</li>
						<li>
							<a href="" target="_blank" title="联系我们">投诉建议</a>
						</li>
						<li>
							<a href="" target="_blank" title="联系我们">商户合作</a>
						</li>
					</ul>
					<ul class="group">
						<li>
							<a href="">虾米</a>
						</li>
						<li>
							<a href="">来往</a>
						</li>
						<li>
							<a href="">支付宝</a>
						</li>
						<li>
							<a href="">亲子</a>
						</li>
						<li>
							<a href="">免费玩儿</a>
						</li>
					</ul>
					<p>Copyright © 版权所有河南创致行企业管理咨询有限公司 (2017-2037)
					</p>
					<p>豫ICP备13007531号-1
					</p>
					<img class="img" src="__IMG__/code.png" alt="" />
				</div>
                        </div>

		</div>
	</body> 
</html>

<script src="__JS__/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    //为导航栏添加鼠标移入事件
    $(".nav_left li>a").mouseenter(function() {
        $(this).css({
            backgroundColor: 'white',
            color: '#ff4b3c'
        });
    });
    $(".nav_left li>a").mouseleave(function() {
        $(this).css({
            backgroundColor: 'transparent',
            color: 'white'
        });
    });
    $(".text_center h2").fadeIn(2000, function() {
    });
    $(".text_center p").fadeIn(3000, function() {
    });
</script>
</body>
</html>