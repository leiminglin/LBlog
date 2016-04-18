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
<td colspan="2"><?php elang('Security');?>(<?php elang('Admin');elang('Login page uri')?>)</td>
</tr>
<tr>
<td>/admin/</td>
<td><input type="text" name="LOGIN_PAGE_URI" class="longinput" value="<?php echo arr_get($site, 'login_page_uri', 'login');?>"/></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/jscode" method="post">
<table>
<tr>
<td><?php elang('JavaScript Code')?></td>
</tr>
<tr>
<td><textarea cols="80" rows="12" name="JAVASCRIPT_CODE"><?php ehtml(arr_get($site, 'javascript_code'));?></textarea></td>
</tr>
<tr>
<td align="center"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
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

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/openid_weibo" method="post">
<table>
<tr>
<td colspan="2"><?php elang('Weibo');elang('Config')?></td>
</tr>
<tr>
<td><?php elang('AppKey')?></td>
<td><input type="text" name="WEIBO_CONFIG_APPKEY" class="longinput" value="<?php echo arr_get($site, 'weibo_config_appkey');?>"/></td>
</tr>
<tr>
<td><?php elang('SecretKey')?></td>
<td><input type="text" name="WEIBO_CONFIG_SECRETKEY" class="longinput" value="<?php echo arr_get($site, 'weibo_config_secretkey');?>"/></td>
</tr>
<tr>
<td><?php elang('Callback')?></td>
<td><input type="text" name="WEIBO_CONFIG_CALLBACK" class="longinput" value="<?php echo arr_get($site, 'weibo_config_callback');?>"/></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/timezone" method="post">
<table>
<tr>
<td><?php elang('Timezone')?></td>
<td><input type="text" name="TIMEZONE" value="<?php echo arr_get($site, 'timezone');?>"/></td>
<td align="center"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>

<div class="line"></div>

<form action="<?php echo WEB_APP_PATH?>admin/settings/save/logo" method="post" enctype="multipart/form-data" target="iframeFile">
<table>
<tr>
<td><?php elang('Logo')?></td>
<td><input type="file" name="LOGO"/></td>
<td align="center"><input class="btn" type="submit" value="<?php elang('Submit')?>" data-id="settings_logo"/></td>
</tr>
<tr>
<td colspan="3" id="logo_img_td"><img src="<?php echo $site['logo_url']?>" 
width="<?php echo $site['logo_width']?>" height="<?php echo $site['logo_height']?>"/></td>
</tr>
</table>
</form>
<iframe id="iframeFile" name="iframeFile" class="hidden"></iframe>



<div class="line"></div>

<div>

pages ...,
cookie ,admin nav
salt
function p
statistic task onshow event
table 


</div>
