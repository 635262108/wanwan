
$(document).ready(function(){

	var login = $('#loginform');
	var recover = $('#recoverform');
	var speed = 400;

	$('#to-recover').click(function(){
		
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
	
	
	$('#to-login').click(function(){

        });
    
    if($.browser.msie == true && $.browser.version.slice(0,3) < 10) {
        $('input[placeholder]').each(function(){ 
       
        var input = $(this);       
       
        $(input).val(input.attr('placeholder'));
               
        $(input).focus(function(){
             if (input.val() == input.attr('placeholder')) {
                 input.val('');
             }
        });
       
        $(input).blur(function(){
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.val(input.attr('placeholder'));
            }
        });
    });

        
        
    }
    
    //登录
    $("#login").click(function(){
        var name = $("#name").val();
        var pwd = $("#pwd").val();
       $.post("login",{ name: name,pwd:pwd},
        function(obj){
            if(obj.state_code != 200){
                alert(obj.msg);
                return false;
            }else{
                window.location.href = '/abab.php'
            }
        }, "json");
    })
    
    
     //登录
    $("#seller_login").click(function(){
        var mobile = $("#seller_mobile").val();
        var pwd = $("#seller_pwd").val();
        console.log('点击登录');
       $.post("/seller/user/login",{ mobile: mobile,pwd:pwd},
        function(obj){
            if(obj.state_code != 200){
                alert(obj.msg);
                return false;
            }else{
                window.location.href = '/seller/activity/index.html'
            }
        }, "json");
    })
});