<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\chuangzhixing\wanwan/application/admin\view\service\return_visit.html";i:1512006679;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\header.html";i:1510821022;s:63:"D:\chuangzhixing\wanwan/application/admin\view\public\left.html";i:1511351498;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\footer.html";i:1511351498;}*/ ?>
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
    <li class="active"><a href="<?php echo url('admin/index/index'); ?>"><i class="icon icon-home"></i> <span>首页</span></a></li>
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
          <span class="label label-important">4</span>
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
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a>
            <a href="<?php echo url('admin/service/index'); ?>" class="tip-bottom">客户中心</a>
            <a href="#" class="current">回访记录</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>回访记录</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>会员名称</th>
                                <th>手机号</th>
                                <th>签到时间</th>
                                <th>场次时间</th>
                                <th>报名来源</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_center" style="font-size: 12px;">
                            <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): if( count($res)==0 ) : echo "" ;else: foreach($res as $key=>$vo): ?>
                            <tr>
                                <td><?php echo $vo['name']; ?></td>
                                <td><?php echo $vo['mobile']; ?></td>
                                <td>
                                    <?php if($vo['sign_time'] == 0): ?>
                                        未签到
                                    <?php else: ?>
                                        <?php echo date('Y.m.d H:i',$vo['sign_time']); endif; ?>
                                </td>
                                <td><?php echo date('Y.m.d H:i',$vo['begin_time']); ?>--<?php echo date('m.d H:i',$vo['end_time']); ?></td>
                                <td><?php echo $vo['source_name']; ?></td>
                                <td><?php echo $vo['record']; ?></td>
                                <td class="center"> <a href="<?php echo url('admin/service/dis_save_visit',['aid'=>$vo['aid'],'oid'=>$vo['order_id']]); ?>"><i class="check icon-reorder">&nbsp;&nbsp;记录</i></a>
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
<div class="row-fluid" style="position: fixed;bottom: 0px;">
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
<script src="__AJS__/Calendar.js"></script>
</html>
