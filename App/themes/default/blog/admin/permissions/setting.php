

<form action="<?php echo WEB_APP_PATH?>admin/permissions/setting_save/<?php echo $type?>/<?php echo $id;?>" method="post">
<table>
<tr>
<?php
$c = count($rs);
foreach ($rs as $k=>$v){
	if($k%3==0 && $k>0 && $k<$c){
		echo '</tr><tr>';
	}
?>

<td>
<input id="per<?php echo $type,$v['id']?>" name="permissionids[]" value="<?php echo $v['id']?>" type="checkbox" title="<?php echo $v['description']?>" <?php if(in_array($v['id'], $rsr)){echo 'checked';};?>/>
<label for="per<?php echo $type,$v['id']?>" <?php if(in_array($v['id'], $rsr)){echo 'class="cl"';};?>><?php echo $v['description']?></label>
</td>

<?php 
}
?>
</tr>
<tr>
<td align="center" colspan="3"><input class="btn" type="button" value="<?php elang('Submit')?>"/></td>
</tr>
</table>
</form>