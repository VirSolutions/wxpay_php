<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

require_once "/home/www/php/wxengine/lib/WxPay.Api.php";
require_once "/home/www/php/wxengine/logic/WxPay.NativePay.php";
require_once "/home/www/php/wxengine/logic/log.php";

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
//$url1 = $notify->GetPrePayUrl("123456789");
//$url2 = $notify->GetPrePayUrl("123456700");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$WxPayUnifiedOrder = new WxPayUnifiedOrder();
$inputPid001 = &$WxPayUnifiedOrder;
$inputPid001 ->SetBody("大玩家金牛万达店_水果先锋");
$inputPid001 ->SetAttach("大玩家金牛万达店");
$inputPid001 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid001 ->SetTotal_fee("1000");
$inputPid001 ->SetTime_start(date("YmdHis"));
$inputPid001 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid001 ->SetGoods_tag("水果先锋");
$inputPid001 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid001 ->SetTrade_type("NATIVE");
$inputPid001 ->SetProduct_id("Fruit_DWJ_JNWD_S");
$resultPid001 = $notify->GetPayUrl($inputPid001);
$urlPid001 = $resultPid001 ["code_url"];

sleep(1);

/**$inputPid002 = new WxPayUnifiedOrder(); */
$inputPid002 = &$WxPayUnifiedOrder;
$inputPid002 ->SetBody("大玩家金牛万达店_全面开火");
$inputPid002 ->SetAttach("大玩家金牛万达店");
$inputPid002 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid002 ->SetTotal_fee("3000");
$inputPid002 ->SetTime_start(date("YmdHis"));
$inputPid002 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid002 ->SetGoods_tag("全面开火");
$inputPid002 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid002 ->SetTrade_type("NATIVE");
$inputPid002 ->SetProduct_id("Fire_DWJ_JNWD_S");
$resultPid002 = $notify->GetPayUrl($inputPid002);
$urlPid002 = $resultPid002 ["code_url"];

sleep(1);

/**$inputPid003 = new WxPayUnifiedOrder();*/
$inputPid003 = &$WxPayUnifiedOrder;
$inputPid003 ->SetBody("大玩家金牛万达店_水果先锋_双人");
$inputPid003 ->SetAttach("大玩家金牛万达店");
$inputPid003 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid003 ->SetTotal_fee("2000");
$inputPid003 ->SetTime_start(date("YmdHis"));
$inputPid003 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid003 ->SetGoods_tag("水果先锋");
$inputPid003 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid003 ->SetTrade_type("NATIVE");
$inputPid003 ->SetProduct_id("Fruit_DWJ_JNWD_D");
$resultPid003 = $notify->GetPayUrl($inputPid003);
$urlPid003 = $resultPid003 ["code_url"];

sleep(1);

/**$inputPid004 = new WxPayUnifiedOrder();*/
$inputPid004 = &$WxPayUnifiedOrder;
$inputPid004 ->SetBody("大玩家金牛万达店_全面开火_动感背心");
$inputPid004 ->SetAttach("大玩家金牛万达店");
$inputPid004 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid004 ->SetTotal_fee("1000");
$inputPid004 ->SetTime_start(date("YmdHis"));
$inputPid004 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid004 ->SetGoods_tag("全面开火_动感背心");
$inputPid004 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid004 ->SetTrade_type("NATIVE");
$inputPid004 ->SetProduct_id("Fire_DWJ_JNWD_Vest");
$resultPid004 = $notify->GetPayUrl($inputPid004);
$urlPid004 = $resultPid004 ["code_url"];

			
if (empty($urlPid001)){
	echo "PID001 not set";
} else {
		echo "PID001 URL: " .$urlPid001;
}
 
if (empty($urlPid002)){
	echo "PID002 not set";
} else {
		echo "PID002 URL: " .$urlPid002;
}
 
if (empty($urlPid003)){
	echo "PID003 not set";
} else {
		echo "PID003 URL: " .$urlPid003;
}

