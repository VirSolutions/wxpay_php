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
$inputPid001 ->SetBody("大玩家万达店_水果忍者");
$inputPid001 ->SetAttach("Products001");
$inputPid001 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid001 ->SetTotal_fee("1");
$inputPid001 ->SetTime_start(date("YmdHis"));
$inputPid001 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid001 ->SetGoods_tag("水果忍者");
$inputPid001 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid001 ->SetTrade_type("NATIVE");
$inputPid001 ->SetProduct_id("123456781");
$resultPid001 = $notify->GetPayUrl($inputPid001);
$urlPid001 = $resultPid001 ["code_url"];

sleep(1);

/**$inputPid002 = new WxPayUnifiedOrder(); */
$inputPid002 = &$WxPayUnifiedOrder;
$inputPid002 ->SetBody("大玩家万达店_火力全开");
$inputPid002 ->SetAttach("Products002");
$inputPid002 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid002 ->SetTotal_fee("2");
$inputPid002 ->SetTime_start(date("YmdHis"));
$inputPid002 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid002 ->SetGoods_tag("火力全开");
$inputPid002 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid002 ->SetTrade_type("NATIVE");
$inputPid002 ->SetProduct_id("123456782");
$resultPid002 = $notify->GetPayUrl($inputPid002);
$urlPid002 = $resultPid002 ["code_url"];

sleep(1);

/**$inputPid003 = new WxPayUnifiedOrder();*/
$inputPid003 = &$WxPayUnifiedOrder;
$inputPid003 ->SetBody("大玩家万达店_最高危机");
$inputPid003 ->SetAttach("Products003");
$inputPid003 ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid003 ->SetTotal_fee("1");
$inputPid003 ->SetTime_start(date("YmdHis"));
$inputPid003 ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid003 ->SetGoods_tag("最高危机");
$inputPid003 ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid003 ->SetTrade_type("NATIVE");
$inputPid003 ->SetProduct_id("123456783");
$resultPid003 = $notify->GetPayUrl($inputPid003);
$urlPid003 = $resultPid003 ["code_url"];

			
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
	width: 400px;
	background-color: #555;
	color: #fff;
	text-align: left;
	border-radius: 6px;
	padding: 8px;
	position: absolute;
	z-index: 2000;
	bottom: 125%;
	left: 50%;
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
				<h1>欢迎来到VR竞技场&nbsp;</h1>
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
				<img alt="&quot;VRDreams.com.cn&quot;" height="250" src="http://60.205.127.180/php/vendor/dwj/images/home_1.jpg" width="900" /></li>
				<li>
				<img alt="" height="250" src="http://60.205.127.180/php/vendor/dwj/images/home_2.jpg" width="900" /></li>
			</ul>
		</div>
		<!--close slideshow-->
		<div class="ourwork" style="height: 290px">
			<h3>VR 火力全开</h3>
			<p>微信二维码支付<br />
			单次游戏:30RMB<br />
			双人游戏:50RMB</p>
			<div class="popup" onclick="myFunctionPop()">
				内容介绍 <span id="myPopup" class="popuptext">《神秘海域》是集解谜、寻宝、探险、射击于一身的冒险动作游戏系列。PS3\PS4系列由SCE旗下Naughty 
				Dog（顽皮狗）工作室制作，PSV版则由Bend Studio制作，为外传性质作品。第一部作品于2007年发售。游戏设定在原始丛林、热带雨林、沙漠腹地、雪山高原、古代遗迹等地，以电影方式呈现。主人公Nathan 
				Drake（内森·德雷克）要面对各种各样的敌人，最终找到宝藏。该系列游戏同时拥有小说和电影等衍生作品，小说由Christopher 
				Golden执笔，2011年10月4日推出。电影版从2008年开始筹备，但进度缓慢，预计于2015年初开始拍摄，2016年上映。
				</span></div>
			<p>
			<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid001);?>" /></p>
			<!--close more--></div>
		<!--close ourwork-->
		<div class="testimonials" style="height: 290px">
			<h3>VR 疯狂水果</h3>
			<p>微信二维码支付<br />
			单次游戏:30RMB<br />
			双人游戏:50RMB</p>
			<div class="popup" onclick="myFunctionPop()">
				内容介绍 <span id="myPopup" class="popuptext">《神秘海域》是集解谜、寻宝、探险、射击于一身的冒险动作游戏系列。PS3\PS4系列由SCE旗下Naughty 
				Dog（顽皮狗）工作室制作，PSV版则由Bend Studio制作，为外传性质作品。第一部作品于2007年发售。游戏设定在原始丛林、热带雨林、沙漠腹地、雪山高原、古代遗迹等地，以电影方式呈现。主人公Nathan 
				Drake（内森·德雷克）要面对各种各样的敌人，最终找到宝藏。该系列游戏同时拥有小说和电影等衍生作品，小说由Christopher 
				Golden执笔，2011年10月4日推出。电影版从2008年开始筹备，但进度缓慢，预计于2015年初开始拍摄，2016年上映。</span>
			</div>
			<p>
			<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid002);?>" /></p>
			<!--close more--></div>
		<!--close testimonials-->
		<div class="projects" style="height: 290px">
			<h3>VR 最高危机</h3>
			<p>微信二维码支付<br />
			单次游戏:30RMB<br />
			双人游戏:50RMB</p>
			<div class="popup" onclick="myFunctionPop()">
				内容介绍 <span id="myPopup" class="popuptext">《神秘海域》是集解谜、寻宝、探险、射击于一身的冒险动作游戏系列。PS3\PS4系列由SCE旗下Naughty 
				Dog（顽皮狗）工作室制作，PSV版则由Bend Studio制作，为外传性质作品。第一部作品于2007年发售。游戏设定在原始丛林、热带雨林、沙漠腹地、雪山高原、古代遗迹等地，以电影方式呈现。主人公Nathan 
				Drake（内森·德雷克）要面对各种各样的敌人，最终找到宝藏。该系列游戏同时拥有小说和电影等衍生作品，小说由Christopher 
				Golden执笔，2011年10月4日推出。电影版从2008年开始筹备，但进度缓慢，预计于2015年初开始拍摄，2016年上映。</span>
			</div>
			<p>
			<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid003);?>" /></p>
			<!--close more--></div>
		<!--close projects-->
		<div id="content">
			<div class="content_item">
				<h1>合作伙伴</h1>
				<p>&nbsp;</p>
				<form method="post">
					<input height="122" name="Image_partner001" src="http://60.205.127.180/php/vendor/dwj/images/GSTX_logo_s.png" type="image" width="100" />&nbsp;&nbsp;&nbsp;&nbsp;
					<input height="104" name="Image_partner002" src="http://60.205.127.180/php/vendor/dwj/images/wx_pay_logo_s.png" type="image" width="100" /></form>
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

