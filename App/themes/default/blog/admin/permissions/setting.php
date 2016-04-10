

<form action="<?php echo WEB_APP_PATH?>admin/permissions/setting_save/<?php echo $type?>/<?php echo $id;?>" method="post">
<table>
<?php foreach ($rs as $k=>$v){?>
<?php 
if($k%2==0 && $k>0 && $k<count($rs)-1){
	echo '</tr><tr>';
}

if($k==0){
	echo '<tr>';
}

if($k==count($rs)){
	echo '</tr>';
}
?>

<td>
<input id="per<?php echo $type,$v['id']?>" name="permissionids[]" value="<?php echo $v['id']?>" type="checkbox" title="<?php echo $v['description']?>" <?php if(in_array($v['id'], $rsr)){echo 'checked';};?>/>
<label for="per<?php echo $type,$v['id']?>" <?php if(in_array($v['id'], $rsr)){echo 'class="cl"';};?>><?php echo $v['description']?></label>
</td>

<?php }?>

<tr>
<td align="center" colspan="2"><input class="btn" type="button" value="Submit"/></td>
</tr>
</table>
</form>