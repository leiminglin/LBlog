<?php
class ModelCat extends Model{

	public $table_name = 'blog_cat';

	public function getCats($offset = 0, $limit = 10){
		$offset = (int)$offset;
		$limit = (int)$limit;
		$sql = "SELECT * FROM {$this->dbPrefix}blog_cat order by id asc limit $offset, $limit";
		return $this->db->query($sql);
	}
	
	public function getCount(){
		$rs = $this->db->getOne($this->table, 'COUNT(1) C');
		return isset($rs['C']) ? $rs['C'] : 0;
	}
	
	public function addCat($name){
		if(!$this->checkCatExistsByName($name) && strlen(trim($name)) > 0){
			return $this->db->insert("{$this->dbPrefix}blog_cat", array('name' => $name));
		}
		return false;
	}
	
	public function modifyCat($id, $name){
		if($this->checkCatExistsById($id) && !$this->checkCatExistsByIdName($id, $name) && strlen(trim($name)) > 0){
			return $this->db->update("{$this->dbPrefix}blog_cat", array('name' => $name), 'id=:id', array('id'=>$id));
		}
		return false;
	}
	
	public function checkCatExistsByName($name){
		$rs = $this->db->getOne($this->table, 'COUNT(1) C', 'name=?', array($name));
		return isset($rs['C']) && $rs['C'] > 0 ? true : false;
	}
	
	public function checkCatExistsById($id){
		$rs = $this->db->getOne($this->table, 'COUNT(1) C', 'id=?', array($id));
		return isset($rs['C']) && $rs['C'] > 0 ? true : false;
	}
	
	public function checkCatExistsByIdName($id, $name){
		$rs = $this->db->getOne($this->table, 'COUNT(1) C', 'id!=? and name=?', array($id, $name));
		return isset($rs['C']) && $rs['C'] > 0 ? true : false;
	}
}
