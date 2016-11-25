<div class="line">


<?php if(p('roles_add')){?>
<span>
<input type="text" placeholder=" role name" style="width:80px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="lblog_admin_roles_post"><?php elang('Add')?></a>
</span>
<?php }?>


</div>


<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('RoleName')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml($v['role_name']);?></td>
<td>



<?php if(p('roles_modify')){?>
<a href="javascript:void(0)" data-action="lblog_admin_roles_edit" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>

<?php if($v['id'] != ADMIN_ROLE_ID){?>
	<?php if(p('permissions_role_read')){?>
	<?php if(p('roles_modify')){?> / <?php }?><a href="javascript:void(0)" data-action="lblog_admin_roles_permission" data-id="<?php echo $v['id'];?>"><?php elang('Permission')?></a>
	<?php }?>
<?php }?>




</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_roles_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
