<?php
class ModelComment extends Model{
	
	public function getCommentsByAid($aid){
		$sql = "SELECT a.*,b.nickname,b.source FROM {$this->dbPrefix}blog_comment a"
			." LEFT JOIN {$this->dbPrefix}user b ON a.uid = b.id "
			." WHERE a.is_active='Y' AND a.aid='{$aid}' ORDER BY id DESC";
		$rs = $this->db->query($sql);
		if(!$rs){
			return;
		}
		$users = array();
		foreach( $rs as $k=>$v ){
			$v['userid'] = $v['uid'];
			if( !isset($users[$v['userid']]) ){
				$users[$v['userid']] =
				json_decode($this->getUserinfoById($v['userid'], $v['source']), true);
			}
			if( isset($users[$v['userid']]['figureurl_qq_2']) ){
				// tencent qq
				$rs[$k]['userinfo']['avatar'] = $users[$v['userid']]['figureurl_qq_2'];
			}elseif( isset($users[$v['userid']]['avatar_large']) ){
				$rs[$k]['userinfo']['avatar'] = $users[$v['userid']]['avatar_large'];
			}else{
				$rs[$k]['userinfo']['avatar'] = WEB_PATH.'static/resource/lbloglogo100.png';
			}
		}
		return $rs;
	}
	
	public function add($arr){
		if(!isset($arr['content']) || !isset($arr['aid']) 
			|| !$arr['content'] || !$arr['aid'] ){
			return false;
		}
		$arr['content'] = $this->savePreProcess($arr['content']);
		$sqlarr = array(
			'aid'=>$arr['aid'],
			'content'=>$arr['content'],
			'uid'=>Tool::checkCookie(),
			'createtime'=>time(),
		);
		$this->db->insert($this->dbPrefix.'blog_comment', $sqlarr);
		return $this->db->getLastId();
	}
	
	public function savePreProcess($v){
		return preg_replace('/<script.*?<\/script>|<style.*?<\/style>|<iframe.*?<\/iframe>/i', '', $v);
	}
	
	public function getUserinfoById($uid, $source){
		if($source == 'qq'){
			$table = $this->dbPrefix.'user_qq';
		}elseif($source == 'weibo'){
			$table = $this->dbPrefix.'user_weibo';
		}else{
			return '';
		}
		$sql = "SELECT userinfo FROM {$table} WHERE userid='{$uid}'";
		$rs = $this->db->query($sql);
		return $rs[0]['userinfo'];
	}
	
	public function getRecentComments(){
		$sql = "SELECT a.*,b.nickname,c.title FROM {$this->dbPrefix}blog_comment a"
		." LEFT JOIN {$this->dbPrefix}user b ON a.uid = b.id "
		." LEFT JOIN {$this->dbPrefix}blog_archives c ON a.aid = c.id "
		." WHERE a.is_active='Y' ORDER BY id DESC LIMIT 10";
		$rs = $this->db->query($sql);
		$ids = Tool::getArrayFieldList($rs, 'aid');
		$mArchives = new ModelArchives();
		$urls = $mArchives->getArchivesUrlByIds($ids);
		foreach ($rs as &$v){
			$v['url'] = isset($urls[$v['aid']]) ? $urls[$v['aid']] : '';
		}
		return $rs;
	}
}