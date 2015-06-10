<?php
class ModuleArchives extends LmlBlog{
	private $mCats;
	public $mArchives;
	private $mComment;
	public $conditions = array(
		'comment' => 'checkLogin'
	);
	
	public function __construct(){
		$this->mCats = new ModelCat();
		$this->mArchives = new ModelArchives();
		$this->mComment = new ModelComment();
		$this->mStatistic = new ModelArchivesStatistic();
		$this->assign('cats', $this->mCats->getCats());
	}
	public function index(){
		$matches = '';
		$id = '';
		preg_match('/^(?:\/index\.php)?\/archives\/?([\d]+)*/i', LML_REQUEST_URI, $matches);
		isset( $matches[1] ) ? $id = $_GET['id'] = (int)$matches[1] : $id = 1;
		
		$article = $this->mArchives->getArticleById($id);
		
		if(empty($article)){
			return Tool::notFoundPage();
		}
		
		if(isset($article['url']) && $article['url']){
			preg_match('/^(?:\/index\.php)?\/archives\/[\d]+\/([\w\-]+)/i', LML_REQUEST_URI, $matches);
			if (!isset($matches[1])){
				header('HTTP/1.1 301 Moved Permanently');
				header('Status:301 Moved Permanently');
				header('Location:' . preg_replace('/(\/archives\/[\d]+)\/*/', "$1/".$article['url'], $_SERVER['REQUEST_URI']));
			}elseif($matches[1] != $article['url']){
				header('HTTP/1.1 301 Moved Permanently');
				header('Status:301 Moved Permanently');
				header('Location:' . preg_replace('/(\/archives\/[\d]+)\/[\w\-\/]+/', "$1/".$article['url'], $_SERVER['REQUEST_URI']));
			}
		}
		
		$this->assign('id', $id);
		$this->assign('article', $article);
		$this->assign('comments', $this->mComment->getCommentsByAid($id));
		$this->assign('relevance', $this->mArchives->getRelevanceArticle($id));
		$this->assign('relations', $this->mArchives->getRelationArticle($id));
		$this->mStatistic->addViewTimes($id);
		$this->display();
	}
	
	public function comment(){
		if($_POST){
			if( ($id = $this->mComment->add($_POST)) == true ){
				$this->mStatistic->addCommentTimes($_POST['aid']);
				echo json_encode(array('status'=>true, 'id'=>$id));
			}else{
				echo json_encode(array('status'=>false, 'msg'=>'保存失败！'));
			}
		}
	}
}