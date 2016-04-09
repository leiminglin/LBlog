

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>UriRegExp</th>
<th>Description</th>
<th>CreateTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml($v['name']);?></td>
<td><?php ehtml($v['uri_regexp']);?></td>
<td><?php ehtml($v['description']);?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_permissions_edit" data-id="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>

<?php
$data_action = 'lblog_admin_permissions_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>