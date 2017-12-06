<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"D:\chuangzhixing\wanwan/application/admin\view\index\index.html";i:1512539389;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\header.html";i:1510821022;s:63:"D:\chuangzhixing\wanwan/application/admin\view\public\left.html";i:1512089528;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\footer.html";i:1512089528;}*/ ?>
<head>
	<title>玩翫碗后台管理</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="__ACSS__/bootstrap.min.css" />

<link rel="stylesheet" href="__ACSS__/bootstrap-responsive.min.css" />

<link rel="stylesheet" href="__ACSS__/colorpicker.css" />

<link rel="stylesheet" href="__ACSS__/datepicker.css" />

<link rel="stylesheet" href="__ACSS__/uniform.css" />

<link rel="stylesheet" href="__ACSS__/select2.css" />

<link rel="stylesheet" href="__ACSS__/matrix-style.css" />

<link rel="stylesheet" href="__ACSS__/matrix-media.css" />

<link rel="stylesheet" href="__ACSS__/modal_box.css" />

<link rel="stylesheet" href="__ACSS__/bootstrap-wysihtml5.css" />

<link href="__FONT-AWESOME__/font-awesome.css" rel="stylesheet">

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="__ACSS__/jquery-calendar.css"/>
	
	
</head>
<div id="header">
	<h1></h1>
</div>
<div id="user-nav" class="navbar navbar-inverse" style="margin-left: 60%;">
	<ul class="nav" style="width: auto; margin: 0px;">
		<li class="dropdown" id="profile-messages">
			<a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span class="text">欢迎<?php echo \think\Session::get('adminInfo.name'); ?>！</span><b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li>
					<a href="#"><i class="icon-user"></i> 个人信息</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="#"><i class="icon-check"></i> 修改密码</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?php echo url('admin/admin/login'); ?>"><i class="icon-key"></i> 退出登录</a>
				</li>
			</ul>
		</li>
		<li class="">
			<a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a>
		</li>
		<li class="">
			<a title="" href="<?php echo url('admin/admin/login'); ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a>
		</li>
	</ul>
</div> <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul style="display: block;">
    <li class="active" id="index"><a href="<?php echo url('admin/index/index'); ?>"><i class="icon icon-home"></i> <span>首页</span></a></li>
    <li class="submenu"> <a href="#" class="first_li"><i class="icon-user"></i> <span>客户中心</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="<?php echo url('admin/user/index'); ?>">客户列表</a></li>
        <li><a href="<?php echo url('admin/user/attendance'); ?>">签到概况</a></li>
        <li><a href="<?php echo url('admin/user/recharge_record'); ?>">充值记录</a></li>
        <li><a href="<?php echo url('admin/user/deal'); ?>">成单记录</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#" class="first_li"><i class="icon icon-file"></i> <span>活动中心</span> <span class="label label-important">7</span></a>
      <ul>
        <li><a href="<?php echo url('admin/activity/index'); ?>">活动列表</a></li>
        <li><a href="<?php echo url('admin/activity/specification'); ?>">活动安排</a></li>
        <li><a href="<?php echo url('admin/activity/activity_type'); ?>">活动分类</a></li>
        <li><a href="<?php echo url('admin/activity/extension'); ?>">活动扩展</a></li>
        <li><a href="<?php echo url('admin/activity/activity_ask'); ?>">活动提问</a></li>
        <li><a href="<?php echo url('admin/activity/activity_comment'); ?>">评论列表</a></li>
        <li><a href="<?php echo url('admin/activity/leave_for'); ?>">请假列表</a></li>
      </ul>
    </li>

    <li class="submenu"> 
        <a href="#" class="first_li"><i class="icon icon-inbox"></i>
            <span>订单中心</span>
            <span class="label label-important">2</span>
        </a>
    		<ul style="display: none;">
        <li><a href="<?php echo url('admin/activity/order'); ?>">订单列表</a></li>
        <li><a href="<?php echo url('admin/activity/refund'); ?>">退款列表</a></li>
       </ul>
   </li>
      <li class="submenu">
          <a href="#" class="first_li"><i class="icon-headphones"></i>
              <span>客服中心</span>
              <span class="label label-important">1</span>
          </a>
          <ul style="display: none;">
              <li><a href="<?php echo url('admin/service/index'); ?>">报名情况</a></li>
          </ul>
      </li>
  <li class="submenu">
      <a href="#" class="first_li"><i class="icon-bell"></i>
          <span>权限中心</span>
          <span class="label label-important">2</span>
      </a>
      <ul style="display: none;">
          <li><a href="<?php echo url('admin/admin/index'); ?>">管理员管理</a></li>
          <li><a href="<?php echo url('admin/admin/role'); ?>">角色列表</a></li>
      </ul>
  </li>
  <li class="submenu">
      <a href="#" class="first_li"><i class="icon-align-left"></i>
          <span>统计中心</span>
          <span class="label label-important">1</span>
      </a>
      <ul style="display: none;">
          <li><a href="<?php echo url('admin/Statistical/source'); ?>">来源统计</a></li>
          <!--<li><a href="<?php echo url('admin/activity/order'); ?>">会员到场率</a></li>-->
          <!--<li><a href="<?php echo url('admin/activity/refund'); ?>">会员增长率</a></li>-->
          <!--<li><a href="<?php echo url('admin/activity/refund'); ?>">活动排名</a></li>-->
      </ul>
  </li>
  </ul>
