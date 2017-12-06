<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\chuangzhixing\wanwan/application/mobile\view\activity\free_detail.html";i:1511430028;}*/ ?>
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
    <link rel="stylesheet" href="__MobileCss__/idangerous.swiper.css" />
    <link rel="stylesheet" href="__MobileCss__/jquery.bxslider.css"/>
</head>
<body style="background: #f6f6f6;">
<!--返回-->
<div class="three_img">
    <a onclick="javascript:window.history.back(-1);"><img src="__MobileImg__/third_back.png" /></a>
</div>
        <!--玩翫碗信息-->
<div class="playBaby_content almost" id="free_content">
        <div class="content" id="theme_information">

            <div class="baby_img" id="free_eyeImg">
                <img src="__AdminIMG__/<?php echo $activityInfo['a_index_img']; ?>" />
            </div>
            <div class="baby_detail" id="bady_detail">
                <h2 style="margin-bottom: 17px;font-size: 16px;text-align: left;margin-left: -0.5%;color: #656565;font-weight: 500;"><?php echo $activityInfo['a_title']; ?></h2>
                <ul class="information_ul" id="freeActivity">

                    <li style="display: none;"><span>活动时间:</span><span><?php echo date('Y.m.d',$activityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$activityInfo['a_end_time']); ?></span></li>
                    <li><span>活动年龄:</span><span class="max_width">5~11岁</span></li>
                    <li class="special_between"><span>活动名额:</span><span><?php echo $activityInfo['a_num']; ?></span></li>
                    <li><span>活动地点:</span><span><?php echo $activityInfo['a_address']; ?></span></li>
                    <li><span>活动人员:</span>
                        <ul class="time_ul">
                            <li><span>大人:<b style="color: #656565;margin-left: 14%;">￥</b><b class="aldut_price" style="color: #656565;">0.00</b></span></li>
                            <li><span>小孩:<b style="color: #656565;margin-left: 14%;">￥</b><b class="aldut_price" style="color: #656565;">0.00</b></span></li>
                        </ul>
                    </li>
                     <li class="select_time" style="color: #656565;">选择&nbsp;&nbsp;&nbsp;活动时间</li>
                </ul>
            </div>
            <div class="theme_info">
                <?php if(empty($isCollection) || (($isCollection instanceof \think\Collection || $isCollection instanceof \think\Paginator ) && $isCollection->isEmpty())): ?>
                <span class="collect" aid="<?php echo $activityInfo['aid']; ?>">收藏</span>
                <?php else: ?>
                <span class="collect" aid="<?php echo $activityInfo['aid']; ?>">已收藏</span>
                <?php endif; if($activityInfo['a_num'] <= 0): ?>
                <span><a href="javascript:;" class="">已售完</a></span>
                <?php elseif($activityInfo['a_end_time'] > time()): ?>
                <span><a href="javascript:;" class="i_want">我要报名</a></span>
                <?php else: ?>
                <span><a href="javascript:;" class="">活动结束</a></span>
                <?php endif; ?>

            </div>

        </div>
</div>
<!--点击我要报名-->
<div id="theme_modal_box">
    <form method="get" action="<?php echo url('mobile/activity/activity_sure'); ?>">
        <input type="hidden" name="aid" value="<?php echo $activityInfo['aid']; ?>"/>
        <div class="moal_div">
            <div class="modal_detail">
                <div class="detail_img">
                    <img src="__MobileImg__/eye.png" />
                </div>
                <div class="detail_ul">
                    <ul>
                        <li><?php echo $activityInfo['a_title']; ?></li>
                        <li><?php echo $activityInfo['a_address']; ?></li>
                        <li>活动时间：<?php echo date('Y.m.d',$activityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$activityInfo['a_end_time']); ?></li>
                    </ul>
                </div>
            </div>
            <div class="activity_address">
                <p>活动时间</p >
               <ul class="select_paytime">
                    <?php if(is_array($timeInfo) || $timeInfo instanceof \think\Collection || $timeInfo instanceof \think\Paginator): if( count($timeInfo)==0 ) : echo "" ;else: foreach($timeInfo as $key=>$vo): ?>
                    <li><input type="radio" name="time" value="<?php echo $vo['t_id']; ?>" ><?php echo $vo['t_content']; ?><span style="display: none;"><?php echo $vo['ticket_num']; ?></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>

            <div class="pay_total">
                <p>总计：<b>￥</b><b class="total_num">0.00</b></p>
                <ul class="time_ul">
                    <li><span>大人:<b>￥</b><b class="prompt_aldut_price">0.00</b></span>
                        <div class="reduce_plus">
                            <span class="prompt_adult_reduce">-</span><input type="text" name="adult_num" value="1" class="prompt_adult_val"><span class="plus prompt_adult_plus">+</span>
                        </div>

                    </li>
                    <li><span>小孩:<b>￥</b><b class="prompt_child_price">0.00</b></span>
                        <div class="reduce_plus">
                            <span class="prompt_child_reduce">-</span><input type="text" name="child_num" value="1" class="prompt_child_val"><span  class="plus prompt_child_plus">+</span>
                        </div>
                    </li>
                </ul>
            </div>
            <button type="submit" id="sub_sign" class="my_name">我要报名</button>

        </div>
    </form>
</div>

<div class="pay_ul">
	 <ul>
	 	<li class="special">活动详情</li>
	 	<li>玩伴评论</li>
	 </ul>
</div>

        <!--活动详情-->
        <div class="pay_content">
   
        <div class="freeActivity_content">
            <?php echo $activityInfo['a_content']; ?>
        </div>

        <!--玩伴评论-->
        <div class="playBaby_content almost" id="free_discuss" style="display: none;">
            <h1>#评论</h1>
            <div class="discuss_content">
                <?php if(empty($commentInfo) || (($commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator ) && $commentInfo->isEmpty())): ?>
                <div class="free_no"> 暂无评论......</div>
                <?php else: if(is_array($commentInfo) || $commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator): if( count($commentInfo)==0 ) : echo "" ;else: foreach($commentInfo as $key=>$vo): ?>
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
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </div>
           
        </div>
	</div>

        <script src="__MobileJs__/jquery.min.js"></script>
        <script src="__MobileJs__/idangerous.swiper.min.js"></script>
        <script src="__MobileJs__/jquery.bxslider.js"></script>
        <script type="text/javascript" src="__MobileJs__/index.js" ></script>
    </body>
    <script>
        $("#sub_sign").click(function(){
            var time = $("input[type='radio']:checked").val();
            if (time == undefined) {
                alert('请选择时间')
                return false;
            }
        });
        $(".freeActivity_content p img").attr("style","width:100%");
    </script>
</html>

