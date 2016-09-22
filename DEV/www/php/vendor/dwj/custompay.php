<?php

//logic to enable WXpay QRcode

ini_set('date.timezone','Asia/Shanghai');

require_once "/home/www/php/wxengine/lib/WxPay.Api.php";
require_once "/home/www/php/wxengine/logic/WxPay.NativePay.php";
require_once "/home/www/php/wxengine/logic/log.php";


// Define your username and password
$firePrice = 30;
$fruitPrice = 10;
$EquipPriceVest = 10;
$EquipPriceGun = 10;

$intNumOfFire = $_POST['numOfFire'];
$intNumOfFuite = $_POST['numOfFruit'];

$intIsCheckEquipVest = 0;
$intIsCheckEquipGun = 0;

if (isset($_POST['isCheckEquipVest'])){
		$intIsCheckEquipVest = 1;
	}

if (isset($_POST['isCheckEquipGun'])){
		$intIsCheckEquipGun = 1;
	}

if (is_null($_POST['isCheckFire'])){
		$intNumOfFire = 0;
	}

if (is_null($_POST['isCheckFruit'])){
		$intNumOfFuite = 0;
	}

$total = ($firePrice * $intNumOfFire) + ($fruitPrice * $intNumOfFuite) + ($EquipPriceVest * $intNumOfFire * $intIsCheckEquipVest) + ($EquipPriceGun * $intNumOfFire * $intIsCheckEquipGun);

$totalWXpay = $total * 100;


if (is_null($_POST['isCheckFire']) & is_null($_POST['isCheckFruit'])) {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="7200; url=http://60.205.127.180/vendor/dwj/custompay.php" http-equiv="refresh" />
<meta content="IE=9" http-equiv="X-UA-Compatible" />
<title>VRDreams - Promotion</title>
<link href="http://60.205.127.180/php/vendor/dwj/cssd/style.css" rel="stylesheet" type="text/css" />
<style>
body {
	TEXT-ALIGN: center;
}
#center {
	MARGIN-RIGHT: auto;
	MARGIN-LEFT: auto;
	height: 200px;
	background: #F00;
	width: 400px;
	vertical-align: middle;
	line-height: 200px;
}
</style>
</head>

<body>

<form style="width: 500px; MARGIN-RIGHT: auto; MARGIN-LEFT: auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
	<fieldset style="border:6px groove">
	<legend>
	<h3>多人游戏:</h3>
	</legend>
	<h3>游戏套餐选择：</h3>
	<br />
		<fieldset style="border:1px dashed #ff9966" align="center">
			<legend style="border:0px;background-color:white">
			请选择VR游戏
			</legend>
				<input name="isCheckFire" type="checkbox" value="fire" />全面火力 - 请选择游戏次数： 
				<img src="http://60.205.127.180/php/vendor/dwj/images/fire_dm.png" height="50" />
				<select name="numOfFire">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				</select><br />
				<br />
				<input name="isCheckFruit" type="checkbox" value="fire" />疯狂水果 - 请选择游戏次数：
				<img src="http://60.205.127.180/php/vendor/dwj/images/fruit_dm.png" height="50" /> 
				<select name="numOfFruit">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				</select><br />
		</fieldset>
	<br />

		<fieldset style="border:1px dashed #ff9966" align="center">
			<legend style="border:0px;background-color:white">
			请选择游戏道具
			</legend>
				<input name="isCheckEquipVest" type="checkbox" value="fire" />力回馈背心 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;
				<input name="isCheckEquipGun" type="checkbox" value="fire" />高精枪械模型<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="http://60.205.127.180/php/vendor/dwj/images/vest_3.jpg" height="100" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="http://60.205.127.180/php/vendor/dwj/images/m4a1.png" height="100" />
		</fieldset>
	<br />
	<input name="Submit" type="submit" value="进行支付" /> </fieldset>
</form>
<?php

}
else {

		$notifyCustom = new NativePay();

		$WxPayUnifiedOrderC = new WxPayUnifiedOrder();
		$inputPidCustom = &$WxPayUnifiedOrderC;
		$inputPidCustom ->SetBody("大玩家金牛万达店_套餐支付");
		$inputPidCustom ->SetAttach("大玩家金牛万达店");
		$inputPidCustom ->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$inputPidCustom ->SetTotal_fee($totalWXpay);
		$inputPidCustom ->SetTime_start(date("YmdHis"));
		$inputPidCustom ->SetTime_expire(date("YmdHis", time() + 3600));
		$inputPidCustom ->SetGoods_tag("套餐支付");
		$inputPidCustom ->SetNotify_url("http://60.205.127.180/wxengine/logic/notify.php");
		$inputPidCustom ->SetTrade_type("NATIVE");
		$inputPidCustom ->SetProduct_id("Custom_DWJ_JNWD");
		$resultPidCustom = $notifyCustom->GetPayUrl($inputPidCustom);
		$urlPidCustom = $resultPidCustom ["code_url"];

?>
<form style="width: 600px; MARGIN-RIGHT: auto; MARGIN-LEFT: auto">
	<fieldset style="border:6px groove">
	<legend style="border:0px;background-color:white">
	您所选择的套餐明细
	</legend>
	您所购买的全面火力的游戏次数是: &nbsp;<?php echo $intNumOfFire ?>次.<br />
	您所购买的疯狂水果的游戏次数是: &nbsp;<?php echo $intNumOfFuite ?>次.<br />
			<fieldset style="border:1px dashed #ff9966" align="center">
				<legend style="border:0px;background-color:white;">
				游戏装备
				</legend>
					<?php 	 
				if (isset($_POST['isCheckEquipVest'])){
						echo "<P>"."您选择了力回馈背心作为您的游戏装备"."<img src=\"http://60.205.127.180/php/vendor/dwj/images/vest_3.jpg\" height=\"100\" />"."</P>";
					}

				if (isset($_POST['isCheckEquipGun'])){
						echo "<P>"."您选择了高精枪模作为您的游戏装备"."<img src=\"http://60.205.127.180/php/vendor/dwj/images/m4a1.png\" height=\"100\" />"."</P>";
					}
				?>
			</fieldset>
您的订单所需要支付的总金额是: <?php echo $total ?>人民币 &nbsp; <br />请微信扫码支付吧:<br />
	<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPidCustom);?>" height="350"/>
	<P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://60.205.127.180/vendor/dwj/custompay.php"><img src="http://60.205.127.180/php/vendor/dwj/images/return_4.png" width="100" /></a></P>
	</fieldset>
</form>

<?php

//sleep(20);
//$url = 'http://60.205.127.180/vendor/dwj/custompay.php';
//echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';  

}

?>

</body>

</html>
