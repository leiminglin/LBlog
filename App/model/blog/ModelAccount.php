<?php
class ModelAccount extends Model{

	public $table_name = 'blog_account';

	public function checkIsAdmin($userid){
		$sql = "SELECT * FROM {$this->dbPrefix}blog_account WHERE userid='".$userid."'";
		$rs = $this->db->getOne($sql);
		if(isset($rs['roleid']) && $rs['roleid'] == 1){
			return true;
		}
		return false;
	}
}