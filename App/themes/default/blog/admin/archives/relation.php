<div class="line">
<span>
<input type="text" placeholder="id id" style="width:60px;border:1px solid #edeff2;"/>
<a href="javascript:void(0)" data-action="lblog_admin_set_relation_archives">Set Relation</a>
</span>
</div>


<table>
<tr>
<th>Aid</th>
<th>Relation_Aid</th>
<th>CreatedTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['aid'];?></td>
<td><?php echo $v['relation_aid'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['addtime']);?></td>
<td>
<a href="javascript:void(0)" data-action="lblog_admin_archives_relation_remove" data-id="<?php echo $v['aid'].' '.$v['relation_aid'];?>">Remove</a>
</td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_archives_relation_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>