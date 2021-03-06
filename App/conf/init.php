<?php

//define('ADMIN_FORCE', true);

$start_time = time();
$start_microtime = microtime();
$GLOBALS['start_time'] = time();
$GLOBALS['start_microtime'] = $start_microtime;
define("APP_DOMAIN", arr_get($_SERVER, 'HTTP_HOST'));

$lastRouter = array('last');

$domain = array(
	APP_DOMAIN => array(
		'blog' => array(
			'/^(?:\/index\.php)?\/p\/([1-9][\d]*)/i'=>array(
				'param'=>array('pid'),
				'm'=>'index'
			)
		)
	)
);

defined('DEFAULT_THEME_NAME')||define('DEFAULT_THEME_NAME', get_theme());
defined('LANG_ZH_CN')||define('LANG_ZH_CN', 'zh_CN');
defined('LANG_EN_US')||define('LANG_EN_US', 'en_US');
defined('DEFAULT_LANG')||define('DEFAULT_LANG', get_lang());
defined('ADMIN_ACCOUNT_ID')||define('ADMIN_ACCOUNT_ID', 1);
defined('ADMIN_ROLE_ID')||define('ADMIN_ROLE_ID', 1);

$basecofig = require './App/conf/baseconfig.php';

if(($timezone = arr_get($basecofig, 'timezone')) !== ''){
	define('TIMEZONE', $timezone);
}


/**
 *
 * &theme=default&switch_theme_once
 *
 * @return string
 */
function get_theme() {

	$themes = array('mobile', 'default', 'new');
	if(preg_match('/^(?:\/index\.php)?\/admin/', arr_get($_SERVER, 'REQUEST_URI'))){
		$themes = array('mobile', 'default');
	}
	if( isset($_GET['theme']) && in_array($_GET['theme'], $themes ) ) {
		isset($_GET['switch_theme_once']) || setcookie('theme', $_GET['theme'], 0, '/');
		return $_GET['theme'];
	}

	if( isset($_COOKIE['theme']) && in_array($_COOKIE['theme'], $themes) ){
		return $_COOKIE['theme'];
	}

	$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	if( preg_match('/windows|playstation|ipad|ucweb/i', $user_agent ) ) {
		return 'default';
	}

	if( preg_match('/android|iphone\s*os|mobile\s*safari|symbian|iemobile|series40/i', $user_agent ) ) {
		return 'mobile';
	}

	return 'default';
}

function get_lang(){

	$langs = array(LANG_EN_US, LANG_ZH_CN);
	if( isset($_GET['lang']) && in_array($_GET['lang'], $langs ) ) {
		isset($_GET['switch_lang_once']) || setcookie('lang', $_GET['lang'], 0, '/');
		return $_GET['lang'];
	}

	if( isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $langs) ){
		return $_COOKIE['lang'];
	}

	$http_accept_language = arr_get($_SERVER, 'HTTP_ACCEPT_LANGUAGE', '');
	if(!$http_accept_language){
		return LANG_EN_US;
	}
	$arr = explode(';', $http_accept_language);
	foreach($arr as $k=>$v){
		if(preg_match('/zh/i', $v)){
			return LANG_ZH_CN;
		}elseif(preg_match('/en/i', $v)){
			return LANG_EN_US;
		}
	}
	return LANG_EN_US;
}


/**
 * last router
 */
function last(){
	$rs = q('page')->getAll();
	foreach ($rs as $k=>$v){
		if($v['uri_regexp'] && preg_match($v['uri_regexp'], LML_REQUEST_URI)){
			return r(template_interpreter($v['content']));
		}
	}
	Tool::notFoundPage();
}


/**
 * is session started
 */
function is_session_started()
{
	if ( php_sapi_name() !== 'cli' ) {
		if ( version_compare(phpversion(), '5.4.0', '>=') ) {
			return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
		} else {
			return session_id() === '' ? FALSE : TRUE;
		}
	}
	return FALSE;
}

function db($config=array()){
	if($config){
		$dbconfig = $config;
	}elseif(isset($GLOBALS['dbconfig'])){
		$dbconfig = $GLOBALS['dbconfig'];
	}else{
		return false;
	}
	if (extension_loaded('pdo_mysql') && extension_loaded('PDO')) {
		return MysqlPdoEnhance::getInstance($dbconfig);
	}
	return Mysql::getInstance($dbconfig);
}

