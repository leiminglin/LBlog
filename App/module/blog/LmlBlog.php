<?php
class LmlBlog extends LmlBase{

	public function checkPermission(){
		if( !($userid = $this->isAdminLogin()) ){
			Tool::status(401);
			echo json_encode(array('status'=>false, 'msg'=>'请登录！'));
			return false;
		} elseif (!$this->isUserHasPermission($userid)) {
			Tool::status(403);
			echo json_encode(array('status'=>false, 'msg'=>'Access Denied'));
			return false;
		}
		return true;
	}
	
	public function isAdminLogin(){
		if( !($userid = $this->hasLogin()) ){
			return false;
		}
		$mAccount = new ModelAccount();
		if( !$mAccount->checkIsAdmin($userid) ){
			return false;
		}
		return $userid;
	}

	public function hasPermission() {
		if( !($userid = $this->isAdminLogin()) ){
			return false;
		}
		if ( !$this->isUserHasPermission($userid) ) {
			return false;
		}
		return true;
	}
	
	private function isUserHasPermission($userid) {
		$has_permission_ids = array();
		$all_permissions = q('blog_permission')->getAll();
		if ($userid == ADMIN_ACCOUNT_ID) {
			$has_permission_ids = arr_get_index($all_permissions, 'id');
		}else{
			$has_permissions = q('blog_permission_user')->select('permissionid', 'userid=?', array($userid));
			if(count($has_permissions)==0){
				$rs_account = q('blog_account')->select('roleid', 'userid=?', array($userid));
				$roleid = $rs_account[0]['roleid'];
				$has_permissions = q('blog_permission_role')->select('permissionid', 'roleid=?', array($roleid));
			}
			$has_permission_ids = arr_get_index($has_permissions, 'permissionid');
		}
		
		$permission_id = false;
		foreach ($all_permissions as $k => $v) {
			if(preg_match($v['uri_regexp'], LML_REQUEST_URI)) {
				$permission_id = $v['id'];
				break;
			}
		}
		
		if ($permission_id){
			if (!in_array($permission_id, $has_permission_ids)) {
				return false;
			}
		}
		return true;
	}
}
