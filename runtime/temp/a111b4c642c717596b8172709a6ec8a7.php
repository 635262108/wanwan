<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"D:\chuangzhixing\wanwan/application/mobile\view\user\my_collect.html";i:1511343068;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1511167351;}*/ ?>
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
     
            <?php if(empty($url) || (($url instanceof \think\Collection || $url instanceof \think\Paginator ) && $url->isEmpty())): ?>
                <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/second_back.png"/></a>
            <?php else: ?>
                <a href="<?php echo $url; ?>"><img src="__MobileImg__/second_back.png"/></a>
            <?php endif; ?>
        </div>
    </div>

    <div class="title_word second_activity"> <?php echo $title; ?></div>
    <!--<?php if(\think\Request::instance()->controller() != 'User'): ?>
    <div class="click_stroggle">
    	<a href="<?php echo url('mobile/user/index'); ?>"><img src="__MobileImg__/dot_img.png" /></a>
    </div>
    <?php endif; ?>-->
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
</div>
    <div class="five_organs almost">

	<div class="play_baoContent" id="conllect_Content">
		<?php if(is_array($collectionData) || $collectionData instanceof \think\Collection || $collectionData instanceof \think\Paginator): if( count($collectionData)==0 ) : echo "" ;else: foreach($collectionData as $key=>$vo): ?>
		<a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>">
			<div class="playBao_part">
				 <?php if($vo['a_end_time'] > time()): ?>
					<div class="sign_num">
						
						 <p><?php echo $vo['a_sold_num']; ?></p>
						 <p><?php echo $vo['a_num']; ?></p>
					</div>
					<?php else: ?>
					<div class="sign_num" style="background:url(../../../../public/mobile_static/images/over_img.png) no-repeat";>
						
						 <p><?php echo $vo['a_sold_num']; ?></p>
						 <p><?php echo $vo['a_num']; ?></p>
					</div>
				 <?php endif; ?>
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
					<div class="content_bottom">
				
						<span href="javascript:void(0)" aid="<?php echo $vo['aid']; ?>" class="cancel_collect">取消收藏</span>
						 <?php if($vo['a_end_time'] > time()): ?>
						 <a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>">点我报名>></a>
						 <?php else: ?>
						 <a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>" style="color: #767676;">活动结束>></a>
						 <?php endif; ?>
						
					</div>
				</div>
			</div>
		</a>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		 <div class="nothing display_none" id="new_no" style="display: none;">
                 <div><img src="__MobileImg__/no_activity.png"></div>
                 <div>没有相关活动噢~</div>
                 <div><a href="javascript:;" style="color: #FF4134;">快去看看吧</a></div>
         </div>
	</div>
</div>

    <script src="__MobileJs__/jquery.min.js"></script>
    <script src="__MobileJs__/idangerous.swiper.min.js"></script>
    <script src="__MobileJs__/jquery.bxslider.js"></script>
    <script type="text/javascript" src="__MobileJs__/index.js" ></script>
</body>
</html>

