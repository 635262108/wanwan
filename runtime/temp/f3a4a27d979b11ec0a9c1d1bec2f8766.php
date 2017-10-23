<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\user\login.html";i:1508309656;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>玩翫碗~登录</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <link rel="stylesheet" href="__MobileCss__/register.css"/>
    </head>
    <body>
        <div class="textAlign">
            <div class="wanTitle_img">
                <img src="__MobileImg__/logo.png" />
            </div>

            <div class="information_content">
                <form action="" method="post">
                    <div class="tel">手机号<input type="text" id="login_userName"></div>
                    <p class="user" style="color: #FF4134;font-size: 15px;text-align: center;margin-top: -30px;display: none;">手机号不能为空！</p>
                    <div class="pwd">密码<input type="password" id="login_passward"></div>
                    <p class="pwd_warn" style="color: #FF4134;font-size: 15px;text-align: center;margin-top: -30px;display: none;">密码格式不正确(6-16位的字母或数字)</p>
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
