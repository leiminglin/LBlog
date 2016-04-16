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
					$qq_appid = $_POST['QQ_CONFIG_APPID'];
					$qq_appkey = $_POST['QQ_CONFIG_APPKEY'];
					$qq_callback = $_POST['QQ_CONFIG_CALLBACK'];
					$qq_config_contents = file_get_contents($qq_config_file);
					// "appid":"","appkey":"","callback":
					$qq_config_contents = preg_replace('/"appid":"[^"]*"/', '"appid":"'.$qq_appid.'"', $qq_config_contents);
					$qq_config_contents = preg_replace('/"appkey":"[^"]*"/', '"appkey":"'.$qq_appkey.'"', $qq_config_contents);
					$qq_config_contents = preg_replace('/"callback":"[^"]*"/', '"callback":"'.$qq_callback.'"', $qq_config_contents);
					file_put_contents($qq_config_file, $qq_config_contents);
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
				$permissionids = $_POST['permissionids'];
				
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
