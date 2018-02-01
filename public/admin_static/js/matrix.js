   
		
	// === Sidebar navigation === //
	
	$("#index > a").click(function(e){
		 JSON.stringify(localStorage.setItem('Url',$(this).attr("href")));
		 localStorage.removeItem("ulIndex");
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
      	$("iframe").attr({"width":"100%","height":"1815px","src":first_href});
      	$(this).parents(".wholePage").siblings("#content").hide();
      	 JSON.stringify(localStorage.setItem('Url',first_href));
      	 localStorage.setItem('ulIndex',index)
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
          JSON.stringify(localStorage.setItem('Url',href));
        })
    })
	 	
    
   

	