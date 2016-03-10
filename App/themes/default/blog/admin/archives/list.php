<div class="line">
<a href="javascript:void(0)" id="lblog_admin_archives_post_a">发布</a>
</div>


<table>
<tr>
<th>ID</th>
<th>Title</th>
<th>Author</th>
<th>IsActive</th>
<th>CreatedTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['title'];?></td>
<td><?php echo $v['nickname'];?></td>
<td><?php echo $v['is_active'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td>
<a href="javascript:void(0)" id="lblog_admin_archives_edit_a" data="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>
<?php
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
