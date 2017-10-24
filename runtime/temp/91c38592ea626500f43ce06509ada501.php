<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\chuangzhixing\wanwan/application/admin\view\user\attendance.html";i:1508318472;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\header.html";i:1508318472;s:63:"D:\chuangzhixing\wanwan/application/admin\view\public\left.html";i:1508826818;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\footer.html";i:1508318472;}*/ ?>
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
        <li><a href="<?php echo url('admin/user/attendance'); ?>">会员考勤</a></li>
        <li><a href="#">待添加....</a></li>
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
          <a href="#"><i class="icon-edit"></i>
              <span>签到中心</span>
              <span class="label label-important">1</span>
          </a>
          <ul style="display: none;">
              <li><a href="<?php echo url('admin/activity/order'); ?>">签到概况</a></li>
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
              <li><a href="<?php echo url('admin/activity/order'); ?>">报名情况</a></li>
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
      	<a href="<?php echo url('admin/user/attendance'); ?>" class="tip-bottom">会员考勤</a>
      	<a href="#" class="current">考勤列表</a> 
  </div>
  </div>

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
                  <th>活动标题</th>
                  <th>剩余名额</th>
                  <th>报名人数</th>
                  <th>签到人数</th>
                  <th>到场率</th>
                  <th>操作</th>
           </tr>
              </thead>
              <tbody id="tbody_center" style='font-size: 12px;'>
                <?php if(is_array($actinfo) || $actinfo instanceof \think\Collection || $actinfo instanceof \think\Paginator): if( count($actinfo)==0 ) : echo "" ;else: foreach($actinfo as $key=>$vo): ?>
                <tr class="gradeX trs">
                  <td><?php echo $vo['aid']; ?></td>
                  <td><?php echo $vo['a_title']; ?></td>  
                  <td><?php echo $vo['a_num']; ?></td>
                  <td><?php echo $vo['a_sold_num']; ?></td>
                  <td><?php echo $vo['attendance']; ?></td>
                  <td>
                      <?php
                            if($vo['a_sold_num'] == 0 || $vo['attendance'] == 0){
                                echo '0%';
                            }else{
                                $result = floor(($vo['attendance']/$vo['a_sold_num'])*10000)/10000*100;
                                echo $result."%";
                            }
                      ?>
                  </td>
                  <td class="center">
                      <a href="<?php echo url('admin/user/attendance_detail',['aid'=>$vo['aid']]); ?>"><i class="delete icon-pencil">&nbsp;&nbsp;详情</i></a>	
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
</body>
</html>

