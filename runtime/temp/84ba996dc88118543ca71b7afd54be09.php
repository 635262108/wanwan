<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:95:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\activity\saveactivitylist.html";i:1508309656;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\header.html";i:1508309656;s:81:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\left.html";i:1508834326;s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/admin\view\public\footer.html";i:1508309656;}*/ ?>
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
    <div id="content" style="">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i>首页</a>
                <a href="<?php echo url('admin/activity/index'); ?>" class="tip-bottom" data-original-title="">活动管理</a>
                <a href="#" class="current">编辑活动</a>
            </div>
        </div>

        <div class="row-fluid" id="emit_information" style="">
            <div class="span6" style="margin-left: 0%;">
                <div class="widget-box" style="width: 180%;">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>活动信息</h5>
                    </div>
                    <div class="widget-content nopadding" style="">
                        <form action="<?php echo url('admin/activity/saveActivity'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" name="Alist_form" style="m-horizontal">
                            <div class="control-group">
                                <label class="control-label">活动Id :</label>
                                <div class="controls">
                                    <input class="span11" readonly="" value='<?php echo $ActivityInfo['aid']; ?>' name="activityId" type="text" style="width: 20%">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">标题 :</label>
                                <div class="controls">
                                    <input class="span11" value='<?php echo $ActivityInfo['a_title']; ?>' name="activityTitle" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动描述</label>
                                <div class="controls">
                                    <textarea class="span11" name="remark"><?php echo $ActivityInfo['a_remark']; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">首页缩略图</label>
                                <div class="controls">
                                    <input type="file"  name="index_img"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">主页大图</label>
                                <div class="controls">
                                    <input type="file"  name="a_img"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动开始时间 :</label>
                                <div class="controls">
                                    <input class="span11" value="<?php echo date('Y-m-d H:i:s',$ActivityInfo['a_begin_time']); ?>"  name="begin_time" type="text" style="width: 20%">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动结束时间:</label>
                                <div class="controls">
                                    <input class="span11" value="<?php echo date('Y-m-d H:i:s',$ActivityInfo['a_end_time']); ?>"  name="end_time" type="text" style="width:20%">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动地址:</label>
                                <div class="controls">
                                    <input class="span11" value="<?php echo $ActivityInfo['a_address']; ?>"  name="address" type="text" style="width:20%">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">剩余名额</label>
                                <div class="controls">
                                    <input class="span11"  style="width: 20%;" value='<?php echo $ActivityInfo['a_num']; ?>' name="residue" type="text">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">大人价格</label>
                                <div class="controls">
                                    <input class="span11" value='<?php echo $ActivityInfo['a_adult_price']; ?>' style="width: 20%;margin-right: 10px;" name="adult_price" type="text">元

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">小孩价格</label>
                                <div class="controls">
                                    <input class="span11" value='<?php echo $ActivityInfo['a_child_price']; ?>' style="width: 20%;margin-right: 10px;" name="child_price" type="text">元

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动价格</label>
                                <div class="controls">
                                    <input class="span11" value='<?php echo $ActivityInfo['a_price']; ?>' style="width: 20%;margin-right: 10px;" name="child_price" type="text">元

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动状态</label>
                                <div class="controls">
                                    <select style="width: 20%;" name="activity_status" autocomplete = "off">
                                        <option value="1" <?php if($ActivityInfo['a_status'] == 1): ?> selected="selected" <?php endif; ?>>上架</option>
                                        <option value="2" <?php if($ActivityInfo['a_status'] == 2): ?> selected="selected" <?php endif; ?>>下架</option>
                                    </select>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">活动类型</label>
                                <div class="controls">
                                    <select style="width: 20%;" autocomplete = "off" onChange="changeActivityType($(this).val())">
                                        <option>请选择...</option>
                                        <?php if(is_array($title) || $title instanceof \think\Collection || $title instanceof \think\Paginator): if( count($title)==0 ) : echo "" ;else: foreach($title as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>" <?php if($fidInfo['fid'] == $vo['id']): ?> selected="selected" <?php endif; ?>><?php echo $vo['name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <select id="sonType" style="width: 20%;" name="activity_type">
                                        <option>请选择...</option>
                                        <?php if(is_array($titleSon) || $titleSon instanceof \think\Collection || $titleSon instanceof \think\Paginator): if( count($titleSon)==0 ) : echo "" ;else: foreach($titleSon as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>" <?php if($ActivityInfo['a_type'] == $vo['id']): ?> selected="selected" <?php endif; ?>><?php echo $vo['name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">是否推荐</label>
                                <div class="controls">
                                    <select style="width: 20%;" name="recommend" autocomplete = "off">
                                        <option value="1" <?php if($ActivityInfo['a_is_recommend'] == 1): ?> selected="selected" <?php endif; ?>>是</option>
                                        <option value="0" <?php if($ActivityInfo['a_is_recommend'] == 0): ?> selected="selected" <?php endif; ?>>否</option>
                                    </select>
                                </div>
                            </div>
                            <!--文本编辑区-->
                            <div class="control-group" style="">
                                <label class="control-label">活动详情</label>
                                <textarea id="editor" name="myContent" style="width:790px;height:500px;display: inline-block;margin-left: 15px;z-index: 0;">
                                            <?php echo $ActivityInfo['a_content']; ?>
                                </textarea>

                                <!--<script id="editor" type="text/plain" name="myContent" style="width:500px;height:500px;display: inline-block;margin-left: 15px;z-index: 0;"></script>-->


                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success info_sure">保存</button>
                                <a href="<?php echo url('admin/activity/index'); ?>" class="btn-warning">取消</a>
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
    <script type="text/javascript" charset="utf-8" src="__EDITER__/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="__EDITER__/lang/zh-cn/zh-cn.js"></script>
    <script>

                                    $(function() {
                                        $(".birthday_container").birthday();
                                        var ue = UE.getEditor('editor')

//			    $(".info_sure").on("click",function(){
//			    	console.log("确认跳转");
//			    	window.location.href="change_success.html"
//			    })


                                    })




    </script>
    <!--<div class="row-fluid">
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
<script src="__AJS__/operat_table.js"></script>-->


</body>
</html>
