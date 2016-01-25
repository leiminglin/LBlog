<?php

//define('ADMIN_FORCE', true);

$start_time = microtime();
define("APP_DOMAIN", $_SERVER['HTTP_HOST']);
ini_set('session.cookie_domain', APP_DOMAIN);
session_start();

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

