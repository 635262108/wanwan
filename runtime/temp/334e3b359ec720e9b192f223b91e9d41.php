<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"/var/www/html/wanwan/application/mobile/view/activity/wx_cli_pay.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/header.html";i:1508125376;s:70:"/var/www/html/wanwan/application/mobile/view/public/second_header.html";i:1508914023;}*/ ?>
<!DOCTYPE html>
<html>
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
        <div class="comeback_whole" onclick="javascript:window.history.back(-1);window.location.reload()" >
            <div class="comeback_img">
                <img src="__MobileImg__/second_back.png"/>
            </div>

        </div>
        <div class="title_word second_activity">确认支付</div>

    </div>-->
    <div class="playBaby_content almost">

                <div id="orderDetail_content">
                    <div class="content">

                        <div class="baby_detail">
                            <ul class="detail_information">
                                <li class="li_color">联系人信息</li>
                                <li>用户名：<?php echo session('userInfo.nickname'); ?></li>
                                <li>联系人姓名：<?php echo $order['name']; ?></li>
                                <li>联系方式：<?php echo $order['mobile']; ?></li>
                            </ul>

                        </div>

                    </div>

                    <div class="content">

                        <div class="baby_detail">
                            <div class="pay_title">活动信息</div>
                            <div class="pay_contentDetail">
                               
                                <ul class="detail_information">
                                    <li>主题：<?php echo $activityInfo['a_title']; ?></li>
                                    <li>活动时间：<?php echo date('Y-m-d',$activityInfo['a_begin_time']); ?>~<?php echo date('Y-m-d',$activityInfo['a_end_time']); ?></li>
                                    <li>活动地点：<?php echo $activityInfo['a_address']; ?></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="content">

                        <div class="baby_detail">
                            <ul class="detail_information">
                                <li class="li_color">支付信息</li>
                                <li>支付金额：￥<?php echo $order['order_price']; ?></li>
                            </ul>

                        </div>

                    </div>

                    <button onclick="callpay()" style="background: #FF4134;border-radius: 15px;color: #FFFFFF;outline: none;font-size: 12px;border: none;width: 40%;height: 30px;margin-top: 30px;margin-left: 30%;">确认支付</button>

                </div>

            </div>

    </body>
    <script type="text/javascript">
    //调用微信JS api 支付
    function onBridgeReady() {
        WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                <?php echo $jsApiParameters; ?>,
                function (res) {
                    if (res.err_msg == "get_brand_wcpay_request:ok") {
                        alert('支付成功');
                        window.location.href = "<?php echo url('mobile/activity/pay_success',['order_sn'=>$order['order_sn']]); ?>"
                    }     // 使用以上方式判断前端返回,微信团队郑重提示:res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                    if (res.err_msg == "get_brand_wcpay_request:cancel") {
                        alert('取消支付');
                        history.back();
                    }
                }
        );
    }

    function callpay() {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
            }
        } else {
            onBridgeReady();
        }
    }
</script>
</html>

