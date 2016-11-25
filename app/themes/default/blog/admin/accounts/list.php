<?php 
$user_ids = arr_get_index($rs, 'userid');
$role_ids = arr_get_index($rs, 'roleid');

$users = q('user')->select('*', 'id in ('.implode(',', $user_ids).')');
$roles = q('blog_user_role')->select('*', 'id in ('.implode(',', $role_ids).')');

$users = arr2mapping($users, 'id');
$roles = arr2mapping($roles, 'id');
?>
<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('UserID')?></th>
<th><?php elang('RoleID')?></th>
<th><?php elang('Email')?></th>
<th><?php elang('NickName')?></th>
<th><?php elang('Role')?></th>
<th><?php elang('CreatedTime')?></th>
</tr>
<?php foreach ($rs as $k=>$v){
	$user = arr_get($users, $v['userid']);
	$role = arr_get($roles, $v['roleid']);
?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['userid'];?></td>
<td><?php echo $v['roleid'];?></td>
<td><?php echo arr_get($user, 'email');?></td>
<td><?php echo ehtml(arr_get($user, 'nickname'));?></td>
<td><?php echo ehtml(arr_get($role, 'role_name'));?></td>
<td><?php echo date("Y-m-d H:i:s", arr_get($user, 'createtime'));?></td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_accounts_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
