<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:73:"D:\chuangzhixing\wanwan/application/admin\view\activity\savetypelist.html";i:1509067459;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\header.html";i:1509067459;s:63:"D:\chuangzhixing\wanwan/application/admin\view\public\left.html";i:1509076767;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\footer.html";i:1509067459;}*/ ?>
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
        <li><a href="<?php echo url('admin/activity/specification'); ?>">活动安排</a></li>
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
        <div id="content-header">
                <div id="breadcrumb">
                        <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a>
                        <a href="<?php echo url('admin/activity/activityType'); ?>" class="tip-bottom">分类列表</a>
                        <a href="#" class="current">修改分类</a>
                </div>
        </div>

        <div class="row-fluid" id="emit_information">
                <div class="span6" style="margin-left: 12%;">
                        <div class="widget-box" style="width: 700px;">
                                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                        <h5>修改</h5>
                                </div>
                                <div class="widget-content nopadding">
                                        <form action="<?php echo url('admin/activity/updataType'); ?>" method="post" class="form-horizontal" name="quitPay_form">
                                                <input type="hidden" name="id" value="<?php echo $titleInfo['id']; ?>"/>
                                                <div class="control-group">
                                                    <label class="control-label">分类名称：</label>
                                                    <div class="controls">
                                                            <input class="span11" value="<?php echo $titleInfo['name']; ?>" name="name" type="text">
                                                    </div>
                                                </div>
                                            
                                                <div class="control-group">
                                                    <label class="control-label">排序：</label>
                                                    <div class="controls">
                                                            <input class="span11" value="<?php echo $titleInfo['sort']; ?>" name="sort" type="text">
                                                    </div>
                                                </div>


                                            <div class="form-actions" style="text-align: center">
                                                        <button type="submit" class="btn btn-success info_sure">修改</button>
                                                        <a href="javascript:history.back(-1)" class="btn-warning">取消</a>
                                                </div>
                                                </form>



                                </div>
                        </div>
                </div>
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
		
	</body>

</html>