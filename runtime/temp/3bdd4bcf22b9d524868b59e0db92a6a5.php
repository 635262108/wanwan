<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\activity\index.html";i:1508309656;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\header.html";i:1508309656;s:81:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\left.html";i:1508725962;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\footer.html";i:1508309656;}*/ ?>
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
    <li class="submenu"> <a href="#"><i class="icon-user"></i> <span>会员管理</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="<?php echo url('admin/user/index'); ?>">会员列表</a></li>
        <li><a href="<?php echo url('admin/user/attendance'); ?>">会员考勤</a></li>
        <li><a href="#">待添加....</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>活动管理</span> <span class="label label-important">7</span></a>
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
            <span>订单管理</span>
            <span class="label label-important">2</span>
        </a>
    	<ul style="display: none;">
        <li><a href="<?php echo url('admin/activity/order'); ?>">订单列表</a></li>
        <li><a href="<?php echo url('admin/activity/refund'); ?>">退款列表</a></li>
       </ul>
   </li>
  <li class="submenu">
      <a href="#"><i class="icon-bell"></i>
          <span>权限中心</span>
          <span class="label label-important">3</span>
      </a>
      <ul style="display: none;">
          <li><a href="<?php echo url('admin/activity/order'); ?>">管理员管理</a></li>
          <li><a href="<?php echo url('admin/activity/refund'); ?>">角色列表</a></li>
          <li><a href="<?php echo url('admin/activity/refund'); ?>">管理员日志</a></li>
      </ul>
  </li>
  </ul>
</div>
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
      <div id="breadcrumb"> 
      	<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a> 
      	<a href="#" class="tip-bottom">活动管理</a> 
      	<a href="#" class="current">活动列表</a> 
  </div>
  </div>
<!--添加开始部分-->
  <div class="add_order">
  	 <a href="<?php echo url('admin/activity/addActivityList'); ?>">
        <div class="add" title="添加活动">
          <span style="font-size: 14px;">
              <i class="icon-plus"></i>
                 添加活动
          </span>
        </div>
     </a>
  </div>
<!--添加结束-->
<div class="container-fluid">
  <div class="row-fluid">
  	  <div class="span12">
  	  	        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>活动id</th>
                  <th>活动名称</th>
                  <th>活动开始时间</th>
                  <th>活动结束时间</th>
                  <th>剩余名额</th>
                  <th>已报名额</th>
                  <th>大人价格</th>
                  <th>小孩价格</th>
                  <th>活动价格</th>
                  <th>是否推荐</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody id="tbody_center" style="font-size: 12px;">
                <?php if(is_array($ActivityInfo) || $ActivityInfo instanceof \think\Collection || $ActivityInfo instanceof \think\Paginator): if( count($ActivityInfo)==0 ) : echo "" ;else: foreach($ActivityInfo as $key=>$vo): ?>
                <tr class="gradeX trs">
                  <td><?php echo $vo['aid']; ?></td>
                  <td><?php echo subtext($vo['a_title'],17); ?></td>
                  <td><?php echo date("m-d H:i",$vo['a_begin_time']); ?></td>
                  <td><?php echo date("m-d H:i",$vo['a_end_time']); ?></td>
                  <td><?php echo $vo['a_num']; ?></td>
                  <td><?php echo $vo['a_sold_num']; ?></td>
                  <td><?php echo $vo['a_adult_price']; ?></td>
                  <td><?php echo $vo['a_child_price']; ?></td>
                  <td><?php echo $vo['a_price']; ?></td>
                  <td>
                      <?php switch($vo['a_is_recommend']): case "1": ?>是<?php break; case "0": ?>否<?php break; endswitch; ?>
                  </td>
                  
                  <td class="center">
                  	<a href="<?php echo url('admin/activity/saveActivityList','aid='.$vo['aid']); ?>"><i class="check icon-reorder">&nbsp;&nbsp;编辑</i></a>
                    <i class="delete icon-pencil activity_delete">&nbsp;&nbsp;删除</i>	
                    <a target="view_window" href="http://qr.topscan.com/api.php?text=www.baobaowaner.com/mobile/activity/sign?a=<?php echo $vo['aid']; ?>"><i class="check icon-reorder">&nbsp;&nbsp;二维码</i></a>
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
