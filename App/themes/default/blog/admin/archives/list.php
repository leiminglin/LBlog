<div id="result">
<table>
<tr>
<th>ID</th>
<th>Title</th>
<th>CreatedTime</th>
<th>Author</th>
<th>IsActive</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['title'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td><?php echo $v['nickname'];?></td>
<td><?php echo $v['is_active'];?></td>
</tr>
<?php }?>
</table>
</div>