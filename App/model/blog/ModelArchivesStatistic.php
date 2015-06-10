<?php
class ModelArchivesStatistic extends Model{

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
		$sql = "SELECT COUNT(1) C FROM {$this->dbPrefix}blog_archives_statistic where aid = '{$aid}'";
		$count = $this->db->getOne($sql);
		if( $count['C'] > 0 ){
			return true;
		}
		return false;
	}
	
	public function getArticleReadRank(){
		$sql = "SELECT aid, viewtimes FROM {$this->dbPrefix}blog_archives_statistic ORDER BY viewtimes DESC LIMIT 10";
		return $this->db->query($sql);
	}
}