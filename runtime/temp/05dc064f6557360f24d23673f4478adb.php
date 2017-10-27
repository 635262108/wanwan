<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"/var/www/html/wanwan/application/mobile/view/user/index.html";i:1508125377;s:63:"/var/www/html/wanwan/application/mobile/view/public/header.html";i:1508125376;s:60:"/var/www/html/wanwan/application/mobile/view/public/nav.html";i:1508914023;s:63:"/var/www/html/wanwan/application/mobile/view/public/footer.html";i:1508125376;}*/ ?>
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

<?php if(empty(session('userInfo')) || ((session('userInfo') instanceof \think\Collection || session('userInfo') instanceof \think\Paginator ) && session('userInfo')->isEmpty())): ?>
<div class="into_page">
    <span><a href="<?php echo url('mobile/user/login'); ?>">登录</a></span>
    <span><a href="<?php echo url('mobile/user/register'); ?>">注册</a></span>
</div>
<?php endif; ?>
<!--头部图片-->
<div class="textAlign header">
    <div class="header_img">
        <img src="__MobileImg__/logo.png" />
    </div>
</div>
<!--导航栏tab-->
<div class="textAlign nav">
    <ul>
            <li <?php if(\think\Request::instance()->action() == 'new_activity'): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/new_activity'); ?>">首页</a></li>

            <?php if(is_array($title) || $title instanceof \think\Collection || $title instanceof \think\Paginator): if( count($title)==0 ) : echo "" ;else: foreach($title as $key=>$vo): ?>
            <li <?php if(\think\Request::instance()->param('set') == $vo['id']): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/index',['set'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li <?php if(\think\Request::instance()->action() == 'freeplay'): ?>class="play_baby"<?php endif; ?>><a href="<?php echo url('mobile/Activity/freeplay'); ?>">免费玩儿</a></li>
            <li><a href="<?php echo url('mobile/Activity/about'); ?>">关于我们</a></li>
    </ul>
</div>


<!--轮播图-->
<div class="device">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"> <img src="__MobileImg__/lunbo1.jpg"> </div>
            <div class="swiper-slide"> <img src="__MobileImg__/lunbo2.jpg"> </div>
            <div class="swiper-slide"><img src="__MobileImg__/lunbo3.jpg"></div>
        </div>
    </div>
    <div class="pagination"></div>
</div>

