
<select class="hidden roles_select">
<option value="0">Please Select</option>
<?php foreach ($roles as $k=>$v){?>
<option value="<?php echo $k?>"><?php echo $v?></option>
<?php }?>
</select>

<table>
<tr>
<th>ID</th>
<th>Email</th>
<th>NickName</th>
<th>Source</th>
<th>Role</th>
<th>CreateTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){
	$role_name = arr_get($roles, arr_get($accounts, $v['id']));
?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['email'];?></td>
<td><?php echo $v['nickname'];?></td>
<td><?php echo $v['source'];?></td>
<td><?php echo $role_name;?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
<td>
<?php if($v['id'] != ADMIN_ACCOUNT_ID){?>
<a href="javascript:void(0)" data-action="lblog_admin_users_edit" data-id="<?php echo $v['id'];?>">Edit</a>
<?php }?>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_users_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
