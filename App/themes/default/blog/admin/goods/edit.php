<?php 
lml()->app()->setOneSloc(false);
if(empty($rs)){
	$rs = array();
}
?>
<div><?php 
if(isset($save_status)){
	echo $save_status;
}
?></div>
<form action="<?php echo WEB_APP_PATH?>admin/goods/save<?php echo isset($rs['id']) ? '/'.arr_get($rs, 'id') : '';?>" method="post">
<table>
<tr>
<td><?php elang('Title')?></td>
<td>
<input name="title" type="text" value="<?php ehtml(arr_get($rs, 'title'));?>"/>
<input name="userid" type="hidden" value="<?php ehtml(arr_get($rs, 'userid', Tool::checkAdminCookie()));?>"/>
<input name="images" type="hidden" value=""/>
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

<tr>
<td><?php elang('Cat')?></td>
<td>
<?php 
$rs_id = arr_get($rs, 'id');
if($rs_id){
	$good_cats = arr_get_index(q('mall_goods_cat')->select('good_cat_id', 'good_id=?', array($rs_id)), 'good_cat_id');
}else{
	$good_cats = array();
}


$mall_cats=q('mall_cat')->select('id,title', 'status=1');
if($mall_cats){
	foreach ($mall_cats as $k => $v) {
		echo '<label><input name="z_data[]" type="checkbox" value="'.$v['id'].'" '
			. (in_array($v['id'], $good_cats)?'checked':'') .'>'.$v['title'].'</label>';
	}
	echo '<input name="z_handle" type="hidden" value="mallCatSave"/>';
}
?>
</td>
</tr>

<tr>
<td><?php elang('Album')?></td>
<td>
<div class="image_edit_album" style="min-height:200px;">
	<div>
		<a href="javascript:void(0)" data-action="lblog_admin_images_editor_page" style="position:relative;">选择图片
			<div class="template_imgs"></div>
		</a>
	</div>
	<div class="img_container">
		<?php $images=arr_get($rs, 'images');
		if($images){
			foreach (explode(',', $images) as $k=>$v){
				echo template_interpreter('<div class="wrap"><LBLOGimage id="'.$v.'" nodefer maxwidth="100" maxheight="80"><div class="close"><a href="javascript:void(0)">移除</a></div></div>');
			}
		}
		?>
	</div>
</div>
</td>
</tr>

<tr>
<td><?php elang('Original Price')?></td>
<td>
<input name="origin_price" type="text" value="<?php ehtml(arr_get($rs, 'origin_price'));?>"/>
</td>
</tr>

<tr>
<td><?php elang('Price')?></td>
<td>
<input name="price" type="text" value="<?php ehtml(arr_get($rs, 'price'));?>"/>
</td>
</tr>

<tr>
<td><?php elang('Content')?></td>
<td><textarea cols="88" rows="20" name="content"><?php ehtml(arr_get($rs, 'content', '<div class="intro"><p>content here</p></div>'));?></textarea></td>
</tr>


<?php if(p('goods_modify')){?>
<tr>
<td align="center" colspan="2">
<input class="btn" type="button" value="<?php elang('Submit')?>"<?php if(!isset($rs['id'])){echo ' data-need-refresh="1"';};?>/>
</td>
</tr>
<?php }?>
</table>
</form>


<script>
lml.loadJs('<?php echo WEB_APP_PATH.'admin/js/lmledit_mall?t='.DEFAULT_LANG.filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/lmledit_mall.js');?>', function(){
	lmledit();
});
lml.loadJs('<?php echo WEB_APP_PATH.'admin/js/mall?t='.DEFAULT_LANG.filemtime(DEFAULT_THEME_PATH.C_GROUP.'/admin/js/mall.js');?>', function(){
	goods_init();
});
</script>
