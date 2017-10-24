<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\user\index.html";i:1508838671;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\header.html";i:1508309656;s:81:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\left.html";i:1508834326;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\footer.html";i:1508309656;}*/ ?>
<head>
<title>玩翫碗后台管理</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
</head>
<div id="header">
    <h1></h1>
</div>
<div id="user-nav" class="navbar navbar-inverse" style="margin-left: 60%;">
  <ul class="nav" style="width: auto; margin: 0px;">
    <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">欢迎 admin！</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> 个人信息</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="icon-check"></i> 修改密码</a></li>
        <li class="divider"></li>
        <li><a href="login.html"><i class="icon-key"></i> 退出登录</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul style="display: block;">
    <li class="active"><a href="<?php echo url("","",true,false);?>"><i class="icon icon-home"></i> <span>首页</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon-user"></i> <span>客户中心</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?php echo url('admin/user/index'); ?>">客户列表</a></li>
        <li><a href="<?php echo url('admin/user/attendance'); ?>">签到概况</a></li>
        <li><a href="<?php echo url('admin/user/recharge_record'); ?>">充值记录</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>活动中心</span> <span class="label label-important">7</span></a>
      <ul>
        <li ><a href="<?php echo url('admin/activity/index'); ?>">活动列表</a></li>
        <li><a href="<?php echo url('admin/activity/activityType'); ?>">活动分类</a></li>
        <li><a href="<?php echo url('admin/activity/extension'); ?>">活动扩展</a></li>
        <li><a href="<?php echo url('admin/activity/specification'); ?>">活动规格</a></li>
        <li><a href="<?php echo url('admin/activity/activity_ask'); ?>">活动提问</a></li>
        <li><a href="<?php echo url('admin/activity/activity_comment'); ?>">评论列表</a></li>
        <li><a href="<?php echo url('admin/activity/leave_for'); ?>">请假列表</a></li>
      </ul>
    </li>

    <li class="submenu"> 
        <a href="#"><i class="icon icon-inbox"></i>
            <span>订单中心</span>
            <span class="label label-important">2</span>
        </a>
    	<ul style="display: none;">
        <li><a href="<?php echo url('admin/activity/order'); ?>">订单列表</a></li>
        <li><a href="<?php echo url('admin/activity/refund'); ?>">退款列表</a></li>
       </ul>
   </li>
      <li class="submenu">
          <a href="#"><i class="icon-headphones"></i>
              <span>客服中心</span>
              <span class="label label-important">1</span>
          </a>
          <ul style="display: none;">
              <li><a href="<?php echo url('admin/service/index'); ?>">报名情况</a></li>
          </ul>
      </li>
  <li class="submenu">
      <a href="#"><i class="icon-bell"></i>
          <span>权限中心</span>
          <span class="label label-important">3</span>
      </a>
      <ul style="display: none;">
          <li><a href="#">管理员管理</a></li>
          <li><a href="<?php echo url('admin/activity/refund'); ?>">角色列表</a></li>
          <li><a href="<?php echo url('admin/activity/refund'); ?>">管理员日志</a></li>
      </ul>
  </li>
  <li class="submenu">
      <a href="#"><i class="icon-align-left"></i>
          <span>统计中心</span>
          <span class="label label-important">3</span>
      </a>
      <ul style="display: none;">
          <li><a href="<?php echo url('admin/activity/order'); ?>">会员到场率</a></li>
          <li><a href="<?php echo url('admin/activity/refund'); ?>">会员增长率</a></li>
          <li><a href="<?php echo url('admin/activity/refund'); ?>">活动排名</a></li>
      </ul>
  </li>
  </ul>
</div>
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
      <div id="breadcrumb"> 
      	<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a> 
      	<a onclick="window.location.href=document.referrer" class="tip-bottom">客户中心</a> 
      	<a href="#" class="current">客户列表</a> 
  </div>
  </div>
  
   <div class="add_order">
  	 <a href="<?php echo url('admin/user/add_member'); ?>">
        <div class="add" title="添加会员">
          <span style="font-size: 14px;">
              <i class="icon-plus"></i>
                 添加会员
          </span>
        </div>
     </a>
  </div>
