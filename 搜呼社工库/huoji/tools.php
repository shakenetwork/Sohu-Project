<?PHP
//最无聊的作品					
session_start();
header("Content-Type:text/html;charset=utf-8");
//手机号查询
if (isset($_GET['number'])) {
$url = 'http://webservice.webxml.com.cn/WebServices/MobileCodeWS.asmx/getMobileCodeInfo';
$number = $_GET['number'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "mobileCode={$number}&userId=");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
$data = simplexml_load_string($data);
if (strpos($data, 'http://')) {
echo '<script>alert("手机号不合法");</script>';
} else {
echo '<script>alert("'.$data.'");</script>';
}
}
?>
<html>
<head>
<script type="text/javascript" src="http://www.francescomalagrino.com/BootstrapPageGenerator/3/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="http://www.francescomalagrino.com/BootstrapPageGenerator/3/js/jquery-ui"></script>
<link href="http://www.francescomalagrino.com/BootstrapPageGenerator/3/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="http://www.francescomalagrino.com/BootstrapPageGenerator/3/js/bootstrap.min.js"></script>
<style type="text/css">
*{margin:0; padding:0;}
#footer{ width:100%; height:40px; position:absolute; bottom:0px;}
body {margin:0px; padding:0px;}
div{margin:0px; padding:0px;}

html,body{height:100%;width:auto;overflow:hidden;}
</style>
<script language="javascript" type="text/javascript">    
function ShowTime(){
	document.getElementById("divTime").innerText = Date();    
	}    
</script>
</head>
<body>
<body>  
<div id="Layer1" style="position:absolute; width:100%; height:100%; z-index:-1">  
<img src="img/toolsbj.jpg" height="100%" width="100%"/>  
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="btn-group ">
				 <button class="btn">kali linux</button> <button data-toggle="dropdown" class="btn btn-success"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li>
					<?PHP
					if(isset($_SESSION['user']))
					{
						echo '<a href="#">'.htmlspecialchars($_SESSION['user']).'</a>';
					}else{
						echo '<a href="/huoji/login.php">登陆</a>';
						echo '<a href="/huoji/reg.php">注册</a>';
					}
					?>
					</li>
					<li>
						<a id="modal-520" href="#modal-container-520" data-toggle="modal">知识库</a>
					</li>
					<li>
						<a href="flash0day">FLASH 0DAY测试</a>
					</li>
					<li class="divider">
					</li>
					<li class="dropdown-submenu">
						 <a tabindex="-1" href="#">内部工具箱</a>
						<ul class="dropdown-menu">
							<li>
								<a id="modal-521" href="#modal-container-521" data-toggle="modal">手机归属地查询</a>
							</li>
							<li>
								<a href="http://pan.baidu.com/s/1bn55IMF">免杀大马</a>
							</li>
							<li>
								<a href="http://pan.baidu.com/s/1kTqwtWr">免杀一句话</a>
							</li>
							<li>
								<a href="http://pan.baidu.com/s/1o6A8WMQ">过狗菜刀</a>
							</li>
							<li>
								<a href="http://www.wghostk.com">更多功能敬请期待...</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--桌面-->

<div class="container-fluid" id="footer">
	<div class="row-fluid" >
		<div class="span12">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="../index.php" class="brand">返回搜呼</a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">
								<li class="active">
									<a href="#">桌面</a>
								</li>
								<li>
									<a href="#">console</a>
								</li>
								<li>
									<a href="#"></a>
								</li>
								
							</ul>
							<ul class="nav pull-right">
								<li>
									<a id="modal-366870" href="#modal-container-366870" role="button" class="btn" data-toggle="modal">关于搜呼</a>
								</li>
								<li class="divider-vertical">
								</li>
								
									<body onload="window.setInterval('ShowTime();', 1000);">        
									<div id="divTime"></div>    
									</body>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--知识库部分-->
<div id="modal-container-366870" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						关于搜呼
					</h3>
				</div>
				<div class="modal-body">
					<p>
						搜呼信息泄露查询平台V 2.0版.作者:Ph4nt0m. 在线工具，登陆注册由huoji编写.界面采用bootstrap编写.
						网站:www.wghostk.com
						有任何疑问,请联系:huoji@wghostk.com
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <button class="btn btn-primary" herf="http://www.wghostk.com">访问幽灵网安</button>
				</div>
</div>
<div id="modal-container-520" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						知识库
					</h3>
				</div>
				<div class="modal-body">
					<p>
					空空如也哦. 请等待管理员添加~！
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <button class="btn btn-primary" herf="http://www.wghostk.com">访问幽灵网安</button>
				</div>
</div>

<div id="modal-container-521" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						手机归属地查询
					</h3>
				</div>
				<div class="modal-body">
					<p>
					<form action="" method="get">
                   请输入手机号码: <input type="text" name="number"/> <input type="submit" value="提交" />
                    </form>    
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <button class="btn btn-primary" herf="http://www.wghostk.com">访问幽灵网安</button>
				</div>
</div>
</body>
</html>