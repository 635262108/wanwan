
$(document).ready(function(){

	
	
	// === Sidebar navigation === //
	
	$("#index > a").click(function(e){
//		var href=$(this).attr("href");
//	    $("iframe").attr("src",href);
//		sessionStorage.setItem("href_name",$(this).attr("href"));
//		
//		sessionStorage.removeItem("index");
//		
//		$(".submenu").removeClass("active")
		
	})
	
	
	
	
	
//	侧边栏的点击事件
    
    var sideLis=$(".leftSide>ul").find(".submenu");
    
    var lisContents=$(".listContent").children();
    sideLis.on("click",function(){
    	var index=$(this).index();
    	$(this).addClass("active").siblings().removeClass("active")
    	lisContents.eq(index-1).show().siblings().hide();
    	lisContents.eq(index-1).children("li:nth-child(1)").find("a").addClass("active");
    	lisContents.eq(index-1).children("li:nth-child(1)").siblings().find("a").removeClass("active");
      	var first_href=lisContents.eq(index-1).children("li:nth-child(1)").find("a").attr("href");
      	$("iframe").attr({"width":"100%","height":"1190px","src":first_href});
      	$(this).parents(".wholePage").siblings("#content").hide()
      	
    	
         
//  	sessionStorage.setItem("href_name",first_href);
//  	sessionStorage.setItem("index",index);
//  	window.location.href=first_href;
})
    
    
//  点击重要的部分
    lisContents.each(function(index){
    	var lis=$(this).children("li");
    	
    	lis.on("click",function(){
    	  var href=$(this).find("a").attr("href");
    	  $(this).find("a").addClass("active");
    	  $(this).siblings().find("a").removeClass("active");
    	  $("iframe").attr("src",href);
          $(this).parents(".wholePage").siblings("#content").hide();
    	})
    })

	
});
