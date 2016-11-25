<table>
<tr>
<th><?php elang('Session');elang('ID')?></th>
<th><?php elang('ExpiresTime')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo date('Y-m-d H:i:s', $v['expires']);?></td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_sessions_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
