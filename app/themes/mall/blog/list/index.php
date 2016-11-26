<?php 
function listpage(){
	$pid = 1;
	$pcount = 16;
	
	$mMallGoods = q('mall_goods');
	$counts = count($mMallGoods->select('1','status=1'));
	$page = new Paging($counts, $pid, $pcount);
	
	$matches_get = array();
	preg_match('/^(?:\/index\.php)?\/'.C_MODULE.'\/?(\d+)*/i', LML_REQUEST_URI, $matches_get);
	
	$page_count = $page->getPageCount();
	if (isset($matches_get[1])) {
		$pid = $matches_get[1];
	}else{
		$pid = $page_count;
	}
	
	$begin = $counts - $pcount * $pid > 0 ? $counts - $pcount * $pid : 0;
	$items = $mMallGoods->select('*','status=1 order by updatetime desc limit '.$begin.', '.$pcount);
	
	if($pid > $page_count && $pid>0){
		header('Location: /list/'.$page_count);
		return;
	}
	$pid_display = $page_count + 1 - $pid;
	$page_display = new Paging($counts, $pid_display, $pcount);
	$page_path = 'list/';
	r_file(THEME_PATH.C_GROUP.'/index/index.php', array(
		'items' => $items,
		'pid' => $pid_display,
		'page' => $page_display,
		'page_path' => $page_path,
	));
}

listpage();

?>