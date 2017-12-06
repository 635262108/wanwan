<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"D:\chuangzhixing\wanwan/application/mobile\view\activity\new_activity.html";i:1512476717;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\footer.html";i:1511259883;}*/ ?>
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

<div class="wanwan_logo">
	<span><img src="__MobileImg__/wanwanwan@2x.png"></span>
</div>
<?php if(empty(session('userInfo')) || ((session('userInfo') instanceof \think\Collection || session('userInfo') instanceof \think\Paginator ) && session('userInfo')->isEmpty())): ?>
<div class="into_page">
	<span><a href="<?php echo url('mobile/user/login'); ?>">登录</a></span>
	<span><a href="<?php echo url('mobile/user/register'); ?>">注册</a></span>
</div>
<?php endif; ?>
<div class="device">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<div class="swiper-slide"> <img src="__MobileImg__/lunbo1.jpg"> </div>
			<div class="swiper-slide"> <img src="__MobileImg__/lunbo2.jpg"> </div>
			<div class="swiper-slide"><img src="__MobileImg__/lunbo3.jpg"></div>
		</div>
	</div>
	<div class="pagination"></div>
</div>
<div class="title_content">
	<div class="textAlign nav">
	<ul>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/index',['set'=>26]); ?>"><span><img src="__MobileImg__/wanbao@2x.png"></span>
				<p>玩宝</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/index',['set'=>27]); ?>"><span><img src="__MobileImg__/wanjia@2x.png"></span>
				<p>玩家</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/index',['set'=>28]); ?>"><span><img src="__MobileImg__/wanke@2x.png"></span>
				<p>玩客</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/index',['set'=>29]); ?>"><span><img src="__MobileImg__/wanjiang@2x.png"></span>
				<p>玩匠</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/index',['set'=>30]); ?>"><span><img src="__MobileImg__/wanda@2x.png"></span>
				<p>玩大</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/freeplay'); ?>"><span><img src="__MobileImg__/mianfei@2x.png"></span>
				<p>免费玩儿</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/Activity/about'); ?>"><span><img src="__MobileImg__/guanyuwomen@2x.png"></span>
				<p>关于我们</p>
			</a>
		</li>
		<li class="play_baby">
			<a href="<?php echo url('mobile/User/index'); ?>"><span><img src="__MobileImg__/huiyuanzhongxin@2x.png"></span>
				<p>会员中心</p>
			</a>
		</li>
	</ul>
</div>
</div>

<div class="five_organs almost">
	<div class="five_title title_img">
		<img src="__MobileImg__/wan_whole.png" />
		<div class="playBady_word">最新活动</div>
	</div>

	<div class="play_baoContent">
		<?php if(is_array($actInfo) || $actInfo instanceof \think\Collection || $actInfo instanceof \think\Paginator): if( count($actInfo)==0 ) : echo "" ;else: foreach($actInfo as $key=>$vo): ?>
		<a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>">
			<div class="playBao_part">
				<div class="sign_num">
					
					 <p><?php echo $vo['a_sold_num']; ?></p>
					 <div class="line_white"></div>
					 <p><?php echo $vo['a_num']+$vo['a_sold_num']; ?></p>
				</div>
				<div class="bao_img">
					<img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>" />
				</div>
				<div class="bao_content">
					<span class="outer_border">
  	    	 	 		<span class="inside_border"><?php echo $vo['a_title']; ?></span>
					</span>
					<ul>
						<li>活动介绍：<?php echo subtext($vo['a_remark'],'6'); ?></li>
						<li>活动时间：<?php echo date('Y.m.d',$vo['a_begin_time']); ?>-<?php echo date('Y.m.d',$vo['a_end_time']); ?></li>
						<li>活动地点：<?php echo $vo['a_address']; ?></li>

					</ul>
					<div class="content_bottom"><span>￥<?php echo $vo['a_price']; ?></span>
						<a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>">点我报名>></a>
					</div>
				</div>
			</div>
		</a>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>

<div class="whole_bottom">

<div class="bottom">
    <!--<div class="erweima"></div>-->
    <div class="bottom_title">
        <ul>
            <li><a href="<?php echo url('mobile/user/user'); ?>">会员条款</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/disclaimer'); ?>">免责声明</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/copy'); ?>">版权声明</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/privacy'); ?>">隐私保护</a></li>
            <li class="line">|</li>
            <li><a href="#">投诉建议</a></li>
        </ul>
        <div class="tel">联系方式：400-611-2731</div>
    </div>
</div>

<div class="copyright">
    <div class="first">Copyright©版权所有河南创致行企业管理咨询有限公司 (2017-2037)</div>
    <div class="second">豫ICP备13007531号-1</div>
</div>
</div>
<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<!--<script src="__MobileJs__/jquery.bxslider.js"></script>-->
<script type="text/javascript" src="__MobileJs__/index.js"></script>
<script>
	var mySwiper = new Swiper('.swiper-container', {

		// 自动轮播
		autoplay: 2000,
		autoHeight: true,
		// 分页容器
		pagination: '.pagination',
		grabCursor: true,
		paginationElement: 'li',
		createPagination: true
	})
</script>
</body>

</html>