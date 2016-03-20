<?php 
lml()->app()->setOneSloc(false);
if(!isset($site)){
	$site = array();
}
if(empty($site)){
	$site = array();
}
?>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/seo" method="post">
<table>
<tr>
<td>Site Name</td>
<td><input type="text" name="site_name" value="<?php echo arr_get($site, 'site_name');?>"/></td>
</tr>
<tr>
<td>Site Keywords</td>
<td><input type="text" name="site_keywords" value="<?php echo arr_get($site, 'site_keywords');?>"/></td>
</tr>
<tr>
<td>Site Meta</td>
<td><textarea cols="60" rows="3" name="site_description"><?php echo htmlspecialchars(arr_get($site, 'site_description'));?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="Submit"/></td>
</tr>
</table>
</form>