<?php
class ModelCat extends Model{
	
	public function getCats(){
		$sql = "SELECT * FROM {$this->dbPrefix}blog_cat";
		return $this->db->query($sql);
	}
}