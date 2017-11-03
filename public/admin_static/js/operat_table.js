$(document).ready(function() {
			var trs = $("#tbody_center tr");
			var checks = $(".check");
			checks.live("click", function(event) {

				event.stopPropagation();
				$(".modal_box").show();

				var userId = $(this).parent().parent().children("td:nth-child(1)").html();
				$.post("/abab.php/user/getUserInfo", { "uid": userId }, function(obj) {
					if(obj.state_code == 200) {
						console.log(obj);
//						会员概要
                         $(".member_name").html(obj.data.probably.nickname);
                         $(".member_phone").html(obj.data.probably.mobile);
                         $(".balance").html(obj.data.probably.balance);
                         $(".consumtion").html(obj.data.probably.consumption);
                         $(".enrol_num").html(obj.data.probably.enrol_num);
                         $(".join_num").html(obj.data.probably.join_num);
                         $(".credit").html(obj.data.probably.credit);
                         $(".source").html(obj.data.probably.source);
//                       详细信息
						$(".phone").html(obj.data.detail.mobile);
						$(".nickname").html(obj.data.detail.nickname);
						if(obj.data.detail.sex==1){
							$(".sex").html("男");
						}
						else{
							$(".sex").html("女");
						}
						$(".reg_time").html(obj.data.detail.reg_time)
						$(".province").html(obj.data.detail.province)
						$(".city").html(obj.data.detail.city)
						$(".district").html(obj.data.detail.district);
						$(".address").html(obj.data.detail.address)
						$(".birthday").html(obj.data.detail.birthday);
						$(".email").html(obj.data.detail.email);
						$(".hobby").html(obj.data.detail.hobby);
						
						var child_str='';
//						孩子信息
                          for(var i=0;i<obj.data.child.length;i++){
                          	child_str+="<ul>"
                          	+"<li><span>孩子姓名</span><span>"+obj.data.child[i].name+"</span></li>"+
                          	 "<li><span>孩子性别</span><span>"+obj.data.child[i].gender+"</span></li>"+
                          	 "<li><span>孩子生日</span><span>"+obj.data.child[i].birthday+"</span></li>"+
                          	 "<li><span>孩子学校</span><span>"+obj.data.child[i].school+"</span></li>"+
                          	 "<li><span>可玩时间</span><span>"+obj.data.child[i].play_time+"</span></li>"+
                          	 "<li><span>登记时间</span><span>"+obj.data.child[i].time+"</span></li>"+
                     
                          	"</ul>"
                          }
                         $(".child_information").html(child_str);
                         

					} else {
						alert(obj.msg)
					}
				})
			})
			
			
//			会员信息tab栏转换
           var liDetails=$(".member_title ul").children();
        
           liDetails.on("mouseenter",function(){
           	     tabChange($(this),$(".memberContents").children())

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

			$(".recharge_record tr td:nth-child(8)").live("click", function() {
				$(this).children(".show_word").hide();
				$(this).children(".good_prompt").show();
				$(this).children(".good_prompt").trigger("focus");
			})

			//	赠品传值
			$(".recharge_record tr td:nth-child(8) textarea").live("blur", function() {
				var goosVal = $(this).val();
				var goodsValId = $(this).parent().siblings(".td_id").html();
				sendgoods({ id: goodsValId, giveaway: goosVal }, $(this), $(this).siblings(".show_word"))
			})

			$(".recharge_record tr td:nth-child(10)").live("click", function() {
				$(this).children(".beizhu_word").hide();
				$(this).children(".beizhu").show();
				$(this).children(".beizhu").trigger("focus");
			})

			//备注传值
			$(".recharge_record tr td:nth-child(10) textarea").live("blur", function() {
				sendgoods({ id: $(this).parent().siblings(".td_id").html(), remark: $(this).val() }, $(this), $(this).siblings(".beizhu_word"))
			})
			// 点击是否
			$(".recharge_record tr td:nth-child(9) p").live("click", function() {

				if($(this).attr("class") == "no") {
					sendVal({ id: $(this).parent().siblings(".td_id").html(), is_get: 1 }, $(this), $(this).children(".no_text"), $(this).children("i"))
				} else {
					sendVal({ id: $(this).parent().siblings(".td_id").html(), is_get: 0 }, $(this), $(this).children(".no_text"), $(this).children("i"))
				}
			})

			//	金额变动tab栏的转换
			var lis = $(".record_title ul").children("li");
			lis.on("click", function() {
				 tabChange($(this),$(".detail_record").children())

			})

			

var str_num="<div class='one'><div class='control-group'><label class='control-label'>孩子姓名</label><div class='controls'><input type='text' style='width: 30%;' name='child_name[]' /></div></div></div><div class='control-group'><label class='control-label'>性别</label><div class='controls'><select name='child_gender[]'><option value='1' selected='selected'>男</option><option value='2'>女</option></select></div></div><div class='control-group'><label class='control-label'>生日</label><div class='controls'><input type='text' value='' name='child_birthday[]' placeholder='2017-09-07' onClick='new Calendar().show(this);' class='span11'  style='width: 25%;margin-top: -3px;cursor: pointer;'></div></div>	<div class='control-group'><label class='control-label'>学校</label><div class='controls'><input type='text' value='' class='span11' style='width: 33%' name='child_school[]'></div></div><div class='control-group'><label class='control-label'>可以玩耍的时间</label><div class='controls'><input type='text' value='' class='span11' style='width: 33%' name='child_play_time[]'></div></div>"
//孩子选择tab栏的转换
$(".select_num").trigger("change");
			$(".select_num").on("change", function() {
				if($(this).val() == 1) {
					$(".children_information").html(str_num)
				} else if($(this).val() == 2) {
					$(".children_information").html(str_num+str_num)
				} else if($(this).val() == 3) {
					$(".children_information").html(str_num+str_num+str_num)
				} else {
					
					$(".children_information").html('');
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


//tba栏转换
function tabChange(my,brother){
	 my.addClass("active").siblings().removeClass("active");
     brother.eq(my.index()).show().siblings().hide();
}
