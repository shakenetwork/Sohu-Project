<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>搜呼社工库 - 如何搭建起一个社工库源码,如何搭建社工库并且成为最好的社工库是我们思考的问题</title>
<meta name="keywords" content="社工库,社工库论坛,信息泄露查询,搜呼社工库,搜呼,在线社工库,如何做个社工库,社工库源码"/>
<meta name="description" content="搜呼社工库 - 如何搭建起一个社工库源码,如何搭建社工库并且成为最好的社工库是我们思考的问题"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" content="Ph4nt0m" />
<link rel="stylesheet" href="http://cdn.wghostk.com/css/sgk-bootstrap.min.css">
<script src="http://cdn.wghostk.com/js/sgk-jquery.min.js"></script>
<script src="http://cdn.wghostk.com/js/sgk-bootstrap.min.js"></script>
<link href="google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="google-code-prettify/prettify.js"></script>
</head>
<body>
	<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="btn-group">
				 <button class="btn btn-primary">菜单</button> <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li>
						<a href="http://www.wghostk.com/">访问幽灵网安</a>
					</li>
					<li>
						<a href="http://shang.qq.com/wpa/qunwpa?idkey=f150c411bfe2cb3f03c4869be5f7b0b037f1aa20c495fb67fc79e9dff9a7069a">加入QQ群</a>
					</li>
					<li>
						<a href="/huoji/msg.php">留言</a>
					</li>
					<li class="divider">
					</li>
					<li class="dropdown-submenu">
					<?php
					//关闭错误提示
                    error_reporting(E_ALL & ~E_NOTICE);
                    session_start();
					if(isset($_SESSION['user'])){
						echo '<a>'.htmlspecialchars($_SESSION['user']).'</a>';
						echo '<a tabindex="-1" href="zhuxiao.php">注销</a>';
						echo '<a tabindex="-1" href="/huoji/tools.php">内部工具箱</a>';
						echo '<a tabindex="-1" href="/api.php">调用搜呼API接口</a>';
					}else{
						echo '<a tabindex="-1" href="/huoji/login.php">登陆</a>';
						echo '<a tabindex="-1" href="/huoji/reg.php">注册</a>';
						echo '<a tabindex="-1" href="/order.php">获得邀请码...</a>';
					}?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<h3 class="text-center">
搜呼API接口调用教程:
</h3>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit well">
				<h1>
					别担心,
				</h1>
				<p>
					搜呼的api接口调用方式很简单，我将一步一步的引导您如何调用:
				</p>
				<p>
					1. 搜呼的api 接口:
				</p>
				<p>
					http://本站现在的域名/huoji/api.php?api=yes&amp;apiuser=您的搜呼账号&amp;apipwd=您的搜呼密码&amp;s=要查询的内容
				</p>
				<p>
					2. 返回的内容:
				</p>
				<p>
					<span>查到的结果,账号,邮箱,密码,salt,其他信息</span>
				</p>
				<p>
					<span>比如</span>
				</p>
				<p>
					<span>2,huoji,XXX@XXX.COM,testkey,123,13756465xxxx</span>
				</p>
			</div>
		</div>
	</div>
</div>
<h3 class="text-center">
如果还不懂:
</h3>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit well">
				<h1>
					PHP代码:
				</h1>
				<p>
					&lt;?PHP
				</p>
				<p>
					error_reporting(E_ALL &amp; ~E_NOTICE);//关闭错误信息
				</p>
				<p>
					$user = "huoji"; //搜呼账号
				</p>
				<p>
					$password = "pig";//搜呼密码
				</p>
				<p>
					$key = "huoji";//要查的关键字
				</p>
				<p>
					$fh= file_get_contents('http://本站现在的域名/huoji/api.php?api=yes&amp;apiuser='.$user.'&amp;apipwd='.$password.'&amp;s='.$key.'');
				</p>
				<p>
					//打开网页
				</p>
				<p>
					//echo $fh;
				</p>
				<p>
					$test = explode(",",$fh); //使用explode分割 , , ,
				</p>
				<p>
					if($test[1] == ""){exit(" 找不到相关的结果。");}
				</p>
				<p>
					echo "&lt;li&gt;已查到:".$test[0]."个&lt;/li&gt;";
				</p>
				<p>
					echo "&lt;li&gt;用户名:".$test[1]."&lt;/li&gt;";
				</p>
				<p>
					echo "&lt;li&gt;邮箱:".$test[2]."&lt;/li&gt;";
				</p>
				<p>
					echo "&lt;li&gt;密码:".$test[3]."&lt;/li&gt;";
				</p>
				<p>
					if($test[4] != "")//有时候salt会为空
				</p>
				<p>
					{
				</p>
				<p>
					<span>echo "&lt;li&gt;salt:".$test[4]."&lt;/li&gt;";</span>
				</p>
				<p>
					}else{echo '&lt;li&gt;salt:无&lt;/li&gt;';}
				</p>
				<p>
					if($test[5] != "")//有时候order会为空
				</p>
				<p>
					{
				</p>
				<p>
					<span>echo "&lt;li&gt;其他信息:".$test[5]."&lt;/li&gt;";</span>
				</p>
				<p>
					}else{echo "&lt;li&gt;其他信息:无&lt;/li&gt;";}
				</p>
				
				<p>
					?&gt;
				</p>
			</div>
		</div>
	</div>
