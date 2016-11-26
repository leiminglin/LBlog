<?php
class ModuleCat extends LmlBlog{
	private $mCats;
	private $mArchives;
	
	public function __construct(){
		$this->mCats = new ModelCat();
		$this->mArchives = new ModelArchives();
	}
	
	public function index(){
		if (THEME_NAME == 'mall') {
			return $this->index_mall();
		}
		
		$matches = '';
		$id = '';
		if( !preg_match('/^(?:\/index\.php)?\/cat\/?([\d]+)?(?:\/)?(?:p)?([1-9][\d]*)?/i', LML_REQUEST_URI, $matches) ){
			return Tool::notFoundPage();
		}
		isset( $matches[1] ) ? $id = $_GET['id'] = (int)$matches[1] : $id = 1;
		
		$pid = 1;
		$pcount = 5;
		$counts = $this->mArchives->getCatCount($id);
		$page = new Paging($counts, $pid, $pcount);
		if( isset($matches[2]) ){
			$pid = $_GET['pid'] =  $matches[2];
		}else{
			$pid = $page->getPageCount();
		}
		$begin = $counts-$pcount*$pid>0 ? $counts-$pcount*$pid : 0;
		$articles = $this->mArchives->getCatArticles($id, $begin, $pcount);
		$cats = $this->mCats->getCats();
		$this->assign('cats', $cats);
		$is_real_cat = false;
		foreach ($cats as $t){
			if( $id == $t['id'] ){
				$is_real_cat = true;
				break;
			}
		}
		if(empty($articles) || !$is_real_cat){
			return Tool::notFoundPage();
		}
		$pid = $page->getPageCount() + 1 - $pid;
		$page = new Paging($counts, $pid, $pcount);
		$this->assign('catid', $id);
		$this->assign('articles', $articles);
		$this->assign('page', $page);
		$this->assign('page_path', 'cat/'.$id.'/p');
		$this->assign('pid', $pid);
		$this->display();
	}
	
	private function index_mall(){
		$this->display();
	}
}