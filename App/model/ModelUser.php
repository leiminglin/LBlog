<?php
class ModelUser extends Model{
	
	
	public function add($arr){
		return $this->db->insert($this->dbPrefix.'user', $arr);
	}
	
	public function addQq($arr){
		return $this->db->insert($this->dbPrefix.'user_qq', $arr);
	}
	
	public function addWeibo($arr){
		return $this->db->insert($this->dbPrefix.'user_weibo', $arr);
	}
	
	public function addLoginLog($arr){
		return $this->db->insert($this->dbPrefix.'log_login', $arr);
	}
	
	public function checkQqOpenIdExists($openid){
		$sql = "select count(1) C from {$this->dbPrefix}user_qq where openid='{$openid}'";
		$rs = $this->db->query($sql);
		if( $rs[0]['C']>0 ){
			return true;
		}
		return false;
	}
	
	public function getQqUserInfo($openid){
		$sql = "select userid, userinfo from {$this->dbPrefix}user_qq where openid='{$openid}'";
		return $this->db->query($sql);
	}
	
	public function checkWeiboIdExists($openid){
		$sql = "select count(1) C from {$this->dbPrefix}user_weibo where weiboid='{$openid}'";
		$rs = $this->db->query($sql);
		if( $rs[0]['C']>0 ){
			return true;
		}
		return false;
	}
	
	public function getWeiboUserInfo($openid){
		$sql = "select userid, userinfo from {$this->dbPrefix}user_weibo where weiboid='{$openid}'";
		return $this->db->query($sql);
	}
	
	public function getUserNickName($userid){
		$sql = "select nickname from {$this->dbPrefix}user where id='{$userid}'";
		return $this->db->query($sql);
	}
	
	public function checkLogin($email, $passwd){
		$sql = "select * from {$this->dbPrefix}user where email='".mysql_real_escape_string($email)."'";
		$rs = $this->db->query($sql);
		if(count($rs) == 1 && md5(md5($passwd)) == $rs[0]['passwd']){
			return $rs[0]['id'];
		}
		return false;
	}
	
}