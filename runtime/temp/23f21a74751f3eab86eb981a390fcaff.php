<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:87:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\user\saveuserlist.html";i:1508309656;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\header.html";i:1508309656;s:81:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\left.html";i:1508309656;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\footer.html";i:1508309656;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
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
	<div id="breadcrumb"> 
      	<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a> 
      	<a href="<?php echo url('admin/user/index'); ?>" class="tip-bottom">会员管理</a> 
      	<a href="#" class="current">信息修改</a> 
    </div>
    <div class="row-fluid" id="emit_information">
    	<div class="span6">
    		      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>会员信息</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="<?php echo url('admin/user/saveUser'); ?>" method="post" class="form-horizontal" name="userForm">
            <div class="control-group">
              <label class="control-label">用户Id :</label>
              <div class="controls">
                  <input type="text" value="<?php echo $userInfo['uid']; ?>" class="span11" readonly name="userId"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">手机号 :</label>
              <div class="controls">
                <input type="text" value="<?php echo $userInfo['mobile']; ?>" class="span11" name="userTel"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">昵称</label>
              <div class="controls">
                <input type="text" value="<?php echo $userInfo['nickname']; ?>" class="span11" name="userName"/>
              </div>
            </div>
<!--            <div class="control-group">
              <label class="control-label">状态</label>
              <div class="controls">
                <select name="status" style="display: none;">
                    <option value="<?php echo $userInfo['status']; ?>" <?php if($userInfo['status'] == 1): ?>selected="selected"<?php endif; ?>>正常</option>
                    <option value="<?php echo $userInfo['status']; ?>" <?php if($userInfo['status'] == 2): ?>selected="selected"<?php endif; ?>>被封</option>
              	</select>
              </div>
            </div>-->
<div class="control-group">
              <label class="control-label">状态</label>
              <div class="controls">
                <select name="status" autocomplete = "off">
                    <option value="1" <?php if($userInfo['status'] == 1): ?> selected="selected" <?php endif; ?>>正常</option>
                    <option value="2" <?php if($userInfo['status'] == 2): ?> selected="selected" <?php endif; ?>>被封</option>
              	</select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">注册时间:</label>
              <div class="controls">
                <input type="text" value="<?php echo $userInfo['reg_time']; ?>" readonly class="span11" name="startTime"/>
               </div>
            </div>
            <div class="control-group">
              <label class="control-label">最后登录时间</label>
              <div class="controls">
                <input type="text" value="<?php echo $userInfo['last_time']; ?>" readonly class="span11" name="lastTime"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">生日</label>
              <div class="controls">
                <input type="text" value="<?php echo $userInfo['birthday']; ?>" class="span11" name="userBirthday"/>
               
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">爱好</label>
              <div class="controls">
                <input type="text" value="<?php echo $userInfo['hobby']; ?>" class="span11" name="userLike"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">所在省</label>
              <div class="controls">
                <select name="userProvince" onChange="seachcitys($(this).val())">
                    <option value="0">请选择...</option>
                    <?php if(is_array($provinces) || $provinces instanceof \think\Collection || $provinces instanceof \think\Paginator): if( count($provinces)==0 ) : echo "" ;else: foreach($provinces as $key=>$vo): ?>
                    <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $userInfo['province']): ?>selected='selected'<?php endif; ?>><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">所在市</label>
              <div class="controls">
                <select name="userCountry" id="seachcity" onChange="seachdistricts($(this).val())">
                <option value="0">请选择...</option>
                <?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): if( count($citys)==0 ) : echo "" ;else: foreach($citys as $key=>$vo): ?>
                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $userInfo['city']): ?>selected='selected'<?php endif; ?>><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">所在区</label>
              <div class="controls">
               <select name="userArea" id="seachdistrict">
               <option value="0">请选择...</option>
               <?php if(is_array($districts) || $districts instanceof \think\Collection || $districts instanceof \think\Paginator): if( count($districts)==0 ) : echo "" ;else: foreach($districts as $key=>$vo): ?>
               <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $userInfo['district']): ?>selected='selected'<?php endif; ?>><?php echo $vo['name']; ?></option>
               <?php endforeach; endif; else: echo "" ;endif; ?>
               </select>
               
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">详细地址</label>
              <div class="controls">
                <textarea class="span11" name="detailAddress"><?php echo $userInfo['address']; ?></textarea>
              </div>
            </div>
            
            <div class="form-actions">
            <button class="btn btn-success info_sure" type="submit">确定</button>
              
            <a href="<?php echo url('admin/user/index'); ?>" class="btn-warning">取消</a>
            </div>
           </form>
            
          <!--</form>-->
        </div>
      </div>
    	</div>
    </div>
</div>
	<div class="modal_box hide">
			<div class="info_modalbox">
				<div class="cancel">X</div>
				<div class="right_content">
					<img src="img/right.png" />
					<span>修改成功</span>
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
