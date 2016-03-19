<?php
class ModelCat extends Model{
	
	public function getCats($offset = 0, $limit = 10){
		$sql = "SELECT * FROM {$this->dbPrefix}blog_cat order by id desc limit ?, ?";
		return $this->db->query($sql, array($offset, $limit));
	}
	
	public function getCount(){
		$sql = "SELECT COUNT(1) FROM {$this->dbPrefix}blog_cat";
		$rs = $this->db->getOne($sql);
		return isset($rs['C']) ? $rs['C'] : 0;
	}
}