</div><div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit well">
				<h1>
					如果您想做机器人:
				</h1>
				<div>
					C# code:
				</div>
				<div>
					<span>private static string GetUrlHtml(string url)</span>
				</div>
				<div>
					<div>
						{
					</div>
					<div>
						HttpWebRequest hwr = (HttpWebRequest)WebRequest.Create(url);
					</div>
					<div>
						HttpWebResponse hwrs = (HttpWebResponse)hwr.GetResponse();
					</div>
					<div>
						Stream stream = hwrs.GetResponseStream();
					</div>
					<div>
						StreamReader sr = new StreamReader(stream, Encoding.GetEncoding(hwrs.CharacterSet));
					</div>
					<div>
						string html = sr.ReadToEnd();
					</div>
					<div>
						sr.Close();
					</div>
					<div>
						return html;
					</div>
					<div>
						}
					</div>
				</div>
				<div>
					var user = "huoji"; //用户名
				</div>
				
				<div>
					var key = "pig"; //密码
				</div>
				
				<div>
					var so = textBox1.Text; //关键字
				</div>
				
				<div>
					//注意修改一下域名
				</div>
				
				<div>
					var xx = GetUrlHtml("http://本站现在的域名/huoji/api.php?api=yes&amp;apiuser=" + user + "&amp;apipwd=" + key + "&amp;s=" + so);
				</div>
				
				<div>
					if (xx == " 找不到相关的结果。请更换其他关键词试试。")
				</div>
				
				<div>
					{
				</div>
				
				<div>
					MessageBox.Show("未查到,请换关键字！");
				</div>
				
				<div>
					}
				</div>
				
				<div>
					else
				</div>
				
				<div>
					{
				</div>
				
				<div>
					string a = xx;
				</div>
				
				<div>
					string[] b = new string[5];
				</div>
				
				<div>
					b = a.Split(',');
				</div>
				
				<div>
					label3.Text = b[0]; //数量
				</div>
				
				<div>
					textBox2.Text = b[1]; //用户名
				</div>
				
				<div>
					textBox3.Text = b[2]; //密码
				</div>
				
				<div>
					textBox4.Text = b[3]; //邮箱
				</div>
				
				<div>
					textBox5.Text = b[4]; //salt
				</div>
				
				<div>
					textBox6.Text = b[5]; //其他信息
				</div>
				
				<div>
					}
				</div>
				
				<div>
					↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ 请继续往下翻↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
				</div>
			</div>
		</div>
	</div>
</div>
<h3 class="text-center">
我们提供了一系列无脑演示:
</h3>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit well">
				demo下载:
				<div>
					PHP版本:http://pan.baidu.com/s/1ntFvjrr
				</div>
				<div>
					C# 版本:http://pan.baidu.com/s/1pJkiV2b
				</div>
			</div>
		</div>
	</div>
</div>
<h3 class="text-center">
如果...
</h3>
<h3 class="text-center">
您还是不懂....可以进群求助....
</h3>
<!--新闻打分版，可实现对每篇新闻自动星级评分-->
<div id="SOHUCS"></div>
<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
<script type="text/javascript">
    window._config = { showScore: true };
    window.changyan.api.config({
        appid: 'cyrPO51JQ',
        conf: 'prod_dfed6972139552c6ee21573071de80f2'
    });
</script> 

</body>