//登录
var phone_state1 = false;
var psw_state1 = false;
$("#userName1").blur(function() {
	var reg = /^1[345789]\d{9}$/;
	var phone = $("#userName1").val();
	if(phone == "") {
		$("#userNameOrPasswordErr").text("请输入手机号");
		phone_state1 = false;

	} else {
		if(!reg.test(phone)) {
			$("#userNameOrPasswordErr").text("请输入正确的手机号");
			phone_state1 = false;

		} else {
			$("#userNameOrPasswordErr").text("");
			phone_state1 = true;
		}
	}
	checkLoginform();
});
$("#password1").blur(function() {
	if($("#password1").val() == "") {
		$("#userNameOrPasswordErr").text("请输入密码");
		var psw_state1 = false;
	} else {
		$("#userNameOrPasswordErr").text("");
		var psw_state1 = true;
	}
	checkLoginform();
});

var loginbtn = document.getElementById("subButton");

function checkLoginform() {
	if(phone_state1 && psw_state1) {
		//		loginbtn.removeAttribute("disabled");
		//		$("#subButton").addClass("readySubmit");
		//$("#subButton").attr("disabled","");
	} else {
		//$("#subButton").attr("disabled","disabled");
		//		loginbtn.setAttribute("disabled", "disabled");
		//		$("#subButton").attr("disabled", "disabled");
		//		$("#subButton").removeClass("readySubmit");
		//		$("#subButton").attr("disabled", "disabled");
	}
}
//		$('form input').each(function() {
//			$(this).change(function() {
//				var txtVal = $(this).val();
//				if(txtVal == '') {
//					$('#subButton').attr('disabled', true);
//				} else {
//					$('#subButton').attr('disabled', false);
//				}
//			});
//		})
//
//		function check_form() {
//			var mobile = $("#userName").val();
//			var password = $("#password").val();
//			$.post("login", { mobile: mobile, password: password },
//				function(obj) {
//
//					if(obj.state_code != 200) {
//						alert(obj.msg);
//						return false;
//					} else {
//						window.location.href = "{:U('Home/Index/index')}";
//					}
//				}, "json");
//			return false;
//		}
//		
/************************  失焦判断  **********************************/
//注册		
var phone_state = false;
var name_state = false;
var psw_state = false;
var ck_state = false;
//手机号输入框当失去焦点时的事件	
$("#userName").blur(function() {
	var reg = /^1[345789]\d{9}$/;
	var phone = $(this).val();
	if(phone == "") {
		$("#userNameInfo").text("手机号不能为空！");
		$('#wx_confirme1').css('display', 'none');
		phone_state = false;

	} else {
		if(reg.test(phone)) {
			$("#userNameInfo").text("");
			$('#wx_confirme1').css('display', 'block');
			phone_state = true;
		} else {
			$("#userNameInfo").text("请输入正确的手机号码!");
			$('#wx_confirme1').css('display', 'none');
			phone_state = false;

		}
	}
//	checkform();

});
//昵称
$("#displayName").blur(function() {
	if($("#displayName").val() == "") {
		$("#displayNameInfo").text("昵称不能为空！");
		$('#wx_confirme2').css('display', 'none');
		name_state = false;
	} else {
		$("#displayNameInfo").text("");
		$('#wx_confirme2').css('display', 'block');
		name_state = true;
	}
//	checkform();
});
//密码
$("#password").blur(function() {
	//	var reg2 = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/;
	var reg2 = /^[A-Za-z0-9\s\S]{6,16}$/;
	var pass = $(this).val();
	if(pass == "") {
		$('#passwordInfo').text("密码不能为空！");
		$('#wx_confirme3').css('display', 'none');
		psw_state = false;
	} else {
		if(reg2.test(pass)) {
			$('#wx_confirme3').css('display', 'block');
			$('#passwordInfo').text("");
			psw_state = true;
		} else {
			$('#passwordInfo').text("密码应为6-16位，由数字，英语字母，符号组成！");
			$('#wx_confirme3').css('display', 'none');
			psw_state = false;
		}
	}
//	checkform();
});
//确认密码
$("#repassword").blur(function() {
	if($("#repassword").val() == "") {
		$("#repasswordInfo").text("确认密码不能为空！")
		$('#wx_confirme4').css('display', 'none');
	} else {
		if($("#repassword").val() != $("#password").val()) {
			$("#repasswordInfo").text("确认密码与密码不一致!");
			$('#wx_confirme4').css('display', 'none');
		} else {
			$("#repasswordInfo").text("");
			$('#wx_confirme4').css('display', 'block');
		}

	}
});
//验证码
$("#checkCodeMsg").blur(function() {
	if($("#checkCodeMsg").val() == "") {
		$("#checkCodeInfo").text("验证码不能为空！");
		ck_state = false;
	} else {
		$("#checkCodeInfo").text("");
		ck_state = true;
	}
//	checkform();
});

