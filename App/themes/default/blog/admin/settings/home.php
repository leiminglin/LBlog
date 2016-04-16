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
<td><input type="text" name="SITE_NAME" class="longinput" value="<?php ehtml(arr_get($site, 'site_name'));?>"/></td>
</tr>
<tr>
<td><?php elang('Site keywords')?></td>
<td><input type="text" name="SITE_KEYWORDS" class="longinput" value="<?php ehtml(arr_get($site, 'site_keywords'));?>"/></td>
</tr>
<tr>
<td><?php elang('Site meta-infomation')?></td>
<td><textarea cols="60" rows="3" name="SITE_DESCRIPTION"><?php ehtml(arr_get($site, 'site_description'));?></textarea></td>
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
<td><input type="text" name="LOGIN_PAGE_URI" class="longinput" value="<?php echo arr_get($site, 'login_page_uri', 'login');?>"/></td>
</tr>
<tr>
<td align="center" colspan="3"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/jscode" method="post">
<table>
<tr>
<td colspan="2"><?php elang('JavaScript Code')?></td>
</tr>
<tr>
<td><?php elang('JavaScript Code')?></td>
<td><textarea cols="80" rows="12" name="JAVASCRIPT_CODE"><?php ehtml(arr_get($site, 'javascript_code'));?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/openid_qq" method="post">
<table>
<tr>
<td colspan="2"><?php elang('QQ');elang('Config')?></td>
</tr>
<tr>
<td><?php elang('Appid')?></td>
<td><input type="text" name="QQ_CONFIG_APPID" class="longinput" value="<?php echo arr_get($site, 'qq_config_appid');?>"/></td>
</tr>
<tr>
<td><?php elang('Appkey')?></td>
<td><input type="text" name="QQ_CONFIG_APPKEY" class="longinput" value="<?php echo arr_get($site, 'qq_config_appkey');?>"/></td>
</tr>
<tr>
<td><?php elang('Callback')?></td>
<td><input type="text" name="QQ_CONFIG_CALLBACK" class="longinput" value="<?php echo arr_get($site, 'qq_config_callback');?>"/></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>



<div class="line"></div>

<div>

QQ weibo config,

timezone,

logo upload,

</div>
