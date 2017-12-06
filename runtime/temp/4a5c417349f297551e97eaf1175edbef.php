<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\chuangzhixing\wanwan/application/mobile\view\user\comments_list.html";i:1508752767;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1509332403;}*/ ?>
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
     
            <?php if(empty($url) || (($url instanceof \think\Collection || $url instanceof \think\Paginator ) && $url->isEmpty())): ?>
                <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/second_back.png"/></a>
            <?php else: ?>
                <a href="<?php echo $url; ?>"><img src="__MobileImg__/second_back.png"/></a>
            <?php endif; ?>
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

<!--头部导航-->
<!--<div class="comeback textAlign" id="second_page">
	<div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
		<div class="comeback_img">
			<img src="__MobileImg__/second_back.png"/>
		</div>

	</div>

	<div class="title_word second_activity">填写评论</div>

</div>-->
   <!--玩宝总体内容部分-->
  <div class="playBaby_content almost">
  	  <div class="title title_img">
  	  	  <img src="__MobileImg__/wan_whole.png"/>
  	  	  <div class="playBady_word">评论</div>
  	  </div>
  	  <div  id="commit_content">
  	  	   <form action="" method="post">
  	  	   	   <textarea class="commit_content" name="comment"></textarea>
                           <p class="commit_erro" style="font-size: 15px;color: #ff4314;text-align: center;margin-top: 5px;display: none">评论不能为空</p>
  	  	   	   <button type="submit" class="commit_submit">提交</button>
  	  	   </form>
  	  </div>
  </div>
  
		<script src="__MobileJs__/jquery.min.js"></script>
	</body>
        <script>
        //点击提交评论
        $(".commit_submit").on("click",function(){
                if($(".commit_content").val()==""){
                        $(".commit_erro").show();
                        return false;
                }
                else{
                    var aid = "<?php echo $order_info['aid']; ?>";
                    var osn = "<?php echo $order_info['order_sn']; ?>";
                    var com = $(".commit_content").val();
                    $.post("/home/user/comments",{ aid:aid,comment:com,order_sn:osn},
                    function(obj){
                        if(obj.state_code != 200){
                            alert(obj.msg);
                        }else{
                            alert("提交成功");
                            window.location.href = '/mobile/user/index';
                        }
                    }, "json");
                }
                return false;
        })


        $(".commit_content").on("blur",function(){
                if($(this).val()==""){
                        $(".commit_erro").show();
                        return false;
                }
                else{
                        $(".commit_erro").hide();
                }
        })
            </script>
</html>



