<?PHP
session_start();
if(isset($_SESSION['user'])){
exit("小子不错,注册了还想注册?");
}

?>

<title>搜呼 - 用户注册</title>
<meta name="keywords" content="社工库,社工库论坛,信息泄露查询,搜呼社工库,搜呼,在线社工库,如何做个社工库,社工库源码"/>
<meta name="description" content="搜呼社工库 - 如何搭建起一个社工库源码,如何搭建社工库并且成为最好的社工库是我们思考的问题"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//lib.sinaapp.com/js/jquery/1.10.2/jquery-1.10.2.min.js?version=1.14.6.2"></script>
<link rel="stylesheet" href="http://cdn.wghostk.com/css/sgk-unicorn.login.css" type="text/css">                 
<div class="wrapper" id="page_login">                       
<h2>搜呼 - 用户注册</h2>
<p class="title_desc">搜呼,不为其也.一搜即得,不为其呼</p>   
<div id="content-login" class="center-box">
<img src="/huoji/img/hack.ico" class="avatar">
<script type="text/javascript">
function ischeckemail(){
var email = document.getElementById("emailname").value;
  if (email != "") {
     var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
     isok= reg.test(email );
       if (!isok) {
            alert("邮箱格式不正确，请重新输入！");
            document.getElementById("emailname").focus();
            return false;
        }
    };
}
</script>
<!-- 登陆部分-->
<form method="post" action="member.php">
<div class="login-info">
<p><input class="form-control" name="yqm" type="text" placeholder="邀请码请看说明..." required></p>
<p><input type="text" name="rusername" tabindex="1" required placeholder="用户名[请不要使用中文]"></p>
<p><input type="text" name="remail" tabindex="2" required placeholder="邮箱" onClick="return ischeckemail()"></p>
<p><input type="password" name="rpassword" required  tabindex="3" placeholder="密码"></p>
</div>
<p><input type="submit" value="注册"/></p>
</form></div>