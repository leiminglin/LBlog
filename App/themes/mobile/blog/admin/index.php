<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>后台管理 - <?php echo SITE_NAME?></title>
<style>
body{
	font-family:Microsoft Yahei;
	font-size:14px;
	font-color:#333;
}
</style>
</head>
<body>
<a href="<?php echo WEB_APP_PATH?>admin/postarticle" target="_blank">发表文章</a>
<br/>
<hr/>
<br/>
<input type="text" id="article_id" placeholder="输入要编辑的文章ID"/><a href="javascript:void(0)" 
onclick="javascript:var article_id=document.getElementById('article_id').value; if(article_id<=0){return false;} this.href='<?php echo WEB_APP_PATH?>admin/postarticle?id='+article_id;" 
target="_blank">
编辑文章</a>
<br/>
<hr/>
<br/>
<input type="text" id="relation_aid" placeholder="两个相关文章ID空格分开"/>
<br/>
<a href="javascript:void(0)" 
onclick="javascript:var relation_aid=document.getElementById('relation_aid').value; if(relation_aid<=0){return false;} this.href='<?php echo WEB_APP_PATH?>admin/addrelationarticle?relation_ids='+relation_aid;" 
target="_blank">
设为相关文章</a>
<br/>
<a href="javascript:void(0)" 
onclick="javascript:var relation_aid=document.getElementById('relation_aid').value; if(relation_aid<=0){return false;} this.href='<?php echo WEB_APP_PATH?>admin/removerelationarticle?relation_ids='+relation_aid;" 
target="_blank">
取消相关文章</a>

</body>
</html>