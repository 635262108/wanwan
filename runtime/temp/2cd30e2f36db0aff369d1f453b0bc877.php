<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\chuangzhixing\wanwan/application/admin\view\user\sign.html";i:1512526420;}*/ ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>玩翫碗签到管理系统</title>
		<link rel="stylesheet" href="__ACSS__/sign.css" />
		<link rel="stylesheet" href="__ACSS__/bootstrap.min.css" />
		<link rel="stylesheet" href="__ACSS__/matrix-style.css" />

</head>

	<body id="bg">
		<div class="signContent">
			<div class="system">
				<div class="title">签到管理系统</div>
				<div class="sign_member">
					<!--<button onclick="del()">点击</button>-->
					<div class="prompt"><input type="text" class="urlPrompt" value=""></div>
					<table class="data-table" style="width: 632px;margin: 20px auto;" cellspacing="0" cellpadding="0" border="1" bordercolor="#ccc">
						<thead>
							<tr>
								<th>活动名称</th>
								<th>姓名</th>
								<th>签到结果</th>
                                
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
			$(function() {
				setTimeout('send_data()', 3000);
						
					
			})
			$('.data-table').dataTable({
								"bJQueryUI": true,
								"sPaginationType": "full_numbers",
								"sDom": '<""l>t<"F"fp>',
								"bFilter":false,
								"bLengthChange":false,
								"bPaginage":true ,
							    "ordering":true,
							    "bPaginate": true,
							    "iDisplayLength":5,
							    "bAutoWidth":true
							   
			   });	
			
		
		
											
		function send_data() {
				var url = $(".urlPrompt").val();
				if(url==''){
					setTimeout('send_data()', 1000);
					return;
				}
				$.ajax({
					url: url,
					type: "post",
					dataType: "json", //指定服务器返回的数据类型
					success: function(obj) {
						if(obj.state_code == 200) {
							$(".tbody_center").prepend("<tr>"+ 
							     "<td>"+obj.data.activity+"</td>"+
								"<td>" + obj.data.name + "</td>"+ 
								"<td>" + obj.msg + "</td>"+ 
								"</tr>")
							 $('.data-table').dataTable({
			    	            "bDestroy":true,
								"bJQueryUI": true,
								"sPaginationType": "full_numbers",
								"sDom": '<""l>t<"F"fp>',
								"bFilter":false,
								"bLengthChange":false,
								"bPaginage":true ,
							    "ordering":true,
							    "bPaginate": true,
							    "iDisplayLength":10,
							    "bAutoWidth":true
							   
			    			});	
							

						} else {
							$(".tbody_center").prepend("<tr>"+
							    "<td>"+obj.data.activity+"</td>"+
								"<td>" + obj.data.name + "</td>"+ 
								"<td style='color:#ff4134'>" + obj.msg + "</td>" +
								"</tr>")
							
							 $('.data-table').dataTable({
			    	            "bDestroy":true,
								"bJQueryUI": true,
								"sPaginationType": "full_numbers",
								"sDom": '<""l>t<"F"fp>',
								"bFilter":false,
								"bLengthChange":false,
								"bPaginage":true ,
							    "ordering":true,
							    "bPaginate": true,
							    "iDisplayLength":10,
							    "bAutoWidth":true
							   
			    			});	
						}
						$(".urlPrompt").val('');

					}
				});

				setTimeout('send_data()', 1000);
			}
		
		</script>
	</body>

</html>