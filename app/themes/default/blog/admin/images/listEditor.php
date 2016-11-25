<form action="<?php echo WEB_APP_PATH?>admin/images/save" method="post" enctype="multipart/form-data" target="iframeFileImageEditor">


<table>
<?php if(p('images_add')||p('images_modify')){?>
<tr>
<td colspan="3"><input type="file" name="images[]" multiple="multiple"/></td>
<td colspan="3" align="center">
	<input type="checkbox" name="is_origin" value="1" title="<?php elang('Upload origin image')?>"/>
	<input class="btn" type="submit" value="<?php elang('Submit')?>" data-id="images_upload_editor"/>
</td>
</tr>
<tr>
<td colspan="6" class="preview"></td>
</tr>
<?php }?>



<tr>
<?php foreach ($rs as $k=>$v){
	$size = image_wh($v['width'], $v['height'], 100, 100);
	if( $k > 0 && $k % 6 == 0 ) { echo '</tr><tr>';}
?>
<td><img src="<?php echo WEB_PATH?>file/image/<?php echo $v['id'].'?'.$v['hash']?>" width="<?php echo $size['w']?>" height="<?php echo $size['h']?>" />
<span class="hidden"><?php echo $v['width']?></span><span class="hidden"><?php echo $v['height']?></span></td>
<?php }?>
</tr>
</table>
</form>
<?php
$data_action = 'lblog_admin_images_editor_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
<script>
(function(){
	if(!$('#iframeFileImageEditor').length){
		$('<iframe/>').attr({"id":"iframeFileImageEditor","name":"iframeFileImageEditor","class":"hidden"}).appendTo(document.body);
	}
})();
</script>