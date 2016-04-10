<?php 
lml()->app()->setOneSloc(false);
?>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>
<form action="<?php echo WEB_APP_PATH?>admin/comments/save<?php echo isset($rs['id']) ? '/'.arr_get($rs, 'id') : '';?>" 
method="post">
<table>
<tr>
<td>IsActive：</td>
<td>
<input name="is_active" type="radio" value="Y" id="active_Y" <?php if(arr_get($rs,'is_active')=='Y'){echo 'checked';}?>/>
<label for="active_Y">Yes</label>
<input name="is_active" type="radio" value="N" id="active_N" <?php
if(arr_get($rs,'is_active')=='N'){
	echo 'checked';
}elseif(!arr_get($rs,'is_active')){
	echo 'checked';
}
?>
/>
<label for="active_N">No</label>
</td>
</tr>
<tr>
<td>Content：</td>
<td><textarea cols="88" rows="20" name="content"><?php ehtml(arr_get($rs, 'content'));?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="Submit"<?php if(!isset($rs['id'])){echo ' data-need-refresh="1"';};?>/></td>
</tr>
</table>
</form>
