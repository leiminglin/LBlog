<?php
class Statistic{
	
	public static function start(){
		require APP_PATH.'conf/dbconfig.php';
		require APP_PATH.'conf/siteconfig.php';
		
		if($dbconfig){
			$GLOBALS['dbconfig'] = $dbconfig;
			$mStatistic = new ModelStatistic();
			$mStatistic->save();
			
			ini_set('session.cookie_domain', APP_DOMAIN);
			if ( is_session_started() === FALSE ) {
				$handler = new DbSession();
				if ( version_compare(phpversion(), '5.4.0', '>=') ) {
					session_register_shutdown();
					session_set_save_handler($handler, true);
				} else {
					register_shutdown_function('session_write_close');
					session_set_save_handler(
						array($handler, 'open'),
						array($handler, 'close'),
						array($handler, 'read'),
						array($handler, 'write'),
						array($handler, 'destroy'),
						array($handler, 'gc')
					);
				}
				session_start();
			}
			
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