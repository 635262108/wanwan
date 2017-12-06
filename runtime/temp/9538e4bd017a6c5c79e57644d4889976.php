<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\chuangzhixing\wanwan/application/mobile\view\activity\detail.html";i:1512477371;}*/ ?>
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
<body>
<!--返回按钮-->
<div class="three_img">
    <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/third_back.png" /></a>
</div>

<!--玩翫碗信息-->
<div class="playBaby_content almost" id="theme_information_content">
    <div class="content" id="theme_information">
        <div class="baby_img">
            <img src="__AdminIMG__/<?php echo $activityInfo['a_img']; ?>" />
        </div>
        <div class="baby_detail">
            <h2 style="margin-bottom: 17px;font-size: 16px;text-align: left;margin-left: 0.5%;color: #656565;font-weight: 500;"><?php echo $activityInfo['a_title']; ?></h2>
            <ul class="information_ul">
                <li style="display: none;"><span>活动时间:</span><span><?php echo date('Y.m.d',$activityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$activityInfo['a_end_time']); ?></span></li>
                <li><span style="height: 32px;">活动地点:</span><span class="max_width"><?php echo $activityInfo['a_address']; ?></span></li>
                <li class="last"><span>活动金额:</span>
                    <ul class="time_ul">
                        <li><span>大人:<b style="color: #656565;margin-left: 14%;">￥</b><b class="aldut_price" style="color: #656565;"><?php echo $activityInfo['a_adult_price']; ?></b></span></li>
                        <li><span>小孩:<b style="color: #656565;margin-left: 14%;">￥</b><b class="child_price" style="color: #656565;"><?php echo $activityInfo['a_child_price']; ?></b></span></li>
                    </ul>
                </li>
                <li class="select_time" style="color: #656565;margin-left: -8px;padding-left: 10px;">选择&nbsp;&nbsp;&nbsp;活动时间
                	 <img src="__MobileImg__/dayu.png"  style="width:6px;height:11px;margin-left:65%;"></li>
            </ul>
        </div>
    </div>
</div>

<!--点击我要报名-->
<div id="theme_modal_box">
    <form method="get" action="<?php echo url('activity/add_order'); ?>">
        <?php echo token('code'); ?>
        <input type="hidden" name="aid" value="<?php echo $activityInfo['aid']; ?>"/>
        <div class="moal_div">
            <div class="modal_detail">
                <div class="detail_img">
                    <img src="__AdminIMG__/<?php echo $activityInfo['a_img']; ?>" />
                </div>
                <div class="detail_ul">
                    <ul>
                        <li><?php echo $activityInfo['a_title']; ?></li>
                        <li><?php echo $activityInfo['a_remark']; ?></li>
                        <li>活动地点:<?php echo $activityInfo['a_address']; ?></li>
                        <!--<li>活动时间：<?php echo date('Y.m.d',$activityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$activityInfo['a_end_time']); ?></li>-->
                    </ul>
                </div>
            </div>

            <div class="activity_address">
                <p>活动时间</p >
                <ul class="select_paytime">
                    <?php if(is_array($timeInfo) || $timeInfo instanceof \think\Collection || $timeInfo instanceof \think\Paginator): if( count($timeInfo)==0 ) : echo "" ;else: foreach($timeInfo as $key=>$vo): ?>
                    <li><input type="radio" name="time" value="<?php echo $vo['t_id']; ?>" ><?php echo $vo['begin_time']; ?>-<?php echo $vo['end_time']; ?><span style="display: none;"><?php echo $vo['ticket_num']; ?></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            
            <div class="pay_total">
                <p>总计：<b>￥</b><b class="total">0.02</b></p>
                <ul class="time_ul">
                    <li><span>大人:<b>￥</b><b class="prompt_aldut_price"><?php echo $activityInfo['a_adult_price']; ?></b></span>
                        <div class="reduce_plus">
                            <span class="prompt_adult_reduce">-</span><input name="adult_num" type="text"  value="1" class="prompt_adult_val"><span class="plus prompt_adult_plus">+</span>
                        </div>

                    </li>
                    <li><span>小孩:<b>￥</b><b class="prompt_child_price"><?php echo $activityInfo['a_child_price']; ?></b></span>
                        <div class="reduce_plus">
                            <span class="prompt_child_reduce">-</span><input type="text" name="child_num" value="1" class="prompt_child_val"><span  class="plus prompt_child_plus">+</span>
                        </div>
                    </li>
                </ul>
            </div>
             <?php if($activityInfo['a_end_time'] > time()): ?>
                  <button type="submit" class="my_name">我要报名</button>
                  <?php else: ?>
                    <button type="submit" class="my_name" style="color: #656565;background: #C0C0C0;">活动结束</button>
             <?php endif; ?>
       

        </div>
    </form>
</div>
<div class="pay_ul">
	 <ul>
	 	<li class="special">活动详情</li>
	 	<li>玩伴评论</li>
	 </ul>
