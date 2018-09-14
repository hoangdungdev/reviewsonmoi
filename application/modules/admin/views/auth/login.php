<!DOCTYPE HTML>
<html>
<head>
	<title>DP Administrator</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>media/css/sz-admin.css"	rel="stylesheet"/>
	<link href="<?php echo base_url();?>media/css/color-default.css"	rel="stylesheet"/>
	<script type="text/javascript"	src="<?php echo base_url();?>media/js/jquery.min.js"></script>
</head>
<body>
	<div id="login">
		<form id="login-form" method="POST" name="loginform" action="<?php echo current_url() 
																		// gọi đến đầy đủ url cotroller hiện hảnh : 
																			?>"> 
			<input type="hidden" value="<?php echo $url?>" name="url"/>
			<?php if (validation_errors()):?>
				<div class="response-msg error ui-corner-all">
				<span>Thông báo lỗi</span>
					<?php if (validation_errors()) echo validation_errors(' ','<br>'); ?>
				</div>
			<?php endif; ?>
			<p>
				<label>Username</label><br/>
				<input type="text" tabindex="10" size="20" value="" class="input" id="user_login" name="uid">
			</p>
			<p>
				<label>Password</label><br/>
				<input type="password" tabindex="10" size="20" value="" class="input" id="user_login" name="pwd">
			</p>
			<input type="submit" name="" id="search-submit" class="sz-button fr" value="Go to dashboard">
			<label class="fl" for="rememberme">
				<input type="checkbox" tabindex="90" value="forever" id="rememberme" name="rememberme"/>
				Remember me
			</label>
		</form>
		<div class="sz-link fr"><a href="#">Lost your password?</a></div>
		<div class="sz-link fl"><a href="#">← Back to homepage</a></div>
		<div class="clear"></div>
	</div>
</body>
</html>