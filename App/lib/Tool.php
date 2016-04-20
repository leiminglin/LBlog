<?php
class Tool{

	public static function notFoundPage(){
		LmlUtils::_404();
		$f = DEFAULT_THEME_PATH.(defined('C_GROUP') ? C_GROUP.'/' : '').'@common/404.php';
		if(file_exists($f)){
			include $f;
		}
	}

	public static function getCDNUrl($filename){
		return WEB_PATH.'static/resource/'.$filename;
	}

	public static function htmlspecialcharsDeep($v){
		if(is_array($v)){
			foreach ($v as $a=>$b){
				$v[$a] = self::htmlspecialcharsDeep($b);
			}
		}else{
			return htmlspecialchars($v);
		}
		return $v;
	}


	public static function getCookieValue($v, $e){
		return $v.'_'.$e.'_'.sha1($v.$e.LBLOGSALT);
	}

	public static function checkCookie($v=''){
		if(defined('ADMIN_FORCE') && ADMIN_FORCE){
			return ADMIN_ACCOUNT_ID;
		}
		if(!$v){
			$v = isset($_COOKIE[LBLOGUSS])?$_COOKIE[LBLOGUSS]:'';
			if(!$v){
				return false;
			}
		}
		$arr = explode('_', $v);
		if(count($arr) != 3){
			return false;
		}
		if( $arr[1] < $GLOBALS['start_time'] ){
			return false;
		}
		if(sha1($arr[0].$arr[1].LBLOGSALT) == $arr[2]){
			return $arr[0];
		}
		return false;
	}

	public static function getUserNickName(){
		if( ($userid = self::checkCookie())==true ){
			$m = new ModelUser();
			$rs = $m->getUserNickName($userid);
			return isset($rs[0]['nickname'])?$rs[0]['nickname']:false;
		}
		return false;
	}

	public static function convertTimeToWords($t){
		static $now, $day, $week, $month, $year;
		if(!$now){
			$now = $GLOBALS['start_time'];
			$day = 86400;
			$week = $day * 7;
			$month = $day * 30;
			$year = $day * 365;
		}
		$str = '';
		$sec = $now-$t;
		if( $sec < $day ){
			if($sec > 3600){
				$str .= floor($sec/3600).'小时前';
			}elseif($sec > 300){
				$str .= floor($sec/60).'分钟前';
			}else{
				$str .= '刚刚';
			}
			return $str;
		}elseif( $sec > $year ){
			$str .= floor($sec/$year)."年前";
		}elseif( $sec > $month ){
			$str .= floor($sec/$month)."月前";
		}elseif( $sec > $week ){
			$str .= floor($sec/$week)."周前";
		}elseif( $sec > $day ){
			$str .= floor($sec/$day)."天前";
		}
		return $str.' '.date("H:i", $t);
	}

	public static function getArticleUrl($id, $name = ''){
		return WEB_APP_PATH.'archives/'.$id.($name ? '/'.$name : '');
	}

	public static function getArrayFieldList($array, $field){
		$list = array();
		foreach ($array as $v){
			if(isset($v[$field])){
				$list[] = $v[$field];
			}
		}
		return $list;
	}

	public static function getOriginLinks($path){
		return '
		原文链接 : <a href="http://'.APP_DOMAIN.$path.'">
		http://'.APP_DOMAIN.$path.'</a>
		 &nbsp;来自 : <a href="http://'.APP_DOMAIN.'/">'.SITE_NAME.'</a>
		';
	}
	
	public static function status($c){
		static $s = array(
			// Informational
			100 => 'Continue',
			101 => 'Switching Protocols',
			// Success
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			// Redirection
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Moved Temporarily ', // 1.1
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			// 306 is deprecated but reserved
			307 => 'Temporary Redirect',
			// Client Error
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			// Server Error
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			509 => 'Bandwidth Limit Exceeded',
		);
		if(isset($s[$c]) && !headers_sent()){
			header('HTTP/1.1 '.$c.' '.$s[$c]);
			header('Status:'.$c.' '.$s[$c]);
		}
	}
}
