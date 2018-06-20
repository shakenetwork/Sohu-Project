<?php
include 'config.php';

$order_money   =$_POST['order_money'];//支付金额
$order_paytype =$_POST['paytype'];//支付方式
$order_pid     =$_POST['pid'];//网银专用银行卡选择
$order_name    =$_POST['order_name'];//商品名称
$order_id=date('YmdHis').rand(11111,99999);//生成订单ID

?>
<html>
<head>
<title>pay to bank</title>
</head>
<body onLoad="document.pay.submit();">
<form action="<?php echo $post?>" name="pay" id="pay" method="post">
<input type="hidden" name="order_money" value="<?php echo $order_money?>">
<input type="hidden" name="order_paytype" value="<?php echo $order_paytype?>">
<input type="hidden" name="order_pid" value="<?php echo $order_pid?>">
<input type="hidden" name="order_name" value="<?php echo $order_name?>">
<input type="hidden" name="UserID" value="<?php echo $UserID?>">
<input type="hidden" name="key" value="<?php echo $key?>">
<input type="hidden" name="return" value="<?php echo $return_url?>">
<input type="hidden" name="notify" value="<?php echo $notify_url?>">
<input type="hidden" name="order_id" value="<?php echo $order_id?>">
</form>
</body>
</html>