$(document).ready(function() {
	
var Table=$('.data-table').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"bFilter":true,
		"bLengthChange":true,
		"aaSorting":[[0,"desc"]],
		"retrieve":true,
		"bDestroy":true,
		"bStateSave":true
});
$("span.icon input:checkbox, th input:checkbox").click(function(){
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
		checkbox.each(function(){
			this.checked = checkedStatus;
			if(checkedStatus ==this.checked){
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked){
				$(this).closest('.checker > span').addClass('checked');
			}
		});
});	
	
//封装的api接口
var SpitUrl={
	"add_url":"/api/user/saveChild",
	"delete_url":"/api/user/delChild",
	"recharge_url":"/api/user/recharge",
	"deMoney_url":"/api/user/deductionFee",
	"leave_url":"/api/user/askForLeave",
	"sign_url":"/api/order/saveOrderStatus",
	"getPhone_url":"/api/user/getUserInfo",
	"addMember_url":"/api/order/addOrder",
	"Amend_infoUrl":"/api/user/saveUser",
	"goodDeleteUrl":"/abab.php/goods/del_goods"
}
		var trs = $("#tbody_center tr");
		var checks = $(".check");
//			查看更新所有数据
			checks.live("click", function(event) {                             
				
				event.stopPropagation();
				$(".modal_box").show();

				var userId=$(this).parent().parent().children("td:nth-child(1)").html();
				$.post("/abab.php/user/getUserInfo", {"uid":userId }, function(obj) {
					
				
					if(obj.state_code == 200) {
						
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
							$(".one_sex").html("男");
						}
						else{
							$(".one_sex").html("女");
						}
						$(".reg_time").html(obj.data.detail.reg_time)
						$(".province").html(obj.data.detail.province)
						$(".city").html(obj.data.detail.city)
						$(".district").html(obj.data.detail.district);
						$(".address").html(obj.data.detail.address);
						if(obj.data.detail.birthday=='null'){
							
							$(".birthday").html('');
						}
						else{
							$(".birthday").html(obj.data.detail.birthday);
						}
						
						$(".email").html(obj.data.detail.email);
						$(".hobby").html(obj.data.detail.hobby);
//						给新增的赋值
					   	$(".uid").html(obj.data.detail.uid)
						
						var child_str='';
						var add_str="<div class='add_child'><img src="+'/public/admin_static/img/'+'add.png'+" style='width: 18px;height: 18px;margin-right: 22%;margin-top: -2px;'/><a href='javascript:;'>新增</a></div>"
//						孩子信息
                          for(var i=0;i<obj.data.child.length;i++){
                         
                          	 if(obj.data.child[i].birthday==null){
                          	 	
                          	child_str+="<div class='child_part' num="+obj.data.child[i].id+"><ul>"
                          	+"<li><span>孩子姓名:</span><span class='one_name'>"+obj.data.child[i].name+"</span></li>"+
                          	 "<li><span>孩子性别:</span><span class='one_sex'>"+obj.data.child[i].gender+"</span></li>"+
                          	 "<li><span>孩子生日:</span><span class='one_birthday'>"+"</span></li>"+
                          	 "<li><span>孩子学校:</span><span class='one_school'>"+obj.data.child[i].school+"</span></li>"+
                          	 "<li><span>可玩时间:</span><span class='one_time'>"+obj.data.child[i].play_time+"</span></li>"+
                          	 "<li><span>登记时间:</span><span>"+obj.data.child[i].time+"</span></li>"+
                     
                          	"</ul><div class='operate'><span class='emit'><img src="+'/public/admin_static/img/'+'edit.png'+"><a href='javascript:;'>编辑</a></span><span class='delete'><img src="+'/public/admin_static/img/'+'delete.png'+"><a href='javascript:;'>删除</a></span></div></div>"
                          	 }
                          	 else{
                          	
                          	child_str+="<div class='child_part' num="+obj.data.child[i].id+"><ul>"
                          	+"<li><span>孩子姓名:</span><span class='one_name'>"+obj.data.child[i].name+"</span></li>"+
                          	 "<li><span>孩子性别:</span><span class='one_sex'>"+obj.data.child[i].gender+"</span></li>"+
                          	 "<li><span>孩子生日:</span><span class='one_birthday'>"+obj.data.child[i].birthday+"</span></li>"+
                          	 "<li><span>孩子学校:</span><span class='one_school'>"+obj.data.child[i].school+"</span></li>"+
                          	 "<li><span>可玩时间:</span><span class='one_time'>"+obj.data.child[i].play_time+"</span></li>"+
                          	 "<li><span>登记时间:</span><span>"+obj.data.child[i].time+"</span></li>"+
                     
                          	"</ul><div class='operate'><span class='emit'><img src="+'/public/admin_static/img/'+'edit.png'+"><a href='javascript:;'>编辑</a></span><span class='delete'><img src="+'/public/admin_static/img/'+'delete.png'+"><a href='javascript:;'>删除</a></span></div></div>"
                            }
                          	 }
                         
                             $(".child_information").html(add_str+child_str);
                         
                        
                         

					} else {
					
					}
				})
			})
			
