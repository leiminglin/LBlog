<div class="line">
<span>
<a href="javascript:void(0)" data-action="lblog_admin_archives_post_page">发布</a>
</span>
<span>
<input type="text" placeholder=" id" style="width:40px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="edit_specified_archives">Edit</a>
</span>
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
<a href="javascript:void(0)" data-action="lblog_admin_archives_post_page" data-id="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_archives_list_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
