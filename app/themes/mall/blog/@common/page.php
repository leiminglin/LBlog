<?php 
if( isset($page) && ($count = $page->getPageCount()) > 1){
?>
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