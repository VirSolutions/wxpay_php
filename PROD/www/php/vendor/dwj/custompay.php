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

$total = ($firePrice * $intNumOfFire) + ($fruitPrice * $intNumOfFuite) + ($EquipPriceVest * $intNumOfFire * $intIsCheckEquipVest) + ($EquipPriceGun * $intNumOfFire * $intIsCheckEquipGun);

$totalWXpay = $total * 100;


if (is_null($_POST['isCheckFire']) || is_null($_POST['isCheckFruit'])) {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="3600" http-equiv="refresh" />
<meta content="IE=9" http-equiv="X-UA-Compatible" />
<title>VRDreams - Promotion</title>
<link href="http://60.205.127.180/php/vendor/dwj/cssd/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
 	<fieldset>
 		<legend><h3>多人游戏:</h3></legend>
		<h3>游戏套餐选择：</h3><br />
		<input type="checkbox" name="isCheckFire" value="fire" />全面火力 - 请选择游戏次数：
		<select name="numOfFire">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		</select><br /><br />
		<input type="checkbox" name="isCheckFruit" value="fire" />疯狂水果 - 请选择游戏次数：
		<select name="numOfFruit">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		</select><br /><br />
		游戏道具选择：<br />
		<input type="checkbox" name="isCheckEquipVest" value="fire" />力回馈背心
		<input type="checkbox" name="isCheckEquipGun" value="fire" />高精枪械模型<br /><br />
		<input name="Submit" type="submit" value="进行支付" />
	 </fieldset>
</form>
<?php

}
else {


?>

FireFire num? <?php echo $_POST['numOfFire'] ?> <br />
Fruit num? <?php echo $_POST['numOfFruit'] ?> <br />
Total is <?php echo $total ?> <br />

<?php

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

<img alt="Photo landscape" src="http://60.205.127.180/wxengine/logic/qrcode.php?data=<?php echo urlencode($urlPidCustom);?>" />

<?php

}

?>

</body>

</html>

