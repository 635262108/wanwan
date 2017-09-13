
	
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
            controls:false

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

    })


//加载更多
    $(window).scroll(function() {
        var doc_height = $(document).height();
        var scroll_top = $(document).scrollTop();

        var window_height = $(window).height();
        if (scroll_top + window_height >= doc_height) {
            $(".my_Activity_content").css("height", "auto");

            $("#my_collectMore").css("height", "auto");
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
//请假条的提交
    $(".leave_submit").on("click", function() {
        if ($(".leave_activity").val() == "") {
            $(".activity_warn").show();
            return false;
        }
        if ($(".leave_cause").val() == "") {
            $(".cause_warn").show();
            return false;
        }

    })

//点击取消收藏
    $(".cancel_collect").on("click", function() {
        $(this).parent().parent().parent().parent(".activity_part").css("display", "none");
    })
})