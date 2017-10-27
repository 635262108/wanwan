<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/var/www/html/wanwan/application/mobile/view/activity/activity_sure.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/header.html";i:1508125376;s:70:"/var/www/html/wanwan/application/mobile/view/public/second_header.html";i:1508914023;}*/ ?>
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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="__MobileCss__/bootstrap.min.css" />
    <link rel="stylesheet" href="__MobileCss__/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="__MobileCss__/index.css" />
    <link rel="stylesheet" href="__MobileCss__/reset.css" />
</head>

<div class="comeback textAlign" id="second_page">
    <div class="comeback_whole" >
        <div class="comeback_img">
            <a onclick="window.location.href=document.referrer"><img src="__MobileImg__/second_back.png"/></a>
        </div>

    </div>

    <div class="title_word second_activity"> <?php echo $title; ?></div>
    <?php if(\think\Request::instance()->controller() != 'User'): ?>
    <div class="click_stroggle">
    	<a href="<?php echo url('mobile/user/index'); ?>"><img src="__MobileImg__/dot_img.png" /></a>
    </div>
    <?php endif; ?>
    <!--<ul class="stroggle_ul display_none">
    	<div class="singel_img">
    		<img src="__MobileImg__/triangle.png" />
    	</div>
    	<li>会员中心</li>
    	<li>我的活动</li>
    	<li>我的收藏</li>
    	<li>退出登录</li>
    </ul>-->

</div>
</html>


    <body>
    <!--<div class="comeback textAlign" id="second_page">
        <div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
            <div class="comeback_img">
                <img src="__MobileImg__/second_back.png"/>
            </div>

        </div>

        <div class="title_word second_activity">报名信息</div>

    </div>-->


        <!--大人和小孩的具体信息-->
        <div class="form_Content">
            <form action="<?php echo url('mobile/activity/creat_order'); ?>" method="post">
                <input type="hidden" name="aid" value="<?php echo $ActivityInfo['aid']; ?>"/>
                <input type="hidden" name="adult_num" value="<?php echo $adult_num; ?>"/>
                <input type="hidden" name="child_num" value="<?php echo $child_num; ?>"/>
                <input type="hidden" name="token"  value="<?php echo \think\Request::instance()->token(); ?>"/>
                <input type="hidden" name="time"  value="<?php echo $timeInfo['t_id']; ?>"/>
                <div class="form_common">
                    <div class="adult_img">
                        <img src="__MobileImg__/adult_img.png" />
                    </div>
                    <div><span>姓名</span><input type="text" name="realname" class="adultName">
                        <p class="adultName_warn" style="color: #FF4134;font-size: 12px;text-align: center;margin-left: 40%;display: none;">姓名不能为空！</p>
                    </div>

<!--                    <div><span>性别</span><p class="sex"><input type="radio" name="adultSex" checked="checked">男<input type="radio" class="woman"name="adultSex">女</p> </div>-->
                    <div><span>联系方式</span><input type="text" name="mobile" class="adultTel">
                        <p class="adultTel_warn" style="color: #FF4134;font-size: 12px;text-align: center;margin-left: 40%;display: none;">联系方式不能为空！</p>
                    </div>
                </div>
                <!--第一个小孩-->
                <div class="form_common child_1" num="1">
                    <div class="child_img adult_img">
                        <img src="__MobileImg__/child_img.png" />
                    </div>
                    <div><span>姓名</span><input type="text" name="child_name[]" class="childName_one">
                        <p class="child_warn" style="color: #FF4134;font-size: 12px;text-align: center;margin-left: 40%;display: none;">姓名不能为空！</p>
                    </div>
                    <div><span>性别</span>
                        <p class="sex"><input type="radio" name="child_gender1" value="1">男<input type="radio" class="woman" value="2" name="child_gender1">女</p>
                    </div>

                    <div class="child_birthday"><span>生日</span>
                        <div class="birthdayContainer">
                            <select name="year[]" class="childYear_one" id="year" style="font-size: 12px">
                                <option>请选择</option>
                            </select>
                            <select name="month[]" class="childMonth_one" id="month"  style="font-size: 12px">
                                <option>请选择</option>
                            </select>
                            <select name="day[]" class="childDay_one" id="days"  style="font-size: 12px">
                                <option>请选择</option>
                            </select>
                        </div>


                    </div>
                </div>
                <!--第二个小孩-->
                <div class="form_common child_2" num="2">
                    <div class="child_img adult_img">
                        <img src="__MobileImg__/child_img.png" />
                    </div>
                    <div><span>姓名</span><input type="text" name="child_name[]" class="childName_two">
                        <p class="child_warn2" style="color: #FF4134;font-size: 12px;text-align: center;margin-left: 40%;display: none;">姓名不能为空！</p>
                    </div>
                    <div><span>性别</span>
                        <p class="sex"><input type="radio" name="child_gender2" value="1">男<input type="radio" class="woman" value="2" name="child_gender2">女</p>
                    </div>

                    <div class="child_birthday"><span>生日</span>
                        <div class="birthdayContainer">
                            <select name="year[]" class="childYear_two" id="year_two" style="font-size: 12px">
                                <option>请选择</option>
                            </select>
                            <select name="month[]" class="childMonth_two" id="month_two" style="font-size: 12px">
                                <option>请选择</option>
                            </select>
                            <select name="day[]" class="childDay_two" id="day_two" style="font-size: 12px">
                                <option>请选择</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!--活动详细信息-->
                <div class="playBaby_content almost" id="detail_info">

                    <div class="content" id="theme_information" style="box-shadow: 0px 0px 3px #ff4134;">
                        <div class="baby_detail" style="width: 100%;">
                            <ul class="information_ul">
                                <li><span>活动时间:</span><span><?php echo date('Y.m.d',$ActivityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$ActivityInfo['a_end_time']); ?></span></li>
                                <li><span>活动地点:</span><span class="max_width"><?php echo $ActivityInfo['a_address']; ?></span></li>
                                <li style="height: 14px;justify-content: inherit"><span style="width: 19%;">活动人数:</span>
                                    <span style="width: 65%;"><?php echo $adult_num; ?>大<?php echo $child_num; ?>小</span>

                                </li>
                                <li><span>应付金额:</span><span>总计:<b>￥</b><b class="total"><?php echo $price; ?></b></span></li>
                                <li><input type="text" placeholder="备注" style="width: 70%;" class="beizhu" name="remark"></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <input type="submit" class="name_sure" value="确认报名">
            </form>
        </div>




        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script src="__MobileJs__/jquery.bxslider.js"></script>
        <script src="__MobileJs__/index.js"></script>
        <script type="text/javascript" src="__MobileJs__/birthday.js"></script>
        <script type="text/javascript" src="__MobileJs__/emit_information.js"></script>
        <script>
            //控制小孩的数量
            var num = <?php echo $child_num; ?>;
            if(num==1){
                    $(".child_1").show();
                    $(".child_2").hide();
            }
            if(num==2){
                    $(".child_1").show();
                    $(".child_2").show();
            }
        </script>
    </body>
</html>

