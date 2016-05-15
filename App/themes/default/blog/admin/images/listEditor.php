<table>
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
<?php
$data_action = 'lblog_admin_images_editor_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
