<?php
class ModelArchives extends Model{

	public $table_name = 'blog_archives';
	
	public function getArticles($begin=0, $count=5, $is_active = 'Y'){
		$where = '';
		if($is_active) {
			$where .= "AND a.is_active='".$is_active."'";
		}
		$sql = "SELECT a.*,u.nickname,s.viewtimes,s.commenttimes FROM {$this->dbPrefix}blog_archives a"
			." LEFT JOIN {$this->dbPrefix}user u ON a.userid=u.id"
			." LEFT JOIN {$this->dbPrefix}blog_archives_statistic s ON a.id=s.aid"
			." WHERE 1=1 $where ORDER BY id DESC LIMIT $begin,$count";
		$archives = $this->db->query($sql);
		$ids = Tool::getArrayFieldList($archives, 'id');
		$urls = $this->getArchivesUrlByIds($ids);
		foreach ($archives as &$v){
			$v['url'] = isset($urls[$v['id']]) ? $urls[$v['id']] : '';
		}
		return $archives;
	}
	
	public function getArticleTitles($begin=0, $count=5, $is_active=''){
		$where = '';
		if($is_active) {
			$where .= "AND a.is_active='".$is_active."'";
		}
		$sql = "SELECT a.id, a.userid, a.catid, a.title, a.createtime, a.is_active, "
		."u.nickname, s.viewtimes, s.commenttimes FROM {$this->dbPrefix}blog_archives a"
		." LEFT JOIN {$this->dbPrefix}user u ON a.userid=u.id"
		." LEFT JOIN {$this->dbPrefix}blog_archives_statistic s ON a.id=s.aid"
		." WHERE 1=1 $where ORDER BY id DESC LIMIT $begin,$count";
		$archives = $this->db->query($sql);
		$ids = Tool::getArrayFieldList($archives, 'id');
		$urls = $this->getArchivesUrlByIds($ids);
		foreach ($archives as &$v){
			$v['url'] = isset($urls[$v['id']]) ? $urls[$v['id']] : '';
		}
		return $archives;
	}
	
	public function getArchivesUrlByIds($ids){
		if(!$ids){
			return ;
		}
		$sql = "SELECT * FROM {$this->dbPrefix}blog_archives_url WHERE aid in (".implode(',', $ids).")";
		$urls = $this->db->query($sql);
		$return = array();
		foreach ($urls as $v){
			$return[$v['aid']] = $v['url'];
		}
		return $return;
	}
	
	public function getCount($is_active='Y'){
		$active_sql = '';
		$params = array();
		if($is_active){
			$active_sql = 'is_active=?';
			$params = array_merge($params, array($is_active));
		}
		$c = $this->db->getOne($this->table, 'COUNT(1) C', $active_sql, $params);
		return $c['C'];
	}
	
	public function getArticleById($id, $is_active='Y'){
		$active_sql = '';
		if($is_active){
			$active_sql = "AND is_active='".$is_active."'";
		}
		$sql = "SELECT a.*,u.nickname,s.viewtimes,s.commenttimes FROM {$this->dbPrefix}blog_archives a"
			." LEFT JOIN {$this->dbPrefix}user u ON a.userid=u.id"
			." LEFT JOIN {$this->dbPrefix}blog_archives_statistic s ON a.id=s.aid"
			." WHERE a.id='{$id}' $active_sql";
		$article = arr_get($this->db->query($sql), 0);
		if($article){
			$url = $this->getArchivesUrlByIds(array($article['id']));
			$article['url'] = isset($url[$article['id']]) ? $url[$article['id']] : '';
		}
		return $article;
	}
	
	public function getArticleTitleById($id){
		$sql = "SELECT id, title FROM {$this->dbPrefix}blog_archives a"
			." WHERE a.id='{$id}' AND is_active='Y'";
		$rs = arr_get($this->db->query($sql), 0);
		if($rs){
			$url = $this->getArchivesUrlByIds(array($rs['id']));
			$rs['url'] = isset($url[$rs['id']]) ? $url[$rs['id']] : '';
		}
		return $rs;
	}
	
	public function getCatArticles($id, $begin=0, $count=5){
		$sql = "SELECT a.*,u.nickname,s.viewtimes,s.commenttimes FROM {$this->dbPrefix}blog_archives a"
			." LEFT JOIN {$this->dbPrefix}user u ON a.userid=u.id"
			." LEFT JOIN {$this->dbPrefix}blog_archives_statistic s ON a.id=s.aid"
			." WHERE a.catid='{$id}' AND is_active='Y' ORDER BY id DESC LIMIT $begin,$count";
		$archives = $this->db->query($sql);
		$ids = Tool::getArrayFieldList($archives, 'id');
		$urls = $this->getArchivesUrlByIds($ids);
		foreach ($archives as &$v){
			$v['url'] = isset($urls[$v['id']]) ? $urls[$v['id']] : '';
		}
		return $archives;
	}

	public function getCatCount($id){
		$sql = "SELECT COUNT(1) C FROM {$this->dbPrefix}blog_archives"
		." WHERE catid='{$id}' AND is_active='Y'";
		$c = arr_get($this->db->query($sql), 0);
		return $c['C'];
	}
	
