<?php
session_start();
if(isset($_SESSION['user'])){
exit("小子不错,登陆了还想登陆?");
}

?>
<title>搜呼 - 用户登陆</title>
<meta name="keywords" content="社工库,社工库论坛,信息泄露查询,搜呼社工库,搜呼,在线社工库,如何做个社工库,社工库源码"/>
<meta name="description" content="搜呼社工库 - 如何搭建起一个社工库源码,如何搭建社工库并且成为最好的社工库是我们思考的问题"/>
<script src="//lib.sinaapp.com/js/jquery/1.10.2/jquery-1.10.2.min.js?version=1.14.6.2"></script>
<link rel="stylesheet" href="http://cdn.wghostk.com/css/sgk-unicorn.login.css" type="text/css">                  
<div class="wrapper" id="page_login">                       
<h2>搜呼 - 用户登陆</h2>
<p class="title_desc">搜呼,不为其也.一搜即得,不为其呼</p>   
<div id="content-login" class="center-box">
<img src="/huoji/img/hack.ico" class="avatar">
<!-- 登陆部分-->
<form method="post" action="member.php">
<div class="login-info">
<p><input type="text" name="username" tabindex="1" required placeholder="用户名[注册邮箱也可以登陆]"></p>
<p><input type="password" name="password" required  tabindex="2" placeholder="密码"></p>
</div>
<p><input type="submit" value="登录" tabindex="3"  /></p>
</form></div>