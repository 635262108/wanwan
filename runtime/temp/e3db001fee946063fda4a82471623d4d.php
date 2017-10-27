<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"/var/www/html/wanwan/application/mobile/view/activity/freeplay.html";i:1508914023;s:70:"/var/www/html/wanwan/application/mobile/view/public/second_header.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/footer.html";i:1508125376;}*/ ?>

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


<!--免费活动-->
<div class="playBaby_content almost">

    <div class="content">
        <div class="baby_img">
            <img src="__IMG__/freeplay.png" />
        </div>
        <div class="baby_detail">
            我的最爱是大虾我的最爱是大虾我的最爱是大虾
            我的最爱是大虾我的最爱是大虾我的最爱是大虾
            我的最爱是大虾我的最爱是大虾我的最爱是大虾
        </div>
    </div>
</div>
<!--最新活动-->
<div class="five_organs almost">
    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">最新活动</div>
    </div>
    <div class="play_baoContent">
        <?php if(is_array($newest) || $newest instanceof \think\Collection || $newest instanceof \think\Paginator): if( count($newest)==0 ) : echo "" ;else: foreach($newest as $key=>$v): ?>
        <a href="<?php echo url('mobile/activity/free_detail',['aid'=>$v['aid']]); ?>">
        <div class="playBao_part">
            <div class="bao_img">
                <img src="__AdminIMG__/<?php echo $v['a_index_img']; ?>"/>
            </div>
            <div class="bao_content">
  	    	 	 	<span class="outer_border">
  	    	 	 		<span class="inside_border"><?php echo subtext($v['a_title'],'25'); ?></span>
  	    	 	 	</span>
                <ul>
                    <li>活动介绍：<?php echo subtext($v['a_remark'],'10'); ?></li>
                    <li>活动时间：<?php echo date('Y.m.d',$v['a_begin_time']); ?>-<?php echo date('Y.m.d',$v['a_end_time']); ?></li>
                    <li>活动地点：<?php echo $v['a_address']; ?></li>
                </ul>
                <div class="content_bottom"><span>￥免费</span><a href="javascript:;">点我报名>></a></div>
            </div>
        </div>
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<!--往期回顾-->
<div class="five_organs almost">
    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">往期回顾</div>
    </div>
    <div class="play_baoContent">
        <?php if(is_array($review) || $review instanceof \think\Collection || $review instanceof \think\Paginator): if( count($review)==0 ) : echo "" ;else: foreach($review as $key=>$v): ?>
        <a href="<?php echo url('mobile/activity/free_detail',['aid'=>$v['aid']]); ?>">
            <div class="playBao_part">
                <div class="bao_img">
                    <img src="__AdminIMG__/<?php echo $v['a_index_img']; ?>"/>
                </div>
                <div class="bao_content">
  	    	 	 	<span class="outer_border">
  	    	 	 		<span class="inside_border"><?php echo subtext($v['a_title'],'25'); ?></span>
  	    	 	 	</span>
                    <ul>
                        <li>活动介绍：<?php echo subtext($v['a_remark'],'10'); ?></li>
                        <li>活动时间：<?php echo date('Y.m.d',$v['a_begin_time']); ?>-<?php echo date('Y.m.d',$v['a_end_time']); ?></li>
                        <li>活动地点：<?php echo $v['a_address']; ?></li>
                    </ul>
                    <div class="content_bottom"><span>￥免费</span><a href="javascript:;">点我报名>></a></div>
                </div>
            </div>
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>


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


<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<script src="__MobileJs__/jquery.bxslider.js"></script>
<script type="text/javascript" src="__MobileJs__/index.js" ></script>
</body>
</html>

