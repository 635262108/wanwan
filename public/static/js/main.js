//为导航栏添加鼠标移入事件
$(".nav_left li>a").mouseenter(function() {
	$(this).css({
		backgroundColor: 'white',
		color: '#ff4b3c'
	});
});
$(".nav_left li>a").mouseleave(function() {
	$(this).css({
		backgroundColor: 'transparent',
		color: 'white'
	});
});

//数量加减
changetotal();
var child_num_min = 1;
var child_num_max = 2;
var adult_num_min = 1;
var adult_num_max = 2;
$(".changeadd").each(function() {
	$(this).click(function() {
		//				alert(123);
		var num = parseInt($(this).parent().prev().val());
		var name = $(this).parent().prev().attr("name");
		if(name == 'child_num') {
			var max = child_num_max;
		} else {
			var max = adult_num_max;
		}
		if(num < max) {
			$(this).parent().prev().val(num + 1);
			changetotal();
		}

	});
});
$(".changeredu").each(function() {
	$(this).click(function() {
		//				alert(123);
		var num = parseInt($(this).parent().prev().val());
		var name = $(this).parent().prev().attr("name");
		if(name == 'child_num') {
			var min = child_num_min;
		} else {
			var min = adult_num_min;
		}
		if(num > min) {
			$(this).parent().prev().val(num - 1);
			changetotal();
		}

	});
});

function changetotal() {
	var adult_num = parseInt($(".dB_number_s[name=adult_num]").val());
	var child_num = parseInt($(".dB_number_s[name=child_num]").val());
	if(!isNaN($("#adult").text())) {
		var price_child = $("#child").text();
		var price_adult = $("#adult").text();
		var total = Math.round()
		var total = Math.round((adult_num * parseFloat(price_adult) + child_num * parseFloat(price_child)) * 100) / 100;
		$("#Buy_price").text(total);
		$("#Buy_price2").text(total);
		$(".adult_sel").text(adult_num);
		$(".child_sel").text(child_num);
	} else {
		var price_child = $("#child").text();
		var price_adult = 0.00;
		var total = Math.round()
		var total = Math.round((adult_num * parseFloat(price_adult) + child_num * parseFloat(price_child)) * 100) / 100;
		$("#Buy_price").text(total);
		$("#Buy_price2").text(total);
		$(".adult_sel").text(adult_num);
		$(".child_sel").text(child_num);
	}

}
//孩子生日选择
if($("#value2").val() == "2") {
	$(".child_2").css("display", "block");
};
$('.date_picker').date_input();
$("#datePicker").date_input();
$(".btn-1").click(function() {
	if($("#value2").val() == "1") {
		$(".child_2").css("display", "none");
	} else if($("#value2").val() == "2") {
		$(".child_2").css("display", "block");

	}
});
//确认报名点击判断
function signUpClick() {
	if($("#realname").val() == "") {
		alert("联系人姓名不能为空！");
		return false;
	} else if($("#mobile").val() == "") {
		alert("联系人电话不能为空！");
		return false;
	} else if($("#child_realname").val() == "") {
		alert("孩子姓名不能为空！");
		return false;
	} else if($("#datePicker").val() == "") {
		alert("孩子生日不能为空！");
		return false;
	} else if($(".child_2").css("display") == 'block') {
		if($("#child_realname2").val() == "") {
			alert("孩子姓名不能为空！");
			return false;
		} else if($("#datePicker2").val() == "") {
			alert("孩子生日不能为空！");
			return false;
		}
		return true;
	}
	return true;
}
//点击活动详情  全部评论
$(".view-ul").click(function() {
	$(".active_info").css("display", "block");
	$(".active_comment").css("display", "none");
	$(".view-ul").css("background-color", "#FF4134");
	$(".view-ul").css("color", "white");
	$(".all-comment").css("background-color", "#F9F9F9");
	$(".all-comment").css("color", "black");
});
$(".all-comment").click(function() {
	$(".active_info").css("display", "none");
	$(".active_comment").css("display", "block");
	$(".all-comment").css("background-color", "#FF4134");
	$(".all-comment").css("color", "white");
	$(".view-ul").css("background-color", "#F9F9F9");
	$(".view-ul").css("color", "black");
});
//下拉菜单
var left_dis = $("#topUserName").offset().left;
			$(".header_user").css({
				position: "absolute",
				'left': left_dis - 12
			});
			$("#topUserName").mousemove(function() {
				$(".header_user").show().mouseleave(function() {
					$(this).hide()
				})
			});