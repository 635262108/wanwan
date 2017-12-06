<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"D:\chuangzhixing\wanwan/application/admin\view\user\index.html";i:1512461264;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\header.html";i:1510821022;s:63:"D:\chuangzhixing\wanwan/application/admin\view\public\left.html";i:1512089528;s:65:"D:\chuangzhixing\wanwan/application/admin\view\public\footer.html";i:1512089528;}*/ ?>


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
<style>
	  #s2id_autogen1{
	  	width: 100%;
	  	height: 20px;
	  	
	  }
	  #s2id_autogen1 .select2-choice div b{
	  	background-position:0px -3px;
	  }
	    #s2id_autogen1 .select2-choice{
	    	height: 20px;
	    	line-height: 20px;
	    }
	    #s2id_autogen1 a span{
	    	height: 20px;
	    }
</style>
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
<div id="content" style="background: #F6F6F6;">
	<!--breadcrumbs-->
	<div id="content-header">
		<div id="breadcrumb">
			<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>首页</a>
			<a href="<?php echo url('admin/user/index'); ?>" class="tip-bottom">客户中心</a>
			<a href="#" class="current">客户列表</a>
		</div>
	</div>

	<!--<div class="add_order">
  	 <a href="<?php echo url('admin/user/add_member'); ?>">
        <div class="add" title="添加会员">
          <span style="font-size: 14px;">
              <i class="icon-plus"></i>
                		 添加会员
          </span>
        </div>
     </a>
  </div>-->
	<div class="member_check">
		<ul>
			<li><img src="__AIMG__/add_member.png" style="margin-right: 6px;">
				<a href="<?php echo url('admin/user/add_member'); ?>">添加</a>
			</li>
			<li><img src="__AIMG__/pai.png" style="margin-right: 6px;">排序<span></span></li>
			<li><img src="__AIMG__/shai.png" style="margin-right: 6px;">筛选<span style="display: none;"></span></li>
		</ul>
	</div>
	<div class="pai_contents">
		<div class="pai">
			<ul>
				<li class="active">充值金额</li>
				<li>参与活动次数</li>
				<li>最新发生时间</li>
			</ul>
		</div>
		<div class="shai" style="display: none;">
			<div class="only_one">
				<p>新增</p>
				<ul>
					<li>本月</li>
					<li>本周</li>
				</ul>
			</div>
			<!--<div class="only_one">-->
				<!--<p>成交客户</p>-->
				<!--<ul>-->
					<!--<li>充值</li>-->
					<!--<li>单品</li>-->
				<!--</ul>-->
			<!--</div>-->
			<div class="only_one">
				<p>住址</p>
				<ul>
					<?php if(is_array($zhengZhou) || $zhengZhou instanceof \think\Collection || $zhengZhou instanceof \think\Paginator): if( count($zhengZhou)==0 ) : echo "" ;else: foreach($zhengZhou as $key=>$vo): ?>
					<li><?php echo $vo['name']; ?></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div style="margin-bottom: -3px;">
				<p>孩子年龄段</p>
				<ul>
				   <input type="text" />
				   <div class="age"></div>
				   <input type="text" />&nbsp;&nbsp;岁
				</ul>
			</div>
			<div class="playTimes">
				<p>孩子可玩时间</p>
				<ul>
				   <li>周一</li>
				   <li>周二</li>
				   <li>周三</li>
				   <li>周四</li>
				   <li>周五</li>
				   <li>周六</li>
				   <li>周日</li>
				</ul>
			</div>
			
		<!--<div style="margin-bottom: -4px;">-->
				<!--<p style="width: 70px;">参与频次</p>-->
				<!--<ul>-->
				    <!--参与活动&nbsp;&nbsp;<input type="text" style="width: 35px;height: 17px;"/>&nbsp;&nbsp;次-->
				<!--</ul>-->
		<!--</div>-->

	   <!--<div style="margin-bottom: -4px;">-->
				<!--<p style="width: 70px;">初次成交</p>-->
				<!--<ul>-->
				    <!--参与&nbsp;&nbsp;<input type="text" style="width: 35px;height: 17px;"/>&nbsp;&nbsp;次活动才能初次成交-->
				<!--</ul>-->
		<!--</div>-->

	  <!--<div style="margin-bottom: -4px;">-->
				<!--<p style="width: 70px;">复购次数</p>-->
				<!--<ul>-->
				    <!--复购&nbsp;&nbsp;<input type="text" style="width: 35px;height: 17px;"/>&nbsp;&nbsp;次-->
				<!--</ul>-->
		<!--</div>-->
		<!---->
		 <!--<div style="margin-bottom: -2px;">-->
				<!--<p style="width: 90px;">主题参与情况</p>-->
				<!--<ul>-->
				     <!--<select>-->
				     	    <!--<option>活动主题</option>-->
				     <!--</select>-->
				     <!---->
				<!--</ul>-->
				<!--<ul class="activityOperate">-->
				     	  <!--<li>已体验</li>-->
				     	  <!--<li>未体验</li>-->
			  <!--</ul>-->
		<!--</div>-->
		<!---->
		<div class="only_one">
				<p style="width: 70px;">会员</p>
				<ul>
				   <li>充值后一个月内无消费的会员</li>
				     
				</ul>
		</div>
		<div style="margin-bottom: 8px;" class="only_one">
				<p style="width: 90px;">客户类型</p>
				<ul>
				   <li>会员</li>
				   <li>非会员</li> 
				</ul>
		</div>
		<div class="button">
			    <ul class="button_ul">
			    	  <li class="operate reset">重置</li>
			    	  <li class="operate success">完成</li>
			    </ul>
		</div>
		</div>
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
									<th>余额</th>
									<th>来源</th>
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
										<?php if($vo['sex'] == 1): ?> 男 <?php elseif($vo['sex'] == 2): ?> 女 <?php else: ?> 未设置 <?php endif; ?>
									</td>
									<td>
										<?php if($vo['status'] == 1): ?> 正常 <?php else: ?> 被禁 <?php endif; ?>
									</td>
									<td><?php echo date('Y-m-d H:i:s',$vo['reg_time']); ?></td>
									<td><?php echo $vo['balance']; ?></td>
									<td><?php echo $vo['source_name']; ?></td>
									<td class="center">
										<i class="check icon-reorder">&nbsp;&nbsp;查看</i>
										<a href="<?php echo url('admin/user/saveUserList','uid='.$vo['uid']); ?>"><i class="change icon-pencil">&nbsp;&nbsp;修改</i></a>
										<a href="<?php echo url('admin/user/Consumption_details','uid='.$vo['uid']); ?>"><i class="icon-edit">&nbsp;&nbsp;明细</i></a>
										<a href="<?php echo url('admin/user/recharge','uid='.$vo['uid']); ?>"><i class="icon-credit-card" style="width:80px;">&nbsp;&nbsp;金额变动</i></a>
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

