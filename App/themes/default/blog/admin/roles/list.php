<div class="line">
<span>
<input type="text" placeholder=" role name" style="width:80px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="lblog_admin_roles_post">Add</a>
</span>
</div>


<table>
<tr>
<th>ID</th>
<th>RoleName</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['role_name'];?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_roles_edit" data-id="<?php echo $v['id'];?>">Edit</a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_roles_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
