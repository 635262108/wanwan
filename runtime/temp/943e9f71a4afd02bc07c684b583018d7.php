<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\chuangzhixing\wanwan/application/admin\view\user\add_member.html";i:1512351356;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\header.html";i:1510821022;s:63:"D:\chuangzhixing\wanwan/application/admin\view\public\left.html";i:1512089528;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\footer.html";i:1512089528;}*/ ?>
<!DOCTYPE html>
<html lang="en">

	<head>
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
</div> 
		<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
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
		<div id="content" style="">
			<div id="content-header">
				<div id="breadcrumb">
					<a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i>首页</a>
					<a href="<?php echo url('admin/user/index'); ?>" class="tip-bottom" data-original-title="">客户中心</a>
					<a href="#" class="current">添加会员</a>
				</div>
			</div>

			<div class="row-fluid" id="emit_information" style="width: 1300px;">
				<div class="span6" style="margin-left: 12%;">
					<div class="widget-box" style="width: 100%;">
						<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
							<h5>客户信息</h5>
						</div>
						<div class="widget-content nopadding" style="">
							<form action="<?php echo url('admin/user/add_member'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" name="Alist_form" style="m-horizontal">
								<div class="control-group">
									<label class="control-label">昵称</label>
									<div class="controls">
										<input class="span11" value='' name="nickname" type="text" style="width: 32%;">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">手机号</label>
									<div class="controls">
										<input class="span11" style="width: 30%;" value='' name="mobile" type="text">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">生日</label>
									<div class="controls">
										<input type="text" value="" name="birthday" placeholder="2017-09-07" onClick="new Calendar().show(this);" class="span11" name="birthday" style="width: 25%;margin-top: -3px;cursor: pointer;">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">密码</label>
									<div class="controls">
										<input class="span11" style="width: 30%;" value='' name="password" type="password">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">性别</label>
									<div class="controls">
										<input type="radio" name="sex" value="1" checked="checked">男
										<input type="radio" name="sex" value="2" style="margin-left: 5px;">女

									</div>
								</div>
								<div class="select_address" style="display: flex;justify-content: flex-start;padding-left: 145px;">
									<div class="control-group">
										<label class="control-label" style="width: auto;margin-right: 10px;">所在省</label>
										<div class="controls" style="margin-left: 0px;width: 155px;">
											<select name="province" onChange="seachcitys($(this).val())" style="width:89px;">
												<option value="0">请选择...</option>
												<?php if(is_array($provinces) || $provinces instanceof \think\Collection || $provinces instanceof \think\Paginator): if( count($provinces)==0 ) : echo "" ;else: foreach($provinces as $key=>$vo): ?>
												<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" style="width: auto;margin-right: 10px;">所在市</label>
										<div class="controls" style="margin-left: 0px;width: 155px;">
											<select name="city" id="seachcity" onChange="seachdistricts($(this).val())" style="width:89px;">
												<option value="0">请选择...</option>
											</select>

										</div>
									</div>
									<div class="control-group">
										<label class="control-label" style="width: auto;margin-right: 10px;">所在区</label>
										<div class="controls" style="margin-left: 0px;width: 155px;">
											<select name="district" id="seachdistrict" style="width:89px;">
												<option value="0">请选择...</option>
											</select>

										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">详细地址</label>
									<div class="controls">
										<textarea class="span11" style="width: 40%;" value='' name="address"></textarea>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">开卡金额</label>
									<div class="controls">
										<input type="text" value="0" class="span11 pay_price" name="balance" style="width: 30%;">
									</div>
								</div>

							<div class="payNum_contents" style="display: none;">
									<div class="control-group">
										<label class="control-label">支付方式</label>
										<div class="controls">
											<select name="pay_way">
												<option value="0" selected="selected">不充值</option>
												<option value="1">支付宝</option>
												<option value="2">微信</option>
												<option value="3">现金</option>
											</select>
										</div>
									</div>
								<div class="control-group">
									<label class="control-label">充值时间</label>
									<div class="controls">
										<input type="text" value="" name="pay_time" placeholder="2017-09-07" onClick="new Calendar().show(this);" class="span11" name="birthday" style="width: 25%;margin-top: -3px;cursor: pointer;">
									</div>
								</div>
									<div class="control-group">
									<label class="control-label">赠品</label>
									<div class="controls">
										<textarea name="giveaway"></textarea>
									</div>
									</div>
									<div class="control-group">
										<label class="control-label">是否领取</label>
										<div class="controls">
											<input type="radio" name="is_get" value="0">是
											<input type="radio" name="is_get" value="1">否
										</div>
									</div>
										
								<div class="control-group">
									<label class="control-label">充值备注</label>
									<div class="controls">
										<textarea name="remark"></textarea>
									</div>
								</div>
							</div>
							
								
								
								<div class="control-group">
									<label class="control-label">报名来源</label>
									<div class="controls">
										<select name="source">
											<?php if(is_array($source) || $source instanceof \think\Collection || $source instanceof \think\Paginator): if( count($source)==0 ) : echo "" ;else: foreach($source as $key=>$vo): ?>
											<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">孩子数量</label>
									<div class="controls">
										<select class="select_num">
											<option selected="selected">暂不选择</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
									</div>
								</div>

								<div class="children_information">
									
								</div>

								<div class="form-actions">
									<button type="submit" class="btn btn-success info_sure">保存</button>
									<a href="<?php echo url('admin/user/index'); ?>" class="btn-warning">取消</a>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		</body>
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

</html>