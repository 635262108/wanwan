<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"D:\chuangzhixing\wanwan/application/home\view\user\index.html";i:1508318472;s:69:"D:\chuangzhixing\wanwan/application/home\view\public\user_header.html";i:1508318472;s:67:"D:\chuangzhixing\wanwan/application/home\view\public\user_left.html";i:1508318472;}*/ ?>

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
<div class="userRight1">
    <!--个人信息-->
    <div class="user_info">
        <!--<img src="__IMG__/buy.jpg"/>-->
        <div class="user_face_left">
            <div class="user_face_img">
                <?php if($userInfo['headIcon'] == ''): ?>
                <img src="/public/static/img/wan.jpg" />
                <?php else: ?>
                <img src="__HEADICON__/<?php echo session('userInfo.headIcon'); ?>" />
                <?php endif; ?>
            </div>
            <div class="user_info-1" style="position: absolute;left: 200px;">
                <p class="user_name"><?php echo $userInfo['nickname']; ?></p>
                <span style="font-size: 12px;"><?php echo $userInfo['signature']; ?></span>
            </div>
        </div>
        <div class="user_face_right">
            <img src="__IMG__/my-bg.png" />
        </div>
    </div>
    <!--下部-->
    <!--<div class="user_pro_list">
            <div class="user_pro">
                    <div class="user_ac_text">
                            <p class="user_ac_p">最新参加的活动</p>
                            <a href="" class="user_ac_a">详细</a>
                    </div>
                    <div class="my_new_activity m_ac">
                            <div class="my_activity_img">
                                    <img src="__IMG__/banner1.png" width="170px" />
                            </div>
                            <div class="ac_name" style="">
                                    <div class="ac_settle_name">探索眼睛的秘密</div>
                                    <div class="ac_settle_Time">时间：2017/03/26 - 2017/03/26</div>
                            </div>
                    </div>
            </div>
            <div class="user_pro">
                    <div class="user_ac_text">
                            <p class="user_ac_p">未支付的活动</p>
                            <a href="" class="user_ac_a">详细</a>
                    </div>
                    <div class="my_new_activity m_ac">
                            <div class="my_activity_img">
                                    <img src="__IMG__/banner1.png" width="170px" />
                            </div>
                            <div class="ac_name" style="">
                                    <div class="ac_settle_name">探索眼睛的秘密</div>
                                    <div class="ac_settle_Time">时间：2017/03/26 - 2017/03/26</div>
                            </div>
                    </div>
            </div>
            <div class="user_pro">
                    <div class="user_ac_text">
                            <p class="user_ac_p">已报名的活动</p>
                            <a href="" class="user_ac_a">详细</a>
                    </div>
                    <div class="my_new_activity m_ac">
                            <div class="my_activity_img">
                                    <img src="__IMG__/banner1.png" width="170px" />
                            </div>
                            <div class="ac_name" style="">
                                    <div class="ac_settle_name">探索眼睛的秘密</div>
                                    <div class="ac_settle_Time">时间：2017/03/26 - 2017/03/26</div>
                            </div>
                    </div>
            </div>
            <div class="user_pro">
                    <div class="user_ac_text">
                            <p class="user_ac_p">待评价的活动</p>
                            <a href="" class="user_ac_a">详细</a>
                    </div>
                    <div class="my_new_activity m_ac">
                            <div class="my_activity_img">
                                    <img src="__IMG__/banner1.png" width="170px" />
                            </div>
                            <div class="ac_name" style="">
                                    <div class="ac_settle_name">探索眼睛的秘密</div>
                                    <div class="ac_settle_Time">时间：2017/03/26 - 2017/03/26</div>
                            </div>
                    </div>
            </div>
    </div>-->
    <!--猜你喜欢-->
    <div class="favoriteList">
        <p class="favoriteList1"><img style="width: 35px;height: 35px;vertical-align: middle;" src="__IMG__/like.png" />猜你喜欢</p>
        <ul class="activeFList activeFList1">
            <?php foreach($like as $vo): ?>
            <li>
                <div>
                    <a href="<?php echo url('home/Activity/detail',['aid'=>$vo['aid']]); ?>"><img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>" title="" /></a>
                </div>
                <h4><a href="<?php echo url('home/Activity/detail',['aid'=>$vo['aid']]); ?>" title = ""><?php echo $vo['a_title']; ?> ...</a></h4>
                <p class="activeFList-2 fav_height" style="top:30px;"><?php echo $vo['a_price']; ?><i class="col7 f">已报名<?php echo $vo['a_sold_num']; ?>人</i></p>
            </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>
</div>

</body>

</html>