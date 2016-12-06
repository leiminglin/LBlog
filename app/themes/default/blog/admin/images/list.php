<div class="line">

<?php if(p('images_read_post')){?>
<span>
<a href="javascript:void(0)" data-action="lblog_admin_images_post_page"><?php elang('Post')?></a>
</span>
<?php }?>



</div>


<table>
<tr>
<th><?php elang('ID')?></th>
<!--<th><?php elang('Path')?></th>-->
<th><?php elang('Image')?></th>
<!--<th><?php elang('Type')?></th>-->
<th><?php elang('Size')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){
	$size = image_wh($v['width'], $v['height'], 100, 100);
?>
<tr>
<td><?php echo $v['id'];?></td>
<!--<td><?php ehtml($v['path']);?></td>-->
<td><img src="<?php echo WEB_PATH?>file/image/<?php echo $v['id'].'?'.$v['hash']?>" width="<?php echo $size['w']?>" height="<?php echo $size['h']?>" /></td>
<!--<td><?php ehtml($v['type']);?></td>-->
<td><?php echo $v['size'];?></td>
<td><?php echo date("ymd H:i:s", $v['createtime']);?></td>
<td>
<?php if(p('images_modify')){?>
<a href="javascript:void(0)" data-action="lblog_admin_images_post_page" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_images_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
