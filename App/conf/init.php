<?php

//define('ADMIN_FORCE', true);

$start_time = microtime();
define("APP_DOMAIN", $_SERVER['HTTP_HOST']);
ini_set('session.cookie_domain', APP_DOMAIN);
session_start();

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