<!--查看模态框-->
<div class="modal_box hide">
	<div class="modal_div" style="background: #F0F0F0;">
		<div class="cancel">X</div>
		<div class="total_title">会员信息</div>
		<div class="member_title">
			<ul>
				<li class="active">会员概要</li>
				<li>详细信息</li>
				<li>孩子信息</li>
			</ul>
		</div>

		<div class="memberContents">
			<div class="memeber_information" style="margin-top: 40px;">
				<ul>
					<li><span>会员姓名</span><span class="member_name"></span></li>
					<li><span>会员手机</span><span class="member_phone"></span></li>
					<li><span>会员余额</span><span class="balance"></span></li>
					<li><span>消费金额</span><span class="consumtion"></span></li>
					<li><span>报名次数</span><span class="enrol_num"></span></li>
					<li><span>参加次数</span><span class="join_num"></span></li>
					<li><span>信用积分</span><span class="credit"></span></li>
					<li><span>会员来源</span><span class="source"></span></li>
					<li><span style="width: 31%;">当前充值次数</span><span class="pay_num">9999</span></li>

				</ul>

			</div>
			<div class="detailContent_information" style="display: none;margin-top: 40px;">
				<ul>
					<li><span>会员姓名</span><span class="nickname"></span></li>
					<li><span>会员手机</span><span class="phone"></span></li>
					<li><span>会员性别</span><span class="sex"></span></li>
					<li><span>加入时间</span><span class="reg_time"></span></li>
					<li><span style="text-align: right;">省</span><span class="province"></span></li>
					<li><span style="text-align: right;">市</span><span class="city"></span></li>
					<li><span style="text-align: right;">区</span><span class="district"></span></li>
					<li><span>详细地址</span><span class="address"></span></li>
					<li><span>会员生日</span><span class="birthday"></span></li>
					<li><span>会员邮箱</span><span class="email"></span></li>
					<li><span>会员爱好</span><span class="hobby"></span></li>

				</ul>
			</div>
			<div class="child_information" style="display: none;">
				<!--<div class="add_child"><img src="__AIMG__/add.png" style="width: 18px;height: 18px;margin-right: 22%;margin-top: -2px;"/><a href="javascript:;" class="add_new">新增</a></div>
			  	<div class="child_part">
			  		<div class="uid" style="display: none;"></div>
			  		<ul>
			  	   	   <li><span>孩子姓名:</span><span>薛茜</span></li>
			  	   	   <li><span>孩子性别:</span><span>男</span></li>
			  	   	   <li><span>孩子生日:</span><span>2012.2.4</span></li>
			  	   	   <li><span>孩子学校:</span><span>第一中学</span></li>
			  	   	   <li><span>可玩时间:</span><span>上午9点半</span></li>
			  	   	   <li><span>登记时间:</span><span>2014.78</span></li>
			  		</ul>
			  		<div class="operate">
			  			    <span class="emit"><img src="__AIMG__/edit.png"><a href="javascript:;">编辑</a></span>
			  			    <span><img src="__AIMG__/delete.png"><a href="javascript:;" class="delete">删除</a></span>
			  		</div>
			  	</div>-->

			</div>
		</div>

	</div>

