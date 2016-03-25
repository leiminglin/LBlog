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
		if( defined('C_GROUP') ){
			$d .= C_GROUP.$s;
		}
		if($t){
			$arr = explode('/', $t, 2);
			if(count($arr) == 1){
				array_unshift($arr, C_MODULE);
			}
			$this->fetch($d.$arr[0].$s.$arr[1].$suffix);
		}else{
			$this->fetch($d.C_MODULE.$s.C_ACTION.$suffix);
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
}
