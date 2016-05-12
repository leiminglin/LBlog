<?php
abstract class LmlBase{
	public $v = array();
	public function __call($name, $arg){
		// TODO handle some unknow method
		Tool::notFoundPage();
	}
	public function assign($k, $v){
		$this->v[$k] = $v;
	}
	public function display($t='', $suffix='.php'){
		$s = DIRECTORY_SEPARATOR;
		$d = DEFAULT_THEME_PATH;
		$g = '';
		if( defined('C_GROUP') ){
			$g = C_GROUP;
			$d .= C_GROUP.$s;
		}
		
		if($t){
			$arr = explode('/', $t, 2);
			if(count($arr) == 1){
				array_unshift($arr, C_MODULE);
			}
			$theme_uri = $arr[0].$s.$arr[1].$suffix;
		}else{
			$theme_uri = C_MODULE.$s.C_ACTION.$suffix;
		}
		
		$f = $d.$theme_uri;
		if (file_exists($f)) {
			$this->fetch($f);
		}else{
			$identifier = DEFAULT_THEME_NAME.'/'.$g.'/'.$theme_uri;
			$db_page = s('page', $identifier);
			
			if($db_page){
				r($db_page, $this->v);
			}else{

			}
		}
	}
	private function fetch($f){
		extract($this->v, EXTR_OVERWRITE);
		include $f;
	}

	public function render($f){
		return include $f;
	}

	public function __construct(){
		
	}
	
	public function hasLogin(){
		if( !($userid = Tool::checkCookie()) ) {
			return false;
		}
		return $userid;
	}
	
	public function checkLogin(){
		if(!$this->hasLogin()){
			Tool::status(401);
			echo json_encode(array('status'=>false, 'msg'=>'请登录！ '));
			return false;
		}
		return true;
	}
}
