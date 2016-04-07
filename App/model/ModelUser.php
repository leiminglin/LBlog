<?php
class ModelUser extends Model{

	public $table_name = 'user';

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
	
	public function checkEmailAndPasswd($email, $passwd){
		$rs = $this->db->select($this->dbPrefix.'user', '*', 'email=?', array($email));
		if(count($rs) == 1 && md5(md5($passwd)) == $rs[0]['passwd']){
			return $rs[0]['id'];
		}
		return false;
	}

	public function getUsers($offset = 0, $limit = 10){
		$offset = (int)$offset;
		$limit = (int)$limit;
		$sql = "SELECT * FROM {$this->dbPrefix}user order by id desc limit $offset, $limit";
		return $this->db->query($sql);
	}
	
	public function getCount(){
		$sql = "SELECT COUNT(1) C FROM {$this->dbPrefix}user";
		$rs = $this->db->getOne($sql);
		return isset($rs['C']) ? $rs['C'] : 0;
	}
	
	public function register($email, $passwd){
		if(!$this->checkEmailExists($email)){
			$this->db->insert($this->table, array(
				'email' => $email,
				'passwd' => generate_passwd($passwd),
				'nickname' => 'lblog_'.substr($email, 0, 4),
				'createtime' => time(),
			));
			return $this->db->getLastId();
		}
		return false;
	}
	
	public function checkEmailExists($email){
		$rs = $this->db->select($this->table, 'id', 'email=?', array($email));
		if(count($rs) > 0){
			return true;
		}
		return false;
	}

}
