

<table>
<tr>
<th>ID</th>
<th>Aid</th>
<th>Uid</th>
<th>Content</th>
<th>IsActive</th>
<th>CreatedTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['aid'];?></td>
<td><?php echo $v['uid'];?></td>
<td><?php echo preg_replace('/<[^>]+>/i', '', $v['content']);?></td>
<td><?php echo $v['is_active'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_comments_post_page" data-id="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_comments_list_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>