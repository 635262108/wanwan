$(".submenu").on("click", function() {
	$(this).children("ul").slideToggle(50);
	$(this).siblings(".submenu").find("ul").hide();
	var index = $(this).index();
	var href = $(this).find("ul li:nth-child(1)").children("a").attr("href");
	var className=$(this).find("ul li:nth-child(1)").children("a").attr("class");
    if(className =='activity') {
		window.location.href = href;
	} 
	else{
		$(this).children(".first_li").addClass("active")
		$(this).siblings().children(".first_li").removeClass("active");
		JSON.stringify(localStorage.setItem('Uindex', index));
	}

})

//侧边栏下面的部分
$(".submenu ul li").on("click", function() {
	var a_href = $(this).find("a").attr("href");
	JSON.stringify(localStorage.setItem('Url', a_href));
	var href_name = JSON.stringify(localStorage.getItem('Url'));
	$("iframe").attr("src", href_name);
	$("iframe").show();
	$(".submenu a[href=" + href_name + "]").parent().parent("ul").show();
	$(".submenu a[href=" + href_name + "]").siblings(".line").parent().parent("ul").show();
	$(".submenu a[href=" + href_name + "]").siblings(".line").show();
	console.log($(".submenu a[href=" + href_name + "]").siblings(".line").parent().parent("ul").css('display'),'显示方式')
//	$(".submenu a[href=" + href_name + "]").parent().siblings("li").find(".line").hide();
//	$(".submenu a[href=" + href_name + "]").parents(".submenu").siblings().find(".line").hide();
	$(".submenu a[href=" + href_name + "]").parents(".wholePage").children("#content").hide();
})