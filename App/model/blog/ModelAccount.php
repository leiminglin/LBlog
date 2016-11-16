<?php
class ModelAccount extends Model{

	public $table_name = 'blog_account';

	public function checkIsAdmin($userid){
		//$sql = "SELECT * FROM {$this->dbPrefix}blog_account WHERE userid='".$userid."'";
		$rs = $this->db->getOne($this->dbPrefix.'blog_account', '*', 'userid=?', array($userid));
		if(isset($rs['roleid']) && $rs['roleid']){
			return true;
		}
		return false;
	}
	
	public function addAccount($uid, $rid){
		if(!$this->checkExists($uid)){
			return $this->db->insert($this->table, array(
					'userid' => $uid,
					'roleid' => $rid,
			));
		}else{
			return $this->db->update($this->table, array('roleid' => $rid), 
					'userid=:userid', array('userid'=>$uid));
		}
	}
	
	public function checkExists($uid){
		$rs = $this->db->select($this->table, '*', 'userid=?', array($uid));
		if(count($rs) > 0){
			return true;
		}
		return false;
	}
}