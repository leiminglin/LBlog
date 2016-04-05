<?php
class ModelArchivesRelation extends Model{

	public $table_name = 'blog_archives_relation';

	public function checkRelationExists($aid, $aid2){
		$rs = $this->db->getOne($this->table, 'COUNT(1) C', '(aid=? AND relation_aid=?) OR (aid=? AND relation_aid=?)', array($aid, $aid2, $aid, $aid2));
		if( $rs['C'] > 0 ){
			return true;
		}
		return false;
	}
	
	public function addRelation($aid, $aid2){
		if( $this->checkRelationExists($aid, $aid2) ){
			return false;
		}
		$arr = array(
				'aid'=>$aid,
				'relation_aid'=>$aid2,
				'addtime'=>time()
			);
		return $this->db->insert($this->dbPrefix.'blog_archives_relation', $arr);
	}
	
	public function removeRelation($aid, $aid2){
		if( !$this->checkRelationExists($aid, $aid2) ){
			return false;
		}
		return $this->db->delete($this->dbPrefix.'blog_archives_relation', 
				"(aid='{$aid}' AND relation_aid='{$aid2}') OR (relation_aid='{$aid}' AND aid='{$aid2}')");
	}
	
	public function getAll($offset = 0, $limit = 10){
		$offset = (int)$offset;
		$limit = (int)$limit;
		return $this->db->query("select * from {$this->dbPrefix}blog_archives_relation order by aid desc limit $offset, $limit");
	}
	
	public function getCount(){
		$rs = $this->db->select($this->dbPrefix.'blog_archives_relation', 'COUNT(1) C');
		return isset($rs[0]['C']) ? $rs[0]['C'] : 0;
	}
}
