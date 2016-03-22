<table>
<tr>
<th>ID</th>
<th>Host</th>
<th>Uri</th>
<th>RemoteAddr</th>
<th>Referrer</th>
<th>Time</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['http_host'];?></td>
<td><?php echo $v['request_uri'];?></td>
<td><?php echo $v['remote_addr'];?></td>
<td><?php echo $v['http_referer'];?></td>
<td><?php echo $v['request_time'];?></td>
</tr>
<?php }?>
</table>
<?php
$data_action = 'lblog_admin_statistics_page';
include DEFAULT_THEME_PATH.C_GROUP.'/admin/common/admin_page.php';
?>