<div class="container-fluid">
  <div class="row-fluid">
  	  <div class="span12">
  	  	        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>会员列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>用户id</th>
                  <th>昵称</th>
                  <th>手机号</th>
                  <th>性别</th>
                  <th>状态</th>
                  <th>加入时间</th>
                  <th>地址</th>
                  <th>余额</th>
                  <th>等级</th>
                  <th>操作</th>
               </tr>
              </thead>
              <tbody id="tbody_center" style="font-size: 12px;">
                <?php if(is_array($userInfo) || $userInfo instanceof \think\Collection || $userInfo instanceof \think\Paginator): if( count($userInfo)==0 ) : echo "" ;else: foreach($userInfo as $key=>$vo): ?>
                <tr>
                  <td><?php echo $vo['uid']; ?></td>
                  <td><?php echo $vo['nickname']; ?></td>
                  <td><?php echo $vo['mobile']; ?></td>
                  <td>
                    <?php if($vo['sex'] == 1): ?>
                      男
                    <?php else: ?>
                      女
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($vo['status'] == 1): ?>
                      正常
                    <?php else: ?>
                      被禁
                    <?php endif; ?>
                  </td>
                  <td><?php echo date('Y-m-d H:i:s',$vo['reg_time']); ?></td>
                  <td><?php echo $vo['address']; ?></td>
                  <td></td>
                  <td></td>
                  <td class="center">
                      <i class="check icon-reorder">&nbsp;&nbsp;查看</i>
                      <a href="<?php echo url('admin/user/saveUserList','uid='.$vo['uid']); ?>"><i class="change icon-pencil">&nbsp;&nbsp;修改</i></a>
                      <a href="<?php echo url('admin/user/Consumption_details','uid='.$vo['uid']); ?>"><i class="icon-edit">&nbsp;&nbsp;明细</i></a>
                      <a href="<?php echo url('admin/user/recharge','uid='.$vo['uid']); ?>"><i class="icon-credit-card">&nbsp;&nbsp;充值</i></a>
                  </td>
                  
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
          </div>
        </div>
  	  </div>
  </div>
</div>
</div>
<div class="modal_box hide">
	<div class="modal_div">
		<div class="cancel">X</div>
		<table class="detail_information" border="1" style="width:700px ;height: 200px;font-size: 12px;">
			<tr>
				<td>用户id</td>
				<td class="userId"></td>
				<td>手机号</td>
				<td class="phone"></td>
				<td>昵称</td>
				<td class="nickname"></td>
			</tr>
			<tr>
				<td>状态</td>
				<td class="normal"></td>
				<td>注册时间</td>
				<td class="start"></td>
				<td>最后登录时间</td>
				<td class="finsh"></td>
			</tr>
			<tr>
				<td>生日</td>
				<td class="birthday"></td>
				<td>爱好</td>
                                <td class="hobby"></td>
				<td>所在省</td>
				<td class="province"></td>
			</tr>
			<tr>
				<td>所在市</td>
				<td class="country"></td>
				<td>所在区</td>
				<td class="area"></td>
				<td>详细地址</td>
				<td class="address"></td>
			</tr>
                        <tr>
				<td>个性签名</td>
                                <td colspan="5" class="sign"></td>
			</tr>
			
		</table>
	</div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in/">Themedesigner.in</a> </div>
</div>
<script src="__AJS__/jquery.min.js"></script> 
<script src="__AJS__/jquery.ui.custom.js"></script> 
<script src="__AJS__/bootstrap.min.js"></script> 
<script src="__AJS__/jquery.uniform.js"></script> 
<script src="__AJS__/select2.min.js"></script> 
<script src="__AJS__/jquery.dataTables.min.js"></script> 
<script src="__AJS__/matrix.js"></script> 
<script src="__AJS__/matrix.tables.js"></script>
<script src="__AJS__/operat_table.js"></script>
</html>
