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
<form action="<?php echo WEB_APP_PATH?>admin/goods_cat/save<?php echo isset($rs['id']) ? '/'.arr_get($rs, 'id') : '';?>" method="post">
<table>
<tr>
<td><?php elang('Title')?></td>
<td>
<input name="title" type="text" value="<?php ehtml(arr_get($rs, 'title'));?>"/>
<?php if(isset($rs['id'])){?>
<input name="updatetime" type="hidden" value="1"/>
<?php }?>
</td>
</tr>

<tr>
<td><?php elang('Status')?></td>
<td>
<label>Y<input name="status" type="radio" value="1" <?php if(arr_get($rs, 'status')){echo 'checked';}?>/></label>
 &nbsp;<label>N<input name="status" type="radio" value="0" <?php if(!arr_get($rs, 'status')){echo 'checked';}?>/></label>
</td>
</tr>


<?php if(p('mall_cats_modify')){?>
<tr>
<td align="center" colspan="2">
<input class="btn" type="button" value="<?php elang('Submit')?>"<?php if(!isset($rs['id'])){echo ' data-need-refresh="1"';};?>/>
</td>
</tr>
<?php }?>
</table>
</form>
