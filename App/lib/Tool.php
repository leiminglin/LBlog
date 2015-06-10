<?php
class Tool{
	
	public static function notFoundPage(){
		LmlUtils::_404();
		include DEFAULT_THEME_PATH.(defined('C_GROUP') ? C_GROUP.'/' : '').'@common/404.php';
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
			return 1;
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
		if( $arr[1] < time() ){
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
			$now = time();
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
		原文链接 : <a href="http://'.SITE_DOMAIN.$path.'">
		http://'.SITE_DOMAIN.$path.'</a>
		 &nbsp;来自 : <a href="http://'.SITE_DOMAIN.'/">'.SITE_NAME.'</a>
		';
	}
}