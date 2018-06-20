<?php
// require ("/CCWAF.php"); 幽灵CC防火墙 V 2.0 需要的朋友可以开启
// $Id:$
// 引用sphinxapi类
ini_set("session.cookie_httponly", 1); 
require ("sphinxapi.php");
//关闭错误提示
require '/huoji/config.php';//TONG JI CI shu
error_reporting(E_ALL & ~E_NOTICE);
session_start();
set_time_limit(0);
$num = 0;
$Others = 'NOT Used';
if(isset($_SESSION['user'])){
$stop_user = mysql_real_escape_string($_SESSION['user']);
$stop_sql = mysql_query("select stop from users where username = '$stop_user' limit 1");
while($rowstop=mysql_fetch_array($stop_sql)){$stop_why = $rowstop['stop'];}	
}
if (!empty($_GET) && !empty($_GET['q'])) {
    $Keywords = strip_tags(trim($_GET['q']));
    $cl = new SphinxClient();
    // 返回结果设置
    $opts = array(
        "before_match" => "<font color=red>",
        "after_match" => "</font>",
        "chunk_separator" => " ... ",
        "limit" => 150,
        "around" => 3,
    );
    $cl->SetServer('127.0.0.1', 9312);
    $cl->SetConnectTimeout(3);
    $cl->SetArrayResult(true);
    $cl->SetMatchMode(SPH_MATCH_ANY);
    
    if (!empty($_GET) && !empty($_GET['p'])) {
        $p = !intval(trim($_GET['p'])) == 0 ? intval(trim($_GET['p'])) - 1 : 0;
        $p = $p * 20;
        // 我在csft.conf 设置了最大返回结果数2000。但是我在生成页码的时候 最多生成20页，我想能满足大部分搜索需求了。
        // 以下语句表示从P参数偏移开始每次返回20条。
        $cl->setLimits($p, 20);
    } else {
        $cl->setLimits(0, 20);
    }
    $res = $cl->Query(".$Keywords.", "*");
    mysql_connect("数据库地址", "数据库用户名", "数据库密码"); //数据库账号密码
    mysql_select_db("数据库库名"); //数据库库名名
    if (is_array($res["matches"])) {
        foreach ($res["matches"] as $docinfo) {
            $ids = $ids . $docinfo[id] . ',';
        }
		
        $hitest = rtrim($ids, ',');
		$ids = mysql_real_escape_string($hitest);
        $sql = "select * from huoji where id in($ids)"; //注意修改表名
        mysql_query("set names utf8");
		$Others = 'Used SoHu_SGK_1';
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		if ($num == 0) {			//如果表1找不到结果.其他的照葫芦画瓢.但是注意表2必须接着表1的ID，否则不出结果
		$Others = 'Used SoHu_SGK_2';
		$sql = "select * from huoji_2 where id in($ids)"; //注意修改表名
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		}
		if ($num == 0) {			//如果表2找不到结果.其他的照葫芦画瓢.但是注意表3必须接着表2的ID，否则不出结果
		$Others = 'Used SoHu_SGK_3';
		$sql = "select * from huoji_3 where id in($ids)"; //注意修改表名
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		}
		if ($num == 0) {			//........
		$Others = 'Used SoHu_SGK_4';
		$sql = "select * from huoji_4 where id in($ids)"; //注意修改表名
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		}
		if ($num == 0) {			//如果表3找不到结果.那就换个裤子 ;>
		$ids = 0;
		$res = $cl->Query(".$Keywords.", "*");
		if (is_array($res["matches"])) {
        foreach ($res["matches"] as $docinfo) {
            $ids = $ids . $docinfo[id] . ',';
        }
		$Others = 'Used SoHu_HACK_SGK';
		$hitest = rtrim($ids, ',');
		$ids = mysql_real_escape_string($hitest);
		$sql = "select * from huoji_md5_sgk where id in($ids)"; //注意
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		}
    }		
	if ($num == 0) {			//邮箱数据库
		$ids = 0;
		$res = $cl->Query(".$Keywords.", "*");
		if (is_array($res["matches"])) {
        foreach ($res["matches"] as $docinfo) {
            $ids = $ids . $docinfo[id] . ',';
        }
		$Others = 'Used SoHu_Email_SGK';
		$hitest = rtrim($ids, ',');
		$ids = mysql_real_escape_string($hitest);
		$sql = "select * from huoji_5_email where id in($ids)"; //注意
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		}
    }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>搜呼社工库</title>
<meta name="keywords" content="社工库,社工库论坛,信息泄露查询,搜呼社工库,搜呼,在线社工库,如何做个社工库,社工库源码"/>
<meta name="description" content="搜呼社工库 - 如何搭建起一个社工库源码,如何搭建社工库并且成为最好的社工库是我们思考的问题"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" content="Ph4nt0m" />
<link rel="stylesheet" href="http://cdn.wghostk.com/css/sgk-bootstrap.min.css">
<script src="http://cdn.wghostk.com/js/sgk-jquery.min.js"></script>
<script src="http://cdn.wghostk.com/js/sgk-bootstrap.min.js"></script>
<style type="text/css"> 
.align-center{ 
position:fixed;left:50%;top:50%;margin-left:width/2;margin-top:height/2;
} 

</style>

<script>
<!--
    function check(form){
if(form.q.value==""){
  alert("Not null！");
  form.q.focus();
  return false;
 }
}
-->
</script>
<style type="text/css">
#out {
 height: 400px;
 width: 400px;
 background-color: #CCCCCC;
 position: relative;
}
#in {
 height: 300px;
 width: 300px;
 background-color: #CC9900;
 position: absolute;
 bottom: 0px;
}
</style>
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
					<li>
						<a href="http://www.key08.com/bk/">神奇的地方</a>
					</li>
					<li>
						<a href="/huoji/flash0day">FLASH 0DAY测试</a>
					</li>
					<li class="divider">
					</li>
					<li class="dropdown-submenu">
					<?php
					if(isset($_SESSION['user'])){
						if($stop_why == '0'){echo '<a>'.htmlspecialchars($_SESSION['user']).'[正式会员]</a>';}else{echo '<a>'.htmlspecialchars($_SESSION['user']).'[测试用户]</a>';}
						echo '<a tabindex="-1" href="zhuxiao.php">注销</a>';
						echo '<a tabindex="-1" href="/huoji/tools.php">内部工具箱</a>';
						echo '<a tabindex="-1" href="/api.php">调用搜呼API接口</a>';
					}else{
						echo '<a tabindex="-1" href="/huoji/login.php">登陆</a>';
						echo '<a tabindex="-1" href="/huoji/reg.php">注册</a>';
						echo '<a tabindex="-1" href="order.php">获得邀请码...</a>';
					}?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
	<div id="container"><div id="header"><h3 class="text-center" contenteditable="false">搜呼 - 一搜即得</h3></div><br /><br />
	<div class="hero-unit well" style="text-align: center;" contenteditable="false">
