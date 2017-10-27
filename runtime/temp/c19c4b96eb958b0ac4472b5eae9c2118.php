<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"/var/www/html/wanwan/application/mobile/view/activity/detail.html";i:1508125374;s:63:"/var/www/html/wanwan/application/mobile/view/public/footer.html";i:1508125376;}*/ ?>
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
            <h2 style="margin-bottom: 17px;font-size: 16px;text-align: left;margin-left: -0.5%;color: #656565;"><?php echo $activityInfo['a_title']; ?></h2>
            <ul class="information_ul">
                <li><span>活动时间:</span><span><?php echo date('Y.m.d',$activityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$activityInfo['a_end_time']); ?></span></li>
                <li><span>活动地点:</span><span class="max_width"><?php echo $activityInfo['a_address']; ?></span></li>
                <li class="last"><span>活动金额:</span>
                    <ul class="time_ul">
                        <li><span>大人:<b style="color: #656565;margin-left: 14%;">￥</b><b class="aldut_price" style="color: #656565;"><?php echo $activityInfo['a_adult_price']; ?></b></span></li>
                        <li><span>小孩:<b style="color: #656565;margin-left: 14%;">￥</b><b class="child_price" style="color: #656565;"><?php echo $activityInfo['a_child_price']; ?></b></span></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="theme_info">
            <?php if(empty($isCollection) || (($isCollection instanceof \think\Collection || $isCollection instanceof \think\Paginator ) && $isCollection->isEmpty())): ?>
            <span class="collect" aid="<?php echo $activityInfo['aid']; ?>">收藏</span>
            <?php else: ?>
            <span class="collect" aid="<?php echo $activityInfo['aid']; ?>">已收藏</span>
            <?php endif; ?>
            <span><a href="javascript:;" class="i_want">我要报名</a></span>
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
                        <li><?php echo $activityInfo['a_remark']; ?></li>
                        <li>活动时间：<?php echo date('Y.m.d',$activityInfo['a_begin_time']); ?>-<?php echo date('Y.m.d',$activityInfo['a_end_time']); ?></li>
                    </ul>
                </div>
            </div>

            <div class="activity_address">
                <p>活动地点</p>
                <div class="address"><?php echo $activityInfo['a_address']; ?></div>
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
            <button type="submit" class="my_name">我要报名</button>

        </div>
    </form>
</div>

<!--活动内容-->
<div class="detailActivity">
    <div class="dot"></div>
    <h3>活动内容</h3>
    <div class="activity_parts">
        <?php if(is_array($extensionInfo) || $extensionInfo instanceof \think\Collection || $extensionInfo instanceof \think\Paginator): if( count($extensionInfo)==0 ) : echo "" ;else: foreach($extensionInfo as $key=>$vo): ?>
        <div class="acyivity_part">
            <div class="activity_imgBorder">
                <!--<div class="img_activity">-->
                    <a href="<?php echo url('mobile/activity/detail_list',['eid'=>$vo['extension_id']]); ?>">
                        <img src="__AdminIMG__/<?php echo $vo['extension_img']; ?>"/>
                    </a>
                <!--</div>-->
            </div>
            <div class="activity_detail">
                <ul>
                    <li><?php echo $vo['extension_title']; ?></li>
                    <li><?php echo subtext($vo['extension_remark'],'40'); ?></li>
                </ul>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<!--玩伴评论-->
<div class="playBaby_content almost">
    <div class="title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">玩伴评论</div>
    </div>
    <div class="discuss_content">
        <?php if(empty($commentInfo) || (($commentInfo instanceof \think\Collection || $commentInfo instanceof \think\Paginator ) && $commentInfo->isEmpty())): ?>
        <div class="nothing"> 暂无评论......</div>
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
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="discuss_more"><a href="<?php echo url('mobile/activity/comments_list',['aid'=>$activityInfo['aid']]); ?>">查看全部</a></div>
        <?php endif; ?>
    </div>
</div>

<!--翫碗答疑
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
<div class="quiz_result_content">
    <div class="result_part">
        <div class="discuss_part" id="discuss_question">
            <div class="discuss_img">
                <img src="__MobileImg__/eye.png" />
            </div>
            <ul>
                <li>王小二</li>
                <li>这个主题的活动特别有意思，也很有意义</li>
                <li>2017.09.25 22:22</li>
            </ul>
        </div>
        <div class="discuss_part" id="discuss_response">
            <div class="discuss_img">
                <img src="__MobileImg__/eye.png" />
            </div>
            <ul>
                <li>王小二</li>
                <li>这个主题的活动特别有意思，也很有意义</li>
                <li>2017.09.25 22:22</li>
            </ul>
        </div>
    </div>

    <div class="result_part">
        <div class="discuss_part" id="discuss_question">
            <div class="discuss_img">
                <img src="__MobileImg__/eye.png" />
            </div>
            <ul>
                <li>王小二</li>
                <li>这个主题的活动特别有意思，也很有意义</li>
                <li>2017.09.25 22:22</li>
            </ul>
        </div>
        <div class="discuss_part" id="discuss_response">
            <div class="discuss_img">
                <img src="__MobileImg__/eye.png" />
            </div>
            <ul>
                <li>王小二</li>
                <li>这个主题的活动特别有意思，也很有意义</li>
                <li>2017.09.25 22:22</li>
            </ul>
        </div>
    </div>
    <div class="result_part">
        <div class="discuss_part" id="discuss_question">
            <div class="discuss_img">
                <img src="__MobileImg__/eye.png" />
            </div>
            <ul>
                <li>王小二</li>
                <li>这个主题的活动特别有意思，也很有意义</li>
                <li>2017.09.25 22:22</li>
            </ul>
        </div>
        <div class="discuss_part" id="discuss_response">
            <div class="discuss_img">
                <img src="__MobileImg__/eye.png" />
            </div>
            <ul>
                <li>王小二</li>
                <li>这个主题的活动特别有意思，也很有意义</li>
                <li>2017.09.25 22:22</li>
            </ul>
        </div>
    </div>
    <div class="discuss_more"><a href="result_more.html">查看全部</a></div>
</div>
提问成功模态框
<div class="modal_box display_none">

    <div class="moal_div">
        提问成功
        <div class="cancel">
            <img src="__MobileImg__/cancel.png" />
        </div>
    </div>
</div>-->
<br><br><br>
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
<script type="text/javascript" src="__MobileJs__/index.js" ></script>
<script>
    $(".freeActivity_content p img").attr("style","width:100%");
</script>
</body>
</html>

