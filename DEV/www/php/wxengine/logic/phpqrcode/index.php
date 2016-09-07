<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once "../example/WxPay.NativePay.php";
require_once '../example/log.php';

//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$notify = new NativePay();
$url1 = $notify->GetPrePayUrl("123456789");
$url2 = $notify->GetPrePayUrl("123456700");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$inputPid001 = new WxPayUnifiedOrder();
$inputPid001 ->SetBody("test");
$inputPid001 ->SetAttach("test");
$inputPid001 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid001 ->SetTotal_fee("3000");
$inputPid001 ->SetTime_start(date("YmdHis"));
$inputPid001 ->SetTime_expire(date("YmdHis", time() + 600));
$inputPid001 ->SetGoods_tag("test");
$inputPid001 ->SetNotify_url("http://200.200.200.212/example/notify.php");
$inputPid001 ->SetTrade_type("NATIVE");
$inputPid001 ->SetProduct_id("123456781");
$resultPid001 = $notify->GetPayUrl($inputPid001);
$urlPid001 = $resultPid001 ["code_url"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>VRDreams</title>
<meta content="free website template" name="description" />
<meta content="enter your keywords here" name="keywords" />
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<meta content="IE=9" http-equiv="X-UA-Compatible" />
<link href="http://200.200.200.212/php/dwj/css/style.css" rel="stylesheet" type="text/css" />
<script src="http://200.200.200.212/php/dwj/js/jquery.min.js" type="text/javascript"></script>
<script src="http://200.200.200.212/php/dwj/js/image_slide.js" type="text/javascript"></script>
</head>

<!--the CSS for the description popup-->
<style>
.popup {
	position: relative;
	display: inline-block;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.popup .popuptext {
	visibility: hidden;
	width: 160px;
	background-color: #555;
	color: #fff;
	text-align: center;
	border-radius: 6px;
	padding: 8px 0;
	position: absolute;
	z-index: 1;
	bottom: 125%;
	left: 50%;
	margin-left: -80px;
}
.popup .popuptext::after {
	content: "";
	position: absolute;
	top: 100%;
	left: 50%;
	margin-left: -5px;
	border-width: 5px;
	border-style: solid;
	border-color: #555 transparent transparent transparent;
}
.popup .show {
	visibility: visible;
	-webkit-animation: fadeIn 1s;
	animation: fadeIn 1s;
}
@-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 1;}
}
@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
}
</style>
<body>

<script>
// When the user clicks on div, open the popup
function myFunctionPop() {
    var popup = document.getElementById('myPopup');
    popup.classList.toggle('show');
}
</script>
<div id="main">
	<div id="header">
		<div id="banner">
			<div id="welcome">
				<h1>欢迎来到虚实梦境&nbsp;</h1>
			</div>
			<!--close welcome-->
			<div id="menubar">
				<ul id="menu">
					<li><a href="http://weibo.com/dawanjiaclc">合作商主页 - 大玩家</a></li>
				</ul>
			</div>
			<!--close menubar--></div>
		<!--close banner--></div>
	<!--close header-->
	<div id="site_content">
		<div class="slideshow">
			<ul class="slideshow">
				<li class="show">
				<img alt="&quot;VRDreams.com.cn&quot;" height="250" src="http://200.200.200.212/php/dwj/images/home_1.jpg" width="900" /></li>
				<li>
				<img alt="" height="250" src="http://200.200.200.212/php/dwj/images/home_2.jpg" width="900" /></li>
			</ul>
		</div>
		<!--close slideshow-->
		<div class="ourwork" style="height: 290px">
			<h3>VR 火力全开</h3>
			<p>微信二维码支付<br />
			单次游戏:30RMB<br />
			双人游戏:50RMB</p>
			<div class="popup" onclick="myFunctionPop()">
				内容介绍 <span id="myPopup" class="popuptext">this game is great!!!!!!!!!!</span>
			</div>
			<p>
			<img alt="Photo landscape" src="http://200.200.200.212/example/qrcode.php?data=<?php echo urlencode($urlPid001);?>" /></p>
			<!--close more--></div>
		<!--close ourwork-->
		<div class="testimonials" style="height: 290px">
			<h3>VR 疯狂水果</h3>
			<p>微信二维码支付<br />
			单次游戏:30RMB<br />
			双人游戏:50RMB</p>
			<!--close more--></div>
		<!--close testimonials-->
		<div class="projects" style="height: 290px">
			<h3>VR 最高危机</h3>
			<p>微信二维码支付<br />
			单次游戏:30RMB<br />
			双人游戏:50RMB</p>
			<!--close more--></div>
		<!--close projects-->
		<div id="content">
			<div class="content_item">
				<h1>合作伙伴</h1>
				<p>&nbsp;</p>
				<form method="post">
					<input height="122" name="Image_partner001" src="http://200.200.200.212/php/dwj/images/GSTX_logo_s.png" type="image" width="100" />&nbsp;&nbsp;&nbsp;&nbsp;
					<input height="104" name="Image_partner002" src="http://200.200.200.212/php/dwj/images/wx_pay_logo_s.png" type="image" width="100" /></form>
				<p></p>
			</div>
			<!--close content_item--></div>
		<!--close content--></div>
	<!--close site_content-->
	<!--close content_grey--></div>
<!--close main-->
<div id="footer_container">
	<div id="footer">
		ALL RIGHTS RECEIVED BY VRDREAMS.COM.CN </div>
	<!--close footer--></div>
<!--close footer_container-->

</body>

</html>

