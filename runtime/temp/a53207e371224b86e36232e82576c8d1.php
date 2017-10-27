<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"/var/www/html/wanwan/application/home/view/activity/detail.html";i:1506069047;s:61:"/var/www/html/wanwan/application/home/view/public/header.html";i:1508914023;s:61:"/var/www/html/wanwan/application/home/view/public/footer.html";i:1505556820;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="__CSS__/detail.css"/>
<div class="content">
    <!--介绍-->
    <div class="detail_banner">
        <div class="detail_banner_img">
            <img src="__AdminIMG__/<?php echo $activityInfo['a_img']; ?>" />
        </div>
        <div class="detail_article">
            <ul class="detail_article_ul">
                <?php if(is_array($extensionInfo) || $extensionInfo instanceof \think\Collection || $extensionInfo instanceof \think\Paginator): if( count($extensionInfo)==0 ) : echo "" ;else: foreach($extensionInfo as $key=>$vo): ?>
                <li>
                    <div class="topic_pic">
                        <a href="javascript:;" onclick="openDetail(<?php echo $vo['extension_id']; ?>)">
                            <img src="__AdminIMG__/<?php echo $vo['extension_img']; ?>" />
                        </a>
                    </div>
                    <div class="topic_txt">
                        <a href="javascript:;" onclick="openDetail(<?php echo $vo['extension_id']; ?>)">
                            <h5><?php echo $vo['extension_title']; ?></h5>
                            <p><?php echo $vo['extension_remark']; ?></p>
                        </a>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>	
            </ul>

        </div>
    </div>
    <!--购买-->
    <div class="buy_con" style="overflow: hidden;margin-bottom: 20px;">
        <div class="buy_info">
            <img src="__IMG__/de2.png" />
            <div class="buy_name">
                <span style="font-weight: 700;">玩翫</span>信息
            </div>
            <form action="<?php echo url('home/Activity/activity_sure'); ?>" method="get">
                <div class="buy_name_info">
                    <input type="hidden" name="aid" value="<?php echo $activityInfo['aid']; ?>" />
                    <p><span style="color: #FF4134;">活动时间：</span><?php echo date('Y年m月d日',$activityInfo['a_begin_time']); ?>-<?php echo date('m月d日',$activityInfo['a_end_time']); ?></p>
                    <p style="margin-top: 10px;"><span style="color: #FF4134;">活动地点：</span><?php echo $activityInfo['a_address']; ?></p>
                    <div class="number" style="margin-top: 10px;">
                        <span style="color: #FF4134;float: left;">人员数量：</span>
                        <span style="float: left;">大人：￥<span id="adult"><?php echo $activityInfo['a_adult_price']; ?></span> </span>
                        <div class="lab" style="margin-top: -3px;">
                            <input id="num-1" class="p-f-text dB_number_s" type="text" name="adult_num" value="1" maxlength="6" />
                            <div class="button">
                                <a id="up-1" class="up changeadd" href="javascript:;"></a>
                                <a id="down-1" class="down changeredu" href="javascript:;"></a>
                            </div>
                        </div>

                        <span style="float: left;margin:10px 0 0 80px;">孩子：￥<span id="child"><?php echo $activityInfo['a_child_price']; ?></span></span>
                        <div class="lab" style="margin-top: 5px;">
                            <input id="num-2" class="p-f-text dB_number_s" name="child_num" type="text" value="1" maxlength="6" />
                            <div class="button">
                                <a id="up-2" class="up changeadd" href="javascript:;"></a>
                                <a id="down-2" class="down changeredu" href="javascript:;"></a>
                            </div>
                        </div>
                    </div>
                    <div class="activeList">
                        <p class="price">￥<span id="Buy_price">30</span> </p>
                        <input class="entered" style="border-radius: 5px;border:none;" value="我要玩" type="submit" >
                    </div>
            </form>
            <div class="share">
                <?php if(empty($isCollection) || (($isCollection instanceof \think\Collection || $isCollection instanceof \think\Paginator ) && $isCollection->isEmpty())): ?>
                <a href="javascript:void(0)"><img id="scButton" src="__IMG__/icon-sc.png" /><span>收藏</span></a>
                <?php else: ?>
                <a href="javascript:void(0)"><img id="scButton" src="__IMG__/icon-sc2.png" /><span>收藏</span></a>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!--评论-->
    <div class="relate_right">
        <ul class="activity_ul" style="margin:20px 0;">
            <li class="view-ul"><span style="font-weight: 700;">玩伴</span>评论</li>
            <!--						<li class="all-comment"><span style="font-weight: 700;">相关</span>玩翫</li>-->
            <li class="all-question"><span style="font-weight: 700;">玩翫</span>答疑</li>
        </ul>
        <!--评论-->
        <div class="active_comment">
            <h3 style="margin: 20px 0;">全部评价</h3>
            <ul style="overflow-y:scroll;height:270px;">
                <?php if(empty($commentInfo) || (($commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator ) && $commentInfo->isEmpty())): ?>
                <p style="text-align: center;line-height: 200px;">暂无评论......</p>
                <?php else: if(is_array($commentInfo) || $commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator): if( count($commentInfo)==0 ) : echo "" ;else: foreach($commentInfo as $key=>$vo): ?>
                <li class="common_list_li">
                    <div class="userAttar_Img">
                        <?php if($vo['headIcon'] == ''): ?>
                        <img src="__IMG__/wan.jpg" />
                        <?php else: ?>
                        <img src="__HEADICON__/<?php echo $vo['headIcon']; ?>" />
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
                            <?php echo htmlentities($vo['content']); ?>
                        </div>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
        </div>

        <!--相关玩具-->
        <!--					<div class="relate_toy">
                                                        精品推荐
                                                        <h3>精品推荐</h3>
                                                        <?php if(is_array($recommendInfo) || $recommendInfo instanceof \think\Collection || $recommendInfo instanceof \think\Paginator): if( count($recommendInfo)==0 ) : echo "" ;else: foreach($recommendInfo as $key=>$vo): ?>
                                                        <div class="content_three_wrap">
                                                                <div class="content_three_img">
                                                                        <a href="products-buy.html"><img src="<?php echo $vo['a_index_img']; ?>" /></a>
                                                                </div>
                                                                <div class="content_three_info">
                                                                        <h4 class="name "><?php echo $vo['a_title']; ?></h4>
                                                                        <p class="activeList-2">
                                                                                <span class="price">￥<?php echo $vo['a_price']; ?> </span>
                                                                                <a style="margin-left: 45px;font-size: 13px;" href="">点击购买</a>
                                                                        </p>
                                                                </div>
                                                        </div>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                        相关翫具
                                                        <h3>相关翫具</h3>
                                                        <?php if(is_array($goodsInfo) || $goodsInfo instanceof \think\Collection || $goodsInfo instanceof \think\Paginator): if( count($goodsInfo)==0 ) : echo "" ;else: foreach($goodsInfo as $key=>$vo): ?>
                                                        <div class="content_three_wrap">
                                                                <div class="content_three_img">
                                                                        <a href="products-buy.html"><img src="<?php echo $vo['g_img']; ?>" /></a>
                                                                </div>
                                                                <div class="content_three_info">
                                                                        <h4 class="name "><?php echo $vo['g_title']; ?></h4>
                                                                        <p class="activeList-2">
                                                                                <span class="price">￥<?php echo $vo['g_price']; ?> </span>
                                                                                <a style="margin-left: 45px;font-size: 13px;" href="">点击购买</a>
                                                                        </p>
                                                                </div>
                                                        </div>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </div>-->

        <!--答疑-->
        <div class="active_question">
            <h3 style="margin: 20px 0;">我有疑问</h3>
            <ul style="overflow-y:scroll;height:270px;">
                <?php if(empty($question) || (($question instanceof \think\Collection || $question instanceof \think\Paginator ) && $question->isEmpty())): ?>
                    <p style="text-align: center;line-height: 200px;">暂无疑问......</p>
                <?php else: foreach($question as $vo): ?> 
                <li class="common_list_li">
                    <div class="userAttar_Img">
                        <img src="__HEADICON__/<?php echo $vo['headIcon']; ?>" />
                    </div>
                    <div class="conment_info">
                        <div class="user_name" style="color: gray;">
                            <?php echo $vo['nickname']; ?>
                        </div>
                        <div class="act_commoDate" style="color:#b7b7bd;font-size: 0.8em;">
                            <?php echo date('Y-m-d',$vo['time']); ?>
                        </div>
                        <div class="act_common_content">
                            <?php echo $vo['content']; ?>
                        </div>
                    </div>
                </li>
                <?php foreach($answer as $val): if($vo['comment_id'] == $val['reply_id']): ?> 
                <li class="act_reply_content" style="">
                    <div class="reply_userImg">
                        <img src="__HEADICON__/<?php echo $val['headIcon']; ?>" />
                    </div>
                    <div class="reply_info">
                        <div class="reply_name" style="color: gray;">
                            <?php echo $val['nickname']; ?>
                        </div>
                        <div class="act_replyDate" style="color:#b7b7bd;font-size: 0.8em;">
                            <?php echo date('Y-m-d',$val['time']); ?>
                        </div>
                        <div class="act_reply_content">
                            <?php echo $val['content']; ?>
                        </div>
                    </div>

                </li>
                <?php endif; endforeach; endforeach; endif; ?>
            </ul>
            <div class="question_form" style="margin-bottom: 20px;">
                <div class="share_header" style="margin-bottom: 10px;">
                    <span>我有疑问</span>
                </div>
                <form action="" method="post">
                    <textarea name="message" id="message" rows="5" cols="" style="width: 560px;resize: none;"></textarea>

                </form>
                <div class="share_submit">
                    <button id="ques_button">确定提问</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--弹出框-->
