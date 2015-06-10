<?php
class Statistic{
	
	public static function start(){
		require APP_PATH.'conf/dbconfig.php';
		require APP_PATH.'conf/siteconfig.php';
		$GLOBALS['dbconfig'] = $dbconfig;
		$mStatistic = new ModelStatistic();
		$mStatistic->save();
	}
	
}