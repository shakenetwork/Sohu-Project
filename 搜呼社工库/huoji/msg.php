<?PHP
/* 登陆留言框 - 通用版 
*  website:www.wghostk.com
*/
?>
<!DOCTYPE html>
<html>
<head>
   <title>搜呼留言板</title>
<meta name="keywords" content="社工库,社工库论坛,信息泄露查询,搜呼社工库,搜呼,在线社工库,如何做个社工库,社工库源码"/>
<meta name="description" content="搜呼社工库 - 如何搭建起一个社工库源码,如何搭建社工库并且成为最好的社工库是我们思考的问题"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>

<body><div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<ul class="breadcrumb">
				<li>
					<a href="../index.php">返回搜呼主页</a> <span class="divider">/</span>
				</li>
				<li>
					<?PHP 
					if (isset($_SESSION['user'])){
						echo '<a href="./zhuxiao.php">欢迎您:'.htmlspecialchars($_SESSION['user']).',点击注销登陆</a> <span class="divider">/</span>';
					}else{
						echo '<a href="/login.php">登陆</a> <span class="divider">/</span>';
					}
					?>
				</li>
				<li class="active">
					QQ群:215273185.加群请注明 搜呼会员
				</li>
			</ul>
		</div>
	</div>
</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-header">
				<h1>
					搜呼留言板 <span>请为本站打分 : )</span>
				</h1>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit well">
				<h1>
					搜呼社工库  - 全网最大的在线社工库
				</h1>
				<p>
					已包含以下数据库(包括但不限于):
				</p>
				<p>
					重大信息泄露事件:12306,37GAME,华为,机锋论坛,小米论坛....截至2015年已全部包含
				</p>
				<p>
					网络类站点:红客联盟(2015),CNMSEC(2014),HK共享吧(2015),CSDN,....共计69个
				</p>
				<p>
					邮箱类站点:126,163,GMAIL,139....共计12个
				</p>
				<p>
					通讯类站点:QQ,IS语音,YY语音,新浪微博....共计9个
				</p>
				<p>
					网盘类站点:百度云,115云盘,789盘,千军万马网盘....共计14个
				</p>
				<p>
					社工库类站点:weigongkai,594sgk,97bug,soyun,somima,sopass....共计8个
				</p>
				<p>
					其他点站:数据盘D盘 总内存 5,00GB ,还剩下4.33GB可用.
				</p>
				<p>
					站长留言:还在考虑是否继续添加数据库,坐看运营效果.
				</p>
			</div>
		</div>
	</div>
</div>
<div id="SOHUCS" sid="54110"></div>
<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js"></script>
<script type="text/javascript">
    window._config = { showScore: true };
    window.changyan.api.config({
        appid: 'cyrPO51JQ',
        conf: 'prod_dfed6972139552c6ee21573071de80f2'
    });
</script>
</body>
</html>