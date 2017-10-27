<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"/var/www/html/wanwan/application/mobile/view/activity/new_activity.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/header.html";i:1508125376;s:60:"/var/www/html/wanwan/application/mobile/view/public/nav.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/footer.html";i:1508125376;}*/ ?>
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

<?php if(empty(session('userInfo')) || ((session('userInfo') instanceof \think\Collection || session('userInfo') instanceof \think\Paginator ) && session('userInfo')->isEmpty())): ?>
<div class="into_page">
    <span><a href="<?php echo url('mobile/user/login'); ?>">登录</a></span>
    <span><a href="<?php echo url('mobile/user/register'); ?>">注册</a></span>
</div>
<?php endif; ?>
<!--头部图片-->
<div class="textAlign header">
    <div class="header_img">
        <img src="__MobileImg__/logo.png" />
    </div>
</div>
<!--导航栏tab-->
<div class="textAlign nav">
    <ul>
            <li <?php if(\think\Request::instance()->action() == 'new_activity'): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/new_activity'); ?>">首页</a></li>

            <?php if(is_array($title) || $title instanceof \think\Collection || $title instanceof \think\Paginator): if( count($title)==0 ) : echo "" ;else: foreach($title as $key=>$vo): ?>
            <li <?php if(\think\Request::instance()->param('set') == $vo['id']): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/index',['set'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li <?php if(\think\Request::instance()->action() == 'freeplay'): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/freeplay'); ?>">免费玩儿</a></li>
            <li><a href="<?php echo url('mobile/Activity/about'); ?>">关于我们</a></li>
    </ul>
</div>

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

<div class="five_organs almost">
    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
          <div class="playBady_word">最新活动</div>
    </div>

        <div class="play_baoContent">
           <?php if(is_array($actInfo) || $actInfo instanceof \think\Collection || $actInfo instanceof \think\Paginator): if( count($actInfo)==0 ) : echo "" ;else: foreach($actInfo as $key=>$vo): ?>
            <a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>">
                <div class="playBao_part">
                    <div class="bao_img">
                        <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
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
                         <div class="content_bottom"><span>￥<?php echo $vo['a_price']; ?></span><a href="javascript:;">点我报名>></a></div>
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
<script>
    var mySwiper = new Swiper('.swiper-container',{

        // 自动轮播
        autoplay:2000,
        autoHeight:true,
        // 分页容器
        pagination: '.pagination',
        grabCursor: true,
        paginationElement : 'li'
    })

</script>
</body>
</html>