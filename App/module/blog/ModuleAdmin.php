<?php
class ModuleAdmin extends LmlBlog{
	
	private $mArchives;
	public $conditions = array(
		'postarticle' => 'checkLogin',
		'editarticle' => 'checkLogin',
		'backData' => 'checkLogin',

		'addrelationarticle' => 'checkLogin',
		'removerelationarticle' => 'checkLogin',

		'archives' => 'checkLogin',
		'cats' => 'checkLogin',
		'statistics' => 'checkLogin',
		'settings' => 'checkLogin',
	);
	
	public function __construct(){
		$this->mArchives = new ModelArchives();
	}
	
	public function __call($name, $arg){
		$mConfig = new ModelConfig();
		$login_uri = $mConfig->getConfig('LOGIN_PAGE_URI');
		if($name == $login_uri){
			return $this->login($login_uri);
		}
		return parent::__call($name, $arg);
	}
	
	public function index(){
		if($this->checkLogin()){
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
			if( ($userid = $mUser->checkLogin($email, $passwd)) == true ){
				$expire_time = time()+86400*30;
				setcookie(LBLOGUSS, Tool::getCookieValue($userid, $expire_time), $expire_time, '/', APP_DOMAIN);
				header("Location:/admin");
				exit;
			}else{
				$this->assign('save_status', '登录失败：用户名或密码错误！');
				$this->display('admin/@login');
			}
		}else{
			if($this->checkLogin()){
				header("Location:".WEB_APP_PATH.'admin');
			}else{
				$this->display('admin/@login');
			}
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
		$mCats = new ModelCat();
		switch ($action){
			case 'list':
				$pid = 1;
				$matches = route_match('[\w]+\/(\d+)');
				if (isset($matches[1]) && $matches[1] > 1) {
					$pid = $matches[1];
				}
				$rs = $mCats->getCats(10*($pid-1), 10);
				$count = $mCats->getCount();
				$page = new Paging($count, $pid, 10);
				
				$this->assign('rs', $rs);
				$this->assign('page', $page);
				$this->assign('pid', $pid);
				$this->display('', '/list.php');
				break;
			case 'save':
				$matches = route_match('[\w]+\/(\d+)');
				if (!isset($matches[1])) {
					if($mCats->addCat($_POST['name'])){
						echo 'Add Successfully!';
					}else{
						echo 'Add Failed!';
					}
				}else{
					$id = $matches[1];
					if($mCats->modifyCat($id, $_POST['name'])){
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
		switch ($action){
			case 'save';
				$matches_save = route_match('save\/([\w]+)');
				$type = arr_get($matches_save, 1);
				if($type == 'seo'){
					foreach ($_POST as $k=>$v){
						$mConfig->updateConfig($k, $v);
					}
				}elseif($type == 'security'){
					if($mConfig->checkConfigExists('LOGIN_PAGE_URI')){
						$mConfig->updateConfig('LOGIN_PAGE_URI', $_POST['login_page_uri']);
					}else{
						$mConfig->saveConfig('LOGIN_PAGE_URI', $_POST['login_page_uri']);
					}
				}
				break;
			case '';
				$site = array();
				$site['site_name'] = $mConfig->getConfig('SITE_NAME');
				$site['site_keywords'] = $mConfig->getConfig('SITE_KEYWORDS');
				$site['site_description'] = $mConfig->getConfig('SITE_DESCRIPTION');
				$site['login_page_uri'] = $mConfig->getConfig('LOGIN_PAGE_URI');
				$this->assign('site', $site);
				$this->display('', '/home.php');
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
		header('Expires: '.date('D, d M Y H:i:s e', time() + $cache_seconds));
		$this->display('', '/'.$action.'.js');
	}
	
	
	
	
	
}