<?php

//define('ADMIN_FORCE', true);

$start_time = microtime();
define("APP_DOMAIN", $_SERVER['HTTP_HOST']);

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


/**
 *
 * &theme=default&switch_theme_once
 *
 * @return string
 */
function get_theme() {

	$themes = array('mobile', 'default');
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
	}else{
		$dbconfig = $GLOBALS['dbconfig'];
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
	if(!$k || !$arr){
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

function q($a){
	static $q = array();
	if(arr_get($q,$a)){
		return $q[$a];
	}
	return $q[$a] = new ModelQ($a);
}

