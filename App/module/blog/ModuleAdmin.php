<?php
class ModuleAdmin extends LmlBlog{
	
	private $mArchives;
	public $conditions = array(
		'postarticle' => 'checkPermission',
		'editarticle' => 'checkPermission',
		'backData' => 'checkPermission',

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
						if(($id = $m->add($_POST)) == true){
							$this->assign('save_status', '保存成功！');
							$rs = $m->find($id);
							$this->assign('rs', $rs);
							$this->display('', '/edit.php');
						}
					}else{
						$id = $matches[1];
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
				setcookie(LBLOGUSS, Tool::getCookieValue($userid, $expire_time), $expire_time, '/', APP_DOMAIN, false, true);
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
		$qq_config_file = APP_PATH.'third/qqconnect2.1/API/comm/inc.php';
		$weibo_config_file = APP_PATH.'third/sinaweibov2/config.php';
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
					$qq_config_contents = file_get_contents($qq_config_file);
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
					file_put_contents($qq_config_file, $qq_config_contents);
				}elseif($type == 'openid_weibo'){
					$weibo_appkey = addslashes($_POST['WEIBO_CONFIG_APPKEY']);
					$weibo_secretkey = addslashes($_POST['WEIBO_CONFIG_SECRETKEY']);
					$weibo_callback = addslashes($_POST['WEIBO_CONFIG_CALLBACK']);
					$weibo_config_contents = file_get_contents($weibo_config_file);
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
					// "WB_AKEY", ''
					$weibo_config_contents = preg_replace('/"WB_AKEY",\s\'[^\']*\'/', '"WB_AKEY", \''.$weibo_appkey.'\'', $weibo_config_contents);
					$weibo_config_contents = preg_replace('/"WB_SKEY",\s\'[^\']*\'/', '"WB_SKEY", \''.$weibo_secretkey.'\'', $weibo_config_contents);
					$weibo_config_contents = preg_replace('/"WB_CALLBACK_URL",\s\'[^\']*\'/', '"WB_CALLBACK_URL", \''.$weibo_callback.'\'', $weibo_config_contents);
					file_put_contents($weibo_config_file, $weibo_config_contents);
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
					echo '<img src="'.WEB_PATH.'file/image/'.$insert_id.'" width="'.$image_wh['w'].'" height="'.$image_wh['h'].'"/>';
					return;
				}
				break;
			case '';
				$site = array();
				$site['site_name'] = $mConfig->getConfig('SITE_NAME');
				$site['site_keywords'] = $mConfig->getConfig('SITE_KEYWORDS');
				$site['site_description'] = $mConfig->getConfig('SITE_DESCRIPTION');
				$login_uri = $mConfig->getConfig('LOGIN_PAGE_URI');
				$site['login_page_uri'] = $login_uri ? $login_uri : 'login';
				$site['javascript_code'] = $mConfig->getConfig('JAVASCRIPT_CODE');
				
				$qq_inc = file($qq_config_file);
				$qq_config = json_decode($qq_inc[1]);
				$site['qq_config_appid'] = $qq_config->appid;
				$site['qq_config_appkey'] = $qq_config->appkey;
				$site['qq_config_callback'] = $qq_config->callback;
				
				$weibo_config = file($weibo_config_file);
				// define("WB_AKEY", '');
				preg_match('/define\("WB_AKEY",\s\'(.*)\'\);/', $weibo_config[1], $matches_temp);
				$site['weibo_config_appkey'] = arr_get($matches_temp, 1);
				// define("WB_SKEY", '');
				preg_match('/define\("WB_SKEY",\s\'(.*)\'\);/', $weibo_config[2], $matches_temp);
				$site['weibo_config_secretkey'] = arr_get($matches_temp, 1);
				// define("WB_CALLBACK_URL", 'http://{your_domain}/user/oauthweibo');
				preg_match('/define\("WB_CALLBACK_URL",\s\'(.*)\'\);/', $weibo_config[3], $matches_temp);
				$site['weibo_config_callback'] = arr_get($matches_temp, 1);
				
				$baseconfig = require APP_PATH.'conf/baseconfig.php';
				$site['timezone'] = $baseconfig['timezone'];
				
				$site['logo_url'] = WEB_PATH.'static/resource/lbloglogo100.png';
				$site['logo_width'] = 100;
				$site['logo_height'] = 100;
				$logo_image_id = $mConfig->getConfig('LOGO_IMG_ID');
				if ($logo_image_id) {
					$site['logo_url'] = WEB_PATH.'file/image/'.$logo_image_id;
					$image = q('file_image')->find($logo_image_id);
					$image_wh = image_wh($image['width'], $image['height']);
					$site['logo_width'] = $image_wh['w'];
					$site['logo_height'] = $image_wh['h'];
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
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				if (!isset($matches[1])) {
					if($m->add($_POST['name'])){
						echo 'Add Successfully!';
					}else{
						echo 'Add Failed!';
					}
				}else{
					$id = $matches[1];
					if($m->update()){
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
