<?
error_reporting(E_ALL & ~E_NOTICE);
//幽灵网安 - 智能CC攻击防御引擎 V2.0 正式版
// website : http://www.wghostk.com
$CC_sec = '1';
// 0 - 关闭防护,不推荐
// 1 - 普通防护,智能识别CC攻击,十秒拦截CC攻击
// 2 - 加强防护,拦截所有CC攻击.建议在遭到攻击的情况下使用
// 3 - 自动防护,注意可能会稍微影响性能并且不是所有网站都支持。如果出现异常请不要使用!只支持80端口
//------------------------------------------------------------------------------------------------------------
$CC_white = 'api.php'; 
//api接口白名单.任何类似于api.php这样的文件直接放行
$sbIP = GetIP();
$CC_NO = CC_white();
/*
---------------------------------------------------------------------------------------------------------------
自动防护设置模块,当CC_sec 为 3 时候有效果
参考表:
个人博客/个人网站: 300 
中型网站: 1000
大型网站: 3000
*/
$CC_AUTO = 300;
//当网站并发数小于或者等于300时候,默认使用 普通防护 .大于300时候使用 强力防护.可自己设置大小.参考上面的参考表
session_start();
if ($sbIP != "FUCK"){
	if(check_spider() == false){
		//先进行CC攻击验证
		if($CC_sec != '0' && $CC_NO != $CC_white){
		$_SESSION['session_check'] = 'YES';
		if($CC_sec == '1'){
		CC_huoji();}
	    if($CC_sec == '2'){
		CC_huoji2();}
		if($CC_sec == '3'){
			$CC_S = (int)autosec();
			IF($CC_S <= $CC_AUTO){CC_huoji();}
			IF($CC_S > $CC_AUTO){CC_huoji2();}}
		}
	}
}else{
	echo '警告,本网站的防火墙无法取得您的真实IP,可能是防火墙版本太老！请联系管理员 ：<';
}
/*
* 幽灵CC防火墙 智能CC防御引擎 V 2.0 
* 十 秒 拦 截 C C 攻 击
* 转 载 请 注 明 版 权
*/ 

function CC_huoji()
{
	if(!isset($_SESSION['session_check'])){
	echo  '抱歉,您的浏览器看起来并不支持cookie,请设置一下浏览器,比如退出隐私模式,启用cookie,降低安全级别等,然后再访问本站!';
    exit();}
	//普通模式
		if (cheakget()){
			cheak ();
		}else{
			if (!isset($_SESSION['CC_get_hacker'])){
			// 如果浏览器未知,则可能是GET空请求！
			echo '
            <HTML><HEAD><TITLE>幽灵CC防火墙</TITLE>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<META content="text/html; charset=unicode" http-equiv=Content-Type></HEAD>
            <BODY>
            <P>提示：您看起来不像普通浏览器,请</P>
            <form id="form" name="form" method="post" action=""/>
            <P><INPUT type=submit value=点击继续访问 name=submit></P></BODY></HTML>
            </form>';
			if (isset ( $_POST ['submit'] ) && $_POST ['submit']) {
				$_SESSION ['CC_get_hacker'] = "OKisSEC";
				echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
			}
			exit();
		}
	  }
}	
function CC_huoji2()
{
	if(!isset($_SESSION['session_check'])){
	echo  '抱歉,您的浏览器看起来并不支持cookie,请设置一下浏览器,比如退出隐私模式,启用cookie,降低安全级别等,然后再访问本站!';
    exit();}
	//强力模式
		if(!isset($_SESSION['CC_big_hacker'])){
		echo '
            <HTML><HEAD><TITLE>幽灵CC防火墙</TITLE>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<META content="text/html; charset=unicode" http-equiv=Content-Type></HEAD>
            <BODY>
            <P>提示：当前网站压力大,请</P>
            <form id="form" name="form" method="post" action=""/>
            <P><INPUT type=submit value=点击继续访问 name=submit5></P></BODY></HTML>
            </form>';
		if (isset ( $_POST ['submit5'] ) && $_POST ['submit5']) {
			$_SESSION ['CC_big_hacker'] = "OKSEC0123456789";
			echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
		}
		exit();
		}	
}

