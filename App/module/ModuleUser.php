<?php
class ModuleUser extends LmlBase{



	/**
	 * QQ login callback
	 */
	public function oauth(){
		require_once(APP_PATH."third/qqconnect2.1/API/qqConnectAPI.php");
		$qc = new QC();
		$acs = $qc->qq_callback();
		$oid = $qc->get_openid();
		$mUser = new ModelUser();
		$userid='';
		if($mUser->checkQqOpenIdExists($oid)){
			$userinfo = $mUser->getQqUserInfo($oid);
			$_SESSION['userinfo'] = json_decode($userinfo[0]['userinfo'], true);
			$userid = $userinfo[0]['userid'];
		}else{
			$qc2 = new QC($acs, $oid);
			$arr = $qc2->get_user_info();
			/*
			lml()->fileDebug('access_token:'.$acs.', openid:'.$oid, APP_PATH.'LMLPHP_debug/authqq.txt');
			lml()->fileDebug($arr, APP_PATH.'LMLPHP_debug/authqq.txt');
			*/
			$_SESSION['userinfo'] = $arr;
			$arrsql = array(
				'email'=>$GLOBALS['start_microtime'].'_'.rand(0, 10000),
				'passwd'=>'',
				'nickname'=>$arr['nickname'],
				'source'=>'qq',
				'createtime'=>$GLOBALS['start_time'],
			);
			$mUser->add($arrsql);
			$userid = $mUser->db->getLastId();
			$arrsql = array(
				'userid'=>$userid,
				'openid'=>$oid,
				'accesstoken'=>$acs,
				'userinfo'=>json_encode($arr),
				'createtime'=>$GLOBALS['start_time'],
			);
			$mUser->addQq($arrsql);
		}

		$arrsql = array(
				'userid'=>$userid,
				'from'=>'qq',
				'createtime'=>$GLOBALS['start_time'],
		);
		$mUser->addLoginLog($arrsql);
		$expire_time = $GLOBALS['start_time']+86400*30;
		setcookie(LBLOGUSS, Tool::getCookieValue($userid, $expire_time), $expire_time, '/', APP_DOMAIN, false, true);
		header('HTTP/1.1 302 Moved Temporarily');
		header('Status:302 Moved Temporarily');
		header('Location:'.$_SESSION['backurl']);
	}

