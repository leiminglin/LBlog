
<form action="<?php echo WEB_APP_PATH?>admin/images/save<?php echo isset($rs)?'/'.$rs['id']:'';?>"
 method="post" enctype="multipart/form-data" target="iframeFileImage">
<table>
<tr>
<?php if(p('images_add')||p('images_modify')){?>
<td><input type="file" name="images[]" <?php if(!isset($rs)){?>multiple="multiple"<?php }?>/></td>
<td align="center"><input type="checkbox" name="is_origin" value="1" title="<?php elang('Upload origin image')?>"/> <input class="btn" type="submit" value="<?php elang('Submit')?>" data-id="images_upload"/></td>
<?php }?>


<?php 
$size_str = '';
if(isset($rs)){
	$size = image_wh($rs['width'], $rs['height']);
	$size_str = ' width="'.$size['w'].'" height="'.$size['h'].'" ';
}
?>

</tr>
<tr>
<td colspan="2" class="preview">
<?php 
if(isset($rs)){
?>
	<img src="<?php echo WEB_PATH.'file/image/'.$rs['id'].'?'.$rs['hash']?>"<?php echo $size_str?>/>
<?php 
}else{
?>
	
<?php 
}?>
</td>
</tr>
</table>
</form>
<iframe id="iframeFileImage" name="iframeFileImage" class="hidden"></iframe>