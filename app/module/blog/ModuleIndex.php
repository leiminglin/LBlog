<?php
class ModuleIndex extends LmlBlog{
	
	private $mCats;
	private $mArchives;
	
	public function __construct(){
		$this->mCats = new ModelCat();
		$this->mArchives = new ModelArchives();
		$this->assign('cats', $this->mCats->getCats());
	}
	public function index(){
		if (THEME_NAME == 'mall') {
			return $this->index_mall();
		}

		$pid = 1;
		$pcount = 5;
		
		$counts = $this->mArchives->getCount();
		$page = new Paging($counts, $pid, $pcount);
		if( isset($_GET['pid']) ){
			$pid = $_GET['pid'];
		}else{
			$pid = $page->getPageCount();
		}
		$begin = $counts-$pcount*$pid>0 ? $counts-$pcount*$pid : 0;
		$articles = $this->mArchives->getArticles($begin, $pcount);
		
		if(!$articles && $pid){
			return Tool::notFoundPage();
		}
		$pid = $page->getPageCount() + 1 - $pid;
		$page = new Paging($counts, $pid, $pcount);
		$this->assign('articles', $articles);
		$this->assign('page', $page);
		$this->assign('page_path', 'p/');
		$this->assign('pid', $pid);
		$this->display();
	}

	private function index_mall(){
		$this->display('list/index');
	}
}
