<div class="line">

<?php if(p('pages_add')){?>
<span>
<a href="javascript:void(0)" data-action="lblog_admin_pages_post"><?php elang('Add')?></a>
</span>
<?php }?>

</div>



<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Name')?></th>
<th><?php elang('UriRegExp')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml($v['name']);?></td>
<td><?php ehtml($v['uri_regexp']);?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
<td>



<?php if(p('pages_modify')){?>
<a href="javascript:void(0)" data-action="lblog_admin_pages_post" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>


</td>
</tr>
<?php }?>
</table>

<?php
$data_action = 'lblog_admin_pages_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
