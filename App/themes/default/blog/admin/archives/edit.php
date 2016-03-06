<?php 
lml()->app()->setOneSloc(false);
if(empty($article)){
	exit;
}
?>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>
<form action="<?php echo WEB_APP_PATH?>admin/archives/save/<?php echo arr_get($article, 'id');?>" method="post" onsubmit="return get_save_archives(this);">
<table>
<tr>
<td>Title：</td>
<td><input name="title" type="text" value="<?php echo arr_get($article, 'title');?>"/></td>
</tr>
<tr>
<td>Catid：</td>
<td><input name="catid" type="text" value="<?php echo arr_get($article, 'catid');?>"/></td>
</tr>
<tr>
<td>Userid：</td>
<td><input name="userid" type="text" value="1" value="<?php echo arr_get($article, 'userid');?>"/></td>
</tr>
<tr>
<td>IsActive：</td>
<td>
<input name="is_active" type="radio" value="Y" id="active_Y" <?php if(arr_get($article, 'is_active') == 'Y'){echo 'checked';}?>/><label for="active_Y">Yes</label>
<input name="is_active" type="radio" value="N" id="active_N" <?php if(arr_get($article, 'is_active') == 'N'){echo 'checked';}?>/><label for="active_N">No</label>
</td>
</tr>
<tr>
<td>Url：</td>
<td>
<input name="url" type="text" value="<?php echo arr_get($article, 'url');?>"/>
</td>
</tr>
<tr>
<td>Content：</td>
<td><textarea cols="100" rows="15" name="content"><?php echo htmlspecialchars(arr_get($article, 'content'));?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="submit" value="Submit"/></td>
</tr>
</table>
</form>
