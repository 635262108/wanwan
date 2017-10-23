<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:95:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\activity\addextensionlist.html";i:1508309656;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\header.html";i:1508309656;s:81:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\left.html";i:1508309656;}*/ ?>
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
  </ul>
</div>
<div id="content">
        <div id="content-header">
                <div id="breadcrumb">
                        <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a>
                        <a href="<?php echo url('admin/activity/extension'); ?>" class="tip-bottom">扩展列表</a>
                        <a href="#" class="current">添加扩展</a>
                </div>
        </div>

        <div class="row-fluid" id="emit_information">
            <div class="span6" style="margin-left: 0">
                        <div class="widget-box" style="width: 180%;">
                                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                        <h5>添加</h5>
                                </div>
                                <div class="widget-content nopadding">
                                        <form action="<?php echo url('admin/activity/addExtension'); ?>" enctype="multipart/form-data" method="post" class="form-horizontal" name="quitPay_form">
                                                <div class="control-group">
                                                    <label class="control-label">活动标题：</label>
                                                    <div class="controls">
                                                        <select name="aid">
                                                            <?php if(is_array($ActivityInfo) || $ActivityInfo instanceof \think\Collection || $ActivityInfo instanceof \think\Paginator): if( count($ActivityInfo)==0 ) : echo "" ;else: foreach($ActivityInfo as $key=>$vo): ?>
                                                                <option value="<?php echo $vo['aid']; ?>"><?php echo $vo['a_title']; ?></option>
                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">扩展标题：</label>
                                                    <div class="controls">
                                                            <input class="span11" value="" name="title" type="text">
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label">扩展描述：</label>
                                                    <div class="controls">
                                                         <textarea class="span11" name="remark"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label">扩展图</label>
                                                    <div class="controls">
                                                        <input type="file"  name="img"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label">活动详情</label>
                                                    <textarea id="editor" name="content" style="width:780px;height:500px;margin-left: 15px;display: inline-block;z-index: 0">
                                                    </textarea>
                                                    <!--<script id="editor" type="text/plain" name="content" style="width:780px;height:500px;margin-left: 15px;display: inline-block;z-index: 0"></script>-->

                                                </div>

                                            <div class="form-actions" style="text-align: center">
                                                        <button type="submit" class="btn btn-success info_sure">保存</button>
                                                        <a href="javascript:history.back(-1)" class="btn-warning">取消</a>
                                                </div>
                                                </form>



                                </div>
                        </div>
                </div>
        </div>
</div>		
                <script src="__AJS__/jquery.min.js"></script>
                <script src="__AJS__/jquery.ui.custom.js"></script>
                <script src="__AJS__/bootstrap.min.js"></script>
                <script src="__AJS__/jquery.uniform.js"></script>
                <script src="__AJS__/select2.min.js"></script>
                <script src="__AJS__/jquery.dataTables.min.js"></script>
                <script src="__AJS__/matrix.js"></script>
                <script src="__AJS__/birthday.js" type="text/javascript" charset="utf-8"></script>
                <script src="__AJS__/operat_table.js"></script>

                <script type="text/javascript" charset="utf-8" src="__EDITER__/ueditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="__EDITER__/ueditor.all.min.js"> </script>
                <script type="text/javascript" charset="utf-8" src="__EDITER__/lang/zh-cn/zh-cn.js"></script>
                 <script>

                        $(function(){
                            $(".birthday_container").birthday();
                            var ue = UE.getEditor('editor')
                        })




                </script>
	</body>

</html>