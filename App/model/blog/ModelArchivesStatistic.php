<?php
class ModelArchivesStatistic extends Model{

	public $table_name = 'blog_archives_statistic';

	public function addViewTimes($aid){
		if( $this->checkExists($aid) ){
			$sql = "UPDATE {$this->dbPrefix}blog_archives_statistic SET viewtimes = viewtimes+1 WHERE aid ='{$aid}'";
			return $this->db->query($sql);
		}
		$arr = array(
			'aid' => $aid,
			'viewtimes' => 1,
			'commenttimes' => 0
		);
		return $this->db->insert($this->dbPrefix.'blog_archives_statistic', $arr);
	}
	
	public function addCommentTimes($aid){
		$sql = "UPDATE {$this->dbPrefix}blog_archives_statistic SET commenttimes = commenttimes+1 WHERE aid ='{$aid}'";
		return $this->db->query($sql);
	}
	
	public function checkExists( $aid ){
		$count = $this->db->getOne($this->table, 'COUNT(1) C', 'aid=?', array($aid));
		if( $count['C'] > 0 ){
			return true;
		}
		return false;
	}
	
	public function getArticleReadRank(){
		$sql = "SELECT aid FROM {$this->dbPrefix}blog_archives_statistic ORDER BY viewtimes DESC LIMIT 1000";
		return $this->db->query($sql);
	}
}
