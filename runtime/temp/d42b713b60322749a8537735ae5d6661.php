<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\chuangzhixing\wanwan/application/mobile\view\user\my_activity.html";i:1508752767;s:66:"D:\chuangzhixing\wanwan/application/mobile\view\public\header.html";i:1508318472;s:73:"D:\chuangzhixing\wanwan/application/mobile\view\public\second_header.html";i:1508840840;}*/ ?>
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
    <div class="click_stroggle">
    	<a href="<?php echo url('mobile/user/index'); ?>"><img src="__MobileImg__/dot_img.png" /></a>
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

<!--头部导航-->
<!--<div class="comeback textAlign" id="second_page">
    <div class="comeback_whole" onclick="javascript:window.history.back(-1);" >
        <div class="comeback_img">
            <img src="__MobileImg__/second_back.png"/>
        </div>

    </div>

    <div class="title_word second_activity">全部活动</div>

</div>-->
</div>
<!--五官-->
<div class="five_organs almost">
    <div class="activity_content textAlign">
        <ul class="lis_tab">
            <li <?php if(\think\Request::instance()->param('a') == 1): ?>class="play_baby"<?php endif; ?>>我的活动</li>
            <li <?php if(\think\Request::instance()->param('a') == 2): ?>class="play_baby"<?php endif; ?>>未付款</li>
            <li <?php if(\think\Request::instance()->param('a') == 3): ?>class="play_baby"<?php endif; ?>>已付款</li>
            <li <?php if(\think\Request::instance()->param('a') == 4): ?>class="play_baby"<?php endif; ?>>待评价</li>
            <li <?php if(\think\Request::instance()->param('a') == 5): ?>class="play_baby"<?php endif; ?>>退款/售后</li>
        </ul>
    </div>
    <div class="all_activityContent">
        <!--我的活动开始部分-->
        <div class="my_Activity_content" <?php if(\think\Request::instance()->param('a') != 1): ?>style="display:none;"<?php endif; ?>>
            <?php if(is_array($myOrderData) || $myOrderData instanceof \think\Collection || $myOrderData instanceof \think\Paginator): if( count($myOrderData)==0 ) : echo "" ;else: foreach($myOrderData as $key=>$vo): ?>
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
        </div>

        <!--我的活动结束部分-->
        <!--未付款开始部分-->
        <div class="my_Activity_content" <?php if(\think\Request::instance()->param('a') != 2): ?>style="display:none;"<?php endif; ?>>

            <?php if(is_array($notPay) || $notPay instanceof \think\Collection || $notPay instanceof \think\Paginator): if( count($notPay)==0 ) : echo "" ;else: foreach($notPay as $key=>$vo): ?>
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


        </div>

        <!--未付款结束部分-->

        <!--已付款部分-->
        <div class="my_Activity_content" <?php if(\think\Request::instance()->param('a') != 3): ?>style="display:none;"<?php endif; ?>>

            <?php if(is_array($havePay) || $havePay instanceof \think\Collection || $havePay instanceof \think\Paginator): if( count($havePay)==0 ) : echo "" ;else: foreach($havePay as $key=>$vo): ?>
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


        </div>
        <!--已付款结束部分-->
        <!--待评价开始部分-->

        <div class="my_Activity_content" <?php if(\think\Request::instance()->param('a') != 4): ?>style="display:none;"<?php endif; ?>>

            <?php if(is_array($notEvaluate) || $notEvaluate instanceof \think\Collection || $notEvaluate instanceof \think\Paginator): if( count($notEvaluate)==0 ) : echo "" ;else: foreach($notEvaluate as $key=>$vo): ?>
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


        </div>
        <!--待评价结束部分-->

        <!--退款售后开始部分-->
        <div class="my_Activity_content" <?php if(\think\Request::instance()->param('a') != 5): ?>style="display:none;"<?php endif; ?>>

            <?php if(is_array($afterSale) || $afterSale instanceof \think\Collection || $afterSale instanceof \think\Paginator): if( count($afterSale)==0 ) : echo "" ;else: foreach($afterSale as $key=>$vo): ?>
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
        </div>
        <!--退款结束部分-->
    </div>

</div>


<script src="__MobileJs__/jquery.min.js"></script>
<script src="__MobileJs__/idangerous.swiper.min.js"></script>
<script src="__MobileJs__/jquery.bxslider.js"></script>
<script type="text/javascript" src="__MobileJs__/index.js" ></script>
</body>
</html>