function route_match($regexp){
	$matches = array();
	preg_match('/^(?:\/index\.php)?\/'.C_MODULE.'\/'.C_ACTION.'\/?'.$regexp.'*/i', LML_REQUEST_URI, $matches);
	return $matches;
}

function arr_get($arr, $k, $r=''){
	if($k === '' || !$arr){
		return $r;
	}
	return isset($arr[$k]) ? $arr[$k] : $r;
}

function tag_a($text, $func){
	return '<a href="javascript:void(0)" onclick="'.$func.'">'.$text.'</a>';
}

function lang($token, $data=array()){
	static $lang = array();
	if($data){
		$lang = array_merge($lang, $data);
	}
	return isset($lang[$token]) ? $lang[$token] : $token;
}

function elang($t){
	echo htmlspecialchars(lang($t), ENT_QUOTES);
}

function arr2mapping($arr, $f, $m=''){
	$retval = array();
	foreach ($arr as $k=>$v){
		if(isset($v[$f])){
			$retval[$v[$f]] = arr_get($v, $m, $v);
		}
	}
	return $retval;
}

function generate_passwd($passwd, $salt=''){
	return md5(md5($passwd.$salt));
}

function p($k, $d=array()){
	static $p=array();
	if($d){
		$p = array_merge($p, $d);
	}else{
		return isset($p[$k]) ? true : false;
	}
}

function q($a){
	static $q = array();
	if(arr_get($q,$a)){
		return $q[$a];
	}
	return $q[$a] = new ModelQ($a);
}

function ehtml($v){
	echo htmlspecialchars($v);
}

function arr_get_index($a, $i=0){
	$ret = array();
	foreach ($a as $v){
		$ret[] = isset($v[$i]) ? $v[$i] : '';
	}
	return $ret;
}

function r($p, $d=array()){
	extract($d, EXTR_OVERWRITE);
	return eval('?>'.$p);
}

function s($name, $data=null){
	static $store = array();
	if(is_array($data)){
		if(!isset($store[$name])){
			$store[$name] = array();
		}
		$store[$name] = array_merge($store[$name], $data);
	}elseif(!empty($data)){
		return arr_get($store[$name], $data);
	}else{
		return arr_get($store, $name, array());
	}
}

function template_interpreter($o, $title=''){
	$matches = null;
	preg_match_all('/<LBLOG(a|article|image)\s[\s\S]*?\/?>/i', $o, $matches, PREG_OFFSET_CAPTURE);
	
	if( isset($matches[0][0][1]) ){
		$str = '';
		$pos = 0;
		foreach($matches[0] as $k => $v){
			$str .= substr($o, $pos, $v[1]-$pos);
			$tag_str = $v[0];
			$matches_id = null;
			preg_match('/id="(\d+)"/i', $tag_str, $matches_id);
			if(!isset($matches_id[1])){
				return;
			}
			$id = $matches_id[1];
			switch ($matches[1][$k][0]){
				case 'a':
					$article = q('blog_archives')->getOne('title', "id=$id and is_active='Y'");
					if(!$article){
						continue;
					}
					$article_url = q('blog_archives_url')->getOne('url', "aid=$id");
					$url = arr_get($article_url, 'url');
					$str .= '<a href="'.Tool::getArticleUrl($id, $url).'" title="'.$article['title'].'">'.$article['title'].'</a>';
					break;
				case 'article':
					break;
				case 'image':
					$image = q('file_image')->find($id);
					if(!$image){
						continue;
					}
					$str .= '<img src="'.WEB_APP_PATH.'file/image/'.$id.'?'.$image['hash']
					.'" alt="'.$title.'" title="'.$title.'" width="'.$image['width'].'" height="'.$image['height'].'" />';
					
					break;
			}
			$pos = $v[1] + strlen($v[0]);
		}
		$str .= substr($o, $pos);
		return $str;
	}
	return $o;
}

function is_ssl(){
	if(isset($_SERVER['HTTPS'])){
		$https = arr_get($_SERVER, 'HTTPS');
		if($https === 1 || $https === 'on'){
			return true;
		}
		if(arr_get($_SERVER, 'SERVER_PORT')){
			return true;
		}
	}
	return false;
}

