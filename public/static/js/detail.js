$(".view-ul").click(function() {
	$(".active_comment").css("display", "block");
	$(".relate_toy").css("display", "none");
	$(".active_question").css("display", "none");
	$(".view-ul").css("background-color", "#FF4134");
	$(".view-ul").css("color", "white");
	$(".all-comment").css("background-color", "#F9F9F9");
	$(".all-comment").css("color", "black");
	$(".all-question").css("background-color", "#F9F9F9");
	$(".all-question").css("color", "black");
});
$(".all-comment").click(function() {
	$(".active_comment").css("display", "none");
	$(".relate_toy").css("display", "block");
	$(".active_question").css("display", "none");
	$(".all-comment").css("background-color", "#FF4134");
	$(".all-comment").css("color", "white");
	$(".view-ul").css("background-color", "#F9F9F9");
	$(".view-ul").css("color", "black");
	$(".all-question").css("background-color", "#F9F9F9");
	$(".all-question").css("color", "black");
});
$(".all-question").click(function() {
	$(".all-comment").css("background-color", "#F9F9F9");
	$(".all-comment").css("color", "black");
	$(".view-ul").css("background-color", "#F9F9F9");
	$(".view-ul").css("color", "black");
	$(".all-question").css("background-color", "#FF4134");
	$(".all-question").css("color", "white");
	$(".active_comment").css("display", "none");
	$(".relate_toy").css("display", "none");
	$(".active_question").css("display", "block");

});

function showTime() {
	var mydate = new Date();
	var str = "" + mydate.getFullYear() + "-";
	str += (mydate.getMonth() + 1) + "-";
	str += mydate.getDate();
	return str;
}

//个人中心-我的活动
$(".userRightNav li").click(function() {
	$(this).addClass("active_userRight").siblings().removeClass("active_userRight");
});
$(".navMyOrder").click(function() {
	$(".orderList").css("display", "block");
	$(".no_pay").css("display", "none");
	$(".have_pay").css("display", "none");
	$(".no_access").css("display", "none");
	$(".refund").css("display", "none");
});
$(".navNoPay").click(function() {
	$(".orderList").css("display", "none");
	$(".no_pay").css("display", "block");
	$(".have_pay").css("display", "none");
	$(".no_access").css("display", "none");
	$(".refund").css("display", "none");
});
$(".navHavePay").click(function() {
	$(".orderList").css("display", "none");
	$(".no_pay").css("display", "none");
	$(".have_pay").css("display", "block");
	$(".no_access").css("display", "none");
	$(".refund").css("display", "none");
});
$(".navAccess").click(function() {
	$(".orderList").css("display", "none");
	$(".no_pay").css("display", "none");
	$(".have_pay").css("display", "none");
	$(".no_access").css("display", "block");
	$(".refund").css("display", "none");
});
$(".navRefund").click(function() {
	$(".orderList").css("display", "none");
	$(".no_pay").css("display", "none");
	$(".have_pay").css("display", "none");
	$(".no_access").css("display", "none");
	$(".refund").css("display", "block");
});
$(".nav_pay_favorite").click(function() {
	$(".pay_myfavorite").css("display", "block");
	$(".nopay_myfavorite").css("display", "none");
});
$(".nav_nopay_favorite").click(function() {
	$(".pay_myfavorite").css("display", "none");
	$(".nopay_myfavorite").css("display", "block");
});
//我的消息

$(".navTalkMessage").click(function() {
	$(".buyMessage").css("display", "none");
	$(".talkMessage").css("display", "block");
});
$(".navBuyMessage").click(function() {
	$(".buyMessage").css("display", "block");
	$(".talkMessage").css("display", "none");
});