<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"D:\chuangzhixing\wanwan/application/home\view\user\my_message.html";i:1508318472;s:69:"D:\chuangzhixing\wanwan/application/home\view\public\user_header.html";i:1508318472;s:67:"D:\chuangzhixing\wanwan/application/home\view\public\user_left.html";i:1508318472;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
		<link rel="stylesheet" type="text/css" href="__CSS__/user.css" />
                <link rel="stylesheet" type="text/css" href="__CSS__/cart.css" />
		<title></title>
	</head>
	<body>
		<!--顶部-->
		<div class="personal_top">
			<div class="per_top_center">
				<div class="per_logo">
                                    <a href="<?php echo url('home/index/index'); ?>"><img src="__IMG__/logo_w.png" /></a>
				</div>
				<div class="per_right">
					<ul class="top_right">
						<li>
							<a href="<?php echo url('home/Index/index'); ?>"><img src="__IMG__/icon-home.png" /> 首页</a>
						</li>
						|
						<li id="topUserName">
                                                    
							<a href="<?php echo url('home/User/index'); ?>">
                                                            <?php if(session('userInfo.headIcon') == ''): ?>
                                                                <img id="topUserImg" src="/public/static/img/wan.jpg" />
                                                            <?php else: ?>
                                                            <img id="topUserImg" src="__HEADICON__/<?php echo session('userInfo.headIcon'); ?>" />
                                                            <?php endif; ?>
                                                                <?php echo session('userInfo.nickname'); ?>
							</a>
						</li>
						|
						<li>
							<a href="<?php echo url('home/User/myfavorite'); ?>">收藏 </a>
						</li>
						|
						<li>
							<a href="<?php echo url('home/User/my_message'); ?>">
                                                            消息 <span id="message" style="font-weight: bold;color: #f00;">
                                                                <?php echo session('messageCount')?"(".session('messageCount').")":''; ?>
                                                            </span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--个人中心导航-->
		<div class="personal_nav">
			<ul class="per_ul">
				<li>
					<a style='font-size: 16px;' href="<?php echo url('home/User/index'); ?>" class="personal"><img src="__IMG__/user.png" />个人中心</a>
					<?php if(request()->action() == 'index'): ?>
                                        <img class="tri" src="__IMG__/triangle.png" />
                                        <?php endif; ?>
				</li>
				<li>

					<a style='font-size: 16px;' href="<?php echo url('home/User/my_info'); ?>" class="shezhi"><img src="__IMG__/shezhi.png" />账号设置</a>
                                        <?php if(request()->action() == 'my_info'): ?>
                                        <img class="tri" src="__IMG__/triangle.png" />
                                        <?php endif; ?>
				</li>
			</ul>
		</div>
                <script type="text/javascript">
                    var getting = {	
                    url:"<?php echo url('home/User/messageCount'); ?>",
                    dataType:'json',
                    success:function(res) {
                            if(res.data > 0){
                                $("#message").html("("+res.data+")");
                            }   
                        }
                    };
                    window.setInterval(function(){$.ajax(getting)},parseInt(120) * 1000);
                </script>
<!--左侧列表-->
		<div class="userBig">
			<div class="userLeft">
				<!--<div class="userLName">全部功能</div>-->
				<ul class="userLeftNav">
                                    <li>
						<a <?php if(request()->action() == 'index'): ?>style=color:#FF4134;text-decoration:underline<?php endif; ?> href="<?php echo url('home/User/index'); ?>">我的主页</a>
					</li>
					<li>
						<a <?php if(request()->action() == 'my_activity'): ?>style=color:#FF4134;text-decoration:underline<?php endif; ?> href="<?php echo url('home/User/my_activity'); ?>">我的活动</a>
					</li>
					<li>
						<a <?php if(request()->action() == 'myfavorite'): ?>style=color:#FF4134;text-decoration:underline<?php endif; ?> href="<?php echo url('home/User/myfavorite'); ?>">我的收藏</a>
					</li>
					<li>
						<a <?php if(request()->action() == 'my_message'): ?>style=color:#FF4134;text-decoration:underline<?php endif; ?> href="<?php echo url('home/User/my_message'); ?>">我的消息</a>
					</li>
				</ul>
			</div>
                    <script src="__JS__/jquery-2.2.4.min.js" type="text/javascript" charset="utf-8"></script>

               
<!--右侧-->
<div class="userRight">
    <ul class="userRightNav">
        <li class="active_userRight navBuyMessage">订单消息</li>
        <li class="navTalkMessage">系统消息</li>
    </ul>
    <!--订单消息-->				
    <ul class="buyMessage">
        <?php if(empty($orderMessage) || (($orderMessage instanceof \think\Collection || $orderMessage instanceof \think\Paginator ) && $orderMessage->isEmpty())): ?>
            <p style="line-height: 200px;margin-left:35%;">暂无订单消息</p>
        <?php else: if(is_array($orderMessage) || $orderMessage instanceof \think\Collection || $orderMessage instanceof \think\Paginator): if( count($orderMessage)==0 ) : echo "" ;else: foreach($orderMessage as $key=>$vo): ?>
        <li style="list-style: none;">
            <div class="z myMessage-img"><img src="__IMG__/de1.png" ></div>
            <div class="myMessage">
                <span><?php echo date('Y-m-d H:i:s',$vo['send_time']); ?></span>
                <p><?php echo $vo['content']; ?></p>
            </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </ul>
    <!--互动消息-->
    <ul class="talkMessage" style="display: none;">
        <?php if(empty($systemMessage) || (($systemMessage instanceof \think\Collection || $systemMessage instanceof \think\Paginator ) && $systemMessage->isEmpty())): ?>
            <p style="line-height: 200px;">暂无系统消息</p>
        <?php else: if(is_array($systemMessage) || $systemMessage instanceof \think\Collection || $systemMessage instanceof \think\Paginator): if( count($systemMessage)==0 ) : echo "" ;else: foreach($systemMessage as $key=>$vo): ?>
        <li style="list-style: none;">
            <div class="z myMessage-img"><img src="__IMG__/de1.png" ></div>
            <div class="myMessage">
                <span><?php echo date('Y-m-d H:i:s',$vo['send_time']); ?></span>
                <p><?php echo $vo['content']; ?> </p>
            </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </ul>

</div>
</div>
<script src="__JS__/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(".userRightNav li").click(function() {
        $(this).addClass("active_userRight").siblings().removeClass("active_userRight");
    });
    $(".deleteCollect").click(function() {
        $(this).parent().parent().parent().remove();
    })
    $(".navTalkMessage").click(function() {
        $(".buyMessage").css("display", "none");
        $(".talkMessage").css("display", "block");
    });
    $(".navBuyMessage").click(function() {
        $(".buyMessage").css("display", "block");
        $(".talkMessage").css("display", "none");
    })
</script>
</body>
</html>