<?php
class LmlBlog extends LmlBase{
	
	public function checkLogin(){
		if(!$this->hasLogin()){
			Tool::status(401);
			echo json_encode(array('status'=>false, 'msg'=>'请登录！'));
			return false;
		}
		return true;
	}
	
	public function checkPermission(){
		if(!$this->hasPermission()){
			Tool::status(401);
			echo json_encode(array('status'=>false, 'msg'=>'请登录！'));
			return false;
		}
		return true;
	}

	public function hasPermission() {
		if( !($userid = $this->hasLogin()) ){
			return false;
		}
		$mAccount = new ModelAccount();
		if( $mAccount->checkIsAdmin($userid) ){
			return true;
		}
		return false;
	}

	public function hasLogin(){
		if( !($userid = Tool::checkCookie()) ) {
			return false;
		}
		return $userid;
	}

}