<!--玩宝总体内容部分-->
<div class="playBaby_content almost" id="personal_center">
    <div class="title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">会员中心</div>
    </div>
    <div class="content personal_content">
        <div class="baby_img center_img">
            <img src="__HEADICON__/<?php echo $userInfo['headIcon']; ?>" />
        </div>
        <div class="baby_detail">
            <ul>
                <li><?php echo $userInfo['nickname']; ?></li>
                <li><?php echo $userInfo['signature']; ?></li>
                <li>
                    <a href="<?php echo url('mobile/user/my_info'); ?>">
                        <img src="__MobileImg__/emit.png">
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
<!--五官-->
<div class="five_organs almost">
    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">我的活动</div>
    </div>
    <div class="activity_content textAlign">
        <ul class="lis_tab">
            <li class="play_baby li_first">我的活动</li>
            <li>未付款</li>
            <li>已付款</li>
            <li>待评价</li>
            <li>退款/售后</li>
        </ul>
    </div>
    <div class="all_activityContent">
        <!--我的活动开始部分-->
        <div class="my_Activity_content">
            <?php if(is_array($myOrderData) || $myOrderData instanceof \think\Collection || $myOrderData instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($myOrderData) ? array_slice($myOrderData,0,4, true) : $myOrderData->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="my_Activity_big">
                <div class="my_activity_part">
                    <ul>
                        <li>
                            <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                        </li>
                        <li>
                            <p><?php echo $vo['a_title']; ?></p>
                            <p><?php echo date('Y-m-d',$vo['a_begin_time']); ?>--<?php echo date('Y-m-d',$vo['a_end_time']); ?></p>
                            <p><span>套餐：<?php echo $vo['adult_num']; ?>大<?php echo $vo['child_num']; ?>小</span>&nbsp;&nbsp;<span>总计：￥<?php echo $vo['order_price']; ?></span></p>
                        </li>
                        <li>
                            <?php switch($vo['order_status']): case "1":case "4": ?>已参加<?php break; default: ?>未参加
                            <?php endswitch; ?>
                        </li>
                    </ul>
                    <div class="activity_bottom">
                        <?php switch($vo['order_status']): case "1": ?><p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">已完成</a></p><?php break; case "2": ?><p><a href="<?php echo url('mobile/activity/creat_order',['order_sn'=>$vo['order_sn']]); ?>">去付款</a></p><?php break; case "3": ?><p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">待参加</a></p><?php break; case "4": ?><p><a href="<?php echo url('mobile/user/comments_list',['order_sn'=>$vo['order_sn']]); ?>">去评价</a></p><?php break; case "5": ?><p><a href="<?php echo url('mobile/user/refund2',['order_sn'=>$vo['order_sn']]); ?>">退款中</a></p><?php break; case "6": ?><p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">已退款</a></p><?php break; case "7": ?><p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">已请假</a></p><?php break; endswitch; ?>
                    </div>
                </div>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="nothing display_none">
                空空如也~
            </div>
            <div class="activity_more"><a href="<?php echo url('/mobile/user/my_activity',['a'=>1]); ?>">更多</a></div>

        </div>

        <!--我的活动结束部分-->
        <!--未付款开始部分-->
        <div class="my_Activity_content display_none">

            <?php if(is_array($notPay) || $notPay instanceof \think\Collection || $notPay instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($notPay) ? array_slice($notPay,0,4, true) : $notPay->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="my_Activity_big">
                <div class="my_activity_part">
                    <ul>
                        <li>
                            <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                        </li>
                        <li>
                            <p><?php echo $vo['a_title']; ?></p>
                            <p><?php echo date('Y-m-d',$vo['a_begin_time']); ?>--<?php echo date('Y-m-d',$vo['a_end_time']); ?></p>
                            <p><span>套餐：<?php echo $vo['adult_num']; ?>大<?php echo $vo['child_num']; ?>小</span>&nbsp;&nbsp;<span>总计：￥<?php echo $vo['order_price']; ?></span></p>
                        </li>
                        <li>
                            <?php switch($vo['order_status']): case "1":case "4": ?>已参加<?php break; default: ?>未参加
                            <?php endswitch; ?>
                        </li>
                    </ul>
                    <div class="activity_bottom">
                        <p><a href="<?php echo url('mobile/activity/creat_order',['order_sn'=>$vo['order_sn']]); ?>">去付款</a></p>
                        <p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">详情</a></p>
                    </div>
                </div>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="nothing display_none">
                空空如也~
            </div>
            <div class="activity_more"><a href="<?php echo url('/mobile/user/my_activity',['a'=>2]); ?>">更多</a></div>



        </div>

        <!--未付款结束部分-->

        <!--已付款部分-->
        <div class="my_Activity_content display_none">

            <?php if(is_array($havePay) || $havePay instanceof \think\Collection || $havePay instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($havePay) ? array_slice($havePay,0,4, true) : $havePay->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="my_Activity_big">
                <div class="my_activity_part">
                    <ul>
                        <li>
                            <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                        </li>
                        <li>
                            <p><?php echo $vo['a_title']; ?></p>
                            <p><?php echo date('Y-m-d',$vo['a_begin_time']); ?>--<?php echo date('Y-m-d',$vo['a_end_time']); ?></p>
                            <p><span>套餐：<?php echo $vo['adult_num']; ?>大<?php echo $vo['child_num']; ?>小</span>&nbsp;&nbsp;<span>总计：￥<?php echo $vo['order_price']; ?></span></p>
                        </li>
                        <li>
                            <?php switch($vo['order_status']): case "1":case "4": ?>已参加<?php break; default: ?>未参加
                            <?php endswitch; ?>
                        </li>
                    </ul>
                    <div class="activity_bottom">
                        <?php if($vo['order_price'] == 0): ?>
                           <p><a href="<?php echo url('mobile/user/leave_list',['order_sn'=>$vo['order_sn']]); ?>">请假</a></p> 
                        <?php else: ?>
                            <p><a href="<?php echo url('mobile/user/refund',['order_sn'=>$vo['order_sn']]); ?>">退款</a></p>
                        <?php endif; ?>
                        <p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">详情</a></p>
                    </div>
                </div>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="nothing display_none">
                空空如也~
            </div>
            <div class="activity_more"><a href="<?php echo url('/mobile/user/my_activity',['a'=>3]); ?>">更多</a></div>



        </div>
        <!--已付款结束部分-->
        <!--待评价开始部分-->

        <div class="my_Activity_content display_none">

            <?php if(is_array($notEvaluate) || $notEvaluate instanceof \think\Collection || $notEvaluate instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($notEvaluate) ? array_slice($notEvaluate,0,4, true) : $notEvaluate->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="my_Activity_big">
                <div class="my_activity_part">
                    <ul>
                        <li>
                            <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                        </li>
                        <li>
                            <p><?php echo $vo['a_title']; ?></p>
                            <p><?php echo date('Y-m-d',$vo['a_begin_time']); ?>--<?php echo date('Y-m-d',$vo['a_end_time']); ?></p>
                            <p><span>套餐：<?php echo $vo['adult_num']; ?>大<?php echo $vo['child_num']; ?>小</span>&nbsp;&nbsp;<span>总计：￥<?php echo $vo['order_price']; ?></span></p>
                        </li>
                        <li>
                            <?php switch($vo['order_status']): case "1":case "4": ?>已参加<?php break; default: ?>未参加
                            <?php endswitch; ?>
                        </li>
                    </ul>
                    <div class="activity_bottom">
                        <p><a href="<?php echo url('mobile/user/comments_list',['order_sn'=>$vo['order_sn']]); ?>">去评价</a></p>
                        <p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">详情</a></p>
                    </div>
                </div>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="nothing display_none">
                空空如也~
            </div>
            <div class="activity_more"><a href="<?php echo url('/mobile/user/my_activity',['a'=>4]); ?>">更多</a></div>



        </div>
        <!--待评价结束部分-->

        <!--退款售后开始部分-->
        <div class="my_Activity_content display_none">

            <?php if(is_array($afterSale) || $afterSale instanceof \think\Collection || $afterSale instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($afterSale) ? array_slice($afterSale,0,4, true) : $afterSale->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="my_Activity_big">
                <div class="my_activity_part">
                    <ul>
                        <li>
                            <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                        </li>
                        <li>
                            <p><?php echo $vo['a_title']; ?></p>
                            <p><?php echo date('Y-m-d',$vo['a_begin_time']); ?>--<?php echo date('Y-m-d',$vo['a_end_time']); ?></p>
                            <p><span>套餐：<?php echo $vo['adult_num']; ?>大<?php echo $vo['child_num']; ?>小</span>&nbsp;&nbsp;<span>总计：￥<?php echo $vo['order_price']; ?></span></p>
                        </li>
                        <li>
                            <?php switch($vo['order_status']): case "1":case "4": ?>已参加<?php break; default: ?>未参加
                            <?php endswitch; ?>
                        </li>
                    </ul>
                    <div class="activity_bottom">
                        <?php if($vo['order_status'] == 6): ?>
                           <p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">已退款</a></p> 
                        <?php else: ?>
                            <p><a href="<?php echo url('mobile/user/refund2',['order_sn'=>$vo['order_sn']]); ?>">退款中</a></p>
                        <?php endif; ?>
                        <p><a href="<?php echo url('mobile/user/order_detail',['order_sn'=>$vo['order_sn']]); ?>">详情</a></p>
                    </div>
                </div>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="nothing display_none">
                空空如也~
            </div>
            <div class="activity_more"><a href="<?php echo url('/mobile/user/my_activity',['a'=>5]); ?>">更多</a></div>
        </div>
        <!--退款结束部分-->
    </div>

</div>

<!--我的收藏-->
<div class="five_organs almost">
    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">我的收藏</div>
    </div>
    <div class="myActivity_content" id="myComment">
        <div class="myActivity_big">
            <?php if(!(empty($myCollection) || (($myCollection instanceof \think\Collection || $myCollection instanceof \think\Paginator ) && $myCollection->isEmpty()))): if(is_array($myCollection) || $myCollection instanceof \think\Collection || $myCollection instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($myCollection) ? array_slice($myCollection,0,2, true) : $myCollection->slice(0,2, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="activity_part">
                <ul>
                    <li>
                        <img src="__AdminIMG__/<?php echo $vo['a_index_img']; ?>"/>
                    </li>
                    <li>
                        <p><span><?php echo $vo['a_title']; ?></span></p>
                        <!--<p>2017.09.12--2017.09.16</p>-->
                        <p><?php echo $vo['a_remark']; ?></p>
                    </li>
                    <li>
                        <div><span href="javascript:void(0)" aid="<?php echo $vo['aid']; ?>" class="cancel_collect">取消收藏</span></div>
                        <div><a href="<?php echo url('mobile/activity/detail',['aid'=>$vo['aid']]); ?>"  class="sign_up">我要报名</a></div>
                    </li>
                </ul>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>            
        </div>
        <div class="collect_more"><a href="my_collect.html">更多</a></div>
        <?php else: ?>
        <div class="collect_no">
            空空如也~
        </div>
        <?php endif; ?>

    </div>

</div>
<div class="five_organs almost">
<!--    <div class="five_title title_img">
        <img src="__MobileImg__/wan_whole.png"/>
        <div class="playBady_word">我的消息</div>
    </div>
    <div class="message_classfy">
        <div class="order_message common"><a href="<?php echo url('mobile/user/order_message'); ?>">订单消息</a></div>
        <div class="system_message common"><a href="<?php echo url('mobile/user/systems_message'); ?>">系统消息</a></div>
    </div>-->
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

