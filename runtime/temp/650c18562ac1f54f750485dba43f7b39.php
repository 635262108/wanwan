<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\chuangzhixing\wanwan/application/mobile\view\activity\freeplay.html";i:1511769164;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1511167351;}*/ ?>

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
   <div class="second_title">
    	<ul>
    		
    		 <li>最新活动</li>
    		 <li>往期回顾</li>
    		
    	</ul>
    </div>
    
    <div class="total_content">
<div class="five_organs almost">
    <!--<div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">最新活动</div>
    </div>-->
    <div class="play_baoContent">
        <?php if(is_array($newest) || $newest instanceof \think\Collection || $newest instanceof \think\Paginator): if( count($newest)==0 ) : echo "" ;else: foreach($newest as $key=>$v): ?>
        <a href="<?php echo url('mobile/activity/detail',['aid'=>$v['aid']]); ?>">
        <div class="playBao_part">
        	       <?php if($v['a_end_time'] > time()): ?>
					<div class="sign_num">
						
						 <p><?php echo $v['a_sold_num']; ?></p>
						 <div class="line_white"></div>
						 <p><?php echo $v['a_num']; ?></p>
					</div>
					<?php else: ?>
					<div class="sign_num" style="background:url(../../../../public/mobile_static/images/over_img.png) no-repeat";>
						
						 <p><?php echo $v['a_sold_num']; ?></p>
						 <div class="line_white"></div>
						 <p><?php echo $v['a_num']; ?></p>
					</div>
				 <?php endif; ?>
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
                <div class="content_bottom"><span>￥免费</span><a href="<?php echo url('mobile/activity/detail',['aid'=>$v['aid']]); ?>">点我报名>></a></div>
            </div>
        </div>
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
             <div class="no_style" style="display:none;margin-top:88px;" id="new_no">
            	 <div><img src="__MobileImg__/no_activity.png"></div>
                 <div style="color: #8A8A8A;">活动暂时休息一会儿噢~</div>
                 <!--<div><a href="javascript:;" style="color: #FF4134;">快去看看吧</a></div>-->
            </div>
    </div>
</div>

<!--往期回顾-->
<div class="five_organs almost" style="display: none;">
    <div class="play_baoContent">
        <?php if(is_array($review) || $review instanceof \think\Collection || $review instanceof \think\Paginator): if( count($review)==0 ) : echo "" ;else: foreach($review as $key=>$v): ?>
        <a href="<?php echo url('mobile/activity/detail',['aid'=>$v['aid']]); ?>">
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
                    <div class="content_bottom"><span>￥免费</span><a href="<?php echo url('mobile/activity/free_detail',['aid'=>$v['aid']]); ?>">点我报名>></a></div>
                </div>
            </div>
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
             <div class="no_style" style="display:none;margin-top:88px;" id="new_no">
            	 <div><img src="__MobileImg__/no_activity.png"></div>
                 <div style="color: #8A8A8A;">活动暂时休息一会儿噢~</div>
                 <!--<div><a href="javascript:;" style="color: #FF4134;">快去看看吧</a></div>-->
            </div>
    </div>
</div>
</div>



<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<script src="__MobileJs__/jquery.bxslider.js"></script>
<script type="text/javascript" src="__MobileJs__/index.js" ></script>
</body>
</html>

