<?php
class ModelQ extends Model{

	public $table_name = '';

	public function __construct($name){
		$this->table_name = $name;
		parent::__construct();
	}
	
	public function updateOrAdd($arr, $condition){
		$wheres = array();
		if($condition){
			$condition = (array)$condition;
			foreach ($condition as $k => $v){
				$wheres[] = $k.'=?';
			}
		}
		$where = implode(' AND ', $wheres);
		$params = array_values($condition);
		$rs = $this->select('COUNT(1) C', $where, $params);
		if(isset($rs[0]) && arr_get($rs[0], 'C')>0){
			return $this->update($arr, $where, $params);
		}
		return $this->add($arr);
	}
	
	public function isExists($arr){
		$wheres = array();
		foreach ($arr as $k => $v) {
			$wheres[] = $k.'=?';
		}
		$rs = $this->getOne('COUNT(1) C', implode(' AND ', $wheres), array_values($arr));
		if ($rs['C'] > 0){
			return true;
		}
		return false;
	}
	
	public function notExists($arr){
		return $this->isExists($arr) ? false : true;
	}
}
