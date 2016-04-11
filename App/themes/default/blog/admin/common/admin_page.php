<?php 
if( isset($page) && ($count = $page->getPageCount()) > 1 && isset($data_action) && isset($pid) ){
?>
<style>
.page{
	line-height:30px;
	margin:25px 0px;
	font-family:Microsoft Yahei;
}
.page a{
	display:inline-block;
	text-decoration:none;
	border:1px solid #eee;
	color:#666;
	font-weight:bold;
	margin-left:-1px;
	padding:0 5px;
	float:left;
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
<a href="javascript:void(0)" data-action="<?php echo $data_action?>" data-id="<?php echo $page->getPrev();?>" class="word leftradius"><?php elang('Previous page')?></a>
<?php }else{?>
<a href="javascript:void(0)" class="gray word leftradius"><?php elang('Previous page')?></a>
<?php }?>
<?php
foreach ($pids as $t){
	if($pid == $t){?>
<a href="javascript:void(0)" class="current"><?php echo $t?></a>
<?php }else{?>
<a href="javascript:void(0)" data-action="<?php echo $data_action?>" data-id="<?php echo $t?>"><?php echo $t?></a>
<?php }}
if( $page->hasNext() ){
?>
<a href="javascript:void(0)" data-action="<?php echo $data_action?>" data-id="<?php echo $page->getNext()?>" class="word rightradius"><?php elang('Next page')?></a>
<?php }else{?>
<a href="javascript:void(0)" class="gray word rightradius"><?php elang('Next page')?></a>
<?php }?>
</p>
<?php }?>