<?PHP
/* PHP 登陆注册+邀请码系统
*  访问 meber.php?huoji=huoji 生成邀请码,记住先改好账号密码($admin_user),密码建议8位非数字密码.
*/
error_reporting(E_ALL & ~E_NOTICE);
require ('config.php');
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
$user=mysql_real_escape_string($_POST["username"]);
$pwd=md5($_POST["password"]);
$sql="select * from users where username='$user' and password='$pwd' or email='$user' and password='$pwd' limit 1";
//---------------------------------
$rs=mysql_query($sql);
if(mysql_num_rows($rs)==1){
	$name=mysql_fetch_array(mysql_query($sql));
	$_SESSION['user']=$name['username']; 	
	echo '
<html>
<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<blockquote>
				<p>
					登陆成功
				</p> <small>您可以<A href="../index.php">返回首页</A>进行查询操作</small>
			</blockquote>
		</div>
	</div>
</div>
</HTML>
	';	
	}else{
     echo'
	 <html>
<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<blockquote>
				<p>
					登陆失败
				</p> <small>您可以<A href="login.php">返回</A>重新登陆</small>
			</blockquote>
		</div>
	</div>
</div>
</HTML>
	 ';		
	}
}
if(isset($_GET['huoji']) && isset($_GET['huoji']))
{
	if(isset($_SESSION["admin"]))
	{
	$sqll="select * from yqm";
	$rrss=mysql_query($sqll);
		echo'
<form action="" method="post">
<input type="submit" name="submityqm" class="btn btn-primary" value="生成邀请码"/>
</form>
<P>当前邀请码</p>';
while($rowss=mysql_fetch_assoc($rrss)){
	echo '<li>'.$rowss["yqm"].'</li>';
	}
if($_POST["submityqm"] && $_POST["submityqm"] )
{
$yaoqingma = gen_random_password();
$sql_52yqm = "insert into yqm(yqm) values('$yaoqingma')";
 if(mysql_query($sql_52yqm)){
	 echo "生成成功！";
	}else{
	echo "生成失败！";
	}
}
}
	if(isset($_POST['hackerlogin']) && isset($_POST['usernameS']))
	{
		$admin_user = $_POST['usernameS'];
		$admin_password = $_POST['passwordS'];
		if ($admin_user == 'admin') //账号
		{
			if($admin_password == 'sohu520..') //密码
			{
				$_SESSION["admin"] = "IamAdminIamhuoji";
				echo "<script>alert('欢迎回来,点击进入管理页面');location='member.php?huoji=huoji';</script>";
			 
	        }
		}else{
		        echo '登陆失败,你干了啥';
		        exit();
		}
	}
	if(!isset($_SESSION["admin"]))
	{
		echo '
		<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<form class="form-horizontal" method="post" action="">
				<div class="control-group">
					 <label class="control-label" name="usernameS" for="inputEmail">Username</label>
					<div class="controls">
						<input id="inputEmail" type="text" name="usernameS"/>
					</div>
				</div>
				<div class="control-group">
					 <label class="control-label" for="inputPassword" name="passwordS">Your Password</label>
					<div class="controls">
						<input id="inputPassword" type="password" name="passwordS"/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						 <button type="submit" class="btn" name="hackerlogin">登陆</button>
					</div>
				</div>
			</form>

		';
	}
}
if(isset($_POST['rusername']) && isset($_POST['rpassword']))
{
$user=mysql_real_escape_string($_POST["rusername"]);
$pwd=md5($_POST["rpassword"]);
$email = htmlspecialchars(mysql_real_escape_string($_POST['remail']));
$yqm=mysql_real_escape_string($_POST["yqm"]);
//--------------合法性判断-------------------
if(!empty($_POST['remail'])&&!preg_match("/^[0-9a-z_]+@(([0-9a-z]+)[.]){1,2}[a-z]{2,3}$/",$_POST['remail']))
{
	echo "<script>alert('邮箱输入不合法');location='reg.php';</script>";
	exit();
};//邮箱合法性判断
if (preg_match("/[\x7f-\xff]/", $_POST["rusername"])) 
{ 
	echo "<script>alert('请不要使用中文名字！');location='reg.php';</script>";
	exit();
}
//用户名、邮箱重复判断
$check_query2 = mysql_query("select * from users where username='$user' limit 1");
$check_query3 = mysql_query("select * from users where email='$email' limit 1");//收尾
//邀请码
$sql_yqm = mysql_query("select * from yqm where yqm='$yqm' limit 1");
$sql_useyqm = mysql_query("select * from users where yqm='$yqm' limit 1");
if(mysql_fetch_array($check_query2))
{
	echo "<script>alert('抱歉,用户名已经存在');location='reg.php';</script>";
	exit();
}	
if(mysql_fetch_array($check_query3))
{
	echo "<script>alert('抱歉,邮箱已经存在');location='reg.php';</script>";
	exit();
}
if(!mysql_fetch_array($sql_yqm))
{
	exit("<script>alert('邀请码无效');location='reg.php';</script>");
}
if(mysql_fetch_array($sql_useyqm))
{
	echo "<script>alert('sorry,邀请码已经在使用了~');location='reg.php';</script>";
	exit();
}
$sql = "INSERT INTO users(username,email,password,yqm,stop)VALUES('$user','$email','$pwd','$yqm','0')";
$del_sql="DELETE from yqm where yqm='$yqm'";
mysql_query("set names 'utf-8'");
mysql_query($sql);
mysql_query($del_sql);
$_SESSION['user']=$user;
echo '
<html>
<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<blockquote>
				<p>
					注册成功！
				</p> <small>您可以<A href="../index.php">返回首页</A>进行查询操作！</small>
			</blockquote>
		</div>
	</div>
</div>
</HTML>
';	
}
function gen_random_password($password_length = 30, $generated_password = ""){ //password_length 随机密码长度，默认10位   
 $valid_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";   
 $chars_length = strlen($valid_characters) - 1;   
 for($i = $password_length; $i--; ) {   
  //$generated_password .= $valid_characters[mt_rand(0, $chars_length)];   
  
  $generated_password .= substr($valid_characters, (mt_rand()%(strlen($valid_characters))), 1);   
 }   
 return $generated_password;   
}   

?>