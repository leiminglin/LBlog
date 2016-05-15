<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>注册 - <?php ehtml(SITE_NAME)?></title>
<style>
body{
	font-family:Microsoft Yahei;
	font-size:14px;
	font-color:#333;
}
image{
	border:0;
}
input{
	width:200px;
}
.btn{
	width:60px;
	height:30px;
}
.login{
	width:360px;
	margin:100px auto;
}
table tr td, table tr th{
	padding:10px;
}
table{
	border:1px solid #eee;
	border-collapse:collapse;
}
</style>
</head>
<body>
<div class="login">
<form action="<?php echo WEB_APP_PATH?>user/register" method="post">
<table>
<tr>
<td colspan="2" style="background:#f7f7f7;"><?php ehtml(SITE_NAME);?></td>
</tr>
<tr>
<td colspan="2"><?php 
if(isset($save_status)){
	echo $save_status;
}
?></td>
</tr>
<tr>
<td>Email：</td>
<td><input name="email" type="text"/></td>
</tr>
<tr>
<td>Password：</td>
<td><input name="passwd" type="password"/></td>
</tr>
<tr>
<td>Re-Password：</td>
<td><input name="repasswd" type="password"/></td>
</tr>
<tr>
<td>Captcha：</td>
<td><img src="<?php echo WEB_APP_PATH?>user/register/captcha" 
onclick="this.src='<?php echo WEB_APP_PATH?>user/register/captcha?'+Math.random()"/><input name="captcha" type="text"/></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="submit" value="Submit"/></td>
</tr>
</table>
</form>
</div>
</body>
</html>