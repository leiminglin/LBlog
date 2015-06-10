<?php 
if( isset($page) && ($count = $page->getPageCount()) > 1){
?>
<style>
.page{
	text-align:center;
	height:30px;
	line-height:30px;
	margin:40px 0px;
	font-family:Microsoft Yahei;
}
.page a{
	padding:0 5px;
	height:30px;
	display:inline-block;
	text-decoration:none;
	border:1px solid #eee;
	color:#666;
	font-weight:bold;
	margin-left:-1px;
}
.page a:hover{
	color:#fd703d;
}
.page a.current{
	color:#fd703d;
	text-decoration:none;
}
.page a.gray{
	color:#ccc;
	text-decoration:none;
}
.page a.word{
	font-weight:normal;
}
.page .leftradius{
	border-top-left-radius:5px;
	border-bottom-left-radius:5px;
}
.page .rightradius{
	border-top-right-radius:5px;
	border-bottom-right-radius:5px;
}
</style>
<p class="page">
<?php 
$pids = $page->getPids(9);
if( $page->hasPrev() ){
?>
<a href="<?php echo WEB_APP_PATH.$page_path.($count+1-$page->getPrev())?>" class="word leftradius">上一页</a>
<?php }else{?>
<a href="javascript:void(0)" class="gray word leftradius">上一页</a>
<?php }?>
<?php
foreach ($pids as $t){
	if($pid == $t){?>
<a href="javascript:void(0)" class="current"><?php echo $t?></a>
<?php }else{?>
<a href="<?php echo WEB_APP_PATH.$page_path.($count + 1 - $t)?>"><?php echo $t?></a>
<?php }}
if( $page->hasNext() ){
?>
<a href="<?php echo WEB_APP_PATH.$page_path.($count+1-$page->getNext())?>" class="word rightradius">下一页</a>
<?php }else{?>
<a href="javascript:void(0)" class="gray word rightradius">下一页</a>
<?php }?>
</p>
<?php }?>