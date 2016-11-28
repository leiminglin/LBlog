<table>
<tr>
<th><?php elang('ID')?></th>
<th><?php elang('Domain')?></th>
<th><?php elang('URI')?></th>
<th><?php elang('RemoteAddr')?></th>
<th><?php elang('Referrer')?></th>
<th><?php elang('CreatedTime')?></th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['http_host'];?></td>
<td><?php ehtml($v['request_uri']);?></td>
<td><?php echo $v['remote_addr'];?></td>
<td><?php ehtml($v['http_referer']);?></td>
<td><?php echo date('Y-m-d H:i:s', $v['createtime']);?></td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_statistics_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>
