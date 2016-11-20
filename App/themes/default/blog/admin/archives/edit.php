<?php 
lml()->app()->setOneSloc(false);
if(empty($article)){
	$article = array();
}
?>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>
<form action="<?php echo WEB_APP_PATH?>admin/archives/save<?php echo isset($article['id']) ? '/'.arr_get($article, 'id') : '';?>" 
method="post">
<table>
<tr>
<td><?php elang('Title')?></td>
<td><input name="title" type="text" value="<?php ehtml(arr_get($article, 'title'));?>"/></td>
</tr>
<tr>
<td><?php elang('CatID')?></td>
<?php 
$temp = q('blog_cat')->getAll();
$temp_catid = arr_get($article, 'catid', 1);
?>
<td>
<select name="catid">
	<?php foreach ($temp as $k=>$v){?>
	<option value="<?php echo $v['id']?>"<?php if($temp_catid==$v['id']){echo ' selected="selected"';}?>><?php ehtml($v['name'])?></option>
	<?php }?>
</select>
<?php 
/*<input name="catid" type="text" value="<?php echo arr_get($article, 'catid', 1);?>"/>*/
?>
</td>
</tr>
<tr>
<td><?php elang('UserID')?></td>
<td><input name="userid" type="text" value="<?php echo arr_get($article, 'userid', 1);?>"/></td>
</tr>
<tr>
<td><?php elang('IsActive')?></td>
<td>
<input name="is_active" type="radio" value="Y" id="active_Y" <?php if(arr_get($article,'is_active')=='Y'){echo 'checked';}?>/>
<label for="active_Y"><?php elang('Yes')?></label>
<input name="is_active" type="radio" value="N" id="active_N" <?php
if(arr_get($article,'is_active')=='N'){
	echo 'checked';
}elseif(!arr_get($article,'is_active')){
	echo 'checked';
}
?>
/>
<label for="active_N"><?php elang('No')?></label>
</td>
</tr>
<tr>
<td><?php elang('URI')?></td>
<td>
<input name="url" type="text" value="<?php echo arr_get($article, 'url');?>"/>
</td>
</tr>
<tr>
<td><?php elang('Content')?></td>
<td><textarea cols="88" rows="20" name="content"><?php ehtml(arr_get($article, 'content', '<div class="intro"><p>content here</p></div>'));?></textarea></td>
</tr>

<?php if(p('archives_modify')){?>
<tr>
<td align="center" colspan="2">
<input class="btn" type="button" value="<?php elang('Submit')?>"<?php if(!isset($article['id'])){echo ' data-need-refresh="1"';};?>/>
</td>
</tr>
<?php }?>
</table>
</form>

<script>

var visible_tab = $('.tabs_content').children(':visible');
$('form input[type=button]',visible_tab).click(function(){
	if(/[^a-z0-9_\-]/i.test($('form input[name=url]',visible_tab).val())){
		show_info('URL format is [0-9a-z-_]');
		return false;
	}
});

lml.loadJs('<?php echo WEB_APP_PATH.'admin/js/lmledit?t='.DEFAULT_LANG.filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/lmledit.js');?>', function(){
	lmledit();
});
</script>