<h1>记住我:www.key08.com</h1>
<p>搜呼,不为其也.一搜即得,不为其呼 : -)</p>
<p><a class="btn btn-primary btn-large" href="http://www.wghostk.com/hacker-68-1.html">社会工程学攻击案例 »</a></p>
<P>↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓点击下面广告,为本站出一份力~↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓</P>
<P><a href="http://www.boworld.tv/?ref=key08  " target="_blank"><IMG border=0 hspace=0 alt="MOTHER FUCK" src="http://cdn.wghostk.com/img/AD.gif" align=baseline</IMG></a></P>
</div>


<form style="text-align: center;" name="from"action="" method="GET"  >
			<div id="content"><div id="create_form" ><em></em><label><p style="text-align:center;margin:0 auto;"><label ><input class="form-control" class="inurl" placeholder="email,username..." size="50" id="unurl" name="q" value="<?php
echo strip_tags(trim($_GET['q'])); ?>"/></label><span class="but"><input onclick="check(form)" type="submit" value="搜索一下" class="btn btn-success" /></span></p>
		</form></div>﻿
<?php	
if (!$num == 0) {
	mysql_query('Update TongJi set mzcs = mzcs + 1');
	/*
    echo "<br/>找到与&nbsp{$Keywords}&nbsp相关的结果 {$res[total_found]} 个。用时 {$res[time]} 秒。<ol>";
    while ($row = mysql_fetch_assoc($ret)) {
        $sql2 = "SELECT * FROM test WHERE id =" . $row['did']; // 这里的表名也改改。根据数据库ID名查找数据库名称的。
        $ret2 = mysql_query($sql2);
        $retContent = $cl->BuildExcerpts($row, "test1", $Keywords, $opts);
        echo '<li><font color=228B22>From_[' . mysql_result($ret2, 0, "dataname") . '_Datas]</font> <br /><font color=#00CD00>Content:</font>　' . $retContent[2] . '</li><br/>';
    }
    echo '</ol>';*/
	echo "<div class=\"row\">
    <div class=\"alert alert-success alert-dismissible col-md-10 col-md-offset-1\" role=\"alert\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
    找到与<b>&nbsp{$Keywords}&nbsp</b>相关的结果 {$res[total_found]} 个。用时 {$res[time]} 秒。</div>";
    echo "<div class=\"table-responsive col-md-10 col-md-offset-1\">
        <table class=\"table table-striped table-hover\">
          <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>Salt</th>
          <th>Other</th>
          </tr>";
if(isset($_SESSION["user"])){
    if($stop_why == '0'){
	while ($row = mysql_fetch_assoc($ret)) {
        echo "<tr><td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['salt'] . "</td>";
        echo "<td>" . $row['order'] . "</td></tr>";
		  }
	}else{exit("<script>alert('抱歉,您是测试用户,请购买正式用户邀请码！');location='index.php';</script>");}
		echo '<P><div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button><strong>搜到了却显示不对?而且这个密码对你很重要?那么速度进群联系群主使用暴力查询[免费]!必须注明:搜呼社工库</strong></div></P>';  
		}else{
			while ($row = mysql_fetch_assoc($ret)) {
		echo '<tr><td>请<a herf="/huoij/login.php">登陆</a>或者<a herf="/huoij/reg.php">注册</a></td>';
        echo '<td>请<a herf="/huoij/login.php">登陆</a>或者<a herf="/huoij/reg.php">注册</a></td>';
        echo '<td>请<a herf="/huoij/login.php">登陆</a>或者<a herf="/huoij/reg.php">注册</a></td>';
        echo '<td>请<a herf="/huoij/login.php">登陆</a>或者<a herf="/huoij/reg.php">注册</a></td>';
        echo '<td>请<a herf="/huoij/login.php">登陆</a>或者<a herf="/huoij/reg.php">注册</a></td>';
			}
		}
    echo "</table></div></div>";
} else {
    if (!empty($_GET) && !empty($_GET['q'])) {
		mysql_query('Update TongJi set cishu = cishu + 1');
        echo "<br/>找不到与&nbsp{$Keywords}&nbsp相关的结果。请更换其他关键词试试。";
        echo '<ul><hr align="center" width="550" color="#2F2F2F" size="1"><font color=#ff0000>We cannot guarantee the entirely accurate,please voluntarily judge.';
        echo '<br />The data is not complete? Do you want to add or remove it?';
        echo '<br />Contact Email:huoji@key08.com</font>';
        echo '</ul>';
    }
}
?>
		<div class="pages">

		</div>
		<div>
		<ul><li class="current"><a href="http://www.wghostk.com" target="_blank">幽灵网安</a></li><li><a href="http://www.wooyun.org" target="_blank">WooYun.org</a></li></ul>
		</div>
<div id="footer">
<p>© 2001-2015 Powered by Ph4nt0m. Theme by huoji </p>
</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							服务器状态
						</th>
						<th>
							未命中次数
						</th>
						<th>
							命中次数
						</th>
						<th>
							当前状态
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class="success">
						<td>
							Good(Time < 0.043sec)
						</td>
						<td>
							<?PHP 
							$cishu = mysql_query('Select cishu from TongJi');
							while($rowcishu=mysql_fetch_array($cishu)){echo $rowcishu['cishu'];}								
							?>
						</td>
						<td>
							<?PHP 
							$mzcs = mysql_query('Select mzcs from TongJi');
							while($rowmz=mysql_fetch_array($mzcs)){echo $rowmz['mzcs'];}								
							?>
						</td>
						<td>
							<?PHP echo $Others ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>
                    