function upload_file($file, $r='image')
{
	$status = array();
	if (!$file) {
		return 1;
	}
	if ($file['error']) {
		return 2;
	} else if (!file_exists($file['tmp_name'])) {
		return 3;
	} else if (!is_uploaded_file($file['tmp_name'])) {
		return 4;
	}
	$ext=strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

	$hash = md5(file_get_contents($file['tmp_name']));
	$file_name = $hash.'.'.$ext;
	$path = 'master/'.date('Y/m/d').'/';
	$store_path = APP_PATH.'repository/'.$r.'/'.$path;
	if(!file_exists($store_path)){
		LmlUtils::mkdirDeep($store_path);
	}
	move_uploaded_file($file['tmp_name'], $store_path.$file_name);
	$status['hash'] = $hash;
	$status['path'] = $path.$file_name;
	$status['type'] = $file['type'];
	$status['size'] = $file['size'];
	$status['origin_name'] = $file['name'];
	$status['createtime'] = $GLOBALS['start_time'];
	return $status;
}

function upload_image($file)
{
	$ext=strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	if(!in_array($ext, array('png', 'jpg', 'jpeg', 'gif', 'bmp'))){
		return 5;
	}
	$status = upload_file($file, 'image');
	if(!is_array($status)){
		return $status;
	}
	$filename = APP_PATH.'repository/image/'.$status['path'];
	$source_info = getimagesize($filename);
	$status['width'] = $source_info[0];
	$status['height'] = $source_info[1];
	return $status;
}

function image_wh($w, $h, $rw=640, $rh=2000){
	if($w/$h > 1){
		if($w > $rw){
			$rate = $w/$rw;
			return array(
				'w' => $rw,
				'h' => round($h/$rate)
			);
		}
	}else{
		if($h > $rh){
			$rate = $h/$rh;
			return array(
				'w' => round($w/$rate),
				'h' => $rh
			);
		}
	}
	return array(
		'w' => $w,
		'h' => $h,
	);
}

function imagecropper($source_path, $width=640)
{
	$source_info   = getimagesize($source_path);
	$source_width  = $source_info[0];
	$source_height = $source_info[1];
	$source_mime   = $source_info['mime'];
	$source_ratio  = $source_height / $source_width;
	$source_x = 0;
	$source_y = 0;
	if ($source_width > $width)
	{
		$target_width = $width;
		$target_height = round($width * $source_height / $source_width);
	}else{
		return false;
	}

	switch ($source_mime)
	{
		case 'image/gif':
			$source_image = imagecreatefromgif($source_path);
			
// 			$image = new Imagick('old.gif');
// 			$image = $image->coalesceImages();
// 			foreach ($image as $frame) {
// 				$frame->thumbnailImage($target_width, $target_height);
// 			}
// 			$image = $image->optimizeImageLayers();
// 			$image->writeImages($source_path, true);
// 			return file_get_contents($source_path);
			
			break;
		case 'image/jpeg':
			$source_image = imagecreatefromjpeg($source_path);
			break;
		case 'image/png':
			$source_image = imagecreatefrompng($source_path);
			imagesavealpha($source_image, true);
			break;
		default:
			return false;
			break;
	}
	$target_image = imagecreatetruecolor($target_width, $target_height);
	imagealphablending($target_image, false);
	imagesavealpha($target_image, true);
	imagecopyresampled($target_image, $source_image, 0, 0, 0, 0, $target_width, $target_height, $source_width, $source_height);

	ob_start();
	switch ($source_mime)
	{
		case 'image/gif':
			imagegif($target_image);
			break;
		case 'image/jpeg':
			imagejpeg($target_image);
			break;
		case 'image/png':
			imagepng($target_image);
			break;
		default:
			imagejpeg($target_image);
			break;
	}
	return ob_get_clean();
}

function use_time(){
	$t = microtime();
	list($m, $s) = explode(' ', $GLOBALS['start_microtime']);
	list($m2, $s2) = explode(' ', $t);
	return number_format( ($s2.'.'.substr($m2, 2)) - ($s.'.'.substr($m, 2)), 6);
}
