<?php
class ModuleAdmin extends LmlBlog{
	
	private $mArchives;
	public $conditions = array(
		'postarticle' => 'checkPermission',
		'editarticle' => 'checkPermission',
		'bakData' => 'checkPermission',

		'addrelationarticle' => 'checkPermission',
		'removerelationarticle' => 'checkPermission',

		'archives' => 'checkPermission',
		'cats' => 'checkPermission',
		'comments' => 'checkPermission',
		'statistics' => 'checkPermission',
		'settings' => 'checkPermission',
		'users' => 'checkPermission',
		'roles' => 'checkPermission',
		'permissions' => 'checkPermission',
		'sessions' => 'checkPermission',
		'accounts' => 'checkPermission',
		'pages' => 'checkPermission',
		'images' => 'checkPermission',
		'js' => 'checkPermission',
	);
	
	public function __construct(){
		$this->mArchives = new ModelArchives();
		$rs = q('lang_'.DEFAULT_LANG)->getAll();
		$lang = array();
		foreach ($rs as $k => $v) {
			$lang[$v['token']] = $v['content'];
		}
		lang('', $lang);
	}
	
	public function __call($name, $arg){
		$mConfig = new ModelConfig();
		$login_uri = $mConfig->getConfig('LOGIN_PAGE_URI');
		if(!$login_uri){
			$login_uri = 'login';
		}
		if($name == $login_uri){
			return $this->login($login_uri);
		}
		
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1);
		//var_dump(C_ACTION, C_GROUP, C_MODULE, $matches, $action);exit;
		
		$qmap = array(
			'comments' => 'blog_comment',
			'sessions' => 'session',
			'accounts' => 'blog_account',
			'pages' => 'page',
			'goods' => 'mall_goods',
		);
		
		if(isset($qmap[C_ACTION])){
			$m = q($qmap[C_ACTION]);
			switch ($action){
				case 'list':
					$pid = 1;
					$matches = route_match('[\w]+\/(\d+)');
					if (isset($matches[1]) && $matches[1] > 1) {
						$pid = $matches[1];
					}
					$rs = $m->getList(10*($pid-1), 10, false);
					$count = $m->getCount();
					$page = new Paging($count, $pid, 10);
					$this->assign('rs', $rs);
					$this->assign('page', $page);
					$this->assign('pid', $pid);
					$this->display('', '/list.php');
					break;
				case 'post':
					$matches = route_match('[\w]+\/(\d+)');
					if (isset($matches[1])) {
						$rs = $m->find($matches[1]);
						$this->assign('rs', $rs);
					}
					$this->display('', '/edit.php');
					break;
				case 'save':
					$matches = route_match('[\w]+\/(\d+)');
					if (!isset($matches[1])) {
						if(!isset($_POST['createtime']) || !$_POST['createtime']){
							$_POST['createtime'] = $GLOBALS['start_time'];
						}
						if($m->add($_POST)){
							$this->assign('save_status', '保存成功！');
							$rs = $m->find($m->getLastId());
							$this->assign('rs', $rs);
							$this->display('', '/edit.php');
						}
					}else{
						$id = $matches[1];
						if(arr_get($_POST, 'updatetime')){
							$_POST['updatetime']=$GLOBALS['start_time'];
						}
						if($m->update($_POST, "id=$id")){
							$this->assign('save_status', '保存成功！');
						}else{
							$this->assign('save_status', '内容未改变！');
						}
					}
					break;
			}
			return;
		}

