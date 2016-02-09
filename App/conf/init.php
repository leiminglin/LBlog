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



