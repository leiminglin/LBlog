<?php
class ModuleAdmin extends LmlBlog{
	
	private $mArchives;
	public $conditions = array(
		'postarticle' => 'checkLogin',
		'editarticle' => 'checkLogin',
		'backData' => 'checkLogin',
		'index' => 'checkLogin',
		'addrelationarticle' => 'checkLogin',
		'removerelationarticle' => 'checkLogin'
	);
	
	public function __construct(){
		$this->mArchives = new ModelArchives();
	}
	
	public function index(){
		$this->display();
	}
	
	public function login(){
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
			}
		}
		$this->display();
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
		$relation_ids = isset($_GET['relation_ids'])?$_GET['relation_ids']:'';
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
		$action = isset($matches[1]) ? $matches[1] : 'list';
		switch ($action){
			case 'list':
				$mArchives = new ModelArchives();
				$rs = $mArchives->getArticleTitles(0, 5);
				$this->assign('rs', $rs);
				$this->display('', '/list.php');
				break;
		}
	}
	
	
	
	
	
}