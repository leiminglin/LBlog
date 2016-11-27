<?php 
function showPage(){
	$pid = 1;
	$pcount = 16;
	
	$matches_get = array();
	preg_match('/^(?:\/index\.php)?\/'.C_MODULE.'\/?(\d+)?(?:\/list)?\/?(\d+)?.*/i', LML_REQUEST_URI, $matches_get);
	
	if(!isset($matches_get[1])){
		header('Location: /cat/1');
		return;
	}
	$cat_id = $matches_get[1];
	
	$mMallGoods = q('mall_goods');
	$mMallCat = q('mall_cat');
	$mMallGoodsCat = q('mall_goods_cat');
	
	$counts = count($mMallGoodsCat->select('1','good_cat_id='.$cat_id));
	$page = new Paging($counts, $pid, $pcount);
	$page_count = $page->getPageCount();
	
	if (isset($matches_get[2])) {
		$pid = $matches_get[2];
	}else{
		$pid = $page_count;
	}
	
	$begin = $counts - $pcount * $pid > 0 ? $counts - $pcount * $pid : 0;
	$items = $mMallGoodsCat->select('*','good_cat_id=? and status=1 order by updatetime desc limit '.$begin.', '.$pcount, array($cat_id));
	
	if($pid > $page_count && $pid>0){
		header('Location: /cat/'.$cat_id.'/list/'.$page_count);
		return;
	}
	
	$good_ids = array_filter(arr_get_index($items, 'good_id'));
	$items = array();
	if($good_ids){
		$items = $mMallGoods->select('*', 'id in ('.implode(',', $good_ids).')');
		pageCallback::$good_ids = $good_ids;
		pageCallback::$items = $items;
		usort($items, array('pageCallback', 'callback'));
	}
	
	$pid_display = $page_count + 1 - $pid;
	$page_display = new Paging($counts, $pid_display, $pcount);
	$page_path = 'cat/'.$cat_id.'/list/';
	r_file(THEME_PATH.C_GROUP.'/index/index.php', array(
		'items' => $items,
		'pid' => $pid_display,
		'page' => $page_display,
		'page_path' => $page_path,
	));
}

showPage();

class pageCallback {
	public static $good_ids;
	
	public static $items;
	
	public static function callback($a, $b){
		return self::getIndex($a) < self::getIndex($b) ? -1 : 1;
	}
	
	public static function getIndex($a){
		foreach (self::$good_ids as $k => $v){
			if($a['id'] == $v){
				return $k;
			}
		}
	}
}
?>