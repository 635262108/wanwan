<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\chuangzhixing\wanwan/application/admin\view\user\mobile_sign.html";i:1512539135;}*/ ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>玩翫碗签到管理系统</title>
		<link rel="stylesheet" href="__ACSS__/sign.css" />
		<link rel="stylesheet" href="__ACSS__/bootstrap.min.css" />
		<link rel="stylesheet" href="__ACSS__/matrix-style.css" />

	</head>
	<style>
		.tbody_center tr td{
			padding-left: 5px;
			padding-right: 5px;
			box-sizing: border-box;
		}
	</style>

	<body id="bg">
		<div class="signContent">
			<div class="system">
				<div class="title">签到管理系统</div>
				<div class="sign_member">
					<!--<button onclick="del()">点击</button>-->
					<div class="promptContent">
						<input type="text" class="phonePrompt" value="" style="width: 25%;">
						<button class="search_order">查询</button>
					</div>
					<table class="data-table" style="width: 680px;margin: 20px auto;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">
						<thead>
							<tr>
								<th>id</th>
								<th>活动名称</th>
								<th>手机号</th>
								<th>姓名</th>
								<th>大人数量</th>
								<th>小孩数量</th>
								<th>支付方式</th>
								<th>支付时间</th>
								<th>操作</th>
                                
							</tr>
						</thead>
						<tbody class="tbody_center" style="font-size: 12px;">
						    
						</tbody>
					</table>
				</div>

			</div>

		</div>

		<script src="__AJS__/jquery.min.js"></script>
		<script src="__AJS__/jquery.dataTables.min.js"></script>
		<script src="__AJS__/bootstrap.min.js"></script> 
		<script>
		
			 $(".search_order").on("click",function(){
			 	var phoneVal=$(".phonePrompt").val();
			 	var str='';
			   $.get("/abab.php/user/getMobileOrders", {mobile:phoneVal },
					function(obj) {
						
						if(obj.state_code == 200) {
							
							for(var i=0;i<obj.data.length;i++){
								
								str+="<tr>"+ 
							     "<td class='td_first'>"+obj.data[i].order_id+"</td>"+
								"<td>" + obj.data[i].a_title + "</td>"+ 
								"<td>" + obj.data[i].mobile + "</td>"+ 
								"<td>" + obj.data[i].name + "</td>"+ 
								"<td>" +obj.data[i].adult_num+"</td>"+
								"<td>"+obj.data[i].child_num+"</td>"+
								"<td>"+obj.data[i].pay_way+"</td>"+
								"<td>"+obj.data[i].pay_time+"</td>"+
								"<td><button style='width:55px;height:23px;background:#00A0E9;color:#fff;border:none;outline:none;border-radius:3px;font-size:12px' class='qian'>签到</button>"+"</td>"+
								"</tr>"
								
							}
							
							$(".tbody_center").html(str);
							
								
						} 
						else{
								alert(obj.msg);
						}
				}, "json");
			 })
			 
//			 点击签到
            $(document).on("click",'.qian',function(el){
            	var qianId=$(this).parent().siblings(".td_first").html();
                   el=$(this);
                   console.log($(this),9999)
            	
               $.get("/abab.php/user/orderIdSign", {id:qianId},
					function(obj) {
						
						if(obj.state_code == 200) {
							
							el.html(obj.msg)
							
								
						} 
				}, "json");
            })
		</script>
	</body>

</html>