<div class="line">
<span>
<input type="text" placeholder=" cat name" style="width:80px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="lblog_admin_cats_post"><?php elang('Add')?></a>
</span>
</div>


<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Name')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml($v['name']);?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_cats_edit" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_cats_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>