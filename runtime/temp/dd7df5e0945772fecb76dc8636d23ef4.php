<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\chuangzhixing\wanwan/application/admin\view\admin\login.html";i:1509067459;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>玩翫碗后台管理中心</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="__ACSS__/bootstrap.min.css" />
		<link rel="stylesheet" href="__ACSS__/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="__ACSS__/matrix-login.css" />
        <link href="__FONT-AWESOME__/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="http://themedesigner.in/demo/matrix-admin/index.html">
				 <div class="control-group normal_text"> <h3><img src="__AIMG__/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"></i></span><input id="name" type="text" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input id="pwd" type="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">忘记密码?</a></span>
                    <span class="pull-right"><a type="submit" id="login" class="btn btn-success" /> 登录</a></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
                <p class="normal_text">??????????????</p>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>
        </div>
        
        <script src="__AJS__/jquery.min.js"></script>  
        <script src="__AJS__/matrix.login.js"></script> 
    </body>

</html>
