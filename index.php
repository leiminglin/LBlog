<?php
//define('ADMIN_FORCE', true);
$start_time = microtime();
define("APP_DOMAIN", 'lblog.may');
ini_set('session.cookie_domain', APP_DOMAIN);
session_start();
function getRemoteLmlPhp(){
	$cache_filename = 'lml.min.php';
	$remotelib = 'http://pro8091d8.pic12.websiteonline.cn/upload/lmlphp-release-2014-08-27-v1.txt';
	if( file_exists( $cache_filename ) ) {
		$cachemtime = filemtime($cache_filename);
		if( $cachemtime + 86400 > time() ){
			require $cache_filename;
			return;
		}
		$header = get_headers($remotelib);
		foreach ($header as $k){
			if( preg_match('/^Last\-Modified:/i', $k) ){
				$lastmtime = strtotime(preg_replace('/^Last\-Modified:/i', '', $k));
				break;
			}
		}
		if( $lastmtime <= $cachemtime ){
			touch($cache_filename);
			require $cache_filename;
			return;
		}
	}
	$code = file_get_contents( $remotelib );
	file_put_contents($cache_filename, $code);
	eval('?>'.$code);
}
// getRemoteLmlPhp();
require 'lml.min.php';

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

define('APP_DIR', './App');
require APP_DIR.'/conf/init.php';

lml()->app()
->attachEvent(array('onRun'=>array('Statistic', 'start')))
->addDomain($domain)
->addLastRouter($lastRouter)
->run(true);

function last(){
	Tool::notFoundPage();
}

