<?php
class ModelArchivesRelation extends Model{
	
	public function checkRelationExists($aid, $aid2){
		$sql = "SELECT COUNT(1) C FROM {$this->dbPrefix}blog_archives_relation"
		." WHERE (aid='{$aid}' AND relation_aid='{$aid2}') OR (aid='{$aid2}' AND relation_aid='{$aid}') ";
		$rs = $this->db->getOne($sql);
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
				'addtime'=>$GLOBALS['start_time']
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
