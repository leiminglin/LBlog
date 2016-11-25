<?php
abstract class Model{
	public $dbconfig;
	public $db;
	public $dbPrefix;
	
	public $table;

	public function __construct(){
		$this->dbconfig = &$GLOBALS['dbconfig'];
		$this->db = db($this->dbconfig);
		$this->dbPrefix = $this->dbconfig['dbprefix'];
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
		//$sql = "SELECT COUNT(1) C FROM {$this->table}";
		$rs = $this->db->getOne($this->table, 'COUNT(1) C');
		return isset($rs['C']) ? $rs['C'] : 0;
	}
	
	public function add($arr){
		return $this->db->insert($this->table, $arr);
	}
	
	public function update($arr, $where='', $params=array()){
		return $this->db->update($this->table, $arr, $where, $params);
	}
	
	public function find($id){
		return $this->db->getOne($this->table, '*', 'id=?', array((int)$id));
	}

	public function getAll(){
		return $this->db->select($this->table);
	}

	public function del($where='', $params=array()){
		return $this->db->delete($this->table, $where, $params);
	}

	public function select($fields='*', $where_tail='', $params=array()){
		return $this->db->select($this->table, $fields, $where_tail, $params);
	}

	public function getLastId(){
		return $this->db->getLastId();
	}

	public function query($sql, $params=array()){
		return $this->db->query($sql, $params);
	}
	
	public function getOne($fields, $where_tail='', $params=array()){
		return $this->db->getOne($this->table, $fields, $where_tail, $params);
	}
}
