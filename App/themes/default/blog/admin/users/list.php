

<?php if(p('users_role_operate')){?>
<select class="hidden roles_select">
<option value="0"><?php elang('Please select')?></option>
<?php foreach ($roles as $k=>$v){?>
<option value="<?php echo $k?>"><?php ehtml($v)?></option>
<?php }?>
</select>
<?php }?>


<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Email')?></th>
<th><?php elang('NickName')?></th>
<th><?php elang('Source')?></th>
<th><?php elang('Role')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){
	$role_name = arr_get($roles, arr_get($accounts, $v['id']));
?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['email'];?></td>
<td><?php ehtml($v['nickname']);?></td>
<td><?php echo $v['source'];?></td>
<td><?php ehtml($role_name);?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
<td>



<?php if($v['id'] != ADMIN_ACCOUNT_ID){?>

	<?php if(p('users_role_operate')){?>
	<a href="javascript:void(0)" data-action="lblog_admin_users_edit" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
	<?php }?>
	
	<?php if($role_name){?>
		<?php if(p('permissions_user_read')){?>
		<?php if(p('users_role_operate')){?> / <?php }?><a href="javascript:void(0)" data-action="lblog_admin_users_permission" data-id="<?php echo $v['id'];?>"><?php elang('Permission')?></a>
		<?php }?>
	<?php }?>
<?php }?>



</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_users_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
