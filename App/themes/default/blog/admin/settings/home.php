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
<td colspan="2"><?php elang('SEO')?></td>
</tr>
<tr>
<td><?php elang('Site name')?></td>
<td><input type="text" name="site_name" class="longinput" value="<?php ehtml(arr_get($site, 'site_name'));?>"/></td>
</tr>
<tr>
<td><?php elang('Site keywords')?></td>
<td><input type="text" name="site_keywords" class="longinput" value="<?php ehtml(arr_get($site, 'site_keywords'));?>"/></td>
</tr>
<tr>
<td><?php elang('Site meta-infomation')?></td>
<td><textarea cols="60" rows="3" name="site_description"><?php ehtml(arr_get($site, 'site_description'));?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/security" method="post">
<table>
<tr>
<td colspan="3"><?php elang('Security')?></td>
</tr>
<tr>
<td><?php elang('Login page uri')?></td>
<td>/admin/</td>
<td><input type="text" name="login_page_uri" class="longinput" value="<?php echo arr_get($site, 'login_page_uri', 'login');?>"/></td>
</tr>
<tr>
<td align="center" colspan="3"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<div>
statistic code,

QQ weibo config,

timezone,

logo upload,

</div>
