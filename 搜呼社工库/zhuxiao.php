<?PHP
@session_start();
session_destroy();
?>
<html>
<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<blockquote>
				<p>
					注销成功
				</p> <small>您可以<A href="index.php">返回首页</A>重新登陆</small>
			</blockquote>
		</div>
	</div>
</div>
</HTML>