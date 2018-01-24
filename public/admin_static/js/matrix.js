
$(document).ready(function(){

	
	
	// === Sidebar navigation === //
	
	$("#index > a").click(function(e){
	
		sessionStorage.setItem("href_name",$(this).attr("href"));
		
		sessionStorage.removeItem("index");
		
		$(".submenu").removeClass("active")
		
	})
	
	
	
	
	
//	侧边栏的点击事件
    
    var sideLis=$(".leftSide>ul").find(".submenu");
    
    var lisContents=$(".listContent").children();
    sideLis.on("click",function(){
    	var index=$(this).index();
    	$(this).addClass("active").siblings().removeClass("active")
    	lisContents.eq(index-1).show().siblings().hide();
    	lisContents.eq(index-1).children("li:nth-child(1)").find("a").addClass("active");
    	var first_href=lisContents.eq(index-1).children("li:nth-child(1)").find("a").attr("href");
    	sessionStorage.setItem("href_name",first_href);
    	sessionStorage.setItem("index",index);
    	window.location.href=first_href;
    	

    	
    })
    
    lisContents.each(function(index){
    	var lis=$(this).children("li");
    	
    	lis.on("click",function(){
    	
    		sessionStorage.setItem("href_name",$(this).children("a").attr("href"));
    	})
    })
    
      var href_name=JSON.stringify(sessionStorage.getItem('href_name'));
      var ulIndex=sessionStorage.getItem('index');  
      if(sessionStorage.getItem('href_name')=="/abab.php/index/index.html"){
       	   $("#index").addClass("active").siblings().removeClass("active");
      }
      else{
      	sideLis.eq(ulIndex-1).addClass("active").siblings().removeClass("active");
        $(".listContent a[href="+href_name+"]").css({"color":"#27a9e3","border-bottom":"1px solid #27a9e3"});
        $(".listContent a[href="+href_name+"]").parent().parent().show();
      }
      	

      
    
    
	
//	$('.submenu > a').click(function(e)
//	{
//		e.preventDefault();
//		var submenu = $(this).siblings('ul');
//		var li = $(this).parents('li');
//		var submenus = $('#sidebar li.submenu ul');
//		var submenus_parents = $('#sidebar li.submenu');
//		if(li.hasClass('open'))
//		{
//			if(($(window).width() > 768) || ($(window).width() < 479)) {
//				submenu.slideUp();
//			} else {
//				submenu.fadeOut(250);
//			}
//			li.removeClass('open');
//		} else 
//		{
//			if(($(window).width() > 768) || ($(window).width() < 479)) {
//				submenus.slideUp();			
//				submenu.slideDown();
//			} else {
//				submenus.fadeOut(250);			
//				submenu.fadeIn(250);
//			}
//			submenus_parents.removeClass('open');		
//			li.addClass('open');	
//		}
//	});

//  $(".submenu").each(function(){
//		var lis=$(this).children("ul").find("li");
//		lis.on("click",function(){
//			sessionStorage.setItem("href_name",$(this).children("a").attr("href"));
//			
//		})
//	})
//		 var href_name=JSON.stringify(sessionStorage.getItem('href_name'));
//		 $(".submenu a[href="+href_name+"]").parent().css({"background":"#28b779","border":"1px solid transparent"})
//       $(".submenu a[href="+href_name+"]").css("color","#ffffff");
//       $(".submenu a[href="+href_name+"]").parent().parent().show();
	     
	
	
//	$('#sidebar > a').click(function(e)
//	{
//		e.preventDefault();
//		var sidebar = $('#sidebar');
//		if(sidebar.hasClass('open'))
//		{
//			sidebar.removeClass('open');
//			ul.slideUp(250);
//		} else 
//		{
//			sidebar.addClass('open');
//			ul.slideDown(250);
//		}
//	});
//	
	// === Resize window related === //
//	$(window).resize(function()
//	{
//		if($(window).width() > 479)
//		{
//			ul.css({'display':'block'});	
//			$('#content-header .btn-group').css({width:'auto'});		
//		}
//		if($(window).width() < 479)
//		{
//			ul.css({'display':'none'});
//			fix_position();
//		}
//		if($(window).width() > 768)
//		{
//			$('#user-nav > ul').css({width:'auto',margin:'0'});
//          $('#content-header .btn-group').css({width:'auto'});
//		}
//	});
	
//	if($(window).width() < 468)
//	{
//		ul.css({'display':'none'});
//		fix_position();
//	}
//	
//	if($(window).width() > 479)
//	{
//	   $('#content-header .btn-group').css({width:'auto'});
//		ul.css({'display':'block'});
//	}
	
	// === Tooltips === //
//	$('.tip').tooltip();	
//	$('.tip-left').tooltip({ placement: 'left' });	
//	$('.tip-right').tooltip({ placement: 'right' });	
//	$('.tip-top').tooltip({ placement: 'top' });	
//	$('.tip-bottom').tooltip({ placement: 'bottom' });	
	
	// === Search input typeahead === //
//	$('#search input[type=text]').typeahead({
//		source: ['Dashboard','Form elements','Common Elements','Validation','Wizard','Buttons','Icons','Interface elements','Support','Calendar','Gallery','Reports','Charts','Graphs','Widgets'],
//		items: 4
//	});
	
	// === Fixes the position of buttons group in content header and top user navigation === //
//	function fix_position()
//	{
//		var uwidth = $('#user-nav > ul').width();
//		$('#user-nav > ul').css({width:uwidth,'margin-left':'-' + uwidth / 2 + 'px'});
//      
//      var cwidth = $('#content-header .btn-group').width();
//      $('#content-header .btn-group').css({width:cwidth,'margin-left':'-' + uwidth / 2 + 'px'});
//	}
	
	// === Style switcher === //
//	$('#style-switcher i').click(function()
//	{
//		if($(this).hasClass('open'))
//		{
//			$(this).parent().animate({marginRight:'-=190'});
//			$(this).removeClass('open');
//		} else 
//		{
//			$(this).parent().animate({marginRight:'+=190'});
//			$(this).addClass('open');
//		}
//		$(this).toggleClass('icon-arrow-left');
//		$(this).toggleClass('icon-arrow-right');
//	});
//	
//	$('#style-switcher a').click(function()
//	{
//		var style = $(this).attr('href').replace('#','');
//		$('.skin-color').attr('href','css/maruti.'+style+'.css');
//		$(this).siblings('a').css({'border-color':'transparent'});
//		$(this).css({'border-color':'#aaaaaa'});
//	});
	
//	$('.lightbox_trigger').click(function(e) {
//		
//		e.preventDefault();
//		
//		var image_href = $(this).attr("href");
//		
//		if ($('#lightbox').length > 0) {
//			
//			$('#imgbox').html('<img src="' + image_href + '" /><p><i class="icon-remove icon-white"></i></p>');
//		   	
//			$('#lightbox').slideDown(500);
//		}
//		
//		else { 
//			var lightbox = 
//			'<div id="lightbox" style="display:none;">' +
//				'<div id="imgbox"><img src="' + image_href +'" />' + 
//					'<p><i class="icon-remove icon-white"></i></p>' +
//				'</div>' +	
//			'</div>';
//				
//			$('body').append(lightbox);
//			$('#lightbox').slideDown(500);
//		}
//		
//	});
//	
//
//	$('#lightbox').live('click', function() { 
//		$('#lightbox').hide(200);
//	});
	
});
