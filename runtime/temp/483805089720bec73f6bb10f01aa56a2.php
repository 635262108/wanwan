<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"/var/www/html/wanwan/application/home/view/activity/free_detail.html";i:1506306808;s:61:"/var/www/html/wanwan/application/home/view/public/header.html";i:1508914023;s:61:"/var/www/html/wanwan/application/home/view/public/footer.html";i:1505556820;}*/ ?>
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
    .activity-one {
        /*width: 850px;*/
        height: 400px;
        /*border: 1px solid red;*/
        padding: 50px 0;
    }

    .activity-img {
        float: left;
    }

    .activity-img img {
        width: 420px;
        height: 380px;
    }

    .info p {
        font-size: 1em;
        margin-top: 12px;
        color: #666666;
        font-size: 13px;
    }

    .info {
        /*border: 1px solid red;*/
        width: 535px;
        float: right;
        padding: 5px;
        line-height: 25px;
        margin-top: 0px;
    }

    .price {
        color: #FF4134;
        font-size: 24px;
    }

    .lab {
        float: left;
        font-size: 14px;
        margin-top: 8px;
        margin: 9px 10px 0;
    }

    .p-f-text {
        width: 42px;
        float: left;
        margin: 2px 2px 2px 0;
        border: 1px solid #c9c9c9;
        height: 26px;
        line-height: 26px;
        text-indent: 2px;
    }

    .button {
        float: right;
    }

    .up {
        background: url(__IMG__/up.png) center center no-repeat;
    }

    .down {
        background: url(__IMG__/down.png) center center no-repeat;
    }

    .up,
    .down {
        width: 18px;
        height: 12px;
        display: block;
        border: 1px solid #c9c9c9;
        margin: 2px 0;
    }

    .entered{
        color: white;
        background-color: #FF4134;
        padding: 10px 22px;
        font-size: 1.1em;
        cursor: pointer;
        border-radius: 5px;
        margin-left: 285px;
        border: none;
    }

    .activeList span:nth-child(3) {
        margin-left: 340px;
        margin-top: 20px;
        font-size: 12px;
    }

    .activity_ul {
        list-style: none;
        border-bottom: 3px solid #FF4134;
    }

    .activity_ul li {
        /*margin-left: -297px;*/
        width: 100px;
        /*border: 1px solid green;*/
        display: inline-block;
        font-size: 1.2em;
        padding: 5px 20px;
        cursor: pointer;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }

    .activity_ul li:nth-child(1) {
        background-color: #FF4134;
        color: white;
    }

    .active_info {
        /*border: 1px solid green;*/
        padding: 25px;
    }

    .active_comment {
        display: none;
        /*border: 1px solid black;*/
        padding: 25px;
    }

    .userAttar_Img {
        float: left;
        width: 80px;
        /*border: 1px solid green;*/
    }

    .userAttar_Img img {
        width: 60px;
    }

    .conment_info {
        float: right;
        width: 820px;
        line-height: 30px;
    }

    .common_list_li {
        padding: 20px;
        overflow: hidden;
        list-style: none;
        border-bottom: 1px solid #efefef;
    }

    .content_three_wrap {
        width: 225px;
        height: 225px;
        border: 1px solid #ebebeb;
        padding: 5px;
        display: inline-block;
        background-color: white;
        margin: 20px 6px 50px 6px;
    }

    .content_three_img img {
        width: 100%;
        height: 150px;
    }

    .content_three_wrap:hover {
        border: 1px solid #FF4134;
    }

    .activeList a {
        background-color: #FF4134;
        padding: 2px 10px;
        border-radius: 5px;
        color: white;
    }
</style>

