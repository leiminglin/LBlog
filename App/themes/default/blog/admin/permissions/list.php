<div class="line">
<span>
<a href="javascript:void(0)" data-action="lblog_admin_permissions_post"><?php elang('Add')?></a>
</span>
</div>



<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Name')?></th>
<th><?php elang('UriRegExp')?></th>
<th><?php elang('Description')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml($v['name']);?></td>
<td><?php ehtml($v['uri_regexp']);?></td>
<td><?php elang($v['description']);?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
<td>
<?php if($v['is_system'] === 'N'){?>
	<a href="javascript:void(0)" data-action="lblog_admin_permissions_post" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>
</td>
</tr>
<?php }?>
</table>

<?php
$data_action = 'lblog_admin_permissions_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
