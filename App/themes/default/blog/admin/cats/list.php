<div class="line">
<span>
<a href="javascript:void(0)" data-action="lblog_admin_cats_post_page">发布</a>
</span>
</div>


<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['name'];?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_cats_post_page" data-id="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_cats_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>