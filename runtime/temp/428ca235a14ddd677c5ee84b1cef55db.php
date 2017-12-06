<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"D:\chuangzhixing\wanwan/application/mobile\view\activity\index.html";i:1511492005;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1511167351;}*/ ?>
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

<!--玩宝总体内容部分-->
<div class="playBaby_content almost">
    <div class="content">
        <div class="baby_img">
            <img src="<?php echo $titleInfo['logo']; ?>" />
        </div>
        <div class="baby_detail">
           <?php echo $titleInfo['introduce']; ?>
        </div>
    </div>
</div>
<!--五官-->

    <div class="second_title">
    	<ul>
    		<?php if(is_array($titleSon) || $titleSon instanceof \think\Collection || $titleSon instanceof \think\Paginator): if( count($titleSon)==0 ) : echo "" ;else: foreach($titleSon as $key=>$vo): ?>
    		 <li><?php echo $vo['name']; ?></li>
    		 <?php endforeach; endif; else: echo "" ;endif; ?>
    	</ul>
    </div>

<div class="total_content">
<?php if(is_array($titleSon) || $titleSon instanceof \think\Collection || $titleSon instanceof \think\Paginator): if( count($titleSon)==0 ) : echo "" ;else: foreach($titleSon as $key=>$vo): ?>
<div class="five_organs almost">

  

        <div class="play_baoContent" id="second_detail">
            <?php foreach($result as $v): if($v['a_type'] == $vo['id']): ?>
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
                         <div class="content_bottom">
                         	<span>￥<?php echo $v['a_price']; ?></span>
                         	 <?php if($v['a_end_time'] > time()): ?>
                         	 <a href="<?php echo url('mobile/activity/detail',['aid'=>$v['aid']]); ?>">点我报名>></a>
                         	 <?php else: ?>
                         	 <a href="<?php echo url('mobile/activity/detail',['aid'=>$v['aid']]); ?>" style="color: #767676;">活动结束>></a>
                         	 <?php endif; ?>
                         	
                         </div>
                    </div>
                </div>
            </a>
            <?php endif; endforeach; ?>
            <div class="no_style" style="display:none;margin-top:88px;" id="new_no">
            	 <div><img src="__MobileImg__/no_activity.png"></div>
                <div style="color: #8A8A8A;">活动暂时休息一会儿噢~</div>
                 <!--<div><a href="javascript:;" style="color: #FF4134;">快去看看吧</a></div>-->
            </div>
        </div>
        
   </div>
<?php endforeach; endif; else: echo "" ;endif; ?>

</div>


</body>
<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<script src="__MobileJs__/jquery.bxslider.js"></script>
<script src="__MobileJs__/index.js" ></script>
</html>