</div>

<!--活动内容-->
<div class="pay_content">
	

<div class="detailActivity">
    <!--<div class="activity_parts">
    	
        <?php if(is_array($extensionInfo) || $extensionInfo instanceof \think\Collection || $extensionInfo instanceof \think\Paginator): if( count($extensionInfo)==0 ) : echo "" ;else: foreach($extensionInfo as $key=>$vo): ?>
       <a href="<?php echo url('mobile/activity/detail_list',['eid'=>$vo['extension_id']]); ?>">
        <div class="acyivity_part">
            <div class="activity_imgBorder">

                        <img src="__AdminIMG__/<?php echo $vo['extension_img']; ?>"/>

            </div>
            <div class="activity_detail">
                <ul>
                    <li><?php echo $vo['extension_title']; ?></li>
                    <li><?php echo subtext($vo['extension_remark'],'40'); ?></li>
                </ul>
            </div>
        </div>
          </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      
    </div>-->
    <?php echo $activityInfo['a_content']; ?>
</div>

<!--玩伴评论-->
<div class="playBaby_content almost" style="display: none;">
    <div class="discuss_content">
        <?php if(empty($commentInfo) || (($commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator ) && $commentInfo->isEmpty())): ?>
        <div class="nothing"> 暂无评论......</div>
        <?php else: if(is_array($commentInfo) || $commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator): if( count($commentInfo)==0 ) : echo "" ;else: foreach($commentInfo as $key=>$vo): ?>
        <div class="line_bottom" style="background: #FFFFFF;">
        	
        
        <div class="discuss_part">
            <div class="discuss_img">
                <img src="__HEADICON__/<?php echo $vo['headIcon']; ?>" />
            </div>
            <ul>
                <li><?php echo $vo['nickname']; ?></li>
                <li><?php echo htmlentities($vo['content']); ?></li>
                <li><?php echo date('Y.m.d H:i',$vo['time']); ?></li>
            </ul>
        </div>
        <div class="line_border" style="border-bottom:1px solid #dfdbdb;height: 1px;width: 75%;margin-left: 25%;"></div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <!--<div class="discuss_more"><a href="<?php echo url('mobile/activity/comments_list',['aid'=>$activityInfo['aid']]); ?>">查看全部</a></div>-->
        <?php endif; ?>
    </div>
</div>

</div>
<!--
<div class="playBaby_content almost">
    <div class="title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">玩翫答疑</div>
    </div>
    <div class="quiz_content">
        <form action="" method="post">
            <textarea name="quiz" value="这个主题活动特别好" class="quiz"></textarea>
            <p class="quiz_warn" style="color: #FF4134;font-size: 12px;text-align: center;display: none;">提问不能为空</p>
            <button type="submit" class="my_quiz"><span><img src="__MobileImg__/quiz.png"></span><span>我要提问</span></button>
        </form>
    </div>
</div>
<div class="playBaby_content almost">
    <div class="title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">玩翫答疑</div>
    </div>
    <div class="quiz_content">
        <form action="" method="post">
            <textarea name="quiz" value="这个主题活动特别好" class="quiz"></textarea>
            <p class="quiz_warn" style="color: #FF4134;font-size: 12px;text-align: center;display: none;">提问不能为空</p>
            <button type="submit" class="my_quiz"><span><img src="__MobileImg__/quiz.png"></span><span>我要提问</span></button>
        </form>
    </div>
</div>-->



    <div class="bottom_info">
            <?php if(empty($isCollection) || (($isCollection instanceof \think\Collection || $isCollection instanceof \think\Paginator ) && $isCollection->isEmpty())): ?>
            <span class="collect" aid="<?php echo $activityInfo['aid']; ?>">收藏</span>
            <?php else: ?>
            <span class="collect" aid="<?php echo $activityInfo['aid']; ?>" style="border:1px solid #FF4134 ;">已收藏</span>
            <?php endif; if($activityInfo['a_end_time'] > time()): ?>
             <span><a href="javascript:;" class="i_want" class="activity_over">我要报名</a></span>
             <?php else: ?>
                <span style="color: #656565;background: #C0C0C0;" class="activity_over"><a href="javascript:;" class="i_want" class="activity_over">活动结束</a></span>
            <?php endif; ?>
            
    </div>


<script src="__MobileJs__/jquery.min.js"></script>
<script type="text/javascript" src="__MobileJs__/index.js" ></script>
 <script>
        $(".my_name").click(function(){
            var time = $("input[type='radio']:checked").val();
            var adult_num = $(".prompt_adult_val").val();
            var child_num = $(".prompt_child_val").val();
            var sum = adult_num + child_num;
            if(sum == 0){
                alert('数量不能为0')
                return false;
            }
            if (time == undefined) {
                alert('请选择时间')
                return false;
            }
        });
        $(".detailActivity p img").attr("style","width:100%");
    </script>
</body>
</html>

