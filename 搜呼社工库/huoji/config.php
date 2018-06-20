<?php
error_reporting(E_ALL & ~E_NOTICE);
@session_start();
//------------------------------------------
$host='localhost';//数据库服务器
$user='你的数据库账号';//数据库用户名
$password='你的数据库密码';//数据库密码
$database='数据库名字';//数据库名
$conn=@mysql_connect($host,$user,$password) or die('数据库连接失败！');
@mysql_select_db($database) or die('没有找到数据库！');
mysql_query("set names 'utf-8'");
?>