<form action="<?php echo WEB_APP_PATH?>admin/archives/save" method="post" onsubmit="return get_save_archives(this);">
<table>
<tr>
<td>Title：</td>
<td><input name="title" type="text"/></td>
</tr>
<tr>
<td>Catid：</td>
<td><input name="catid" type="text" value="1"/></td>
</tr>
<tr>
<td>Userid：</td>
<td><input name="userid" type="text" value="1"/></td>
</tr>
<tr>
<td>IsActive：</td>
<td>
<input name="is_active" type="radio" value="Y" id="active_Y" checked/><label for="active_Y">Yes</label>
<input name="is_active" type="radio" value="N" id="active_N"/><label for="active_N">No</label>
</td>
</tr>
<tr>
<td>Url：</td>
<td>
<input name="url" type="text" value=""/>
</td>
</tr>
<tr>
<td>Content：</td>
<td><textarea cols="100" rows="15" name="content"></textarea></td>
</tr>
<tr>
<td align="center" colspan="2"><input class="btn" type="submit" value="Submit"/></td>
</tr>
</table>
</form>

