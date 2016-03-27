<?php
abstract class Model{
	public $dbconfig;
	public $db;
	public $dbPrefix;
	
	public $table;

	public function __construct(){
		$dbconfig = $GLOBALS['dbconfig'];
		$this->dbconfig = $dbconfig;
		$this->db = db();
		$this->dbPrefix = $dbconfig['dbprefix'];
		if(property_exists($this, 'table_name')){
			$this->table = $this->dbPrefix.$this->table_name;
		}
	}

	public function getList($offset = 0, $limit = 10){
		$offset = (int)$offset;
		$limit = (int)$limit;
		$sql = "SELECT * FROM {$this->table} order by id desc limit $offset, $limit";
		return $this->db->query($sql);
	}

	public function getCount(){
		$sql = "SELECT COUNT(1) C FROM {$this->table}";
		$rs = $this->db->getOne($sql);
		return isset($rs['C']) ? $rs['C'] : 0;
	}
}