if (empty($urlPid004)){
	echo "PID004 not set";
} else {
		echo "PID004 URL: " .$urlPid004;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>VRDreams</title>
<meta content="3600" http-equiv="refresh" />
<meta content="free website template" name="description" />
<meta content="enter your keywords here" name="keywords" />
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<meta content="IE=9" http-equiv="X-UA-Compatible" />
<link href="http://60.205.127.180/php/vendor/dwj/css/style.css" rel="stylesheet" type="text/css" />
<script src="http://60.205.127.180/php/vendor/dwj/js/jquery.min.js" type="text/javascript"></script>
<script src="http://60.205.127.180/php/vendor/dwj/js/image_slide.js" type="text/javascript"></script>
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
	width: 180px;
	background-color: #555;
	color: #fff;
	text-align: center;
	border-radius: 6px;
	padding: 8px;
	position: absolute;
	z-index: 2000;
	bottom: 100%;
	left: 1%;
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
function fireFunctionPop() {
    var fire_popup = document.getElementById('Popup_fire');
    fire_popup.classList.toggle('show');
}
function fruitFunctionPop() {
    var fruit_popup = document.getElementById('Popup_fruit');
    fruit_popup.classList.toggle('show');
}

</script>
<div id="main">
	<div id="header">
		<div id="banner">
			<div id="welcome">
				<h1>欢迎来到VR竞技场&nbsp;</h1>
			</div>
			<!--close welcome-->
			<div id="menubar">
				<ul id="menu">
					<li><a href="http://weibo.com/dawanjiaclc">合作商主页 - 大玩家金牛万达店</a></li>
					<li><a href="http://60.205.127.180/vendor/dwj/promotion.php" target="_blank">活动通道</a></li>
				</ul>
			</div>
			<!--close menubar--></div>
		<!--close banner--></div>
	<!--close header-->
	<div id="site_content">
		<div class="slideshow">
			<ul class="slideshow">
				<li class="show">
				<img alt="www.VRDreams.com.cn" height="250" src="http://60.205.127.180/php/vendor/dwj/images/vrd_logo.png" width="900" /></li>
				<li>
				<img alt="weibo.com/dawanjiaclc" height="250" src="http://60.205.127.180/php/vendor/dwj/images/dwj_logo.jpg" width="900" /></li>
			</ul>
		</div>
		<!--close slideshow-->
		
		<div class="ourwork" style="height: 290px">
			<h4>VR 全面开火</h4>
			<h3>单次游戏: 30人民币</h3>
			<form method="post" style="vertical-align: middle; text-align: center">
				微信二维码支付<br />
				<br />
				<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid002);?>" /> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/fire_dm.png" width="149" />
			</form>
			<p></p>
			<div class="popup" onclick="fireFunctionPop()" style="height: 16px">
				<h3>游戏装备 动感背心: 10人民币 - 请点击这里</h3>
				<span id="Popup_fire" class="popuptext">
				<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid004);?>" />
				</span></div>
			<!--close more--></div>
		<!--close ourwork-->
		
		<div class="testimonials" style="height: 290px">
			<h4>VR 水果先锋</h4>
			<h3>单次游戏: 10人民币</h3>

			<form method="post" style="vertical-align: middle; text-align: center">
				微信二维码支付<br />
				<br />
				<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid001);?>" />  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/fruit_dm.png" width="149" />
			</form>
			<p></p>
			<div class="popup" onclick="fruitFunctionPop()" style="height: 16px">
				<h3>双次游戏: 20人民币 - 请点击这里</h3>
				<span id="Popup_fruit" class="popuptext"> 
					<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid003);?>" />
				</span>
			</div>

			<!--close more--></div>
		<!--close testimonials-->

		<div id="content">
			<div class="content_item">
				<h1>合作伙伴</h1>
				<p>&nbsp;</p>
				<form method="post" style="vertical-align: middle; text-align: center">
					<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/vive_logo.png" width="100" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/unity_3d.png" width="100" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/unreal_logo.png" width="100" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/wxpay_logo.png" width="100" />
				</form>
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
