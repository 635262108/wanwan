$(function(){

    //大人的加
    
    var time_lis=$(".select_paytime").children();
    time_lis.on("click",function(){
    	$(this).addClass("time_special").siblings().removeClass("time_special");
    	
    	
    })
    
    time_lis.each(function(){
    	if($(this).children("span").html()==0){
    		$(this).css({"background":"#f0f0f0","color":"#b7b5b5"});
    		$(this).off("click");
    		$(this).children("input").attr("readonly",true);
    	}
    })
   


    var adult_price=parseFloat($(".prompt_aldut_price").text());
  
    var child_price=parseFloat($(".prompt_child_price").text());
	
    var adult_num=parseFloat($(".prompt_adult_val").val());
   
    var child_num=parseFloat($(".prompt_child_val").val());
   
    
//  初始化总计
 $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));

//大人的加法
    $(".prompt_adult_plus").on("click",function(event){
        event.stopPropagation();
        adult_num++;
        $(".prompt_adult_val").val(adult_num);
        $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));
        if(adult_num>=2){
            adult_num=2;
            $(".prompt_adult_val").val(adult_num);
            var aldutPrice=adult_num*adult_price;
            var childPrice=child_num*child_price;
           	var Total=(aldutPrice+childPrice).toFixed(2)
         
            $(".total").text(Total);
        }

    })

//大人的减法
    $(".prompt_adult_reduce").on("click",function(event){
        event.stopPropagation();
        adult_num--;
        $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));
        $(".prompt_adult_val").val(adult_num);
        if(adult_num<=0){
            adult_num=0;
            $(".prompt_adult_val").val(adult_num);
             var aldutPrice=adult_num*adult_price;
             var childPrice=child_num*child_price;
           	 var Total=(aldutPrice+childPrice).toFixed(2)
         	 $(".total").text(Total);
         
        }
    })

//孩子的加法
    $(".prompt_child_plus").on("click",function(event){
        event.stopPropagation();
        child_num++;
        $(".prompt_child_val").val(child_num);

        $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));
        if(child_num>=2){
            child_num=2;
            $(".prompt_child_val").val(child_num);
            $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));
        }
    })

//孩子的减法
    $(".prompt_child_reduce").on("click",function(event){
        event.stopPropagation();
        child_num--;
        $(".prompt_child_val").val(child_num);
        $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));
        if(child_num<=0){
            child_num=0;
            $(".prompt_child_val").val(child_num);
            $(".total").text((adult_num*adult_price+child_num*child_price).toFixed(2));
        }
    })


//我要报名操作

    $(".i_want").on("click",function(){
    	 $("#theme_modal_box").show();
         $(".moal_div").animate({"bottom":"0px"},200);
//  $.post("/mobile/user/check_login",
//          function(obj){
//          	console.log(obj,000)
//              if(obj.state_code == 200){
//                 $("#theme_modal_box").show();
//      		   $(".moal_div").animate({"bottom":"0px"},200);
//              }else{
//              	
//                  location.href=obj.data.url;
//              }
//          }, "json");
       


    })
    
    //如果显示活动结束则不能点击
		var activityOver=$(".activity_over").text();
		if(activityOver=="活动结束"){
			$(".i_want").off("click");
		}
    
    $(".select_time").on("click",function(){
//  	    $.post("/mobile/user/check_login",
//          function(obj){
//              if(obj.state_code == 200){
//                 $("#theme_modal_box").show();
//      		   $(".moal_div").animate({"bottom":"0px"},200);
//              }else{
//                 location.href=obj.data.url;
//              }
//          }, "json");
    	 $("#theme_modal_box").show();
         $(".moal_div").animate({"bottom":"0px"},200);

    })
//  活动选择时间
    var pay_details=$(".pay_ul ul").children();
    var pay_Contents=$(".pay_content").children();
    pay_details.on("click",function(){
    	$(this).addClass("special").siblings().removeClass("special");
    	pay_Contents.eq($(this).index()).show().siblings().hide();
    })
//  监听滚轮事件
// $(window).scroll(function(event){
// 	var distance=$(this).scrollTop();
//   if(distance>=418){
//   	console.log('到了');
//   	$(".bottom_info").show();
//   }
//   else{
//   	$(".bottom_info").hide();
//   }
// })

//模态框的操作
    $("#theme_modal_box").on("click",function(){
        $("#theme_modal_box").hide();
        $(".moal_div").animate({"bottom":"-100%"},200);

    })

    $(".moal_div").on("click",function(event){
        event.stopPropagation();
    })
 //收藏
$(".collect").on("click",function(){
     var aid = $(this).attr('aid');
     var _this = $(this);
     if($(this).text()=="已收藏"){
         $.post("/home/activity/collection",{ aid:aid,type:2},
            function(obj){
                if(obj.state_code != 200){
                    alert(obj.msg);
                    return false;
                }else{
                    _this.text("收藏");
                }
            }, "json");
       }
     else{
        $.post("/home/activity/collection",{ aid:aid,type:1},
            function(obj){
                if(obj.state_code != 200){
                    alert(obj.msg);
                    return false;
                }else{
                    _this.text("已收藏");
                }
            }, "json");
       }
  })

