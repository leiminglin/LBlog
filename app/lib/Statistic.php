<?php
class Statistic{
	
	public static function start(){
		require APP_PATH.'conf/dbconfig.php';
		
		if($dbconfig){
			$GLOBALS['dbconfig'] = $dbconfig;
			$mStatistic = new ModelStatistic();
			$mStatistic->save();
			s('config', arr2mapping(q('config')->getAll(), 'name', 'data'));
			
			// Filter spam requests
			$setting_site_domain = s('config', 'SITE_DOMAIN');
			if ($setting_site_domain && preg_replace('/:(\d+)$/i', '', LBLOG_HTTP_HOST) != preg_replace('/:(\d+)$/i', '', $setting_site_domain)) {
				//Tool::status(301);
				//header('Location: //'.$setting_site_domain.$_SERVER['REQUEST_URI']);
				echo '<html><meta http-equiv="refresh" content="0;url=http://'.$setting_site_domain.'/"></html>';
				lblog_exit();
			}
			
			s('page', arr2mapping(q('page')->getAll(), 'name', 'content'));
			require APP_PATH.'conf/siteconfig.php';
			
			ini_set('session.cookie_domain', LBLOG_SERVER_NAME);
			if ( is_session_started() === FALSE ) {
				$handler = new DbSession();
				if ( version_compare(phpversion(), '5.4.0', '>=') ) {
					$handler = new DbSessionHandler();
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
				session_name('LBLOGSID');
				session_set_cookie_params(0, '/', LBLOG_SERVER_NAME, false, true);
				session_start();
			}
		}else{
			if(LML_REQUEST_URI != '/install'){
				Tool::status(301);
				header('Cache-Control: no-cache');
				header('Location: //'.APP_DOMAIN.'/install');
				lblog_exit();
			}
		}
	}
	
}