//			添加按钮（动态生成的）
			$(document).on("click",".add_child",function(){					
				 $(".modal_addsecondBox").show()
			})
//			添加保存（关闭窗口）
			$(".second_cancel").on("click",function(){
					$(".modal_addsecondBox").hide()
			})
//			编辑保存（关闭窗口）
            $(".emit_second_cancel").on("click",function(){
            	   $(".modal_emitsecondBox").hide();
            })
			
//			新增之后保存按钮
            $(".add_success").on("click",function(){
//          	新增的数据的id
            	var id=$(".uid").html();
            	var childName=$(".child_name").val();
            	var childSex=$("input:radio:checked").val();
                var childSch=$(".child_school").val();
            	var play=$(".child_time").val();
            	var childBi=$(".child_birthday").val();
            	
            	var trueOrfalse = confirm("是否确认添加");
            	if(!trueOrfalse){
            		return;
            	}
            	else{
             $.post("/abab.php/user/save_child", {uid:id,
                 	child_name:childName,
                 	child_gender:childSex,
                 	child_school:childSch,
                 	child_play_time:play,
                 	child_birthday:childBi},
						function(obj) {
						
						if(obj.state_code == 200) {
						$(".id").html(obj.data.id);
					    $(".modal_addsecondBox").hide();
								   
								
								    
								   
								  
								   
						var add_child="<div class='child_part' num="+obj.data.id+"><ul>"
                          	+"<li><span>孩子姓名:</span><span class='one_name'>"+childName+"</span></li>"+
                          	 "<li><span>孩子性别:</span><span class='one_sex'>"+"</span></li>"+
                          	 "<li><span>孩子生日:</span><span class='one_birthday'>"+childBi+"</span></li>"+
                          	 "<li><span>孩子学校:</span><span class='one_school'>"+childSch+"</span></li>"+
                          	 "<li><span>可玩时间:</span><span class='one_time'>"+play+"</span></li>"+
                          	 
                     
                          	"</ul><div class='operate'><span class='emit'><img src="+'/public/admin_static/img/'+'edit.png'+"><a href='javascript:;'>编辑</a></span><span class='delete'><img src="+'/public/admin_static/img/'+'delete.png'+"><a href='javascript:;'>删除</a></span></div></div>"
								  
								   
								  
								  $(".child_information").append(add_child);
								  
								  if($("input:radio:checked").val()==="1"){
								    
            							$(".one_sex").html("男")
            						}
					            	else{
					            		$(".one_sex").html("女");
					            	}								  
								   $(".child_name").val("");
								   $("input:radio").attr("checked",false);
								   $(".child_school").val("");
								   $(".child_time").val("");
								   $(".child_birthday").val("");								  
								}
								else{
									
								}
					}, "json");
            	}
            	

            })
//          编辑按钮
          
             $(".child_information").on("click",".emit",function(event){
             	 
             	 event.stopPropagation();
            	
            	$(".modal_emitsecondBox").show();
            	var childParts=$(".child_information").children(".child_part");
            	
            	
            	
            	var index=$(this).parent().parent().index();
                $(".id").attr("num",index);
            	$(".new_name").val(childParts.eq(index-1).find(".one_name").html())
            	if(childParts.eq(index-1).find(".one_sex").html()=="男"){
            		 $(".man").attr("checked",true)
            	}
            	else{
            		 $(".woman").attr("checked",true)
            	}
            	

            	$(".new_school").val(childParts.eq(index-1).find(".one_school").html())
            	$(".new_time").val(childParts.eq(index-1).find(".one_time").html())
            	$(".new_birthday").val(childParts.eq(index-1).find(".one_birthday").html())
            	$(".id").html(childParts.eq(index-1).attr("num"));
            })
             
