<?php 
lml()->app()->setOneSloc(false);
if(empty($article)){
	lblog_exit();
}
?>
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
<form action="<?php echo WEB_APP_PATH?>admin/postarticle?id=<?php echo isset($article['id'])?$article['id']:'';?>" method="post">
<table>
<tr>
<td>Title：</td>
<td><input name="title" type="text" value="<?php echo isset($article['title'])?$article['title']:'';?>"/></td>
</tr>
<tr>
<td>Catid：</td>
<td><input name="catid" type="text" value="<?php echo isset($article['catid'])?$article['catid']:'';?>"/></td>
</tr>
<tr>
<td>Userid：</td>
<td><input name="userid" type="text" value="15" value="<?php echo isset($article['userid'])?$article['userid']:'';?>"/></td>
</tr>
<tr>
<td>IsActive：</td>
<td>
<input name="is_active" type="radio" value="Y" id="active_Y" <?php if(isset($article['is_active']) && $article['is_active'] == 'Y'){echo 'checked';}?>/><label for="active_Y">Yes</label>
<input name="is_active" type="radio" value="N" id="active_N" <?php if(isset($article['is_active']) && $article['is_active'] == 'N'){echo 'checked';}?>/><label for="active_N">No</label>
</td>
</tr>
<tr>
<td>Url：</td>
<td>
<input name="url" type="text" value="<?php echo isset($article['url'])?$article['url']:'';?>"/>
</td>
</tr>
<tr>
<td>Content：</td>
<td><textarea cols="100" rows="15" name="content"><?php echo isset($article['content'])?htmlspecialchars($article['content']):'';?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="submit" value="Submit"/></td>
</tr>
</table>
</form>
</body>
</html>