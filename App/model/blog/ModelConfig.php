<?php
class ModelConfig extends Model{
	
	protected $table;
	
	public function __construct(){
		parent::__construct();
		$this->table = $this->dbPrefix.'config';
	}
	
	public function getConfig($name){
		$rs = $this->db->getOne("select data from {$this->table} where name=?", array($name));
		return isset($rs['data']) ? $rs['data'] : '';
	}
	
	public function checkConfigExists($name){
		$rs = $this->db->getOne("select COUNT(1) C from {$this->table} where name=?", array($name));
		return (isset($rs['C']) && $rs['C'] > 0) ? true : false;
	}
	
	public function saveConfig($name, $data){
		return $this->db->insert($this->table, 
				array('name'=>$name, 'data'=>$data));
	}
	
	public function updateConfig($name, $data){
		return $this->db->update($this->table, array('data'=>$data), 'name=:name', array('name'=>$name));
	}
}
