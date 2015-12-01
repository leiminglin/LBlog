<?php
class Statistic{
	
	public static function start(){
		require APP_PATH.'conf/dbconfig.php';
		require APP_PATH.'conf/siteconfig.php';
		
		if($dbconfig){
			$GLOBALS['dbconfig'] = $dbconfig;
			$mStatistic = new ModelStatistic();
			$mStatistic->save();
		}else{
			if(LML_REQUEST_URI != '/install'){
				header('HTTP/1.1 301 Moved Permanently');
				header('Status:301 Moved Permanently');
				header('Location: http://'.APP_DOMAIN.'/install');
				exit;
			}
		}
	}
	
}