var wait = 60;

function time(code) {
	if(wait == 0) {
		code.removeAttribute("disabled");
		code.value = "获取验证码";
		wait = 60;

	} else {
		code.setAttribute("disabled", true);
		code.value = "重新发送(" + wait + ")";
		//		code.style.backgroundColor = "darkgray";
		wait--;
		setTimeout(function() {
			time(code)
		}, 1000)
	}
}

//点击获取验证码
$("#sendBtn").click(function() {
	var reg = /^1[345789]\d{9}$/;
	var phone = $("#userName").val();
        var _this = this;
	if(phone == "") {
		$("#userNameInfo").text("手机号不能为空！");
		$('#wx_confirme1').css('display', 'none');
	} else {
		if(!reg.test(phone)) {
			$("#userNameInfo").text("请输入正确的手机号码！");
			$('#wx_confirme1').css('display', 'none');
		} else {
                        $.get(verifyUrl,{ mobile: phone},
                        function(obj){
                            if(obj.state_code != 200){
                                alert(obj.msg);
                                return false;
                            }else{
                                $("#userNameInfo").text("");
                                time(_this);
                                $('#wx_confirme1').css('display', 'block');
                            }
                        }, "json");
		}
	}
});

// 点击注册
$("#submitFormBut").click(function() {
	var reg = /^1[345789]\d{9}$/;
	var reg2 = /^[A-Za-z0-9\s\S]{6,16}$/;
	if(reg.test($("#userName").val()) && reg2.test($("#password").val()) && $("#repassword").val() == $("#password").val() && $("#checkCodeMsg").val() != "") {
		var mobile = $("#userName").val();
                var pwd = $("#password").val();
                var mobileCode = $("#checkCodeMsg").val();
                $.post(registerUrl,{ mobile: mobile,password:pwd,mobileCode:mobileCode},
                    function(obj){
                        if(obj.state_code != 200){
                            alert(obj.msg);
                            return false;
                        }else{
                            window.location.href = indexUrl;
                        }
                }, "json");
	} else {
		if($("#userName").val() == "") {
			$("#userNameInfo").text("手机号不能为空！");
		}
		if($("#repassword").val() == "") {
			$("#repasswordInfo").text("确认密码不能为空！");
		}
		if($("#password").val() == "") {
			$('#passwordInfo').text("密码不能为空！");
		}
		if($("#checkCodeMsg").val() == "") {
			$("#checkCodeInfo").text("验证码不能为空！");
		}
		return false;
	}

});
//var registerbtn = document.getElementById("submitFormBut");
//
//function checkform() {
//	if(phone_state && name_state && psw_state && ck_state) {
//		registerbtn.removeAttribute("disabled");
//		// registerbtn.className+=" "+"readySubmit";
//		$("#submitFormBut").addClass("readySubmit");
//	} else {
//		$("#submitFormBut").attr("disabled", "disabled");
//		//           registerbtn.setAttribute("disabled", "");
//		$("#submitFormBut").removeClass("readySubmit");
//	}
//}
//点击注册

////  $(".arrowDown").css("display","block");
////  //判断验证码是否一致                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
////  $(".ckin").keydown(function  () {
////  	if ($(".ckin").val()=="") {
////  		$(".arrowDown").css("display","none");
////  		time(sendbtn);
////  		ck_state = true;
////  	}else{
////  		ck_state = false;
////  	}
////  })
//});
//验证码正确
//$('form input[type="text"]').each(function() {
//			$(this).change(function() {
//				var txtVal = $(this).val();
//				if(txtVal == '') {
//					if (reg.test(phone)||reg2.test(pass)) {
//					$('#submitFormBut').attr('disabled', false);
//				    }
//				} else {	
//					$('#submitFormBut').attr('disabled', true);
//				}
//			});
//		});