//选择时间

  
  
    //会员中心(我的活动tab栏转换)
    var lis = $(".lis_tab").children();
    var contents = $(".all_activityContent").children();


    lis.on("click", function() {
        var index = $(this).index();
        $(this).addClass("play_baby").siblings("li").removeClass("play_baby");
        contents.eq(index).css("display", "block").siblings().css("display", "none");
        var activityParts = contents.eq(index).children(".my_Activity_big");


        if (activityParts.length > 0) {

            $(".activity_more").show();
            $(".no_style").hide();
        }
        else {
            $(".activity_more").hide();
            $(".no_style").show();
        }

    })
    lis.each(function(){
    	if($(this).hasClass("play_baby")){
    		$(this).trigger("click");
    	}
    })




    var leave_activity = $(".leave_activity").val();
    var leave_cause = $(".leave_cause").val();
    $(".leave_activity").on("blur", function() {
        if ($(this).val() == "") {
            $(".activity_warn").show();
        }
        else {
            $(".activity_warn").hide();
        }
    })

    $(".leave_cause").on("blur", function() {
        if ($(this).val() == "") {
            $(".cause_warn").show();
        }
        else {
            $(".cause_warn").hide();
        }
    })

//点击取消收藏
// $(".cancel_collect").parent("a").on("click",function(){
// 	return false;
// })
    $(".cancel_collect").on("click", function(event) {
    	 event.preventDefault();
        var aid = $(this).attr('aid');
        var _this = $(this);
        $.post("/home/activity/collection",{ aid:aid,type:2},
            function(obj){
                if(obj.state_code != 200){
                    alert(obj.msg);
                    return false;
                }else{
                    _this.parent().parent().parent().parent(".playBao_part").remove();
                    
                    var children_lg=$("#conllect_Content").children(".playBao_part").length;
                    if(children_lg==0){
                    	$(".display_none").show()
                    }
                    else{
                    	$(".display_none").hide()
                    }
                    
                
                }
            }, "json");
          
    })
    
    //点击提问按钮
$(".my_quiz").on("click",function(){
	var quiz_content=$(".quiz").val();
	if(quiz_content==""){
		$(".quiz_warn").show();
		return false;
	}
	else{
		$(".modal_box").show();
	}
	
})

$(".quiz").on("blur",function(){
	var quiz_content=$(".quiz").val();
	if(quiz_content==""){
		$(".quiz_warn").show();
		return false;
	}
	else{
		$(".quiz_warn").hide();
	}
})

$(".cancel").on("click",function(){
	$(".modal_box").hide();
})

//二级页面tab栏的转换
// 选中除了第一个子元素之外的所有子元素(隐藏)

//二级主题的点击
$(".total_content .five_organs:not(:first-child)").css("display","none");
var second_lis=$(".second_title ul").children("li");
var secondContents=$(".total_content").children();
 second_lis.on("click",function(){
 	var index=$(this).index();
 	$(this).addClass("special_title").siblings().removeClass("special_title");
 	secondContents.eq(index).show().siblings().hide();
 	var activity=secondContents.eq(index).children().find(".playBao_part");
   	if(activity.length==0){
		$(".no_style").show();
	}
   	else if(activity.length>=1){
   	
   		
       $(".no_style").attr("style","display: none;margin-top:88px ;");
   	}
 	
 })
   second_lis.eq(0).trigger("click");
   
   
// 免费玩儿活动点击
//console.log(secondContents,888888)
//second_lis.on("click",function(){
//	var index=$(this).index();
//	var freeActivitys=secondContents.eq(index).children().find(".playBao_part");
//	if(freeActivitys.length==0){
//		$(".no_style").show();
//	}
// 	else if(freeActivitys.length>=1){
// 		console.log(333333)
// 		
//     $(".no_style").attr("style","display: none;margin-top:88px ;");
// 	}
//})
//second_lis.eq(0).trigger("click");
 
// 当我的收藏没有的时候

var collectParts=$("#conllect_Content").find(".playBao_part");

if(collectParts.length===0){
	$(".nothing").show();
}
else{
	$(".nothing").hide();
}

//点击退出登录
$(".back_login").on("click",function(){
	$(".sure_back").show();
})

//点击取消
$(".select_opera .cancel").on("click",function(){
	$(".sure_back").hide();
});

//点击确认
$(".select_opera .sure").on("click",function(){
	     $.post("/mobile/user/login_out",
            function(obj){
                if(obj.state_code == 200){
                   $(".sure_back").hide();
                 location.href="/mobile/activity/new_activity.html"
                }else{
                    
                }
            }, "json");
})

//生日插件
//$(".birthdayContainer").selectDate();

//判断余额来显示
var money_val=$(".remaining_money").html();
if(money_val=="余额不足"){
	$(".select_remaining").attr("disabled",true);
	$(".weixin").attr("checked",true);
}
else{
	$(".select_remaining").attr("disabled",false);
	$(".select_remaining").attr("checked",true);
}

//点击验证码
var timer;
$(".signUp").on("click",function(){
	  $.get("/mobile/user/getActivityQrCode",{ oid:$(this).attr("id")},
            function(obj){
                if(obj.state_code == 200){
                  	 $(".signUp_modox").show();
                     $(".sign_img").children("img").attr("src",obj.data.url)
                }else{
                   
                }
     }, "json");
     var id=$(this).attr("id");
     setInterval(function(){
     	   $.get("/mobile/user/checkSign",{oid:id},
            function(obj){
                if(obj.state_code == 200){
                	 $(".sign_word").show();
                	 clearInterval();
                   
                }else{
                    $(".sign_word").hide();
                }
     }, "json");
     },1000)
    
})


$(".signUp_modal .cancel").on("click",function(){
	$(".signUp_modox").hide();
	window.location.reload();
})


})
//function signSuccess(my){
//  $.get("/mobile/user/checkSign",{oid:my.attr("id")},
//          function(obj){
//              if(obj.state_code == 200){
//              	 $(".sign_word").show();
//              	 clearInterval(timer);
//                 
//              }else{
//                  $(".sign_word").hide();
//              }
//   }, "json");
//}



