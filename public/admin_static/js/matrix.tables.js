
$(document).ready(function(){
	
//	$('.data-table').dataTable({
//		"bJQueryUI": true,
//		"sPaginationType": "full_numbers",
//		"sDom": '<""l>t<"F"fp>',
//		"bFilter":true,
//		"bLengthChange":true,
//		"aaSorting":[[0,"desc"]],
//		"retrieve":true,
//		"bDestroy":true
//	});
	
	
	$('select').select2();
	
	$("span.icon input:checkbox, th input:checkbox").click(function() {
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
		checkbox.each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.checker > span').addClass('checked');
			}
		});
	});	
});
