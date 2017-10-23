<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\user\my_info.html";i:1508309656;s:84:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\public\header.html";i:1508309656;}*/ ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>玩翫碗不一样的玩</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <link rel="stylesheet" href="__MobileCss__/bootstrap.min.css" />
        <link rel="stylesheet" href="__MobileCss__/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="__MobileCss__/index.css" />
        <link rel="stylesheet" href="__MobileCss__/reset.css" />
        <link rel="stylesheet" href="__MobileCss__/idangerous.swiper.css" />
        <link rel="stylesheet" href="__MobileCss__/jquery.bxslider.css"/>
        <link rel="stylesheet" href="__MobileCss__/activity.css">
    </head>

    <body>

    <!--头部导航-->
    <div class="comeback textAlign" id="second_page">
        <div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
            <div class="comeback_img">
                <img src="__MobileImg__/second_back.png"/>
            </div>

        </div>

        <div class="title_word second_activity">个人信息</div>

    </div>
    </div>


        <div class="playBaby_content almost">
            <!--<div class="title title_img">-->
                <!--<img src="__MobileImg__/ger_06.png"/>-->
            <!--</div>-->
            <form action="<?php echo url('mobile/user/saveUserInfo'); ?>" method="post" class="form_info">
                <div class="nickName">
                    <span>昵称</span> <input type="text" value="<?php echo $userInfo['nickname']; ?>" name="nikename" id="nickName"/>
                    <p id="my_name_chk" style="color: #FF4134;font-size: 13px;float: right;text-align: center;width: 100%;margin-top: 5px;display: none;">昵称不能为空！</p>
                </div>
                <div class="sex">
                    <span>性别</span>
                    <div class="man">
                        <input type="radio" value="1" <?php if($userInfo['sex'] == 1): ?>checked="checked"<?php endif; ?> name="sex" id="man" checked="checked"/>男
                        <input type="radio" value="2" <?php if($userInfo['sex'] == 2): ?>checked="checked"<?php endif; ?> class="woman" name="sex"/>女
                    </div>
                </div>
                <div class="email nickName">
                    <span>邮箱</span><input value="<?php echo $userInfo['email']; ?>" type="text" name="email" id="email"/>
                    <p id="my_email_chk" style="color: #FF4134;font-size: 13px;width: 100%;text-align: center;margin-top: 5px;display: none;">邮箱格式不正确！</p>
                </div>
                <div class="outer">
                    <span>地址</span>
                    <select id="seachprov" name="prov" onChange="seachcitys($(this).val())">
                        <option value=''>请选择</option>
                        <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): if( count($province)==0 ) : echo "" ;else: foreach($province as $key=>$vo): ?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $userInfo['province']): ?>selected="selected"<?php endif; ?> ><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select id="seachcity"  name="city" onChange="seachdistricts($(this).val())">
                        <option value=''>请选择</option>
                        <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): if( count($city)==0 ) : echo "" ;else: foreach($city as $key=>$vo): ?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $userInfo['city']): ?>selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select id="seachdistrict"  name="district">
                        <option value=''>请选择</option>
                        <?php if(is_array($district) || $district instanceof \think\Collection || $district instanceof \think\Paginator): if( count($district)==0 ) : echo "" ;else: foreach($district as $key=>$vo): ?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $userInfo['district']): ?>selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="area nickName">
                    <span>街道</span>
                    <input type="text" value="<?php echo $userInfo['address']; ?>" name="address" id="area"/>
                    <p id="my_name_street" style="color: #FF4134;font-size: 13px;float: right;text-align: center;width: 100%;margin-top: 5px;display: none;">街道不能为空！</p>
                </div>
                <div class="hobby nickName">
                    <span>兴趣</span>
                    <textarea name="hobby" id="hobby"><?php echo $userInfo['hobby']; ?></textarea>
                    <p id="my_name_hobby" style="color: #FF4134;font-size: 13px;float: right;text-align: center;width: 100%;margin-top: 5px;display: none;">兴趣不能为空！</p>
                </div>

                <button id="submit" type="submit">提交</button>
            </form>

<!--            <div class="modal_box">

                <div class="moal_div">
                    修改成功
                    <div class="cancel">
                        <img src="__MobileImg__/cancel.png" />
                    </div>
                </div>
            </div>-->
        </div>


        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="__MobileJs__/emit_information.js"></script>
    </body>
    <script>
        function seachcitys(province) {
            $.get("<?php echo url('home/user/getRegion'); ?>", {id: province},
            function(obj) {
                if (obj.state_code == 200) {
                    $("#seachcity").html(obj.data);
                }
            }, "json");
        }
        function seachdistricts(city) {
            $.get("<?php echo url('home/user/getRegion'); ?>", {id: city},
            function(obj) {
                if (obj.state_code == 200) {
                    $("#seachdistrict").html(obj.data);
                }
            }, "json");
        }
    </script>
</html>