/*
-------------------------------------------------------------------------------------
*/
function check_spider()
{
    $agent= strtolower($_SERVER['HTTP_USER_AGENT']); 
        if (!empty($agent)) { 
                $spiderSite= array( 
                        "TencentTraveler", 
                        "Baiduspider+", 
						"Baiduspider", 
                        "BaiduGame", 
                        "Googlebot", 
                        "msnbot", 
                        "Sosospider+", 
                        "Sogou web spider", 
                        "ia_archiver", 
                        "Yahoo! Slurp", 
                        "YoudaoBot", 
                        "Yahoo Slurp", 
                        "MSNBot", 
                        "Java (Often spam bot)", 
                        "BaiDuSpider", 
                        "Voila", 
                        "Yandex bot", 
                        "BSpider", 
                        "twiceler", 
                        "Sogou Spider", 
                        "Speedy Spider", 
                        "Google AdSense", 
                        "Heritrix", 
                        "Python-urllib", 
                        "Alexa (IA Archiver)", 
                        "Ask", 
                        "Exabot", 
                        "Custo", 
                        "OutfoxBot/YodaoBot", 
                        "yacy", 
                        "SurveyBot", 
                        "legs", 
                        "lwp-trivial", 
                        "Nutch", 
                        "StackRambler", 
                        "The web archive (IA Archiver)", 
                        "Perl tool", 
                        "MJ12bot", 
                        "Netcraft", 
                        "MSIECrawler", 
                        "WGet tools", 
                        "larbin", 
                        "Fish search", 
                ); 
                foreach($spiderSite as $val) { 
                        $str = strtolower($val); 
                        if (strpos($agent, $str) !== false) { 
                                return true; 
                        } 
                } 
        } else { 
                return false; 
        } 
} 


function GetIP(){ 
if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
$ip = getenv("HTTP_X_FORWARDED_FOR"); 
else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
$ip = getenv("HTTP_CLIENT_IP"); 
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
$ip = getenv("REMOTE_ADDR"); 
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
$ip = $_SERVER['REMOTE_ADDR']; 
else 
$ip = "FUCK"; 
return($ip); 
} 
function autosec()
{
if(!isset($_SESSION['CC_auto'])){
ini_set('extension_dir',dirname(__FILE__));
ini_set('enable_dl',TRUE);
if(!extension_loaded("curl")){
	exit('错误:您的服务器不支持curl扩展.请打开PHP_curl扩展或者不要把防御级别设置成3.');
}
$content = `netstat -an -p TCP`;
$regex = "/\s+TCP\s+\d+\.\d+\.\d+\.\d+:(\d+)\s+(\d+\.\d+\.\d+\.\d+):\d+\s+/sm";

$table = array();
/**
 * 端口/ip是唯一的
 */
if(preg_match_all($regex,$content,$result)){
	foreach($result[1] as $i=>$port){
		if(isset($table[$port.':'.$result[2][$i]]))
			$table[$port.':'.$result[2][$i]]++;
		else
			$table[$port.':'.$result[2][$i]] = 1;
	}
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_TIMEOUT,5);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

	$i = 0;
	$count = 0;
	if(asort($table))
		foreach($table as $key=>$times){
			$ip = substr(strstr($key,':'),1);
			$port = substr($key,0,strpos($key,':'));
			$i++;
			//echo "\r\n连接数：",$times,' - ',$key;
			
			if($port=='80') $count += $times;
		}
	$_SESSION['CC_auto'] = 'true';	
	return $count;
}
}else{return 0;}
}
function cheakget() {
	$agent = $_SERVER ["HTTP_USER_AGENT"];
	if (strpos ( $agent, 'MSIE' ) !== false || strpos ( $agent, 'rv:11.0' )) {
		return true;
	} // ie11判断
	if (strpos ( $agent, "MSIE 8.0" )) {
		return true;
	}
	if (strpos ( $agent, "MSIE 7.0" )) {
		return true;
	}
	if (strpos ( $agent, "MSIE 6.0" )) {
		return true;
	}
	if (strpos ( $agent, "Firefox/3" )) {
		return true;
	}
	if (strpos ( $agent, "Firefox/2" )) {
		return true;
	}
	if (strpos ( $agent, "Chrome" )) {
		return true;
	}
	if (strpos ( $agent, "Safari" )) {
		return true;
	}
	if (strpos ( $agent, "Opera" )) {
		return true;
	}
	if (strpos ( $agent, "Baiduspider" )) {
		return true;
	}
	return false;
}
function cheak() {
	
	$cur_time = time ();
	$ACC = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>幽灵cc防火墙</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META content="text/html; charset=unicode" http-equiv=Content-Type>
</HEAD>
<BODY>
<P>刷新过于频繁,请不要快速刷新并且请:</P>
<form id="form" name="form" method="post" action=""/>
<P><INPUT type=submit value=点击继续访问 name=yz></P></BODY></HTML>
</form>
';
	if (isset ( $_POST ['yz'] ) && $_POST ['yz']) {
		$_SESSION ['refresh_times'] = 0;
		$_SESSION ['last_time'] = $cur_time;
		echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
	}
	
	$seconds = '60'; // 时间段[秒]
	$refresh = '35'; // 刷新次数
	
	if (isset ( $_SESSION ['last_time'] )) {
		$_SESSION ['refresh_times'] += 1;
	} else {
		$_SESSION ['refresh_times'] = 1;
		$_SESSION ['last_time'] = $cur_time;
	}
	
	if ($cur_time - $_SESSION ['last_time'] < $seconds) {
		if ($_SESSION ['refresh_times'] >= $refresh) {
			// 处理
			echo $ACC;
			exit ();
		}
	} else {
		$_SESSION ['refresh_times'] = 0;
		$_SESSION ['last_time'] = $cur_time;
	}
	
}
function CC_white()
{
    $phpself=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
    return $phpself;
}
?>