<div class="content">
    <div class="activity-one">
        <div class="activity-img">
            <img src="__AdminIMG__/<?php echo $activityInfo['a_index_img']; ?>" />
        </div>
        <form action="<?php echo url('home/Activity/activity_sure'); ?>" method="get">
            <input type="hidden" name="aid" value="<?php echo $activityInfo['aid']; ?>" />
            <div class="info">
                <h3 class="name" style="color: #FF4134;font-weight: 600;"><?php echo $activityInfo['a_title']; ?></h3>
                <p class="time" style="margin-top: 20px;">活动时间：<?php echo date('Y年m月d日',$activityInfo['a_begin_time']); ?>-<?php echo date('m月d日',$activityInfo['a_end_time']); ?></p>
                <p class="old">适合年龄：
                    <?php if($activityInfo['a_age'] == 1): ?>
                    5~9
                    <?php endif; ?>
                    岁</p>
                <p class="number">活动名额：<?php echo $activityInfo['a_num']+$activityInfo['a_sold_num']; ?></p>
                <p class="place">活动地点：<?php echo $activityInfo['a_address']; ?></p>
                <p style="float: left;">大人:</p>
                <div class="lab ">
                    <input id="num-1" class="p-f-text dB_number_s" type="text" name="adult_num" value="1" maxlength="6" />
                    <div class="button">
                        <a id="up-1" class="up changeadd" href="javascript:;"></a>
                        <a id="down-1" class="down changeredu" href="javascript:;"></a>
                    </div>
                </div>
                <p style="float: left;">孩子:</p>
                <div class="lab">
                    <input id="num-2" class="p-f-text dB_number_s" name="child_num" type="text" value="1" maxlength="6" />
                    <div class="button">
                        <a id="up-2" class="up changeadd" href="javascript:;"></a>
                        <a id="down-2" class="down changeredu" href="javascript:;"></a>
                    </div>
                </div>

                <p style="vertical-align: inherit;margin-top: 50px;">选择时间:</p>
                <div style="color: #666666;margin-left: 60px;margin-top: -24px;font-size: 13px;min-height: 80px;">
                    <?php if(is_array($timeInfo) || $timeInfo instanceof \think\Collection || $timeInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $timeInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="radio" name="time" value="<?php echo $vo['t_id']; ?>" <?php if($vo['ticket_num'] == 0): ?>disabled<?php endif; ?> /><?php echo $vo['t_content']; ?> 剩余 <?php echo $vo['ticket_num']; if($i%2 == 0): ?><br/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <p class="activeList" style="margin-top: 10px;">
                    <span class="price">免费</span>
                    <?php if($activityInfo['a_num'] <= 0): ?>
                    <button disabled="disabled" class="entered" style="border-radius: 5px;background-color: #D0D0D0;">已售完</button>
                    <?php elseif($activityInfo['a_end_time'] > time()): ?>
                    <button class="entered" style="border-radius: 5px;">我要玩</button>
                    <?php else: ?>
                    <button disabled="disabled" class="entered" style="border-radius: 5px;background-color: #D0D0D0">活动已结束</button>
                    <?php endif; ?>

                    <span style="">已报名额/总名额：<?php echo $activityInfo['a_sold_num']; ?>/<?php echo $activityInfo['a_num']+$activityInfo['a_sold_num']; ?></span>
                </p>
            </div>
        </form>
    </div>
    <ul class="activity_ul">
        <li class="view-ul">活动详情</li>
        <li class="all-comment">全部评论</li>
    </ul>
    <!--活动介绍-->
    <div class="active_info">
        <h3 style="margin: 20px 0;">活动详情</h3>
        <?php echo $activityInfo['a_content']; ?>
    </div>
    <!--评论-->
    <div class="active_comment">
        <h3 style="margin: 20px 0;">全部评价</h3>
        <ul>
            <?php if(empty($commentInfo) || (($commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator ) && $commentInfo->isEmpty())): ?>
            <p align="center">暂无评论......</p>
            <?php else: if(is_array($commentInfo) || $commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator): if( count($commentInfo)==0 ) : echo "" ;else: foreach($commentInfo as $key=>$vo): ?>
            <li class="common_list_li">
                <div class="userAttar_Img">
                    <?php if($vo['headIcon'] == ''): ?>
                    <img src="__IMG__/wan.jpg" />
                    <?php else: ?>
                    <img src="<?php echo $vo['headIcon']; ?>" />
                    <?php endif; ?>
                </div>
                <div class="conment_info">
                    <div class="user_name" style="color: gray;">
                        <?php echo $vo['nickname']; ?>
                    </div>
                    <div class="act_commoDate" style="color:#b7b7bd;font-size: 0.8em;">
                        <?php echo date('Y年m月d日',$vo['time']); ?>
                    </div>
                    <div class="act_common_content">
                        <?php echo $vo['content']; ?>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
    </div>

    <!--			<ul class="activity_ul">
                                    <li>相关玩具</li>
                            </ul>
                            <div class="content_three_wrap" style="margin: 20px 0 50px 0;">
                                    <div class="content_three_img">
                                            <a href="products-buy.html"><img src="__IMG__/Pro1.jpg" /></a>
                                    </div>
                                    <div class="content_three_info">
                                            <h4 class="name ">眼球模型</h4>
                                            <p class="activeList">
                                                    <span class="price">￥68 </span>
                                                    <a style="margin-left:  70px;font-size: 13px;" href="">点击购买</a>
                                            </p>
                                    </div>
                            </div>
                            <div class="content_three_wrap">
                                    <div class="content_three_img">
                                            <a href="products-buy.html"><img src="__IMG__/Pro1.jpg" /></a>
                                    </div>
                                    <div class="content_three_info">
                                            <h4 class="name ">眼球模型</h4>
                                            <p class="activeList">
                                                    <span class="price">￥68 </span>
                                                    <a style="margin-left: 70px;font-size: 13px;" href="">点击购买</a>
                                            </p>
                                    </div>
                            </div>
                            <div class="content_three_wrap">
                                    <div class="content_three_img">
                                            <a href="products-buy.html"><img src="__IMG__/Pro1.jpg" /></a>
                                    </div>
                                    <div class="content_three_info">
                                            <h4 class="name ">眼球模型</h4>
                                            <p class="activeList">
                                                    <span class="price">￥68 </span>
                                                    <a style="margin-left: 70px;font-size: 13px;" href="">点击购买</a>
                                            </p>
                                    </div>
                            </div>
                            <div class="content_three_wrap">
                                    <div class="content_three_img">
                                            <a href="products-buy.html"><img src="__IMG__/Pro1.jpg" /></a>
                                    </div>
                                    <div class="content_three_info">
                                            <h4 class="name ">眼球模型</h4>
                                            <p class="activeList">
                                                    <span class="price">￥68 </span>
                                                    <a style="margin-left: 65px;font-size: 13px;" href="">点击购买</a>
                                            </p>
                                    </div>
                            </div>-->
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
    <script type="text/javascript">
        //点击活动详情  全部评论
        $(".view-ul").click(function() {
            $(".active_info").css("display", "block");
            $(".active_comment").css("display", "none");
            $(".view-ul").css("background-color", "#FF4134");
            $(".view-ul").css("color", "white");
            $(".all-comment").css("background-color", "#F9F9F9");
            $(".all-comment").css("color", "black");
        });
        $(".all-comment").click(function() {
            $(".active_info").css("display", "none");
            $(".active_comment").css("display", "block");
            $(".all-comment").css("background-color", "#FF4134");
            $(".all-comment").css("color", "white");
            $(".view-ul").css("background-color", "#F9F9F9");
            $(".view-ul").css("color", "black");
        });
        $(".entered").click(function(check) {
            var time = $("input[type='radio']:checked").val();
            if (time == undefined) {
                alert('请选择时间')
                return false;
            }

        })
    </script>

</html>