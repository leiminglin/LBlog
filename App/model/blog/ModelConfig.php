<?php
class ModelConfig extends Model{

	protected $table_name = 'config';

	public function getConfig($name){
		$rs = $this->db->getOne($this->table, 'data', 'name=?', array($name));
		return isset($rs['data']) ? $rs['data'] : '';
	}

	public function checkConfigExists($name){
		$rs = $this->db->getOne($this->table, 'COUNT(1) C', 'name=?', array($name));
		return (isset($rs['C']) && $rs['C'] > 0) ? true : false;
	}

	public function saveConfig($name, $data){
		return $this->db->insert($this->table, 
				array('name'=>$name, 'data'=>$data));
	}

	public function updateConfig($name, $data){
		return $this->db->update($this->table, array('data'=>$data), 'name=:name', array('name'=>$name));
	}
	
	public function updateOrAdd($name, $data){
		if($this->checkConfigExists($name)){
			return $this->updateConfig($name, $data);
		}else{
			return $this->saveConfig($name, $data);
		}
	}
}