//           点击编辑之后保存
             
         $(".emit_success").on("click",function(){
            		
                      var childParts=$(".child_information").children(".child_part");
            		  var id=$(".id").html();
            		  
            		 
            		  var name=$(".new_name").val();
            		  var sex=$("input:radio:checked").val();
            		  
            		  var school=$(".new_school").val();
            		  var time=$(".new_time").val();
            		  var birthday=$(".new_birthday").val();
            		  
            		  var trueOrfalse = confirm("是否确认编辑");
			            	if(!trueOrfalse){
			            		return;
			            	}
			            	else{
			            $.post("/abab.php/user/save_child", { 
            		  	id:id,child_name:name,
            		  	child_gender:sex,
            		  	child_school:school,
            		  	child_play_time:time,
            		  	child_birthday:birthday},
						function(obj) {
							
							   
								if(obj.state_code == 200) {
								 
								   $(".modal_emitsecondBox").hide();
								   
								   
						 var add_child="<ul>"
                          	+"<li><span>孩子姓名:</span><span class='one_name'>"+name+"</span></li>"+
                          	 "<li><span>孩子性别:</span><span class='one_sex'>"+"</span></li>"+
                          	 "<li><span>孩子生日:</span><span class='one_birthday'>"+birthday+"</span></li>"+
                          	 "<li><span>孩子学校:</span><span class='one_school'>"+school+"</span></li>"+
                          	 "<li><span>可玩时间:</span><span class='one_time'>"+time+"</span></li>"+
                          	 "</ul><div class='operate'><span class='emit'><img src="+'/public/admin_static/img/'+'edit.png'+"><a href='javascript:;'>编辑</a></span><span class='delete'><img src="+'/public/admin_static/img/'+'delete.png'+"><a href='javascript:;'>删除</a></span></div>"
//                           编辑当前的框
                              var index_num=$(".id").attr("num");
                               childParts.eq(index_num-1).attr("num");
                          	   childParts.eq(index_num-1).html(add_child);
                          	 
                          	  if($("input:radio:checked").val()==="1"){
								   
            							$(".one_sex").html("男")
            						}
					            	else{
					            		$(".one_sex").html("女");
					        	}
                          
								  
								}
								else{
									
								}
					}, "json");
			            	}


            		  
            })
         
//       删除按钮
        $(".child_information").on("click",".delete",function(){
       
        	var index=$(this).parent().parent().index();
        	var childParts=$(".child_information").children(".child_part");
        	var delete_id=$(this).parent().parent().attr("num");
        	
        	  var trueOrfalse = confirm("是否确认删除");
			            	if(!trueOrfalse){
			            		return;
			            	}
			            	else{
			            		$.post("/abab.php/user/del_child", { id: delete_id },
								function(obj) {
							
									if(obj.state_code == 200) {
											
										childParts.eq(index-1).remove();
									}
									else{
												
									}
								}, "json");
			            	}
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
			
			//管理员的删除
			$(".manager_delete").live("click", function() {
				deleteData("/abab.php/admin/del_user", { "id": parseInt($(this).parent().siblings(".td_id").html()) },
					$(this).parent().parent())

			})
			
			//角色列表的删除
			$(".role_delete").live("click", function() {
				deleteData("/abab.php/admin/del_role", { "id": parseInt($(this).parent().siblings(".td_id").html()) },
					$(this).parent().parent())

			})
			
			//充值政策的删除
			$(".policyDelete").live("click",function(){
					deleteData("/abab.php/user/delRecharge", { "id": parseInt($(this).parent().parent().siblings(".firstSib").html()) },
					$(this).parent().parent().parent())
			})
			
//			商品删除
            $(".goods_delete").live("click",function(){
            	   deleteData(SpitUrl.goodDeleteUrl,{"id":parseInt($(this).parent().siblings(".tr_id").html())},$(this).parent().parent())
            })
			
			$(".select_activity").on("change", function() {
				var str = '';
				var Activityid = $(this).val();
				
				var price=$(this).children("option:selected").attr("price")
				
				$(".price_num").val(price)
				
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
								str += "<option value=" + t_id + ">" + obj.data[i].begin_time + "--" + obj.data[i].end_time  + "</option>";

							}

							$("#s2id_select_time span").html('请选择');
							$("#select_time").html(str);

							$(".warn").hide();

						}
					}, "json");

			})
			
			
//			输入手机号显示姓名


//点击新增成员保存信息

