<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\chuangzhixing\wanwan/application/mobile\view\activity\sign_fail.html";i:1508318472;}*/ ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <style type="text/css">
            * {
                padding: 0;
                margin: 0;
            }

            body {
                background-color: #eaeeef;
                border: 10px solid #eaeeef;
                height: 100%;
                overflow: hidden;
                font-family: "微软雅黑";
            }

            input[type="button"],
            input[type="submit"],
            input[type="reset"] {
                -webkit-appearance: none;
            }
            .qian_top img {
                width: 100%;
                display: block;
            }
            .qian_content {
                background-color: white;
                width: 100%-2px;
                /*height: 400px;*/
                font-size: 24px;
                overflow: hidden;
                border-bottom: 1px solid #bfbfbf;
                border-left: 1px solid #bfbfbf;
                border-right: 1px solid #bfbfbf;
            }
            .succ_title {
                text-align: center;
                margin-top: 20px;
                color: #ff4134;
                font-weight: 600;
                font-size: 16px;
            }.succ_img{
                text-align: center;
            }
            .huanying{
                padding-bottom: 30px;
                text-align: center;
                font-size: 13px;
                color: #aaaaaa;
                margin-top: 8px;
            }
            @media screen and (max-width:321px) {
                .succ_title{
                    font-size: 15px;
                }
            }
            @media screen and (min-width:321px) and (max-width:400px) {
                .succ_title {
                    font-size: 17px;
                }
            }

            @media screen and (min-width:400px) {
                .succ_title{
                    font-size: 19px
                }
            }
        </style>
    </head>

    <body>
        <div class="qian_top">
            <img src="__MobileImg__/qiandao_top.png" />
        </div>
        <div class="qian_content">
            <div class="succ_title">
                签到失败<br>玩宝没有发现您的报名信息
            </div>
            <div class="succ_img">
                <img src="__MobileImg__/cha.png"/>
            </div>
            <div class="huanying">
                如有疑问，请与现场工作人员联系~~
            </div>
        </div>
        <script type="text/javascript">
            window.onload = function() {
                document.documentElement.style.fontSize = document.documentElement.clientWidth / 6.4 + 'px';
            }
        </script>
    </body>

</html>