</div>

<div class="modal_addsecondBox" style="display: none;">
	<div class="second_modal">
		<div class="second_cancel">X</div>
		<div class="uid" style="display: none;"></div>
		<div class="add_information">
			<div><span>孩子姓名</span><input type="text" class="child_name" value=""></div>
			<div><span>孩子性别</span>
				<input type="radio" name="sex" value="1">男
				<input type="radio" name="sex" value="2" />女
			</div>
			<div><span>孩子学校</span><input type="text" class="child_school" value=""></div>
			<div><span>玩耍时间</span><input type="text" class="child_time" value=""></div>
			<div><span>孩子生日</span><input type="text" onClick="new Calendar().show(this);" value="" style="cursor: pointer;" class="child_birthday"></div>
		</div>
		<div class="add_success">保存</div>
	</div>
</div>

<div class="modal_emitsecondBox" style="display: none;">
	<div class="second_modal">
		<div class="emit_second_cancel">X</div>
		<div class="id" style="display: none;"></div>
		<div class="add_information">
			<div><span>孩子姓名</span><input type="text" class="new_name" value=""></div>
			<div><span>孩子性别</span>
				<input type="radio" name="sex" value="1" class="man">男
				<input type="radio" name="sex" value="2" class="woman" />女
			</div>
			<div><span>孩子学校</span><input type="text" class="new_school" value=""></div>
			<div><span>玩耍时间</span><input type="text" class="new_time" value=""></div>
			<div><span>孩子生日</span><input type="text" onClick="new Calendar().show(this);" value="" style="cursor: pointer;" class="new_birthday"></div>
		</div>
		<div class="emit_success">保存</div>
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

</html>