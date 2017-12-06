<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\chuangzhixing\wanwan/application/mobile\view\user\login.html";i:1511513428;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>玩翫碗~登录</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <link rel="stylesheet" href="__MobileCss__/register.css"/>
    </head>
    <body>
        <div class="textAlign login_bg">
        	
    <div class="comeback_whole" >
        <div class="comeback_img">
     
            <?php if(empty($url) || (($url instanceof \think\Collection || $url instanceof \think\Paginator ) && $url->isEmpty())): ?>
                <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/login_back.png"/></a>
            <?php else: ?>
                <a href="<?php echo $url; ?>"><img src="__MobileImg__/login_back.png"/></a>
            <?php endif; ?>
        </div>
    </div>

            <div class="information_content">
                <form action="" method="post">
                	<p class="tel_namer">手机号</p>
                    <div class="tel"><input type="text" id="login_userName" style="width: 257px;"></div>
                    <p class="user" style="color: #FFFFFF;font-size: 12px;text-align: center;display: none;margin-top: 2px;">手机号不能为空！</p>
                    <p class="tel_namer">密码</p>
                    <div class="pwd" style="margin-bottom: 20px;"><input type="password" id="login_passward"></div>
                    <p class="pwd_warn" style="color: #FFFFFF;font-size: 12px;text-align: center;display: none;margin-top: -15px;">密码格式不正确(6-16位的字母或数字)</p>
                    <div class="login">
                        <a href="forget_pwd.html" class="forget">忘记密码?</a>
                        <a href="register.html" class="register_word">新用户注册</a>
                    </div>


                    <button type="submit" class="login_register">登录</button>


                </form>

            </div>
        </div>

        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="__MobileJs__/emit_information.js"></script>

    </body>
</html>
