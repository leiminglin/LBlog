<?php 
if(empty($rs)){
	$rs = array();
}
?>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>

<form action="<?php echo WEB_APP_PATH?>admin/permissions/save<?php echo isset($rs['id']) && $rs['id'] ? '/'.$rs['id'] : '';?>" 
method="post">
<table>
<tr>
<td><?php elang('Name')?></td>
<td><input name="name" type="text" value="<?php ehtml(arr_get($rs, 'name'));?>" class="longinput"/></td>
</tr>
<tr>
<td><?php elang('UriRegExp')?></td>
<td><input name="uri_regexp" type="text" value="<?php echo arr_get($rs, 'uri_regexp');?>" class="longinput"/></td>
</tr>
<tr>
<td><?php elang('Description')?></td>
<td><input name="description" type="text" value="<?php echo arr_get($rs, 'description');?>" class="longinput"/></td>
</tr>
<tr>
<td align="center" colspan="2">
<input class="btn" type="button" value="<?php elang('Submit')?>"<?php if(!isset($rs['id'])){echo ' data-need-refresh="1"';};?>/>
</td>
</tr>
</table>
</form>
