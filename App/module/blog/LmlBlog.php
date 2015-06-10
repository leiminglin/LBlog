<?php
class LmlBlog extends LmlBase{
	
	public function checkLogin(){
		if( !($userid = Tool::checkCookie()) ) {
			LmlUtils::_404();
			echo json_encode(array('status'=>false, 'msg'=>'请登录！'));
			return false;
		}
		$mAccount = new ModelAccount();
		if($mAccount->checkIsAdmin($userid)){
			return true;
		}
		LmlUtils::_404();
		echo json_encode(array('status'=>false, 'msg'=>'请登录！'));
		return false;
	}
}