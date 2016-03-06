<div id="result">

<div class="line">
<?php echo tag_a('发表文章', 'get_post_archives()');?>
</div>


<table>
<tr>
<th>ID</th>
<th>Title</th>
<th>Author</th>
<th>IsActive</th>
<th>CreatedTime</th>
<th>Action</th>
</tr>
<?php foreach ($rs as $k=>$v){?>
<tr>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['title'];?></td>
<td><?php echo $v['nickname'];?></td>
<td><?php echo $v['is_active'];?></td>
<td><?php echo date("Y-m-d H:i:s", $v['createtime']);?></td>
<td>
<?php echo tag_a('Edit', 'get_edit_archives('.$v['id'].')');?>
</td>
</tr>
<?php }?>
</table>
</div>