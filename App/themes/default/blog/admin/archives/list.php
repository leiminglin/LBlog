<div class="line">

<?php if(p('archives_add')){?>
<span>
<a href="javascript:void(0)" data-action="lblog_admin_archives_post_page"><?php elang('Post')?></a>
</span>
<?php }?>

<?php if(p('archives_read_post')){?>
<span>
<input type="text" placeholder=" <?php elang('ID')?>" style="width:40px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="edit_specified_archives"><?php elang('Edit')?></a>
</span>
<?php }?>


</div>


<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Cat')?></th>
<th><?php elang('Title')?></th>
<th><?php elang('Author')?></th>
<th><?php elang('IsActive')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php
$temp = q('blog_cat')->getAll();
$temp = arr2mapping($temp, 'id', 'name');
foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml(arr_get($temp, $v['catid']));?></td>
<td><?php ehtml($v['title']);?></td>
<td><?php ehtml($v['nickname']);?></td>
<td><?php echo $v['is_active'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td>
<?php if(p('archives_read_post')){?>
<a href="javascript:void(0)" data-action="lblog_admin_archives_post_page" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_archives_list_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
