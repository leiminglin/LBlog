

<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('ArticleID')?></th>
<th><?php elang('UserID')?></th>
<th><?php elang('Content')?></th>
<th><?php elang('IsActive')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['aid'];?></td>
<td><?php echo $v['uid'];?></td>
<td><?php echo preg_replace('/<[^>]+>/i', '', $v['content']);?></td>
<td><?php echo $v['is_active'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td>

<?php if(p('comments_read_post')){?>
<a href="javascript:void(0)" data-action="lblog_admin_comments_post_page" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>

</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_comments_list_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
