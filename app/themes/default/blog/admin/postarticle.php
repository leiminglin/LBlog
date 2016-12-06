<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>后台管理 - <?php ehtml(SITE_NAME)?></title>
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
	width:100%;
}
.btn{
	/*width:100px;*/
	/*height:30px;*/
}
</style>
</head>
<body>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>
<form action="<?php echo WEB_APP_PATH?>admin/postarticle" method="post">
<table style="width:90%" align="center">
<tr>
<td>Title：</td>
<td><input name="title" type="text"/></td>
</tr>
<tr>
<td>Catid：</td>
<td><input name="catid" type="text"/></td>
</tr>
<tr>
<td>Userid：</td>
<td><input name="userid" type="text" value="15"/></td>
</tr>
<tr>
<td>IsActive：</td>
<td>
<input name="is_active" type="radio" value="Y" id="active_Y" checked/><label for="active_Y">Yes</label>
<input name="is_active" type="radio" value="N" id="active_N"/><label for="active_N">No</label>
</td>
</tr>
<tr>
<td>Url：</td>
<td>
<input name="url" type="text" value=""/>
</td>
</tr>
<tr>
<td>Content：</td>
<td><textarea style="width:100%" rows="15" name="content"></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="submit" value="Submit"/></td>
</tr>
</table>
</form>
</body>
</html>