	/**
	 * sina weibo login callback
	 */
	public function oauthweibo(){
		include_once( APP_PATH.'third/sinaweibov2/config.php' );
		include_once( APP_PATH.'third/sinaweibov2/saetv2.ex.class.php' );
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$mUser = new ModelUser();
		$userid='';
		if (isset($_REQUEST['code']) || isset($_REQUEST['text']) ){
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken('code', $keys);
			} catch (OAuthException $e) {
				// lml()->fileDebug($e, APP_PATH.'LMLPHP_debug/debug_'.date("Y-m-d").'.txt');
			}
			if ($token) {
				$_SESSION['token'] = $token;
				setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
			}
			$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$ms  = $c->home_timeline();
			$uid_get = $c->get_uid();
			if($mUser->checkWeiboIdExists($uid_get['uid'])){
				$userinfo = $mUser->getWeiboUserInfo($uid_get['uid']);
				$_SESSION['userinfo'] = json_decode($userinfo[0]['userinfo'], true);
				$userid = $userinfo[0]['userid'];
			}else{
				$user_message = $c->show_user_by_id($uid_get['uid']);
				/*
				lml()->fileDebug('WB_AKEY:'.WB_AKEY.',WB_SKEY:'.WB_SKEY.',TOKEN:'.$_SESSION['token']['access_token'],
					APP_PATH.'LMLPHP_debug/authweibo.txt');
				lml()->fileDebug($user_message, APP_PATH.'LMLPHP_debug/authweibo.txt');
				*/
				$user_message['nickname'] = $user_message['screen_name'];
				$_SESSION['userinfo'] = $user_message;
				$arrsql = array(
						'email'=>$GLOBALS['start_microtime'].'_'.rand(0, 10000),
						'passwd'=>'',
						'nickname'=>$user_message['nickname'],
						'source'=>'weibo',
						'createtime'=>$GLOBALS['start_time'],
				);
				$mUser->add($arrsql);
				$userid = $mUser->db->getLastId();
				$arrsql = array(
						'userid'=>$userid,
						'weiboid'=>$uid_get['uid'],
						'accesstoken'=>$_SESSION['token']['access_token'],
						'userinfo'=>json_encode($user_message),
						'createtime'=>$GLOBALS['start_time'],
				);
				$mUser->addWeibo($arrsql);
			}
			$arrsql = array(
					'userid'=>$userid,
					'from'=>'weibo',
					'createtime'=>$GLOBALS['start_time'],
			);
			$mUser->addLoginLog($arrsql);
			$expire_time = $GLOBALS['start_time']+86400*30;
			setcookie(LBLOGUSS, Tool::getCookieValue($userid, $expire_time), $expire_time, '/', APP_DOMAIN, false, true);
			header('HTTP/1.1 302 Moved Temporarily');
			header('Status:302 Moved Temporarily');
			header('Location:'.$_SESSION['backurl']);
		}
	}

	/**
	 * user login
	 * just for qq now
	 */
	public function qqlogin(){
		if( !isset($_GET['backurl']) ){
			return;
		}
		$_SESSION['backurl'] = $_GET['backurl'];
		require_once(APP_PATH."third/qqconnect2.1/API/qqConnectAPI.php");
		$qc = new QC();
		$qc->qq_login(array('callback'=>APP_DOMAIN.WEB_PATH.'user/oauth'));
	}

	/**
	 * user login
	 * just for sina weibo
	 */
	public function weibologin(){
		if( !isset($_GET['backurl']) ){
			return;
		}
		$_SESSION['backurl'] = $_GET['backurl'];
		include_once( APP_PATH.'third/sinaweibov2/config.php' );
		include_once( APP_PATH.'third/sinaweibov2/saetv2.ex.class.php' );
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
		header('HTTP/1.1 302 Moved Temporarily');
		header('Status:302 Moved Temporarily');
		header('Location:'.$code_url);
	}

	public function logout(){
		unset($_SESSION['userinfo']);
		setcookie(LBLOGUSS, '', 0, '/', APP_DOMAIN);
		header('HTTP/1.1 302 Moved Temporarily');
		header('Status:302 Moved Temporarily');
		$referrer = arr_get($_SERVER, 'HTTP_REFERER');
		if($referrer && preg_match('/'.APP_DOMAIN.'$/i', parse_url($referrer, PHP_URL_HOST))){
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}else{
			header('Location:http://'.APP_DOMAIN);
		}
	}
	
	public function register(){
		
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1);
		
		if($action == 'captcha'){
			require APP_PATH.'third/captcha/captcha.php';
			$captcha = new SimpleCaptcha();
			$captcha->session_var = 'captcha_register';
			$captcha->width = 180;
			$captcha->height = 60;
			$captcha->shadowColor = true;
			$captcha->CreateImage();
			lml()->app()->setOneSloc(false);
			return;
		}
		
		if($_POST){
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			$repasswd = $_POST['repasswd'];
			$captcha = $_POST['captcha'];
			
			$is_valid = false;
			if(strlen($passwd)>5 && strlen($email)>5 && $passwd==$repasswd 
					&& preg_match('/[\w\-\.]+@[\w\-\.]+/', $email)
					&& trim(strtolower($captcha)) == $_SESSION['captcha_register']
					){
				$is_valid = true;
			}
			unset($_SESSION['captcha_register']);
			
			if(!$is_valid){
				$this->assign('save_status', '注册失败：请正确填写邮箱且密码长度至少6个字符！');
				$this->display();
				return;
			}
			
			$mUser = new ModelUser();
			if( $is_valid && ($userid=$mUser->register($email, $passwd)) ){
				$expire_time = $GLOBALS['start_time']+86400*30;
				setcookie(LBLOGUSS, Tool::getCookieValue($userid, $expire_time), $expire_time, '/', APP_DOMAIN, false, true);
				header("Location:".WEB_PATH);
			}else{
				$this->assign('save_status', '注册失败：邮箱已经被注册！');
				$this->display();
			}
		}elseif($this->hasLogin()){
			header("Location:".WEB_PATH);
		}else{
			$this->display();
		}
	}
	
	public function login(){
		if($_POST){
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			
			$is_valid = false;
			if(strlen($email)>5 && strlen($passwd)>5){
				$is_valid = true;
			}
			
			$mUser = new ModelUser();
			if( $is_valid && ($userid = $mUser->checkEmailAndPasswd($email, $passwd)) == true ){
				$expire_time = $GLOBALS['start_time']+86400*30;
				setcookie(LBLOGUSS, Tool::getCookieValue($userid, $expire_time), $expire_time, '/', APP_DOMAIN, false, true);
				$arrsql = array(
					'userid'=>$userid,
					'from'=>null,
					'createtime'=>$GLOBALS['start_time'],
				);
				$mUser->addLoginLog($arrsql);
				header("Location:".WEB_PATH);
			}else{
				$this->assign('save_status', '登录失败：用户名或密码错误！');
				$this->display();
			}
		}elseif($this->hasLogin()){
			header("Location:".WEB_PATH);
		}else{
			$this->display();
		}
	}
}