	public function getRecentArticles(){
		$sql = "SELECT id, title FROM {$this->dbPrefix}blog_archives"
		." WHERE is_active='Y' ORDER BY id DESC LIMIT 0,20";
		$data = $this->db->query($sql);
		$ids = Tool::getArrayFieldList($data, 'id');
		$urls = $this->getArchivesUrlByIds($ids);
		foreach ($data as &$v){
			$v['url'] = isset($urls[$v['id']]) ? $urls[$v['id']] : '';
		}
		return $data; 
	}
	
	public function addArticle($arr){
		if(!isset($arr['content']) || !isset($arr['title'])
		|| !$arr['userid'] || !$arr['catid'] || !$arr['is_active']){
			return false;
		}
		$sqlarr = array(
				'userid'=>$arr['userid'],
				'catid'=>$arr['catid'],
				'title'=>$arr['title'],
				'content'=>$arr['content'],
				'createtime'=>$GLOBALS['start_time'],
				'is_active'=>$arr['is_active'],
		);
		$this->db->insert($this->dbPrefix.'blog_archives', $sqlarr);
		$article_id = $this->db->getLastId();
		$sqlurl = array(
			'aid' => $article_id,
			'url' => $arr['url']
		);
		$this->db->insert($this->dbPrefix.'blog_archives_url', $sqlurl);
		return $article_id;
	}
	
	public function modifyArticle($arr, $id){
		if( !isset($arr['content']) || !isset($arr['title'])
		|| !$arr['userid'] || !$arr['catid'] || !$arr['is_active']  || !isset($arr['url']) ) {
			return false;
		}
		$status1 = $status2 = null;
		if( isset($arr['url']) ) {
			$modify_url_arr = array(
				'url' => $arr['url']
			);
			if ( !$this->checkArticleUrlExists($id) ){
				$sqlurl = array(
						'aid' => $id,
						'url' => $arr['url']
				);
				$this->db->insert($this->dbPrefix.'blog_archives_url', $sqlurl);
			}
			$status1 = $this->db->update($this->dbPrefix.'blog_archives_url', $modify_url_arr, "aid='{$id}'");
		}
		$arr['content'] = preg_replace('/<br>/i', "\n", $arr['content']);
		$update_arr = array(
			'content' => $arr['content'],
			'title' => $arr['title'],
			'userid' => $arr['userid'],
			'catid' => $arr['catid'],
			'is_active' => $arr['is_active']
		);
		
		$status2 = $this->db->update($this->dbPrefix.'blog_archives', $update_arr, "id='{$id}'");
		return $status1 || $status2;
	}
	
	public function mofifyArticleUrl(){
		
	}
	
	public function checkArticleUrlExists($aid){
		//$sql = "SELECT COUNT(1) AS C FROM {$this->dbPrefix}blog_archives_url WHERE aid ='{$aid}'";
		$rs = $this->db->getOne($this->dbPrefix.'blog_archives_url', 'COUNT(1) C', 'aid=?', array($aid));
		return $rs['C'];
	}
	
	public function getRelationArticle($aid){
		if($aid < 6){
			$range = range(1, 11);
		}else{
			$range = range($aid-5, $aid+5);
		}
		foreach ($range as $k => $t){
			if($t == $aid){
				unset($range[$k]);
			}
		}
		
		$sql = "SELECT id, title FROM {$this->dbPrefix}blog_archives"
		." WHERE is_active='Y' AND id in(".implode(',', $range).") ORDER BY id DESC";
		$articles = $this->db->query($sql);
		$ids = Tool::getArrayFieldList($articles, 'id');
		$urls = $this->getArchivesUrlByIds($ids);
		foreach ($articles as &$v){
			$v['url'] = isset($urls[$v['id']]) ? $urls[$v['id']] : '';
		}
		return $articles;
	}
	
	public function getRelevanceArticle($aid){
		$sql = "SELECT * FROM {$this->dbPrefix}blog_archives_relation"
			." WHERE aid='{$aid}' OR relation_aid='{$aid}'";
		$rs = $this->db->query($sql);
		$arr = array();
		foreach( $rs as $k=>$v){
			if( $v['aid'] != $aid ){
				$arr[] = $v['aid'];
			}
			if( $v['relation_aid'] != $aid ){
				$arr[] = $v['relation_aid'];
			}
		}
		sort($arr);
		$urls = $this->getArchivesUrlByIds($arr);
		$return = array();
		foreach ($arr as $k => $v){
			$return[$k]['aid'] = $v;
			$return[$k]['url'] = isset($urls[$v]) ? $urls[$v] : '';
		}
		return $return;
	}
	
	public function checkArchivesIdExists($aid){
		$sql = "SELECT COUNT(1) C FROM {$this->dbPrefix}blog_archives"
		." WHERE is_active='Y' AND id='{$aid}'";
		$rs = $this->db->getOne($sql);
		if( $rs['C'] > 0 ){
			return true;
		}
		return false;
	}
}
