<?php 
function showPage(){
	
	$matches_get = array();
	preg_match('/^(?:\/index\.php)?\/'.C_MODULE.'\/?(\d+)*/i', LML_REQUEST_URI, $matches_get);
	
	$id=0;
	if (isset($matches_get[1])) {
		$id = $matches_get[1];
	}
	
	$mMallGoods = q('mall_goods');
	$item = $mMallGoods->select('*','status=1 and id=?', array($id));
	
	if(!$item){
		Tool::status(302);
		header('Location: /');
		return;
	}
	
	r_file(THEME_PATH.C_GROUP.'/item/pages/item.php', array(
		'item' => $item[0],
		'id' => $id,
	));
}

showPage();

?>