<div class="line">

<?php if(p('goods_add')){?>
<span>
<a href="javascript:void(0)" data-action="lblog_admin_goods_post_page"><?php elang('Post')?></a>
</span>
<?php }?>

<?php if(p('goods_read_post')){?>
<span>
<input type="text" placeholder=" <?php elang('ID')?>" style="width:40px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="edit_specified_goods"><?php elang('Edit')?></a>
</span>
<?php }?>


</div>


<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Title')?></th>
<th><?php elang('Status')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php ehtml($v['title']);?></td>
<td><?php echo $v['status']?'Y':'N';?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td>
<?php if(p('goods_read_post')){?>
<a href="javascript:void(0)" data-action="lblog_admin_goods_post_page" data-id="<?php echo $v['id'];?>"><?php elang('Edit')?></a>
<?php }?>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_goods_list_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
