<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>后台管理 - <?php echo SITE_NAME?></title>
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
	width:350px;
}
.btn{
	width:100px;
	height:30px;
}
</style>
</head>
<body>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>
<form action="<?php echo WEB_APP_PATH?>admin/login" method="post">
<table>
<tr>
<td>Email：</td>
<td><input name="email" type="text"/></td>
</tr>
<tr>
<td>Password：</td>
<td><input name="passwd" type="password"/></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="submit" value="Submit"/></td>
</tr>
</table>
</form>
</body>
</html>