$(document).ready(function(){
	


$(".submenu").on("click", function(){
	console.log('点击了')
	var index = $(this).index();
	
	if($(this).hasClass("open")){
//		收缩
		$(this).children("ul").slideUp(50);
		
		$(this).removeClass("open");
		
	}
	else{
//		展开
		$(this).children("ul").slideDown(50);
		$(this).children(".first_li").addClass("active");
		$(this).siblings().children(".first_li").removeClass("active");
		$(this).siblings(".submenu").find("ul").hide();
		$(this).find(".line").hide();
		$(this).addClass("open");
		$(this).siblings().removeClass("open");
		JSON.stringify(localStorage.setItem('Uindex', index));
	}

})

//侧边栏下面的部分
$(".submenu ul li").on("click", function(event){
	event.stopPropagation();
	var a_href = $(this).find("a").attr("href");
	JSON.stringify(localStorage.setItem('Url', a_href));
	var href_name = JSON.stringify(localStorage.getItem('Url'));
	$("iframe").attr("src", href_name);
	$("iframe").show();
	$(".submenu a[href=" + href_name + "]").siblings(".line").show();
	$(".submenu a[href=" + href_name + "]").parent().siblings("li").find(".line").hide();
	$(".submenu a[href=" + href_name + "]").parents(".submenu").siblings().find(".line").hide();
	$(".submenu a[href=" + href_name + "]").parents(".wholePage").children("#content").hide();
	$(".submenu a[href=" + href_name + "]").parent().parent("ul").attr("style","display: block;");
})

//分店活动的上架,下架
$(".seller_recommend .present").live("click",function(){
   if($(this).hasClass("yes")){
	   	ClickRecommend("/seller/activity/saveAssociatedAs",
	   	    {id:$(this).siblings(".sorting_1").html(),
	   	     status:2},
	   	          $(this),"下架","上架","present"
	   	)
	}
   else{
		ClickRecommend("/seller/activity/saveAssociatedAs",
   	          {id:$(this).siblings(".sorting_1").html(),status:1},
   	          $(this),"下架","上架","present"
   		)
   }
	
})

//分店活动的删除
$(".sellerActivity_delete").live("click", function() {
    deleteData("/seller/activity/delAssociatedAs", { "id": parseInt($(this).parent().parent().children("td:nth-child(1)").text()) },
	$(this).parent().parent())
})


})

function ClickRecommend(url,option,my,wordNo,wordYes,addClass) {

	$.post(url, option, function(obj) {
		if(obj.state_code == 200) {
			if(my.hasClass("yes")) {
				my.html(wordNo)
				my.attr("class","no")
				my.addClass(addClass);
			} 
			else{
				my.html(wordYes);
				
				my.attr("class","yes")
				my.addClass(addClass);
			}
		}

	})

}

function deleteData(url, option, parent) {
		var trueOrfalse = confirm("是否确认删除");
		var _this = $(this);
		if(!trueOrfalse) {
			return;
		} else {

		$.post(url, option, function(data) {
            if(data.state_code == 200) {
					
				 parent.hide();
			} else {
				alert(data.msg)
			}
		})
	}

}