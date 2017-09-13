$(document).ready(function(){
var trs=$("#tbody_center tr");
//	console.log($(".check"),8888)
var checks=$(".check");
//	console.log(trs.children("td").find(".check"),8888)
checks.live("click",function(event){
		
    event.stopPropagation();
    $(".modal_box").show();
        
    var userId=$(this).parent().parent().children("td:nth-child(1)").html();
    $.post("/abab.php/user/getUserInfo",{"uid":userId},function(obj){
            if(obj.state_code == 200){
                $(".userId").html(userId);
                $(".phone").html(obj.data.mobile);
                $(".nickname").html(obj.data.nickname);
                $(".birthday").html(obj.data.birthday);
                $(".hobby").html(obj.data.hobby);
                $(".normal").html(obj.data.status);//状态
                $(".address").html(obj.data.address);
                $(".start").html(obj.data.reg_time);//注册时间
                $(".finsh").html(obj.data.last_time);//最后登录时间
                $(".province").html(obj.data.province);//所在省
                $(".country").html(obj.data.city);
                $(".area").html(obj.data.district);//区
                $(".sign").html(obj.data.signature);
            }else{
                alert(obj.msg)
            }
    })
})
        
//弹出关闭按钮
$(".cancel").on("click",function(){
        $(".modal_box").hide();
})
	
	


//取消(是否确认取消)
$(".btn-warning").on("click",function(){
	return confirm("是否确认取消");
})

//活动页面删除
$(".activity_delete").live("click",function(){
	var trueOrfalse=confirm("是否确认删除");
        var _this = $(this);
	if(!trueOrfalse){
            return;
	}
	else{
            var activityId=$(this).parent().parent().children("td:nth-child(1)").html();
            $.post("/abab.php/activity/delActivity",{"aid":activityId},function(data){
                if(data.state_code== 200){
                    _this.parent().parent().hide();
                }else{
                    alert(data.msg)
                }
            })
		
	}
	
})

//活动分类删除
$(".classfy_delete").live("click",function(){
	var trueOrfalse=confirm("是否确认删除");
        var _this = $(this);
	if(!trueOrfalse){
            return;
	}
	else{
            var tid=$(this).parent().parent().parent().find("td").eq(0).html();
            $.post("/abab.php/activity/delType",{"id":tid},function(data){
                if(data.state_code == 200){
                    _this.parent().parent().parent().hide();
                }else{
                    alert(data.msg)
                }
            })
	}
})

//评论提问删除
$(".ask_delete").live("click",function(){
	var trueOrfalse=confirm("是否确认删除");
        var _this = $(this);
	if(!trueOrfalse){
            return;
	}
	else{
            var cid=$(this).parent().parent().parent().find("td").eq(0).html();
            $.post("/abab.php/activity/delAnyReply",{"id":cid},function(data){
                if(data.state_code == 200){
                    _this.parent().parent().parent().hide();
                }else{
                    alert(data.msg)
                }
            })
	}
})

//评论删除
$(".com_delete").live("click",function(){
	var trueOrfalse=confirm("是否确认删除");
        var _this = $(this);
	if(!trueOrfalse){
            return;
	}
	else{
            var cid=$(this).parent().parent().find("td").eq(0).html();
            $.post("/abab.php/activity/delAnyReply",{"id":cid},function(data){
                if(data.state_code == 200){
                    _this.parent().parent().hide();
                }else{
                    alert(data.msg)
                }
            })
	}
})

//活动规格
$(".spe_delete").live("click",function(){
	var trueOrfalse=confirm("是否确认删除");
        var _this = $(this);
	if(!trueOrfalse){
            return;
	}
	else{
            var cid=$(this).parent().parent().parent().find("td").eq(0).html();
            $.post("/abab.php/activity/delAnySpe",{"id":cid},function(data){
                if(data.state_code == 200){
                    _this.parent().parent().hide();
                }else{
                    alert(data.msg)
                }
            })
	}
})
})

//省改变事件
function seachcitys(province){
    $.get("/home/user/getRegion",{id:province},
    function(obj){
        if(obj.state_code == 200){
            $("#seachcity").html(obj.data);
        }
    }, "json");
}
//市改变事件
function seachdistricts(city){
    $.get("/home/user/getRegion",{id:city},
    function(obj){
        if(obj.state_code == 200){
            $("#seachdistrict").html(obj.data);
        }
    }, "json");
}
//活动类型改变事件
function changeActivityType(tid){
    $.get("/abab.php/activity/getSonType",{id:tid},
    function(obj){
        if(obj.state_code == 200){
            $("#sonType").html(obj.data);
        }
    }, "json");
}