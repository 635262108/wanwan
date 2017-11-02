$(document).ready(function() {
	var trs = $("#tbody_center tr");
	//	console.log($(".check"),8888)
	var checks = $(".check");
	//	console.log(trs.children("td").find(".check"),8888)
	checks.live("click", function(event) {

		event.stopPropagation();
		$(".modal_box").show();

		var userId = $(this).parent().parent().children("td:nth-child(1)").html();
		$.post("/abab.php/user/getUserInfo", { "uid": userId }, function(obj) {
			if(obj.state_code == 200) {
				$(".userId").html(userId);
				$(".phone").html(obj.data.mobile);
				$(".nickname").html(obj.data.nickname);
				$(".birthday").html(obj.data.birthday);
				$(".hobby").html(obj.data.hobby);
				$(".normal").html(obj.data.status); //状态
				$(".address").html(obj.data.address);
				$(".start").html(obj.data.reg_time); //注册时间
				$(".finsh").html(obj.data.last_time); //最后登录时间
				$(".province").html(obj.data.province); //所在省
				$(".country").html(obj.data.city);
				$(".area").html(obj.data.district); //区
				$(".sign").html(obj.data.signature);
			} else {
				alert(obj.msg)
			}
		})
	})

	//弹出关闭按钮
	$(".cancel").on("click", function() {
		$(".modal_box").hide();
	})

	//取消(是否确认取消)
	$(".btn-warning").on("click", function() {
		return confirm("是否确认取消");
	})


	//活动页面删除

	$(".activity_delete").live("click", function() {
		deleteData("/abab.php/activity/delActivity", { "aid": parseInt($(this).parent().parent().children("td:nth-child(1)").text()) },
			$(this).parent().parent())
	})
	//活动分类删除
	$(".classfy_delete").live("click", function() {
		deleteData("/abab.php/activity/delType", { "id": parseInt($(this).parent().parent().parent().find("td").eq(0).html()) }, $(this).parent().parent().parent())
	})
	//评论提问删除
	$(".ask_delete").live("click", function() {
		deleteData("/abab.php/activity/delAnyReply", { "id": parseInt($(this).parent().parent().parent().find("td").eq(0).html()) },
			$(this).parent().parent().parent())

	})
	//扩展删除
	$(".ext_delete").live("click", function() {
		deleteData("/abab.php/activity/del_extension", { "id": parseInt($(this).parent().siblings(".td_id").html()) },
			$(this).parent().parent())

	})
	//评论删除
	$(".com_delete").live("click", function() {
		deleteData("/abab.php/activity/delAnyReply", { "id": parseInt($(this).parent().parent().find("td").eq(0).html()) },
			$(this).parent().parent())

	})
	//活动规格
	$(".spe_delete").live("click", function() {
		deleteData("/abab.php/activity/delAnySpe", { "id": parseInt($(this).parent().siblings(".td_id").html()) },
			$(this).parent().parent())

	})

	//成单删除
	$(".deal_delete").live("click", function() {
		deleteData("/abab.php/user/del_deal", { "id": parseInt($(this).parent().siblings(".td_id").html()) },
			$(this).parent().parent())

	})

	$(".select_activity").on("change", function() {
		var str = '';
		var Activityid = $(this).val();
		$.post("/abab.php/activity/getActivityTime", { aid: Activityid },
			function(obj) {
				if(obj.state_code == -1) {
					$(".warn").show();
					$(".warn").html(obj.msg);
					$("#s2id_select_time span").html('');
					$("#select_time").empty();

				} else if(obj.state_code == 200) {

					for(var i = 0; i < obj.data.length; i++) {
						var t_id = obj.data[i].t_id;
						str += "<option value=" + t_id + ">" + obj.data[i].t_content + "</option>";

					}

					$("#s2id_select_time span").html('请选择');
					$("#select_time").html(str);

					$(".warn").hide();

				}
			}, "json");

	})
	
//	点击赠品输入框


$(".recharge_record tr td:nth-child(8)").live("click",function(){
	$(this).children(".show_word").hide();
	$(this).children(".good_prompt").show();
	$(this).children(".good_prompt").trigger("focus");
})

//	赠品传值
$(".recharge_record tr td:nth-child(8) textarea").live("blur", function() {
		var goosVal = $(this).val();
		var goodsValId = $(this).parent().siblings(".td_id").html();
		sendgoods({ id: goodsValId, giveaway: goosVal },$(this),$(this).siblings(".show_word"))
})

$(".recharge_record tr td:nth-child(10)").live("click",function(){
	$(this).children(".beizhu_word").hide();
	$(this).children(".beizhu").show();
	$(this).children(".beizhu").trigger("focus");
})

	//备注传值
	$(".recharge_record tr td:nth-child(10) textarea").live("blur", function() {
		sendgoods({ id: $(this).parent().siblings(".td_id").html(), remark: $(this).val() },$(this),$(this).siblings(".beizhu_word"))
	})
	// 点击是否
	$(".recharge_record tr td:nth-child(9) p").live("click", function() {

		if($(this).attr("class") == "no") {
			sendVal({ id: $(this).parent().siblings(".td_id").html(), is_get: 1 }, $(this), $(this).children(".no_text"), $(this).children("i"))
		} else {
			sendVal({ id: $(this).parent().siblings(".td_id").html(), is_get: 0 }, $(this), $(this).children(".no_text"), $(this).children("i"))
		}
	})
	
//	tab栏的转换
var lis=$(".record_title ul").children("li");
var contens=$(".detail_record").children();
lis.on("click",function(){
	$(this).addClass("active").siblings("li").removeClass("active");
	contens.eq($(this).index()).show().siblings().hide();
})


//孩子选择tab栏的转换
$(".select_num").on("change",function(){
	if($(this).val()==1){
		$(".one").show().siblings().hide();
	}
	else if($(this).val()==2){
		$(".two").show().siblings().hide();
	}
	else if($(this).val()==3){
		$(".three").show().siblings().hide();
	}
	else{
		$(".none").show().siblings().hide();
	}

})


})

