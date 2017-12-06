<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\chuangzhixing\wanwan/application/mobile\view\user\register.html";i:1511754107;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>玩翫碗~注册</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <link rel="stylesheet" href="__MobileCss__/register.css"/>
    </head>
    <body>
        <div class="textAlign register_bg">
                 <div class="comeback_whole" >
				        <div class="comeback_img">
				     
				            <?php if(empty($url) || (($url instanceof \think\Collection || $url instanceof \think\Paginator ) && $url->isEmpty())): ?>
				                <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/login_back.png"/></a>
				            <?php else: ?>
				                <a href="<?php echo $url; ?>"><img src="__MobileImg__/login_back.png"/></a>
				            <?php endif; ?>
				        </div>
   				 </div>
            <div class="information_content" id="register_content">
                <form action="" method="post">
                	<p class="tel_namer">姓名</p>
                	<div class="name"><input type="text" id="user_name" style="width: 260px;"></div>
                	 <p class="name_warn" style="color: #FFFFFF;font-size: 12px;text-align: center;height: 0px;margin-top:1px;display: none;">姓名不能为空！</p>
                	<p class="tel_namer">手机号</p>
                    <div class="tel"><input type="text" id="telphone" style="width: 260px;"></div>
                    <p class="tel_warn" style="color: #FFFFFF;font-size: 12px;text-align: center;display: none;height: 0px;margin-top:1px;">手机号不能为空！</p>
                    <p class="tel_namer">密码</p>
                    <div class="pwd"><input type="password" id="passward" style="width: 260px;"></div>
                    <p class="pwd_warn" style="color: #FFFFFF;font-size: 12px;text-align: center;display: none;height: 0px;margin-top:1px;">密码格式不正确(6-16位的字母或数字)</p>
                    <p class="tel_namer">确认密码</p>
                    <div class="pwd_sure"><input type="password" id="pwd_sure" style="width: 260px;"></div>
                    <p class="pwd_Surewarn" style="color: #FFFFFF;font-size: 12px;text-align: center;display: none;height: 0px;margin-top:1px;">密码输入与上次不一致</p>
                    <div class="yanzhengma">
                        <div class="prompt"><input type="text" id="check_num" style="width: 130px;"></div>
                        <input type="button" value="获取验证码" class="register_get_num"/ style="width:55%;margin-left: 3%;position: initial;">
                    </div>
                    <p class="check_warn" style="color: #FFFFFF;font-size: 12px;margin-left: 4%;display: none;height: 0px;margin-top:1px;">验证码输入不正确</p>


                    <button type="submit" class="register">注册</button>


                </form>

            </div>
        </div>
        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="__MobileJs__/emit_information.js"></script>

    </body>
</html>
