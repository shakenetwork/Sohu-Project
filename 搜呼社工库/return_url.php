<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-Type: text/html; charset=UTF-8");
$url       = $_SERVER["HTTP_REFERER"]; 
$str   = str_replace("http://","",$url);
$strdomain = explode("/",$str);
$domain    = $strdomain[0];

if($domain!="www.33un.com"){exit;}
include 'config.php';
$order_id=$_GET['order_id'];//订单号
$money=$_GET['money'];//金额
$sign=$_GET['sign'];//效验码
$paytype=$_GET['paytype'];//支付方式
$sign2=md5(md5($UserID.md5($order_id).$return_url));
if($sign2==$sign){
	//验证成功 处理用户充值数据
	/*
		业务处理逻辑 异步返回不支持header 跳转 输出 等代码 
		建议：
		在自己的订单系统里面创建一个单独的字段记录订单状态
		例：
		①创建订单的时候订单状态字段status为0 表示未支付
		②在支付接口回调里面先查询该订单状态是否为0，如果为0则进行业务处理，若为1代表该订单处理过
		③处理订单的完了之后更新status字段值为1
		
		注：这样能有效的防止订单重复处理，导致重复充值 切忌~
	*/
	echo '充值成功<hr>';
	echo '订单号:'.$order_id.'<hr>';
	echo '充值金额:'.$money;
}else{
	//效验码不正确
}
?>