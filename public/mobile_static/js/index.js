$(function(){
    var mySwiper = new Swiper('.swiper-container',{
		
    // 自动轮播
    autoplay:2000,
    autoHeight:true,
    // 分页容器
    pagination: '.pagination',
    grabCursor: true,
    paginationElement : 'li'
 })
 $('.slider2').bxSlider({
        slideWidth: 300,
        auto: true,
        minSlides: 2,
        maxSlides: 2,
        slideMargin: 8,
        moveSlides: 2,
        controls: false

 });
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
  
  
    //会员中心(tab栏转换)
    var lis = $(".lis_tab").children();
    var contents = $(".all_activityContent").children();


    lis.on("click", function() {
        var index = $(this).index();
        $(this).addClass("play_baby").siblings("li").removeClass("play_baby");
        contents.eq(index).css("display", "block").siblings().css("display", "none");
        
        var activityParts = contents.eq(index).children().children(".my_activity_part");


        if (activityParts.length > 0) {

            $(".activity_more").show();
            $(".nothing").hide();
        }
        else {
            $(".activity_more").hide();
            $(".nothing").show();
        }

    })
    $(".li_first").trigger("click");


//加载更多
    $(window).scroll(function() {
        var doc_height = $(document).height();
        var scroll_top = $(document).scrollTop();

        var window_height = $(window).height();
        if (scroll_top + window_height >= doc_height) {
            $(".my_Activity_content").css("height", "auto");
            $("#my_collectMore").css("height", "auto");
            $(".free_more").hide();
            $(".discuss_content").css("height","auto");
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
    $(".cancel_collect").on("click", function() {
        $(this).parent().parent().parent().parent(".activity_part").css("display", "none");
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

//报名加减
//大人的加
var adult_price=$(".aldut_price").text();
var child_price=$(".child_price").text();

var adult_num=$(".adult_val").val();
var child_num=$(".child_val").val();

//大人的加法
$(".adult_plus").on("click",function(){
	
	adult_num++;
	$(".adult_val").val(adult_num);
	
//	var total_price=Math.floor((adult_num*adult_price+child_num*child_price)*100/100);
	$(".total").text(adult_num*adult_price+child_num*child_price);
	
	
	if(adult_num>=2){
		adult_num=2;
		$(".adult_val").val(adult_num);
		$(".total").text(adult_num*adult_price+child_num*child_price);
	}
	
})

//大人的减法
$(".adult_reduce").on("click",function(){
	adult_num--;
	$(".adult_val").val(adult_num);
	
	$(".total").text(adult_num*adult_price+child_num*child_price);
	if(adult_num<=1){
		adult_num=1;
			$(".adult_val").val(adult_num);
		$(".total").text(adult_num*adult_price+child_num*child_price);
	}
})

//孩子的加法
$(".child_plus").on("click",function(){
	child_num++;
	$(".child_val").val(child_num);
	
	$(".total").text(adult_num*adult_price+child_num*child_price);
	if(child_num>=2){
		child_num=2;
		$(".child_val").val(child_num);
		$(".total").text(adult_num*adult_price+child_num*child_price);
	}
})

//孩子的减法
$(".child_reduce").on("click",function(){
	child_num--;
	$(".child_val").val(child_num);
	
	$(".total").text(adult_num*adult_price+child_num*child_price);
	if(child_num<=1){
		child_num=1;
		$(".child_val").val(child_num);
		$(".total").text(adult_num*adult_price+child_num*child_price);
	}
})


//生日插件
$(".birthdayContainer").birthday();

//控制小孩的数量
var num;
if(num==1){
        $(".child_1").show();
        $(".child_2").hide();
}
if(num==2){
        $(".child_1").show();
        $(".child_2").show();
}
})