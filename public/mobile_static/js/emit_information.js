$(function() {    
    var mySwiper = new Swiper('.swiper-container', {
        // 自动轮播
        autoplay: 2000,
        autoHeight: true,
        // 分页容器
        pagination: '.pagination',
        grabCursor: true,
        paginationElement: 'li'
    })



//个人验证

//昵称的验证
    $("#nickName").on("blur", function() {

        if ($(this).val() == "") {
            $("#my_name_chk").css("display", "block");
        } else {
            $("#my_name_chk").css("display", "none");
        }
    })

// 邮箱
    $("#email").blur(function() {
        var email = $("#email").val();
        var reg1 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if (email == "") {
            $("#my_email_chk").css("display", "block");
            $("#my_email_chk").text("邮箱不能为空");
        } else {
            if (!reg1.test(email)) {
                $("#my_email_chk").css("display", "block");
            } else {
                $("#my_email_chk").css("display", "none");
            }
        }
    });

    $("#area").on("blur", function() {
        var street = $("#area").val();
        if (street !== "") {
            $("#my_name_street").hide();
        }
        else {
            $("#my_name_street").show();
        }
    })

    $("#hobby").on("blur", function() {
        var hobby = $("#hobby").val();
        if (hobby !== "") {
            $("#my_name_hobby").hide();
        }
        else {
            $("#my_name_hobby").show();
        }
    })


//修改个人信息
    $("#submit").on("click", function() {
        var nickName = $("#nickName").val();
        var emial = $("#email").val();
        var reg1 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if (nickName == "") {
            $("#my_name_chk").css("display", "block");
            return false;
        }
        if (emial != "") {
            if (reg1.test(emial) == false) {
                $("#my_email_chk").css("display", "block");
                return false;
            }
        }       
    })




    $(".cancel").on("click", function() {
        $(".modal_box").hide();
    })
    //退款理由选择
    $(".step_1").on("click",function(){
            var gender=$('input:radio[name="reason"]:checked').val();
            if(gender==null){
                    $(".please").show();
                    return false;
            }
            else{
                    $(".please").hide();
            }

    })



//手机号的验证
    function isMobilePhone(value) {
        if (value.search(/^(\+\d{2,3})?\d{11}$/) == -1)
            return false;
        else
            return true;
    }
    ;
//注册页面手机号验证
    $("#telphone").on("blur", function() {
        var phone_num = $("#telphone").val();
        if (phone_num !== "") {
            if (isMobilePhone(phone_num) === true) {
                $(".tel_warn").hide();
            } else {
                $(".tel_warn").show();
                $(".tel_warn").text("请输入正确的手机号码");
            }
        }
        else {
            $(".tel_warn").show();
            $(".tel_warn").text("手机号码不能为空");
        }
    })
//  注册页面姓名验证
  $("#user_name").on("blur", function() {
        var name = $("#user_name").val();
        if(name==""){
        	$(".name_warn").show();
        }
        
    })

//忘记密码手机号验证
    $("#forget_telphone").on("blur", function() {
        var forget_Pnum = $("#forget_telphone").val();
        if (forget_Pnum !== "") {
            if (isMobilePhone(forget_Pnum) === true) {
                $(".tel_warn").hide();
            } else {
                $(".tel_warn").show();
                $(".tel_warn").text("请输入正确的手机号码");
            }
        }
        else {
            $(".tel_warn").show();
            $(".tel_warn").text("手机号码不能为空");
        }
    })

//忘记密码验证码验证
    $("#forget_check_num").on("blur", function() {
        var forget_check_num = $("#forget_check_num").val();
        if (forget_check_num !== "") {
            if (isCheckPhoneSMS(forget_check_num) === true) {
                $(".check_warn").hide();
            }
            else {
                $(".check_warn").show();
            }
        }
        else {
            $(".check_warn").show();
            $(".check_warn").text("验证码不能为空");
        }
    })

//重置页面密码验证
    $("#reset_passward").on("blur", function() {
        var reset_num = $("#reset_passward").val();

        if (reset_num !== "") {
            if (checkPassword(reset_num) === true) {
                $(".pwd_warn").hide();
            }
            else {
                $(".pwd_warn").show();
                $(".pwd_warn").text("密码格式不正确");

            }
        }
        else {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码不能为空");
        }

    })
//重置页面确认密码验证
    $("#reset_pwd_sure").on("blur", function() {
        var reset_sureNum = $("#reset_pwd_sure").val();

        var reset_num = $("#reset_passward").val();


//	console.log(pwd_sureNum,88888)

        if (reset_sureNum !== "") {

            if (reset_sureNum === reset_num) {
                $(".pwd_Surewarn").hide();
            }
            else {
                $(".pwd_Surewarn").show();
            }
        }

    })



//验证密码

    function checkPassword(value) {

        if (value.search(/^[0-9a-zA-Z]{6,16}$/) == -1)
            return false;
        else
            return true;
    }

    $("#passward").on("blur", function() {
        var pwd_num = $("#passward").val();

        if (pwd_num !== "") {
            if (checkPassword(pwd_num) === true) {
                $(".pwd_warn").hide();
            }
            else {
                $(".pwd_warn").show();
                $(".pwd_warn").text("密码格式不正确");

            }
        }
        else {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码不能为空");
        }

    })
//登录密码的验证
    $("#login_passward").on("blur", function() {
        var login_pwd = $("#login_passward").val();

        if (login_pwd !== "") {
            if (checkPassword(login_pwd) === true) {
                $(".pwd_warn").hide();
            }
            else {
                $(".pwd_warn").show();
                $(".pwd_warn").text("密码格式不正确");

            }
        }
        else {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码不能为空");
        }

    })

//确认密码验证
    $("#pwd_sure").on("blur", function() {
        var pwd_sureNum = $("#pwd_sure").val();

        var pwd_num = $("#passward").val();

        if (pwd_sureNum !== "") {

            if (pwd_sureNum === pwd_num) {
                $(".pwd_Surewarn").hide();
            }
            else {
                $(".pwd_Surewarn").show();
            }
        }

    })


//验证码验证
    function isCheckPhoneSMS(value) {
        if (value.search(/^\d{4,}$/) == -1)
            return false;
        else
            return true;
    }
    ;

    console.log($("#check_num"), 666666666);

    $("#check_num").on("blur", function() {
        var check_num = $("#check_num").val();
        console.log(check_num, 4444444)
        if (check_num !== "") {
            if (isCheckPhoneSMS(check_num) === true) {
                $(".check_warn").hide();
            }
            else {
                $(".check_warn").show();
            }
        }
        else {
            $(".check_warn").show();
            $(".check_warn").text("验证码不能为空");
        }
    })



//验证账户名（登录）
    $("#login_userName").on("blur", function() {
        var Name_val = $("#login_userName").val();
        if (Name_val == "") {
            $(".user").show();
            
        }
        
        else if (!isMobilePhone(Name_val)) {
            $(".user").show();
            $(".user").text("手机号格式不正确");
        }
    })

//	获取验证码的验证
    var timer;
    var time = 60;
//忘记密码页面
    $(".get_num").on("click", function() {
        if ($("#forget_telphone").val() == "") {
            $(".tel_warn").show();
        }
        else if (!isMobilePhone($("#forget_telphone").val())) {
            $(".tel_warn").show();
            $(".tel_warn").text("手机号格式不正确");
        }
        else {
            var phone = $("#forget_telphone").val();
            $.get('/home/user/getVerify', {mobile: phone,type:1},
            function(obj) {
                if (obj.state_code != 200) {
                    alert(obj.msg);
                    return false;
                } else {
                    clearInterval(timer);
                    timer = setInterval(function() {
                        time--;
                        $('.get_num').val(time + 's后重新获取');
                        $(".get_num").attr("disabled", true);
                        if (time == 0) {
                            clearInterval(timer);
                            time = 60;
                            $('.get_num').val('重新获取')
                            $(".get_num").attr("disabled", false);
                        }
                    }, 1000)
                }
            })

        }
    })
//注册页面

    $(".register_get_num").on("click", function() {
    	console.log('获取验证码');
        if ($("#telphone").val() == "") {
            $(".tel_warn").show();
        }
        else if (!isMobilePhone($("#telphone").val())) {
            $(".tel_warn").show();
            $(".tel_warn").text("手机号格式不正确");
        }
        else {
            var phone = $("#telphone").val();
            $.get('/home/user/getVerify', {mobile: phone},
            function(obj) {
                if (obj.state_code != 200) {
                    alert(obj.msg);
                    return false;
                }else{
                    clearInterval(timer);
                    timer = setInterval(function() {
                    time--;
                    $('.register_get_num').val(time + 's后重新获取');
                    $(".register_get_num").attr("disabled", true);
                    if (time == 0) {
                        clearInterval(timer);
                        time = 60;
                        $('.register_get_num').val('重新获取');
                          $(".register_get_num").attr("disabled",false);
                    }
                }, 1000)
                }
            }, "json");
        }



    })

//		注册页面(点击提交之后的验证)	
    $(".register").on("click", function() {
        var tel = $("#telphone").val();
        var pwd = $("#passward").val();
        var pwd_sure = $("#pwd_sure").val();
        var check_num = $("#check_num").val();
        
        var name=$("#user_name").val();
        if(name==""){
        	$(".name_warn").show();
        	return false;
        }


        if (tel == "") {
            $(".tel_warn").show();

            return false;
        }
        if (isMobilePhone(tel) == false) {
            $(".tel_warn").show();
            $(".tel_warn").text("请输入正确的手机号码");
            return false;
        }

//		密码验证
        if (pwd == "") {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码不能为空");

            return false;
        }
        if (checkPassword(pwd) == false) {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码格式不正确");
            return false;
        }

//		确认密码
        if (pwd_sure == "") {
            $(".pwd_Surewarn").show();
            $(".pwd_Surewarn").text("密码不能为空");


            return false;

        }


//		验证码验证
        if (check_num == "") {
            $(".check_warn").show();
            $(".check_warn").text("验证码输入不能为空");

            return false;
        }
        if (isCheckPhoneSMS(check_num) == false) {

            $(".check_warn").show();
            $(".check_warn").text("验证码输入格式有误");
            return false;
        }
        $.post('/mobile/user/register',{ name:name,mobile:tel,password:pwd,mobileCode:check_num},
            function(obj){
                if(obj.state_code != 200){
                    alert(obj.msg);
                    return false;
                }else{
                    window.location.href = obj.data.url;;
                }
        }, "json");
        return false;

    })

//	登录页面
    $(".login_register").on("click", function() {
        var userName = $("#login_userName").val();
        var login_pwd = $("#login_passward").val();
        if (userName == "") {
            $(".user").show();
            return false;
        }
//		密码验证
        if (login_pwd == "") {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码不能为空");

            return false;
        }
        if (checkPassword(login_pwd) == false) {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码格式不正确");
            return false;
        }
        if (isMobilePhone(userName) == false) {
            $(".user").show();
            $(".user").text("手机号格式不正确");
            return false;
        }
        
        $.post('/mobile/User/login', {mobile: userName, password: login_pwd},
        function(obj) {
            if (obj.state_code != 200) {
                alert(obj.msg);
                return false;
            } else {
                window.location.href = obj.data.url;
            }
        }, "json");
        return false;
    })

//忘记密码
    $(".forget_register").on("click", function() {
        var forget_tel = $("#forget_telphone").val();
        var forget_check_num = $("#forget_check_num").val();
        if (forget_tel == "") {
            $(".tel_warn").show();

            return false;
        }
        if (isMobilePhone(forget_tel) == false) {
            $(".tel_warn").show();
            $(".tel_warn").text("请输入正确的手机号码");
        }

        if (forget_check_num == "") {
            $(".check_warn").show();
            $(".check_warn").text("验证码输入不能为空");

            return false;
        }
        if (isCheckPhoneSMS(forget_check_num) == false) {
            $(".check_warn").show();
            $(".check_warn").text("验证码输入格式有误");
            return false;
        }
        $.post('/home/User/forget_pwd', {mobile: forget_tel, mobileCode: forget_check_num},
        function(obj) {
            if (obj.state_code != 200) {
                alert(obj.msg);
                return false;
            } else {
                window.location.href = '/mobile/user/reset_pwd'
            }
        }, "json");
        return false;
    })

//重置页面验证
    $(".reset_register").on("click", function() {
        var reset_pwd = $("#reset_passward").val();
        var reset_Spwd = $("#reset_pwd_sure").val();
        if (reset_pwd == "") {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码不能为空");

            return false;
        }
        if (checkPassword(reset_pwd) == false) {
            $(".pwd_warn").show();
            $(".pwd_warn").text("密码格式不正确");
            return false;
        }
        if (reset_Spwd == "") {
            $(".pwd_Surewarn").show();
            $(".pwd_Surewarn").text("密码不能为空");
            return false;
        }
        $.post('/home/User/reset_pwd', {pwd: reset_pwd},
        function(obj) {
            if (obj.state_code != 200) {
                alert(obj.msg);
                return false;
            } else {
                alert('密码重置成功,请牢记');
                window.location.href = '/mobile/activity/index';
            }
        }, "json");
        return false;
    })
    
    // 大人信息验证

    $(".adultName").on("blur", function() {
        if ($(this).val() == "") {
            $(".adultName_warn").show();
        }
        else {
            $(".adultName_warn").hide();
        }
    })

//联系方式验证
    $(".adultTel").on("blur", function() {
        if ($(this).val() !== "") {
            if (isMobilePhone($(".adultTel").val())) {
                $(".adultTel_warn").hide();
            }
            else {
                $(".adultTel_warn").show();
                $(".adultTel_warn").text("手机号格式不正确")
            }
        }
        else {
            $(".adultTel_warn").show();
        }

    })

//小孩名字的验证
//     $(".childName_one").on("blur", function() {
//         if ($(this).val() == "") {
//             $(".child_warn").show();
//         }
//         else {
//             $(".child_warn").hide();
//         }
//     })

//第二个小孩名字验证
//     $(".childName_two").on("blur", function() {
//         if ($(this).val() == "") {
//             $(".child_warn2").show();
//         }
//         else {
//             $(".child_warn2").hide();
//         }
//     })


//点击确认报名
    $(".name_sure").on("click", function() {

        if ($(".adultName").val() == "") {
            $(".adultName_warn").show();
            return false;
        }
        if ($(".adultTel").val() == "") {
            $(".adultTel_warn").show();
            return false;
        }
        if (!isMobilePhone($(".adultTel").val())) {
            $(".adultTel_warn").show();
            $(".adultTel_warn").text("手机号格式不正确");
            return false;
        }
        //孩子验证，暂时不要
        // if ($(".childName_one").val() == "") {
        //     $(".child_warn").show();
        //     return false;
        // }
    })
})
