<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/home\view\activity\index.html";i:1508309656;s:82:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/home\view\public\header.html";i:1508309656;s:82:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/home\view\public\footer.html";i:1508309656;}*/ ?>

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
                <a href="<?php echo url('home/index/index'); ?>"><img src="__IMG__/logo.png" /></a>
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
                <img src="<?php echo $titleInfo['logo']; ?>" />
            </div>
            <!--简介内容-->
            <div class="info_main">
                <div class="info_title">
                    <?php echo $titleInfo['name']; ?>简介
                </div>
                <div class="info_content">
                    <?php echo $titleInfo['introduce']; ?>
                </div>
            </div>
            <!--轮播图-->
            <div class="banner">
                <div class="banner-btn">
                    <a href="javascript:;" class="prevBtn"><i></i></a>
                    <a href="javascript:;" class="nextBtn"><i></i></a>
                </div>
                <ul class="banner-img">
                    <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): if( count($banner)==0 ) : echo "" ;else: foreach($banner as $key=>$vo): ?>
                    <li>
                        <a href="#">
                            <img src="<?php echo $vo['banner_url']; ?>">
                            <span class="f-tag"><?php echo $vo['banner_title']; ?></span>
                        </a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <!--<ul class="banner-circle"></ul>-->

            </div>

        </div>

        <!--五官栏目-->
        <?php if(is_array($titleSon) || $titleSon instanceof \think\Collection || $titleSon instanceof \think\Paginator): if( count($titleSon)==0 ) : echo "" ;else: foreach($titleSon as $key=>$vo): ?>
        <div class="content_one" id="<?php echo $vo['id']; ?>">

            <div class="title">
                <span><?php echo $titleInfo['name']; ?>-<?php echo $vo['name']; ?></span>
            </div>
            <?php foreach($result as $v): if($v['a_type'] == $vo['id']): ?>
            <div class="content_one_wrap">
                <div class="content_one_img">
                    <a href="<?php echo url('home/Activity/detail',['aid'=>$v['aid']]); ?>"><img src="__AdminIMG__/<?php echo $v['a_index_img']; ?>" /></a>
                </div>
                <div class="content_one_info">
                    <div class="info_left">
                        <p class="name"><?php echo $v['a_title']; ?></p>
                        <p class="name_info"><?php echo $v['a_remark']; ?>
                        </p>
                    </div>
                    <div class="info_right">
                        <a href="<?php echo url('home/Activity/detail',['aid'=>$v['aid']]); ?>"><img src="__IMG__/sure.png" /></a>
                    </div>

                </div>
            </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <!--悬浮框-->
        <div class="tool">
            <ul class="tooll">
                <?php if(is_array($titleSon) || $titleSon instanceof \think\Collection || $titleSon instanceof \think\Paginator): if( count($titleSon)==0 ) : echo "" ;else: foreach($titleSon as $key=>$vo): ?>
                <li>
                    <a href="#<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</body>
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
<script src="__JS__/main.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/banner.js" type="text/javascript" charset="utf-8"></script>
</html>