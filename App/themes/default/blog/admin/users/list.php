

<table>
<tr>
<th>ID</th>
<th>Email</th>
<th>NickName</th>
<th>Source</th>
<th>CreateTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['email'];?></td>
<td><?php echo $v['nickname'];?></td>
<td><?php echo $v['source'];?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
<td>
<a href="javascript:void(0)" data-action="" data-id="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_users_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