		return parent::__call($name, $arg);
	}
	
	public function index(){
		if($this->hasPermission()){
			$this->display();
		}else{
			header("Location:".WEB_PATH);
		}
	}
	
	private function login($uri='login'){
		$this->assign('login_page_uri', $uri);
		if($_POST){
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			$mUser = new ModelUser();
			if( ($userid = $mUser->checkEmailAndPasswd($email, $passwd)) == true ){
				$expire_time = $GLOBALS['start_time']+86400*30;
				setcookie(LBLOGASS, Tool::getCookieValue($userid, $expire_time, LBLOGASALT), $expire_time, '/', LBLOG_SERVER_NAME, false, true);
				$arrsql = array(
					'userid'=>$userid,
					'from'=>null,
					'createtime'=>$GLOBALS['start_time'],
				);
				$mUser->addLoginLog($arrsql);
				header("Location:".WEB_APP_PATH."admin");
			}else{
				$this->assign('save_status', '登录失败：用户名或密码错误！');
				$this->display('admin/@login');
			}
		}elseif($this->hasPermission()){
			header("Location:".WEB_APP_PATH.'admin');
		}else{
			$this->display('admin/@login');
		}
	}
	
	public function logout(){
		setcookie(LBLOGASS, '', 0, '/', LBLOG_SERVER_NAME);
		Tool::status(302);
		header('Location:http://'.APP_DOMAIN);
	}
	
	public function postarticle(){
		$userid = Tool::checkCookie();
		if( isset($_GET['id']) && $_GET['id'] ){
			return $this->editarticle($_GET['id']);
		}
		if( $_POST ){
			if($this->mArchives->addArticle($_POST)){
				$this->assign('save_status', '保存成功！');
			}else{
				$this->assign('save_status', '保存失败！');
			}
		}
		$this->display();
	}
	
	private function editarticle($id){
		if($_POST){
			if($this->mArchives->modifyArticle($_POST, $id)){
				$this->assign('save_status', '保存成功！');
			}else{
				// $this->assign('save_status', '保存失败！');
			}
		}
		$article = $this->mArchives->getArticleById($id, '');
		$this->assign('article', $article);
		$this->display('editarticle');
	}
	
	private function getRelationArticleIds(&$aid, &$aid2){
		$relation_ids = isset($_REQUEST['relation_ids'])?$_REQUEST['relation_ids']:'';
		if(!$relation_ids){
			echo 'no relation ids';
			exit;
		}
		$matches = '';
		preg_match('/([\d]+)\s+(\d+)/', $relation_ids, $matches);
		
		if( !isset($matches[1]) || !isset($matches[2]) ){
			echo 'relation ids is not correct';
			exit;
		}
		
		$aid = $matches[1];
		$aid2 = $matches[2];
		
		if( $aid == $aid2 ){
			echo 'article id can not be equal';
			exit;
		}
		
		$mArchives = new ModelArchives();
		if( !$mArchives->checkArchivesIdExists($aid) || !$mArchives->checkArchivesIdExists($aid2) ){
			echo 'article id is not invalid';
			exit;
		}
	}
	
	public function addrelationarticle(){
		
		$aid = '';
		$aid2 = '';
		
		$this->getRelationArticleIds($aid, $aid2);
		
		$mRelation = new ModelArchivesRelation();
		if( $mRelation->addRelation($aid, $aid2) ){
			echo 'add ('.$aid.' '.$aid2.') relation success';
		}else{
			echo '('.$aid.' '.$aid2.') relation already exists';
		}
		
	}
	
	public function removerelationarticle(){
		$aid = '';
		$aid2 = '';
		
		$this->getRelationArticleIds($aid, $aid2);
		
		$mRelation = new ModelArchivesRelation();
		if( $mRelation->removeRelation($aid, $aid2) ){
			echo 'remove ('.$aid.' '.$aid2.') relation success';
		}else{
			echo '('.$aid.' '.$aid2.') relation not exists';
		}
		
	}
	
	public function bakData(){
		return;
		$c = 0;
		$dbconfig = $GLOBALS['dbconfig'];
		$db = Mysql::getInstance($dbconfig);
		$start = $_GET['start'];
		echo 'backdata';
		file_put_contents(APP_PATH.'bak_statistic.sql', '');
		while( $c < 10 ){
			$begin = $c * 1000;
			$sql = "select * from lblog_statistic where id > $start order by id asc limit $begin, 1000";
			$rs = $db->query($sql);
			
			$str = "\n".'INSERT INTO `lblog_statistic` VALUES (';
			for ($i=0, $j=count($rs); $i<$j; $i++) {
				if( $i>0 ){
					$str = rtrim($str, ',');
					$str.='),(';
				}
				foreach ($rs[$i] as $v){
					$str .= "'".mysql_real_escape_string($v)."',";
				}
			}
			$str = rtrim($str, ',');
			$str .= ");";
			
			file_put_contents(APP_PATH.'bak_statistic.sql', $str, FILE_APPEND);
			
			sleep(1);
			$c++;
		}
	}
	
	public function archives(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'list');
		switch ($action){
			case 'list':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $this->mArchives->getArticles(10*($pid-1), 10, false);
				$count = $this->mArchives->getCount(false);
				$page = new Paging($count, $pid, 10);
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'post':
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1])) {
					$article = $this->mArchives->getArticleById($matches[1], 0);
					$this->assign('article', $article);
				}
				$this->display('', '/edit.php');
				break;
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				if (!isset($matches[1])) {
					if(($article_id = $this->mArchives->addArticle($_POST)) == true){
						$this->assign('save_status', '保存成功！');
						$article = $this->mArchives->getArticleById($article_id, 0);
						$this->assign('article', $article);
						$this->display('', '/edit.php');
					}
				}else{
					$article_id = $matches[1];
					if($this->mArchives->modifyArticle($_POST, $article_id)){
						$this->assign('save_status', '保存成功！');
					}else{
						$this->assign('save_status', '内容未改变！');
					}
				}
				break;
			case 'relation':
				$matches = route_match('relation\/([a-zA-Z]+)');
				
				if (isset($matches[1]) && $matches[1]) {
					if($matches[1] == 'remove'){
						return $this->removerelationarticle();
					}elseif($matches[1] == 'set'){
						return $this->addrelationarticle();
					}
				} else {
					$mRelations = new ModelArchivesRelation();
					$pid = 1;
					$matches = route_match('[\w]+\/(\d+)');
					if (isset($matches[1]) && $matches[1] > 1) {
						$pid = $matches[1];
					}
					$rs = $mRelations->getAll(10*($pid-1), 10);
					$count = $mRelations->getCount();
					$page = new Paging($count, $pid, 10);
					$this->assign('rs', $rs);
					$this->assign('page', $page);
					$this->assign('pid', $pid);
					$this->display('', '/relation.php');
				}
				break;
		}
	}
	
	public function cats(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'list');
		$mCat = new ModelCat();
		switch ($action){
			case 'list':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $mCat->getCats(10*($pid-1), 10);
				$count = $mCat->getCount();
				$page = new Paging($count, $pid, 10);
				
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				if (!isset($matches[1])) {
					if($mCat->addCat($_POST['name'])){
						echo 'Add Successfully!';
					}else{
						echo 'Add Failed!';
					}
				}else{
					$id = $matches[1];
					if($mCat->modifyCat($id, $_POST['name'])){
						echo 'Modify Successfully!';
					}else{
						echo 'Modify Failed!';
					}
				}
				
				break;
		}
	}
	
	public function statistics(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'list');
		$mStatistic = new ModelStatistic();
		switch ($action){
			case 'list':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $mStatistic->getList(10*($pid-1), 10);
				$count = $mStatistic->getCount();
				$page = new Paging($count, $pid, 10);
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
		}
	}
	
	public function settings() {
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1);
		$mConfig = new ModelConfig();
		$base_config_file = APP_PATH.'conf/baseconfig.php';
		switch ($action){
			case 'save';
				$matches_save = route_match('save\/([\w]+)');
				$type = arr_get($matches_save, 1);
				if(in_array($type, array('seo', 'jscode'))){
					foreach ($_POST as $k=>$v){
						$mConfig->updateOrAdd($k, $v);
					}
				}elseif($type == 'security'){
					if(!preg_match('/^login/', $_POST['LOGIN_PAGE_URI'])){
						echo 'must begin with login';
						return;
					}
					if(!preg_match('/^[a-zA-Z0-9_]+$/i', $_POST['LOGIN_PAGE_URI'])){
						echo 'must be [a-zA-Z0-9_] format';
						return;
					}
					$mConfig->updateOrAdd('LOGIN_PAGE_URI', $_POST['LOGIN_PAGE_URI']);
				}elseif($type == 'openid_qq'){
					$qq_appid = addslashes($_POST['QQ_CONFIG_APPID']);
					$qq_appkey = addslashes($_POST['QQ_CONFIG_APPKEY']);
					$qq_callback = addslashes($_POST['QQ_CONFIG_CALLBACK']);
					$qq_config_contents = s('config', 'OPENID_QQ_CONFIG');
					if(
						strpos('x'.$qq_appid, "'") > 0 || 
						strpos('x'.$qq_appkey, "'") > 0 ||
						strpos('x'.$qq_callback, "'") > 0 ||
						strpos('x'.$qq_appid, '"') > 0 ||
						strpos('x'.$qq_appkey, '"') > 0 ||
						strpos('x'.$qq_callback, '"') > 0
							
					){
						ehtml('It contains illegal characters " and \'');
						return;
					}
					// "appid":"","appkey":"","callback":
					$qq_config_contents = preg_replace('/"appid":"[^"]*"/', '"appid":"'.$qq_appid.'"', $qq_config_contents);
					$qq_config_contents = preg_replace('/"appkey":"[^"]*"/', '"appkey":"'.$qq_appkey.'"', $qq_config_contents);
					$qq_config_contents = preg_replace('/"callback":"[^"]*"/', '"callback":"'.$qq_callback.'"', $qq_config_contents);
					$mConfig->updateOrAdd('OPENID_QQ_CONFIG', $qq_config_contents);
				}elseif($type == 'openid_weibo'){
					$weibo_appkey = addslashes($_POST['WEIBO_CONFIG_APPKEY']);
					$weibo_secretkey = addslashes($_POST['WEIBO_CONFIG_SECRETKEY']);
					$weibo_callback = addslashes($_POST['WEIBO_CONFIG_CALLBACK']);
					if(
						strpos('x'.$weibo_appkey, "'") > 0 ||
						strpos('x'.$weibo_secretkey, "'") > 0 ||
						strpos('x'.$weibo_callback,"'") > 0 ||
						strpos('x'.$weibo_appkey, '"') > 0 ||
						strpos('x'.$weibo_secretkey, '"') > 0 ||
						strpos('x'.$weibo_callback, '"') > 0
					){
						ehtml('It contains illegal characters " and \'');
						return;
					}
					
					$mConfig->updateOrAdd('OPENID_WEIBO_CONFIG_APPKEY', $weibo_appkey);
					$mConfig->updateOrAdd('OPENID_WEIBO_CONFIG_SECRETKEY', $weibo_secretkey);
					$mConfig->updateOrAdd('OPENID_WEIBO_CONFIG_CALLBACK', $weibo_callback);
				}elseif($type == 'timezone'){
					$timezone = addslashes($_POST['TIMEZONE']);
					if(
						strpos('x'.$timezone, "'") > 0 ||
						strpos('x'.$timezone, '"') > 0
					
					){
						ehtml('It contains illegal characters " and \'');
						return;
					}
					$baseconfig = require APP_PATH.'conf/baseconfig.php';
					$baseconfig['timezone'] = $timezone;
					$str = '<?php return $baseconfig='.var_export($baseconfig, true).';';
					file_put_contents($base_config_file, $str);
				}elseif($type == 'logo'){
					$file = arr_get($_FILES, 'LOGO');
					if(!arr_get($file, 'tmp_name') || $file['size'] == 0){
						return;
					}
					$hash = md5(file_get_contents($file['tmp_name']));
					
					$q_image = q('file_image');
					
					if($q_image->isExists(array('hash'=>$hash))){
						$image = $q_image->getOne('*', 'hash=?', array($hash));
						$mConfig->updateOrAdd('LOGO_IMG_ID', $image['id']);
						$image_wh = image_wh($image['width'], $image['height']);
						echo '<img src="'.WEB_PATH.'file/image/'.$image['id'].'" width="'.$image_wh['w'].'" height="'.$image_wh['h'].'"/>';
						return ;
					}
					
					$file_name = $hash.'.'.strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
					$repository_image_path = 'master/'.date('Y/m/d').'/';
					$store_path = APP_PATH.'repository/image/'.$repository_image_path;
					if(!file_exists($store_path)){
						LmlUtils::mkdirDeep($store_path);
					}
					move_uploaded_file($file['tmp_name'], $store_path.$file_name);
					
					$source_info = getimagesize($store_path.$file_name);
					$source_width = $source_info[0];
					$source_height = $source_info[1];
					
					$q_image->add(array(
						'hash' => $hash,
						'path' => $repository_image_path.$file_name,
						'type' => $file['type'],
						'size' => $file['size'],
						'width' => $source_width,
						'height' => $source_height,
						'origin_name' => $file['name'],
						'createtime' => $GLOBALS['start_time'],
					));
					$insert_id = $q_image->getLastId();
					$mConfig->updateOrAdd('LOGO_IMG_ID', $insert_id);
					$image = $q_image->find($insert_id);
					$image_wh = image_wh($image['width'], $image['height']);
					echo '<img src="'.WEB_PATH.'file/image/'.$insert_id.'?'.$image['hash']
						.'" width="'.$image_wh['w'].'" height="'.$image_wh['h'].'"/>';
					return;
				}
				break;
			case '';
				$site = array();
				$site['site_name'] = s('config', 'SITE_NAME');
				$site['site_keywords'] = s('config', 'SITE_KEYWORDS');
				$site['site_description'] = s('config', 'SITE_DESCRIPTION');
				$login_uri = s('config', 'LOGIN_PAGE_URI');
				$site['login_page_uri'] = $login_uri ? $login_uri : 'login';
				$site['javascript_code'] = s('config', 'JAVASCRIPT_CODE');
				
				$qq_config = json_decode(s('config', 'OPENID_QQ_CONFIG'));
				$site['qq_config_appid'] = $qq_config->appid;
				$site['qq_config_appkey'] = $qq_config->appkey;
				$site['qq_config_callback'] = $qq_config->callback;
				
				$site['weibo_config_appkey'] = s('config', 'OPENID_WEIBO_CONFIG_APPKEY');
				$site['weibo_config_secretkey'] = s('config', 'OPENID_WEIBO_CONFIG_SECRETKEY');
				$site['weibo_config_callback'] = s('config', 'OPENID_WEIBO_CONFIG_CALLBACK');
				
				$baseconfig = require APP_PATH.'conf/baseconfig.php';
				$site['timezone'] = $baseconfig['timezone'];
				
				$site['logo_url'] = WEB_PATH.'static/resource/lbloglogo100.png';
				$site['logo_width'] = 100;
				$site['logo_height'] = 100;
				$logo_image_id = $mConfig->getConfig('LOGO_IMG_ID');
				if ($logo_image_id) {
					$image = q('file_image')->find($logo_image_id);
					if($image){
						$image_wh = image_wh($image['width'], $image['height']);
						$site['logo_width'] = $image_wh['w'];
						$site['logo_height'] = $image_wh['h'];
						$site['logo_url'] = WEB_PATH.'file/image/'.$logo_image_id.'?'.$image['hash'];
					}
				}
				
				$this->assign('site', $site);
				$this->display('', '/home.php');
				break;
		}
	}

	public function users(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'list');
		$mUser = new ModelUser();
		switch ($action){
			case 'list';
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$mRole = new ModelRole();
				$mAccount = new ModelAccount();
				$rs = $mUser->getUsers(10*($pid-1), 10);
				$count = $mUser->getCount();
				$page = new Paging($count, $pid, 10);
				$this->assign('rs', $rs);
				$roles = arr2mapping($mRole->getAll(), 'id', 'role_name');
				$this->assign('roles', $roles);
				$accounts = arr2mapping($mAccount->getAll(), 'userid', 'roleid');
				$this->assign('accounts', $accounts);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'set_account':
				$uid = (int)$_POST['userid'];
				$rid = (int)$_POST['roleid'];
				if($uid){
					$mAccount = new ModelAccount();
					$mAccount->addAccount($uid, $rid);
					echo 'Save Successfully!';
				}
				break;
		}
	}

	public function roles(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'list');
		$m = new ModelRole();
		switch ($action){
			case 'list';
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $m->getList(10*($pid-1), 10);
				$count = $m->getCount();
				$page = new Paging($count, $pid, 10);
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				if (!isset($matches[1])) {
					if($m->add(array('role_name'=>$_POST['name']))){
						echo 'Add Successfully!';
					}else{
						echo 'Add Failed!';
					}
				}else{
					$id = $matches[1];
					if($m->update(array('role_name'=>$_POST['name']), "id=$id")){
						echo 'Modify Successfully!';
					}else{
						echo 'Modify Failed!';
					}
				}
				break;
		}
	}
	
	public function permissions(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'list');
		$m = q('blog_permission');
		switch ($action){
			case 'list':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $m->getList(10*($pid-1), 10);
				$count = $m->getCount();
				$page = new Paging($count, $pid, 10);
		
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'post':
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1])) {
					$rs = $m->find($matches[1]);
					$this->assign('rs', $rs);
				}
				$this->display('', '/edit.php');
				break;
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				if (!isset($matches[1])) {
					if($m->add(array(
						'name' => $_POST['name'],
						'uri_regexp' => $_POST['uri_regexp'],
						'description' => $_POST['description'],
						'is_system' => 'N',
						'createtime' => $GLOBALS['start_time'],
					))){
						$rs = $m->find($m->getLastId());
						$this->assign('rs', $rs);
						$this->assign('save_status', '保存成功！');
						$this->display('', '/edit.php');
					}
				}else{
					$id = $matches[1];
					if($m->update(array(
						'name' => $_POST['name'],
						'uri_regexp' => $_POST['uri_regexp'],
						'description' => $_POST['description'],
					), "id=$id")){
						echo 'Modify Successfully!';
					}else{
						echo 'Modify Failed!';
					}
				}
				break;
			case 'setting':
				$matches = route_match('[\w]+\/([\w]+)\/(\d+)');
				if(!isset($matches[1]) || !isset($matches[2])){
					return;
				}
				$type = $matches[1];
				$rs = $m->getAll();
				$this->assign('rs', $rs);

				if($type == 'user'){
					$mu = q('blog_permission_user');
					$rsr = $mu->select('*', 'userid=?', array($matches[2]));
					$this->assign('rsr', arr_get_index($rsr, 'permissionid'));
					$this->assign('id', $matches[2]);
					$this->assign('type', $type);
					$this->display('', '/setting.php');
				}elseif($type == 'role'){
					$mr = q('blog_permission_role');
					$rsr = $mr->select('*', 'roleid=?', array($matches[2]));
					$this->assign('rsr', arr_get_index($rsr, 'permissionid'));
					$this->assign('id', $matches[2]);
					$this->assign('type', $type);
					$this->display('', '/setting.php');
				}
				break;
			case 'setting_save':
				$matches = route_match('[\w]+\/([\w]+)\/(\d+)');
				if(!isset($matches[1]) || !isset($matches[2])){
					return;
				}
				$type = $matches[1];
				$id = $matches[2];
				$permissionids = arr_get($_POST, 'permissionids', array());
				
				if($type == 'user'){
					$mu = q('blog_permission_user');
					$mu->del('userid=?', array($id));
					foreach ($permissionids as $v){
						$mu->add(array(
							'userid' => $id,
							'permissionid' => (int)$v,
							'createtime' => $GLOBALS['start_time'],
						));
					}
				}elseif($type == 'role'){
					$mr = q('blog_permission_role');
					$mr->del('roleid=?', array($id));
					foreach ($permissionids as $v){
						$mr->add(array(
							'roleid' => $id,
							'permissionid' => (int)$v,
							'createtime' => $GLOBALS['start_time'],
						));
					}
				}
				break;
		}
	}
	
	public function images(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1);

		$m = q('file_image');
		switch ($action){
			case 'list':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $m->getList(12*($pid-1), 12, false);
				$count = $m->getCount();
				$page = new Paging($count, $pid, 12);
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'editorList':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $m->getList(12*($pid-1), 12, false);
				$count = $m->getCount();
				$page = new Paging($count, $pid, 12);
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/listEditor.php');
				break;
			case 'post':
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1])) {
					$rs = $m->find($matches[1]);
					$this->assign('rs', $rs);
				}
				$this->display('', '/edit.php');
				break;
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				$is_origin = arr_get($_POST, 'is_origin');
				if (isset($matches[1])) {
					$fid = $matches[1];
					$images = $_FILES['images'];
					$file = array();
					$file['name'] = $images['name'][0];
					$file['type'] = $images['type'][0];
					$file['tmp_name'] = $images['tmp_name'][0];
					$file['error'] = $images['error'][0];
					$file['size'] = $images['size'][0];
					if(!$is_origin){
						$result_co = imagecropper($file['tmp_name']);
						if($result_co){
							file_put_contents($file['tmp_name'], $result_co);
							$file['size'] = filesize($file['tmp_name']);
						}
					}
					$db_image = $m->find($fid);
					$hash = md5(file_get_contents($file['tmp_name']));
					if($m->notExists(array('hash'=>$hash))){
						$status = upload_image($file);
					}else{
						echo '<p>Filename '.$file['name'].' is already uploaded</p>';
						return;
					}
					
					if(file_exists(APP_PATH.'repository/image/'.$db_image['path'])){
						//unlink(APP_PATH.'repository/image/'.$db_image['path']);
						$image_deleted = array(
							'image_id' => $db_image['id'],
							'hash' => $db_image['hash'],
							'path' => $db_image['path'],
							'type' => $db_image['type'],
							'size' => $db_image['size'],
							'origin_name' => $db_image['origin_name'],
							'width' => $db_image['width'],
							'height' => $db_image['height'],
							'image_createtime' => $db_image['createtime'],
							'createtime' => $GLOBALS['start_time'],
						);
						q('file_image_deleted')->add($image_deleted);
					}
					unset($status['createtime']);
					$m->update($status, "id=$fid");
					echo '<p><img src="'.WEB_PATH.'file/image/'.$fid.'?'.$hash
					.'" width="'.$status['width'].'" height="'.$status['height'].'"/></p>';
					return;
				}else{
					//add
					$images=$_FILES['images'];
					$status = array();
					$out_html = '';
					if(is_array($images['name'])){
						foreach ($images['name'] as $k=>$v){
							//"name"]=> ["type"]=> ["tmp_name"]=>  ["error"]=> a} ["size"]=> array(1) 
							$file = array(
								'name' => $v,
								'type' => $images['type'][$k],
								'tmp_name' => $images['tmp_name'][$k],
								'error' => $images['error'][$k],
								'size' => $images['size'][$k],
							);
							
							if(!$is_origin){
								$result_co = imagecropper($file['tmp_name']);
								if($result_co){
									file_put_contents($file['tmp_name'], $result_co);
									$file['size'] = filesize($file['tmp_name']);
								}
							}
							$hash = md5(file_get_contents($file['tmp_name']));
							if($m->notExists(array('hash'=>$hash))){
								$status[$v] = upload_image($file);
							}else{
								$out_html .= '<p>Filename '.$file['name'].' is already uploaded</p>';
							}
						}
					}else{
						$status[$images['name']] = upload_image($images);
					}
					foreach ($status as $k=>$v) {
						if(is_array($v)){
							$m->add($v);
							$status[$k]['id'] = $m->getLastId();
							
							$image_wh = image_wh($v['width'], $v['height']);
							$out_html .= '<p><img src="'.WEB_PATH.'file/image/'.$status[$k]['id'].'?'.$v['hash']
								.'" width="'.$image_wh['w'].'" height="'.$image_wh['h'].'"/></p>';
						}else{
							$out_html .= '<p>Filename '.$v['name'].' is upload failed!</p>';
						}
					}
					echo $out_html;
				}
				break;
		}
		return;
	}

	public function js(){
		$matches = route_match('([\w]+)');
		$action = arr_get($matches, 1, 'common');
		$cache_seconds = 86400*365;
		header('Pragma: none');
		header('Content-Type: text/javascript');
		header('Cache-Control: public, max-age='.$cache_seconds);
		// Sun, 05 Mar 2017 15:02:23 GMT
		header('Expires: '.date('D, d M Y H:i:s e', $GLOBALS['start_time'] + $cache_seconds));
		$this->display('', '/'.$action.'.js');
	}
	
	
	
	
	
}
