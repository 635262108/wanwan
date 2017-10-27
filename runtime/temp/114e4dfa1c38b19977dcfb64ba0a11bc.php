<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/var/www/html/wanwan/application/mobile/view/user/register.html";i:1508125378;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>玩翫碗~注册</title>
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
                    <div class="tel">手机号<input type="text" id="telphone"></div>
                    <p class="tel_warn" style="color: #FF4134;font-size: 12px;text-align: center;margin-top: -30px;display: none;">手机号不能为空！</p>
                    <div class="pwd">密码<input type="password" id="passward"></div>
                    <p class="pwd_warn" style="color: #FF4134;font-size: 12px;text-align: center;margin-top: -30px;display: none;">密码格式不正确(6-16位的字母或数字)</p>
                    <div class="pwd_sure">确认密码<input type="password" id="pwd_sure"></div>
                    <p class="pwd_Surewarn" style="color: #FF4134;font-size: 12px;text-align: center;margin-top: -30px;display: none;">密码输入与上次不一致</p>
                    <div class="yanzhengma">
                        <div class="prompt"><input type="text" id="check_num"></div>
                        <input type="button" value="获取验证码" class="register_get_num"/>
                    </div>
                    <p class="check_warn" style="color: #FF4134;font-size: 12px;margin-top: -30px;margin-left: 4%;display: none;">验证码输入不正确</p>


                    <button type="submit" class="register">注册</button>


                </form>

            </div>
        </div>
        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="__MobileJs__/emit_information.js"></script>

    </body>
</html>