</div>
<div id="content" style="background:#F6F6F6;height: 726px;">
	<!--breadcrumbs-->
	<div id="content-header">
		<div id="breadcrumb">
			<a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a>
		</div>
	</div>
	<!--<div class="row-fluid">
       <div class="span6">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $result['user_num']; ?></strong> <small>用户</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong><?php echo $result['member_num']; ?></strong> <small>会员 </small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong><?php echo $result['activity_order_num']; ?></strong> <small>订单</small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong><?php echo $result['activity_num']; ?></strong> <small>活动</small></li>
              </ul>
       

    </div>
    </div>-->

	<div class="ul_classify">
		<ul class="first">
			<li>用&nbsp;户<span></span></li>
			<li>会&nbsp;员<span style="display: none;"></span></li>
			<li>收&nbsp;入<span style="display: none;"></span></li>
			<li>消&nbsp;费<span style="display: none;"></span></li>
			<li class="sign">签&nbsp;到</span></li>
		</ul>
		<ul id="signSelect" style="display: none;">
			<li><a href="<?php echo url('admin/user/mobile_sign'); ?>">手机号签到</a></li>
			<li><a href="<?php echo url('admin/user/sign'); ?>">二维码签到</a></li>
		</ul>
	</div>
	<div class="classify_contents">
		<!--用户-->
		<div>
			<ul>
				<li>
					<p>总用户</p>
					<p><?php echo $result['user_num']; ?></p>
				</li>
				<li>
					<p>当月新增用户</p>
					<p><?php echo $result['month_user']; ?></p>
				</li>
				<li>
					<p>当周新增用户</p>
					<p><?php echo $result['week_user']; ?></p>
				</li>
			</ul>
			<div class="apply_details">
				<div class="detail_table">
					<div class="title">报名人数</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>

							<td><?php echo $result['last_week_order']; ?></td>
							<td><?php echo $result['week_order']; ?></td>
						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">成交金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_order_price']; ?></td>
							<?php endif; if($result['week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_order_price']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">充值金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_recharge']; ?></td>
							<?php endif; if($result['week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_recharge']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>
			</div>
		</div>
		<!--会员-->
		<div style="display:none;">
			<ul>
				<li>
					<p>总会员</p>
					<p><?php echo $result['member_num']; ?></p>
				</li>
				<li>
					<p>当月新增会员</p>
					<p><?php echo $result['month_member']; ?></p>
				</li>
				<li>
					<p>当周新增会员</p>
					<p><?php echo $result['week_member']; ?></p>
				</li>
			</ul>
			<div class="apply_details">
				<div class="detail_table">
					<div class="title">报名人数</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>

							<td><?php echo $result['last_week_order']; ?></td>
							<td><?php echo $result['week_order']; ?></td>
						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">成交金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_order_price']; ?></td>
							<?php endif; if($result['week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_order_price']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">充值金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_recharge']; ?></td>
							<?php endif; if($result['week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_recharge']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>
			</div>
		</div>
		<!--活动-->
		<!--<div style="display: none;">
    	 	   	   <ul>
    	 	   	   	   <li>
    	 	   	   	   	   <p>本月消费</p>
    	 	   	   	   	   <p>1860</p>
    	 	   	   	   </li>
    	 	   	   	   <li>
    	 	   	   	   	   <p>本周消费</p>
    	 	   	   	   	   <p>862</p>
    	 	   	   	   </li>
    	 	   	   	   <li>
    	 	   	   	   	   <p>当日消费</p>
    	 	   	   	   	   <p>86</p>
    	 	   	   	   </li>
    	 	   	   </ul>
    	 	   </div>-->
		<!--收入-->
		<div style="display: none;">
			<ul>
				<li>
					<p>本月收入</p>
					<p>1860</p>
				</li>
				<li>
					<p>本周收入</p>
					<p>862</p>
				</li>
				<li>
					<p>本日收入</p>
					<p>86</p>
				</li>
			</ul>
			<div class="apply_details">
				<div class="detail_table">
					<div class="title">报名人数</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>

							<td><?php echo $result['last_week_order']; ?></td>
							<td><?php echo $result['week_order']; ?></td>
						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">成交金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_order_price']; ?></td>
							<?php endif; if($result['week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_order_price']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">充值金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_recharge']; ?></td>
							<?php endif; if($result['week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_recharge']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>
			</div>
		</div>
		<!--消费-->
		<div style="display: none;">
			<ul>
				<li>
					<p>本月消费</p>
					<p>1860</p>
				</li>
				<li>
					<p>本周消费</p>
					<p>862</p>
				</li>
				<li>
					<p>当日消费</p>
					<p>86</p>
				</li>
				<li>
					<p>复购率</p>
					<p>20%</p>
				</li>
			</ul>
			<div class="apply_details">
				<div class="detail_table">
					<div class="title">报名人数</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>

							<td><?php echo $result['last_week_order']; ?></td>
							<td><?php echo $result['week_order']; ?></td>
						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">成交金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_order_price']; ?></td>
							<?php endif; if($result['week_order_price'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_order_price']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>

				<div class="detail_table">
					<div class="title">充值金额</div>
					<table style="width: 687px;height:80px;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">

						<tr>
							<td>上周</td>
							<td>本周</td>
						</tr>
						<tr>
							<?php if($result['last_week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['last_week_recharge']; ?></td>
							<?php endif; if($result['week_recharge'] == null): ?>
							<td>0</td>
							<?php else: ?>
							<td><?php echo $result['week_recharge']; ?></td>
							<?php endif; ?>

						</tr>

					</table>
				</div>
			</div>
		</div>
	</div>
	<!--<div class="row-fluid" style="position:absolute;bottom: 0px;">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in/">Themedesigner.in</a> </div>
</div>-->
<script src="__AJS__/jquery.min.js"></script> 
<script src="__AJS__/jquery.ui.custom.js"></script> 
<script src="__AJS__/bootstrap.min.js"></script> 
<script src="__AJS__/jquery.uniform.js"></script> 
<script src="__AJS__/select2.min.js"></script> 
<script src="__AJS__/jquery.dataTables.min.js"></script> 
<script src="__AJS__/matrix.js"></script> 
<script src="__AJS__/matrix.tables.js"></script>
<script src="__AJS__/operat_table.js"></script>
<script src="__AJS__/Calendar.js"></script>
</div>

