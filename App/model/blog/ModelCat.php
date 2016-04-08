<?php
class ModelCat extends Model{
	
	public function getCats($offset = 0, $limit = 10){
		$offset = (int)$offset;
		$limit = (int)$limit;
		$sql = "SELECT * FROM {$this->dbPrefix}blog_cat order by id desc limit $offset, $limit";
		return $this->db->query($sql);
	}
	
	public function getCount(){
		$sql = "SELECT COUNT(1) C FROM {$this->dbPrefix}blog_cat";
		$rs = $this->db->getOne($sql);
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
		$sql = "select COUNT(1) C from {$this->dbPrefix}blog_cat where name=?";
		$rs = $this->db->getOne($sql, array($name));
		return isset($rs['C']) && $rs['C'] > 0 ? true : false;
	}
	
	public function checkCatExistsById($id){
		$sql = "select COUNT(1) C from {$this->dbPrefix}blog_cat where id=?";
		$rs = $this->db->getOne($sql, array($id));
		return isset($rs['C']) && $rs['C'] > 0 ? true : false;
	}
	
	public function checkCatExistsByIdName($id, $name){
		$sql = "select COUNT(1) C from {$this->dbPrefix}blog_cat where id!=? and name=?";
		$rs = $this->db->getOne($sql, array($id, $name));
		return isset($rs['C']) && $rs['C'] > 0 ? true : false;
	}
}
