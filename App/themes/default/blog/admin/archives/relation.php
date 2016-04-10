<div class="line">
<span>
<input type="text" placeholder=" <?php elang('ID')?> <?php elang('ID')?>" style="width:70px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="lblog_admin_set_relation_archives"><?php elang('Set to related')?></a>
</span>
</div>


<table>
<tr>
<th><?php elang('Article')?><?php elang('ID')?></th>
<th><?php elang('Relation')?><?php elang('Article')?><?php elang('ID')?></th>
<th><?php elang('CreatedTime')?></th>
<th><?php elang('Action')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['aid'];?></td>
<td><?php echo $v['relation_aid'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['addtime']);?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_archives_relation_remove" data-id="<?php echo $v['aid'].' '.$v['relation_aid'];?>"><?php elang('Remove')?></a>
<input type="hidden" value="<?php echo $v['aid'].' '.$v['relation_aid'];?>"/>
<a href="javascript:void(0)" data-action="lblog_admin_set_relation_archives" class="hidden"><?php elang('Revert')?></a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_archives_relation_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>