<?php if(is_array($extensionInfo) || $extensionInfo instanceof \think\Collection || $extensionInfo instanceof \think\Paginator): if( count($extensionInfo)==0 ) : echo "" ;else: foreach($extensionInfo as $key=>$vo): ?>
<div id="bg<?php echo $vo['extension_id']; ?>" style="display: none;" class="bg">
    <div class="alert_div" onclick="closeDetail(<?php echo $vo['extension_id']; ?>)">
        <div class="close" id="close<?php echo $vo['extension_id']; ?>" style="border-radius: 5px;">
            <img src="__IMG__/close.png" style="border-radius: 5px;" />
        </div>
        <div class="alert_content" style="overflow-y:scroll;">
            <?php echo $vo['extension_content']; ?>

        </div>

    </div>

</div>
<?php endforeach; endif; else: echo "" ;endif; ?>

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

<script src="__JS__/jquery-2.2.4.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/main.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/detail.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>
<script>
                //点击收藏按钮
                $("#scButton").click(function(){
        var src = $(this).attr("src")
                var _this = $(this);
                if (src == '/public/static/img/icon-sc.png'){
        $.post("<?php echo url('home/activity/collection'); ?>", { aid: <?php echo $activityInfo['aid']; ?>, type:1},
                function(obj){
                if (obj.state_code != 200){
                alert(obj.msg);
                        return false;
                } else{
                $(_this).attr("src", "/public/static/img/icon-sc2.png")
                }
                }, "json");
        } else{
        $.post("<?php echo url('home/activity/collection'); ?>", { aid: <?php echo $activityInfo['aid']; ?>, type:2},
                function(obj){
                if (obj.state_code != 200){
                alert(obj.msg);
                        return false;
                } else{
                $(_this).attr("src", "/public/static/img/icon-sc.png")
                }
                }, "json");
        }
        })

                //弹出框
                        function openDetail(id){
                        $(".alert_div" + id).css("display", "block");
                                $("#bg" + id).css("display", "block");
                                $('body').css({
                        "overflow-x": "hidden",
                                "overflow-y": "hidden"
                        });
                        }

                //关闭弹窗
                function closeDetail(id){
                $("#bg" + id).css("display", "none");
                        $('body').css({
                "overflow-x": "scroll",
                        "overflow-y": "scroll"
                });
                }
                //问题
                $("#ques_button").click(function() {
                var message = $("#message").val();
                        if (message == "") {
                alert("问题不能为空哦~");
                } else {
                if (message.length < 5) {
                alert("问题长度不能少于5个字符~");
                } else {
                $.post("<?php echo url('home/activity/answer_questions'); ?>", { aid: <?php echo $activityInfo['aid']; ?>, content:message},
                        function(obj){
                        if (obj.state_code != 200){
                        alert(obj.msg);
                                return false;
                        } else{
                        $('.active_question ul').prepend('<li class="common_list_li">' +
                                '<div class="userAttar_Img">' + '<img src="' + obj.data.headIcon + '" />' + '</div>' + '<div class="conment_info">' +
                                '<div class="user_name" style="color: gray;">' + obj.data.nickname + '</div>' +
                                '<div class="act_commoDate" style="color:#b7b7bd;font-size: 0.8em;">' + showTime() + '</div>' +
                                '<div class="act_common_content">' + message + '</div>' + '</div>' + '</li>');
                        }
                        }, "json");
                }
                };
                        $("#message").val("");
                        });
</script>