//省改变事件
function seachcitys(province) {
	$.get("/home/user/getRegion", { id: province },
		function(obj) {
			if(obj.state_code == 200) {
				$("#seachcity").html(obj.data);
			}
		}, "json");
}
//市改变事件
function seachdistricts(city) {
	$.get("/home/user/getRegion", { id: city },
		function(obj) {
			if(obj.state_code == 200) {
				$("#seachdistrict").html(obj.data);
			}
		}, "json");
}
//活动类型改变事件
function changeActivityType(tid) {
	$.get("/abab.php/activity/getSonType", { id: tid },
		function(obj) {
			if(obj.state_code == 200) {
				$("#sonType").html(obj.data);
			}
		}, "json");
}


//传递是否参数
function sendVal(option, my, children_one, children_two) {

	$.post("/abab.php/user/save_recharge", option, function(obj) {
		if(obj.state_code == 200) {
			if(my.attr("class") == "no") {
				my.attr({ "class": "yes", "style": "color:rgb(27,188,157)" });
				children_one.text("是");
				children_two.attr({ "class": "icon-ok", "style": "color:rgb(27,188,157)" })

			} else {
				my.attr({ "class": "no", "style": "color:rgb(158,163,167)" });
				children_one.text("否");
				children_two.attr({ "class": "icon-ban-circle", "style": "color:rgb(158,163,167)" });
			}
		}

	})

}
//赠品和备注的传值

function sendgoods(option,my,brother) {
	$.post("/abab.php/user/save_recharge", option, function(obj) {
		if(obj.state_code==200){
			brother.html(my.val());
			my.hide();
			brother.show();
		}

	})
}

//是否确认删除传值
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