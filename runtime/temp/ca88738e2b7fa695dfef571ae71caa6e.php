<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\activity\about.html";i:1508740909;s:91:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\public\second_header.html";i:1508737887;s:84:"D:\phpStudy\PHPTutorial\WWW\wanwan\wanwan/application/mobile\view\public\footer.html";i:1508309656;}*/ ?>

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

    <div class="title_word second_activity"> <?php echo $titleInfo['name']; ?></div>
    <div class="click_stroggle">
    	<a href="javascript:;"><img src="__MobileImg__/dot_img.png" /></a>
    </div>
    
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


<!--玩宝总体内容部分-->
<div class="playBaby_content almost">
    <div class="title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">玩翫碗</div>
    </div>
    <div class="wanwanContent">
        <div>玩翫碗，致力于通过不一样的玩，</div>
        <div>让孩子像沐浴在日光下的小鸟一样，通过欢快的玩耍练习，探</div>
        <div>索世界，从而了解事物本来的样子。在自得其乐中，成为她自</div>
        <div>己，拥有属于自己的生活方式，获得满足与愉悦。</div>
    </div>
</div>
<!--五官-->
<div class="five_organs almost">
    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">WAN体系</div>
    </div>
    <div class="wanwan_imgContent">

        <img src="__MobileImg__/wan_system.png"/>



    </div>
</div>


<div class="detailActivity" id="system_content">
    <div class="dot"></div>
    <h3>体系介绍</h3>
    <div class="system_part" style="border-left:3px solid rgb(244,159,30) ;">
        <div class="system_img">
            <img src="__MobileImg__/playBao_white.png" />
        </div>
        <ul>
            <li>释义：宝：代表孩子自己也代表孩子们的玩伴-玩宝,让孩子们了解自身</li>
            <li>内容：神奇的自我：五官/四肢/整体/性启蒙/心理</li>
        </ul>
    </div>

    <div class="system_part" style="border-left:3px solid rgb(49,186,254) ;">
        <div class="system_img">
            <img src="__MobileImg__/playjia_white.png" />
        </div>
        <ul>
            <li>释义：家：家庭中和孩子紧密相关的衣食住行、基础社交</li>
            <li>内容：幸福的家庭:吃穿住用/家庭</li>
        </ul>
    </div>

    <div class="system_part" style="border-left:3px solid rgb(13,85,97) ;">
        <div class="system_img">
            <img src="__MobileImg__/playke_white.png" />
        </div>
        <ul>
            <li>释义：客：与“主”相对代表走出去，探索外面的世界、</li>
            <li>内容：美丽的世界：公园/城市/动植物/生态/生存</li>
        </ul>
    </div>

    <div class="system_part" style="border-left:3px solid rgb(255,65,53) ;">
        <div class="system_img">
            <img src="__MobileImg__/playjiang_white.png" />
        </div>
        <ul>
            <li>释义：匠：代表熟练的技能在不断练习的过程中，熟能生巧</li>
            <li>内容：奇妙的技能：技能训练营</li>
        </ul>
    </div>

    <div class="system_part" style="border-left:3px solid rgb(255,217,29) ;">
        <div class="system_img">
            <img src="__MobileImg__/playda_white.png" />
        </div>
        <ul>
            <li>释义：大：代表大规模、大手笔，涵盖内容多，也代表思想自由</li>
            <li>内容：璀璨的文明：丝绸之路/豫见中原/君子六艺</li>
        </ul>
    </div>

</div>


<div class="bottom">
    <!--<div class="erweima"></div>-->
    <div class="bottom_title">
        <ul>
            <li><a href="<?php echo url('mobile/user/user'); ?>">会员条款</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/disclaimer'); ?>">免责声明</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/copy'); ?>">版权声明</a></li>
            <li class="line">|</li>
            <li><a href="<?php echo url('mobile/user/privacy'); ?>">隐私保护</a></li>
            <li class="line">|</li>
            <li><a href="#">投诉建议</a></li>
        </ul>
        <div class="tel">联系方式：400-611-2731</div>
    </div>
</div>

<div class="copyright">
    <div class="first">Copyright©版权所有河南创致行企业管理咨询有限公司 (2017-2037)</div>
    <div class="second">豫ICP备13007531号-1</div>
</div>
<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<script src="__MobileJs__/jquery.bxslider.js"></script>
<script type="text/javascript" src="__MobileJs__/index.js" ></script>
<script>
    var mySwiper = new Swiper('.swiper-container',{

        // 自动轮播
        autoplay:2000,
        autoHeight:true,
        // 分页容器
        pagination: '.pagination',
        grabCursor: true,
        paginationElement : 'li'
    })

</script>
</body>
</html>

