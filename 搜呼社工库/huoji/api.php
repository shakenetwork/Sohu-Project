<?PHP
error_reporting(E_ALL & ~E_NOTICE);
set_time_limit(0);
require ('/config.php');
//API接口 请求方式 GET 注意 ,要设置好UA 否则会被防火墙拦截
// api.php?api=yes&apiuser=账号&apipwd=密码&s=关键字
if(isset($_GET["api"]) && isset($_GET["apipwd"]) && isset($_GET["s"]))
{
	$api_mod = $_GET["api"];
	if($api_mod == "yes"){
		$api_s = $_GET["s"];
		//$api_s = check_input(strip_tags(trim($_GET["s"])));
		if($api_s == "")
		 {
			 exit("你是猪吗");
		 }else{
			 if(yanzheng())
			 {
				api();
			 }
		 }
		 
	}
}
function yanzheng()
{
$api_user = check_input($_GET["apiuser"]);
$api_pwd = check_input($_GET["apipwd"]);
$api_sql="select * from users where username=$api_user and password=$api_pwd limit 1";
//---------------------------------
$api_rs=mysql_query($api_sql);
if(mysql_num_rows($api_rs)==1){return true;}else{return false;}
}
function check_input($value)
{
// 去除斜杠
if (get_magic_quotes_gpc())
  {
  $value = stripslashes($value);
  }
// 如果不是数字则加引号
if (!is_numeric($value))
  {
  $value = "'" . mysql_real_escape_string($value) . "'";
  }
return $value;
}
function api()
{
// 引用sphinxapi类
require ("../sphinxapi.php");
$api_Keywords = check_input(strip_tags(trim($_GET['s']))); //可能会有错误 继续看
$api_cl = new SphinxClient();
// 返回结果设置
$opts = array(
        "before_match" => "<font color=red>",
        "after_match" => "</font>",
        "chunk_separator" => " ... ",
        "limit" => 150,
        "around" => 3,
    );
$api_cl->SetServer('127.0.0.1', 9312);
 $api_cl->SetConnectTimeout(3);
 $api_cl->SetArrayResult(true);
 $api_cl->SetMatchMode(SPH_MATCH_ALL);
 
 $api_cl->setLimits(0, 20);
 $res = $api_cl->Query(".$api_Keywords.", "*");
 mysql_connect("localhost", "huoji", "huoji120.."); //数据库账号密码
 mysql_select_db("huoji"); //数据库库名名
    if (is_array($res["matches"])) {
        foreach ($res["matches"] as $docinfo) {
            $ids = $ids . $docinfo[id] . ',';
        }
  $hitest = rtrim($ids, ',');
  $ids = check_input($hitest);
  $sql = "select * from huoji where id in($ids)"; //注意修改表名
  mysql_query("set names utf8");
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
		if ($num == 0) {			//如果表3找不到结果.那我就换个裤子 ;>
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
	if ($num == 0) {			//如果找不到结果.那我就换个裤子 ;>邮箱数据库
		$ids = 0;
		$res = $cl->Query(".$Keywords.", "*");
		if (is_array($res["matches"])) {
        foreach ($res["matches"] as $docinfo) {
            $ids = $ids . $docinfo[id] . ',';
        }
		$Others = 'Used SoHu_Email_SGK';
		$hitest = rtrim($ids, ',');
		$ids = $hitest;
		$sql = "select * from huoji_5_email where id in($ids)"; //注意
        $ret = mysql_query($sql);
        $num = mysql_num_rows($ret);
		}
    }
  }
  
  
if (!$num == 0) {
	
	echo "{$res[total_found]},";
    while ($row = mysql_fetch_assoc($ret)) {
        echo $row['username'].",".$row['email'].",".$row['password'].",".$row['salt'].",".$row['order'];
		  }
		
} else {
    if (!empty($_GET) && !empty($_GET['s'])) {
        echo "找不到相关的结果。请更换其他关键词试试。";

    }
  }
}
?>