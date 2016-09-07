<?php

//logic to enable WXpay QRcode

ini_set('date.timezone','Asia/Shanghai');

require_once "/home/www/php/wxengine/lib/WxPay.Api.php";
require_once "/home/www/php/wxengine/logic/WxPay.NativePay.php";
require_once "/home/www/php/wxengine/logic/log.php";

$notifyPromo = new NativePay();

$WxPayUnifiedOrderP = new WxPayUnifiedOrder();
$inputPid001P = &$WxPayUnifiedOrderP;
$inputPid001P ->SetBody("大玩家金牛万达店_全面开火_DM");
$inputPid001P ->SetAttach("大玩家金牛万达店");
$inputPid001P ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$inputPid001P ->SetTotal_fee("2000");
$inputPid001P ->SetTime_start(date("YmdHis"));
$inputPid001P ->SetTime_expire(date("YmdHis", time() + 3600));
$inputPid001P ->SetGoods_tag("全面开火");
$inputPid001P ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
$inputPid001P ->SetTrade_type("NATIVE");
$inputPid001P ->SetProduct_id("Fire_DWJ_JNWD_DM");
$resultPid001P = $notifyPromo->GetPayUrl($inputPid001P);
$urlPid001P = $resultPid001P ["code_url"];


// Define your username and password
$username = "dwj";
$password = "1024";

if ($_POST['txtUsername'] != $username || $_POST['txtPassword'] != $password) {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="3600" http-equiv="refresh" />
<meta content="IE=9" http-equiv="X-UA-Compatible" />
<title>VRDreams - Promotion</title>
<link href="http://60.205.127.180/php/vendor/dwj/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<h3>请工作人员验证登录</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
	<label for="txtUsername">
	<h6>员工工号</h6>
	</label><input name="txtUsername" title="Enter your Username" type="text" />
	<label for="txtpassword">
	<h6>密码</h6>
	</label>
	<input name="txtPassword" title="Enter your password" type="password" />
	<p><input name="Submit" type="submit" value="Login" /></p>
</form>
<?php

}
else {

?>
<link href="http://60.205.127.180/php/vendor/dwj/css/style.css" rel="stylesheet" type="text/css" />
<div id="main">
	<div id="header">
		<div id="banner">
			<div id="welcome">
				<h1>DM促销活动页面！！</h1>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<!--close welcome-->
			<div id="menubar">
				<ul id="menu">
					<li><a href="http://60.205.127.180/vendor/dwj/index.php">返回大玩家金牛万达店VR主页</a></li>
				</ul>
			</div>
			<!--close menubar--></div>
		<!--close banner--></div>

	<div class="ourwork" style="height: 290px">
			<h4>VR 全面开火</h4>
			<h3>单次游戏: 30人民币 - 活动减10元</h3>
			<form method="post" style="vertical-align: middle; text-align: center">
				微信二维码支付<br />
				<br />
				<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid001P);?>" /> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img alt="Photo landscape" src="http://60.205.127.180/php/vendor/dwj/images/fire_dm.png" width="149" />
			</form>
			<!--close more--></div>
		<!--close ourwork-->

		<div class="testimonials" style="height: 290px">
			<h4>VR 水果先锋</h4>
			<h3>单次游戏: 10人民币 - 无活动</h3>

			<!--<form method="post" style="vertical-align: middle; text-align: center">
				微信二维码支付<br />
				<br />
				<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPid001);?>" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input height="104" name="Image_partner004" src="http://60.205.127.180/php/vendor/dwj/images/wx_pay_logo_s.png" type="image" width="100" />
			</form>-->
			<!--close more--></div>
		<!--close testimonials-->


</div>
<!--close main-->

<?php

}

?>

</body>

</html>

