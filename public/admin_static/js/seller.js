//点击侧边栏的时候
$(".submenu>a").on("click",function(){
	$(this).siblings("ul").slideToggle();
	$(this).parent(".submenu").siblings(".submenu").find("ul").hide();
})


$(".submenu").on("click",function(){
	var index=$(this).index();
	$("#index").removeClass("active");
	$(this).children(".first_li").addClass("active")
	$(this).siblings().children(".first_li").removeClass("active");
})

//侧边栏下面的部分
$(".submenu ul li").on("click",function(){
	var a_href=$(this).find("a").attr("href");
	JSON.stringify(localStorage.setItem('Url',a_href));
	var href_name=JSON.stringify(localStorage.getItem('Url'));
	$("iframe").attr("src",href_name);
	$("iframe").show();
	$(".submenu a[href="+href_name+"]").siblings(".line").show();
	$(".submenu a[href="+href_name+"]").parent().siblings("li").find(".line").hide();
	
	$(".submenu a[href="+href_name+"]").parents(".submenu").siblings().find(".line").hide();
	$(".submenu a[href="+href_name+"]").parents(".wholePage").children("#content").hide();
	
	
})