$(".save_member").on("click",function(event){
	event.preventDefault()
	var mobile=$(".get_phone").val();
	var aid=$(".aId").val();
	var tid=$(".tId").val();
	var adultNum=$(".adult_num").val();
	var childNum=$(".child_num").val();
	var payWay=$(".pay_way option:selected").val();
	var reMark=$(".remark").val();
	var Name=$(".get_name").val();
	var Source=$(".source option:selected").val();
	var signT=$(".alreadySign option:selected").val();
	var orderPrice=$(".price").val();
	
	$.post(SpitUrl.addMember_url,{mobile:mobile,
		aid:aid,
		t_id:tid,
		adult_num:adultNum,
		child_num:childNum,
		pay_way:payWay,
		source:Source,
		name:Name,
		sign_time:signT,
		remark:reMark,
		order_price:orderPrice
	},function(obj) {
					if(obj.state_code == 200){
						window.history.go(-1);
					}
					else{
					     alert(obj.msg)
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
					$(".children_information").html('')
				}

			})
			
//			开卡金额控制
 		$(".pay_price").trigger("focus");
        $(".pay_price").on("blur",function(){
        	if($(this).val()==0){
        		$(".payNum_contents").hide();
        	}
        	else if($(this).val()>0){
        		$(".payNum_contents").show();
        	}
        })
        
        
//      权限选择

// 点击全部
   $(".whole_check").on("click",function(){
   	    if($(this).attr("checked")){
   	    	$(this).siblings().find("input").attr("checked",true);
   	    }
   	    else{
   	    	$(this).siblings().find("input").attr("checked",false);
   	    }
   })
   
// 点击一级标题
	var inputs=$(".first_check").children(".first_child");
    inputs.on("click",function(){
      	var checked_len=$(".first_check").children(".first_child:checked").length;
        if(checked_len===3){
    		$(".whole_check").attr("checked",true);
    		
    	}
        if($(this).attr("checked")){
        	$(this).siblings(".second_check").find("input").attr("checked",true);
        }
        else{
        	$(this).siblings(".second_check").find("input").attr("checked",false)
        	$(".whole_check").attr("checked",false);
        }
        
      

    })
    
//  三级的点击事件
		$(".first_check").each(function(){
			var threeInput=$(this).children(".second_check").find("input");
			$(this).children(".second_check").find("input:checked").length
			
			threeInput.on("click",function(){
				
				var threeInput_len=$(this).parent(".second_check").find("input:checked").length;
				
				if(threeInput_len==0){
					  $(this).parent(".second_check").siblings(".first_child").attr("checked",false);
					  $(".whole_check").attr("checked",false);
				}
				
				
				if($(this).attr("checked")){
				 	
				 	  $(this).parent(".second_check").siblings(".first_child").attr("checked",true);
				 	  
				 }
			})
			
		})
   
    
//首页js
var firstlis=$(".ul_classify .first li:not(:last-child)");

var firstContents=$(".classify_contents").children();

firstlis.on("click",function(){
	$(this).children("span").show()
	$(this).siblings().children("span").hide();
	firstContents.eq($(this).index()).show().siblings().hide();
})

//客户列表的点击事件
var paixuli=$(".pai ul").children();
paixuli.on("click",function(){
	$(this).addClass("active").siblings().removeClass("active");
})
 
var checklis=$(".member_check ul li:not(:first-child)");
var checkContens=$(".pai_contents").children();
checklis.on("click",function(){
	$(this).children("span").show();
	$(this).siblings().children("span").hide();
	checkContens.eq($(this).index()-1).show().siblings().hide()
})

//筛选条件多选事件
var checkMore=$(".playTimes ul").children("li");
checkMore.on("click",function(){
	if($(this).hasClass("active")){
		$(this).removeClass("active");
	}
	else{
		$(this).addClass("active");
	}
	
})

var activitys=$(".activityOperate").children();
activitys.on("click",function(){
	$(this).addClass("active").siblings().removeClass("active");
})
    
    	//  点击是否推荐
$(".recommend .push").live("click",function(){
   if($(this).hasClass("yes")){
	   	ClickRecommend("/abab.php/activity/saveActivityField",
	   	          {aid:$(this).siblings(".sorting_1").html(),a_is_recommend:0},
	   	          $(this),"不推荐","推荐","push"
	   	)
	}
   else{
		ClickRecommend("/abab.php/activity/saveActivityField",
   	          {aid:$(this).siblings(".sorting_1").html(),a_is_recommend:1},
   	          $(this),"不推荐","推荐","push"
   	)
   }
	
})
//点击是否上架
$(".recommend .present").live("click",function(){
   if($(this).hasClass("yes")){
	   	ClickRecommend("/abab.php/activity/saveActivityField",
	   	    {aid:$(this).siblings(".sorting_1").html(),
	   	     a_status:0},
	   	          $(this),"下架","上架","present"
	   	)
	}
   else{
		ClickRecommend("/abab.php/activity/saveActivityField",
   	          {aid:$(this).siblings(".sorting_1").html(),a_status:1},
   	          $(this),"下架","上架","present"
   		)
   }
	
})

$(".status").live("click",function(){
	var my=$(this);
	if($(this).html()=="上架"){
		$.post("/abab.php/goods/save_goods_status", {"id":$(this).siblings(".tr_id").html(),"status":2},
			function(obj) {
				console.log(obj.msg)
				if(obj.state_code == 200) {
					my.html("下架");
				}
		}, "json");
	}
	else{
		$.post("/abab.php/goods/save_goods_status", {"id":$(this).siblings(".tr_id").html(),"status":1},
			function(obj) {
				if(obj.state_code == 200) {
					my.html("上架");
				}
		}, "json");
	}
	
})

//商品的上架和下架


//充值政策的功能
//点击查看内容
$(".content").live("click",function(){
	
		$.get("/abab.php/user/getPolicyCon", { id: $(this).siblings(".firstSib").html() },
		function(obj) {
			if(obj.state_code == 200) {
				var str=''
				for(var i=0;i<obj.data.length;i++){
					str+="<li>"+obj.data[i].content+"</li>"
				}
				$(".rechargeDiv ul").html(str);
				$(".rechargeModalbox").show()
			}
		}, "json");
	
})

$(".rechargeDiv .cancel").on("click",function(){
	 $(".rechargeModalbox").hide()
})

//点击添加政策内容
$(".add_policy").on("click",function(){
	$(".policyContent").append("<div class='policy_part'><input class='span11' style='width: 80%;' value='' name='content[]' type='text'><span class='cancel'>删除</span></div>")
})

$(document).on("click",".policy_part .cancel",function(){
	$(this).parent().remove();
})

//点击编辑的删除
$(".emit_cancel").on("click",function(){
var parent=$(this).parent(".policy_part");
		$.get("/abab.php/user/delPolicy", { id: $(this).siblings(".cancel_id").val() },
		function(obj) {
			if(obj.state_code == 200) {
				parent.remove();
			}
		}, "json");
})


//活动安排的添加按钮
$(".add_arrange").on("click",function(){
	var str='<div class="arrangePart"><div class="control-group"><label class="control-label">活动时间：</label><div class="controls timeControl"><input type="text" value="" name="begin_time[]" placeholder="格式：2017-09-07 15:30" onfocus="$(this).calendar()" style="cursor: pointer;"><div class="line"></div><input type="text" value="" name="end_time[]" placeholder="格式：2017-09-07 15:30" onfocus="$(this).calendar()" style="cursor: pointer;"></div></div><div class="control-group"><label class="control-label">备注：</label><div class="controls"><input class="span11" value="" name="remark[]" type="text" style="width:20%"></div></div><div class="control-group"><label class="control-label">名额：</label><div class="controls"><input class="span11" value="" placeholder="整数" name="ticket_num[]" type="text" style="width:20%"></div></div><div class="control-group"><label class="control-label">是否显示：</label><div class="controls"><select name="is_display[]" style="width:20%"><option value="0">否</option><option value="1">是</option></select></div></div><div class="arrange_delete"><img src='+"/public/admin_static/img/"+"pay_cancel.png"+' style="width: 16px;height: 16px;"/></div></div>'
	
	$(".arrangeContents").append(str);
})

//点击删除操作
$(document).on("click",".arrange_delete",function(){
	$(this).parent().remove();
})

//客户列表详细信息(不重要信息的收缩展开)
$(".slideDown").on("click",function(){
	$(".hiddenInfo").show();
	$(this).hide()
})

$(".slideUp").on("click",function(){
	$(".hiddenInfo").hide();
	$(".slideDown").show();
})

var infoLis=$(".click_ulContent ul").children("li");
var DetaiContents=$(".detail_Container").children();
infoLis.on("click",function(){
	$(this).addClass("active").siblings().removeClass("active");
	DetaiContents.eq($(this).index()).show().siblings().hide();
})

//客户列表新增孩子信息(新增)
$(".add_order").on("click",function(){
var str="<div class='childInforPart partInput'><ul><li>孩子姓名：<input type='text'/ class='Name'></li><li>孩子性别：<input type='radio' name='sex' value='1' class='man'>男<input type='radio' name='sex' value='2' class='woman' />女</li><li>孩子年龄：<input type='text' class='age'></li><li>孩子生日：<input type='text' class='Birthday' onClick='new Calendar().show(this);' style='cursor:pointer'></li><li>孩子学校：<input type='text' class='School'></li><li>可玩时间：<input type='text' class='play'></li></ul><div class='operate'><span class='add_save'><img src="+'/public/admin_static/img/'+'edit.png'+"><a href='javascript:;'>保存</a></span><span><img src="+'/public/admin_static/img/'+'delete.png'+"><a href='javascript:;' class='childDelete'>删除</a></span></div></div>"
$(".childInforContent").append(str);
})

$(document).on("keyup",".age",function(){
	
	var age=$(this).val();
	var mydate=new Date();
	var currentYear= mydate.getFullYear();
	var birthday=(currentYear-age)+'-'+01+'-'+01;
	$(".Birthday").val(birthday);
	
})
//点击新增的保存

$(document).on("click",".add_save",function(){
	var uid=$(".hidden_val").val();
	var childName =$(".Name").val();
	var sex=$("input:radio:checked").val();
	var birthday=$(".Birthday").val();
	var school=$(".School").val();
	var playTime=$(".play").val();
	$.post(SpitUrl.add_url,{uid:uid,name:childName,gender:sex,birthday:birthday,school:school,play_time:playTime},function(obj){
		if(obj.state_code == 200){
			window.location.reload();
		}
	})
})
//孩子信息删除
$(document).on("click",".childDelete",function(){
	var id=$(this).parent().parent().parent().attr("num");
	var trueOrfalse = confirm("是否确认删除");
	var el=$(this);
	if(!trueOrfalse){
          return;
	}
	else{
		$.post(SpitUrl.delete_url,{id:id},function(obj){
			if(obj.state_code == 200){
				el.parent().parent().parent().remove();
			}
		})
	}

})

//点击编辑
$(document).on("click",".emit",function(){
	var id=$(this).parent().parent().attr("num");
	
	var Name=$(this).parent().siblings("ul").find(".childName").html();
	var Sex=$(this).parent().siblings("ul").find(".childSex").html();
	
	var Birthday=$(this).parent().siblings("ul").find(".childBirthday").html();
	var School=$(this).parent().siblings("ul").find(".childSchool").html();
	
	var play=$(this).parent().siblings("ul").find(".childPlay").html();
	var str="<div class='childInforPart partInput' num="+id+"><ul><li>孩子姓名：<input type='text'/ class='Name' value="+Name+"></li><li>孩子性别：<input type='radio' name='sex' value='1' class='man'>男<input type='radio' name='sex' value='2' class='woman' />女</li><li>孩子生日：<input type='text' class='birthday' value="+Birthday+" onClick='new Calendar().show(this);' style='cursor:pointer'></li><li>孩子学校：<input type='text' class='school' value="+School+" ></li><li>可玩时间：<input type='text' class='play'  value="+play+" ></li></ul><div class='operate'><span class='save'><img src="+'/public/admin_static/img/'+'edit.png'+"><a href='javascript:;'>保存</a></span><span><img src="+'/public/admin_static/img/'+'delete.png'+"><a href='javascript:;' class='childDelete'>删除</a></span></div></div>";
	
	$(this).parent().parent(".childInforPart").html(str);
	if(Sex=="女"){
		$(".woman").attr("checked",true);
	}
	else{
		$(".man").attr("checked",true);
	}
});

//编辑之后保存
$(document).on("click",".save",function(){
	var id=$(this).parent().parent().attr("num");
	var uid=$(".hidden_val").val();
	var childName=$(".Name").val();
	var sex=$("input:radio:checked").val();
	var birthday=$(".birthday").val();
	var school=$(".school").val();
	var playTime=$(".play").val();
	$.post(SpitUrl.add_url,{uid:uid,id:id,name:childName,gender:sex,birthday:birthday,school:school,play_time:playTime},function(obj){
		if(obj.state_code == 200){
			window.location.reload();
		}
	})
})


//充值ajax
$(".recharge_for").on("click",function(event){
	event.preventDefault();
	var uid=$(".hidden_val").val();
	var amount=$(".amountMoney").val();
	var giveaway= $(".giveVal").val();
	var payTime=$(".pay_time").val();
	var isGet=$(".is_get input:radio:checked").val();
	var payWay=$(".pay_way option:selected").val();
    $.post(SpitUrl.recharge_url,{uid:uid,amount:amount,giveaway:giveaway,pay_time:payTime,is_get:isGet,pay_way:payWay},function(obj){
		if(obj.state_code == 200){
            window.location.reload();
		}
	})
	
})
//扣费ajax
$(".lose_money").on("click",function(event){
	event.preventDefault();
	var uid=$(".hidden_val").val();
	var money=$(".money").val();
	var remark=$(".remark").val()
    $.post(SpitUrl.deMoney_url,{uid:uid,money:money,remark:remark},function(obj){
		if(obj.state_code == 200){
            window.location.reload();
		}
	})
	
})

//请假弹出层
$(".leaveModal .cancel").on("click",function(){
	$(this).parent().parent().hide();
})
//点击请假
$(".activity_leave").live("click",function(){
	if($(this).html()=="已请假"){
		$(this).off("click");
	}
	else{
		$(".leaveModal").show()
		var id=$(this).parent().siblings(".leave_id").html();
		$(".hidden_id").val(id);
	}

})

//点击签到
$(".sign").live("click",function(){
	if($(this).html()=="已签到"){
		$(this).off("click");
	}
	else{
		var id=$(this).parent().siblings(".leave_id").html();

	    $.post(SpitUrl.sign_url,{id:id,order_status:4},function(obj){
		if(obj.state_code == 200){
			 window.location.reload();
		}
	    })
	}
})

//点击早退
$(".quit").live("click",function(){
	if($(this).html()=="已早退"){
		$(this).off("click");
	}
	else{
		var id=$(this).parent().siblings(".leave_id").html();
	    $.post(SpitUrl.sign_url,{id:id,order_status:8},function(obj){
		if(obj.state_code == 200){
			 window.location.reload();
		}
	    })
	}
})

//点击保存
$(".leaveSave").on("click",function(){
	var id= $(".hidden_id").val();
	var reason=$(".leaveCause textarea").val();
    $.post(SpitUrl.leave_url,{id:id,reason:reason},function(obj){
		if(obj.state_code == 200){
            window.location.reload();
		}
	})
})

//点击意向客户
$(".Wantuser").on("click",function(){
	if($(this).html()=="已标记"){
		$(this).off("click");
	}
	else{
		
				 var uid=$(this).parent().siblings(".uid").val();
				 $.post(SpitUrl.Amend_infoUrl,{uid:uid,label:1},function(obj){
					if(obj.state_code == 200){
			            window.location.reload();
					}
				})
		
	}

})

//修改客户信息点击保存
$(".amendSave").on("click",function(event){
	event.preventDefault();
	var uId=$(".uid").val();
	var Mobile=$(".mobile").val();
	var Nickname=$(".nickname").val();
	var Member_grade=$(".isGet input:radio:checked").val();
	var Status=$(".status option:selected").val();
	var Birthday=$(".birthday").val();
	var Hobby=$(".hobby").val();
	var Province=$(".province option:selected").val();
	var City=$(".city option:selected").val();
	var District=$(".district option:selected").val();
	var Address=$(".address").val();
	var Source=$(".source option:selected").val();
	$.post(SpitUrl.Amend_infoUrl,{uid:uId,
		mobile:Mobile,
		nickname:Nickname,
		member_grade:Member_grade,
		status:Status,
		birthday:Birthday,
		hobby:Hobby,
		province:Province,
		city:City,
		district:District,
		address:Address,
		source:Source
	},function(obj){
		if(obj.state_code == 200){
             window.history.go(-1);
		}
	})
	


})
//操作明细记录里面的选项(充值，扣费，付费)
var particularslis=$(".particularsUl").children();
particularslis.on("click",function(){
    var index=$(this).index();
    var typeNum=index+1;
    var uId=$(".hidden_val").val();
    var str='';
    if($(this).hasClass("active")){
    	$(this).removeClass("active");
    	console.log($(".activityRecord .data-table").attr("style"),'活动记录的宽度')
//  	$(".activityRecord .data-table").attr("style","width: 100%;")
     $.post('/api/user/getAnyUserConsumption',{uid:uId,type:''
		
	},function(obj){
		if(obj.state_code == 200){
			
			for(var i=0;i<obj.data.length;i++){
				
				str+="<tr>"+"<td>"+obj.data[i].id+"</td>"
				           +"<td>"+obj.data[i].money+"</td>"
						   +"<td>"+obj.data[i].balance+"</td>"
						   +"<td>"+obj.data[i].type+"</td>"
						   +"<td>"+obj.data[i].remark+"</td>"
						   +"<td>"+obj.data[i].addtime+"</td>"
						   +"<td class='center'><i class='delete icon-pencil repeal'>&nbsp;&nbsp;撤销</i>	</td>"
					  "</tr>"
				
				
			}
			
			Table.fnClearTable();
			Table.fnDestroy();
			$(".detailTable").html(str);
			
			
		    Table=$('.data-table').dataTable({
			    "bDestroy":true,
				"bJQueryUI": true,
				"retrieve":true,
				"sPaginationType": "full_numbers",
				"sDom": '<""l>t<"F"fp>',
				"bFilter":true,
				"bLengthChange":true,
				"aaSorting":[[0,"desc"]],
				"bAutoWidth":true
			});
			
           $(".data-table").attr("style","width:100%;");
			
			
		}
	})
    }
    else{
    	  $(this).addClass("active").siblings().removeClass("active");
    	  console.log($(".activityRecord .data-table").attr("style"),'活动记录的宽度1')
//  	  $(".activityRecord .data-table").attr("style","width: 100%;")
      	  $.post('/api/user/getAnyUserConsumption',{uid:uId,type:typeNum
		
	},function(obj){
		if(obj.state_code == 200){
			
			for(var i=0;i<obj.data.length;i++){
				
				str+="<tr>"+"<td>"+obj.data[i].id+"</td>"
				           +"<td>"+obj.data[i].money+"</td>"
						   +"<td>"+obj.data[i].balance+"</td>"
						   +"<td>"+obj.data[i].type+"</td>"
						   +"<td>"+obj.data[i].remark+"</td>"
						   +"<td>"+obj.data[i].addtime+"</td>"
						   +"<td class='center'><i class='delete icon-pencil repeal'>&nbsp;&nbsp;撤销</i>	</td>"
					  "</tr>"
				
				
			}
			
			Table.fnClearTable();
			Table.fnDestroy();
			$(".detailTable").html(str);
			
			
		    Table=$('.data-table').dataTable({
			    "bDestroy":true,
				"bJQueryUI": true,
				"retrieve":true,
				"sPaginationType": "full_numbers",
				"sDom": '<""l>t<"F"fp>',
				"bFilter":true,
				"bLengthChange":true,
				"aaSorting":[[0,"desc"]],
				"bAutoWidth":true
			});
			
            $(".data-table").attr("style","width: 100%;");
			
			
		}
	})
    }
    

})

//点击明细记录里面的撤销
$(document).on("click",".repeal",function(){
	   var repealId=$(this).parent().siblings(".sorting_1").html();
	   var parent=$(this).parent().parent();
		var trueOrfalse = confirm("是否确认撤销");
		if(!trueOrfalse) {
			return;
		} else {

		$.post('/api/user/undoUserConsumeDetail',{id:repealId},function(obj) {
            if(obj.state_code == 200) {
            	  parent.remove();
				  $(".balance").html(obj.data.balance);
				
			} else {
				
			}
		})
	}
})


//活动安排里面输入折扣,价格改变

$(".discount").on("blur",function(){
	
	if($(this).val()==''){
//		$(".price").val(priceVal);
	}
	else{
	var discountVal=$(".discount").val()/100;
    var priceVal=Number($(".price").val());
    console.log(discountVal,priceVal)
    var priceNow = discountVal*priceVal;
	$(".price").val(priceNow.toFixed(2));
	}
	
	
})

//$(".price").on("blur",function(){
//	priceVal=Number($(this).val());
//	var priceNow = discountVal*priceVal;
//	$(".price").val(priceNow);
//})


  



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
function seachdistricts(city){
	$.get("/home/user/getRegion", { id: city },
		function(obj){
			if(obj.state_code == 200) {
				$("#seachdistrict").html(obj.data);
			}
	}, "json");
}
//活动类型改变事件
function changeActivityType(tid) {
	$.get("/abab.php/activity/getSonType", {id:tid},
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

//活动列表(点击事件)
function ClickRecommend(url,option,my,wordNo,wordYes,addClass) {

	$.post(url, option, function(obj) {
		if(obj.state_code == 200) {
			if(my.hasClass("yes")) {
				my.html(wordNo)
				my.attr("class","no")
				my.addClass(addClass);
			} 
			else{
				my.html(wordYes);
				
				my.attr("class","yes")
				my.addClass(addClass);
			}
		}

	})

}
