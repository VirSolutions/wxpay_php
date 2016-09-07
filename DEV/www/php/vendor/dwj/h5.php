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


<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="js/custom.js"></script>
</head>
<body>

<a href="#popupBasic" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">Basic Popup</a>
<div data-role="popup" id="popupBasic">
<p>This is a completely basic popup, no options set.</p>
</div>
	
<a href="#popupPhotoLandscape" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">Photo landscape</a>

<div data-role="popup" id="popupPhotoLandscape" class="photopopup" data-overlay-theme="a" data-corners="false" data-tolerance="30,15">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img src="http://200.200.200.212/example/qrcode.php?data=<?php echo urlencode($urlPid001);?>" alt="Photo landscape">
</div>

</body>
</html>
