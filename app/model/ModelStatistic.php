<?php
class ModelStatistic extends Model{

	public function save(){
		$http_accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])?$_SERVER['HTTP_ACCEPT_LANGUAGE']:'';
		$http_accept_encoding =  isset($_SERVER['HTTP_ACCEPT_ENCODING'])?$_SERVER['HTTP_ACCEPT_ENCODING']:'';
		$http_referer =  isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
		$request_uri = arr_get($_SERVER, 'REQUEST_URI');
		$arr = array(
			'http_host' => APP_DOMAIN,
			'request_uri' => $request_uri,
			'remote_addr' => arr_get($_SERVER, 'REMOTE_ADDR'),
			'request_method' => arr_get($_SERVER, 'REQUEST_METHOD'),
			'http_x_forward_for' => arr_get($_SERVER, 'HTTP_X_FORWARD_FOR'),
			'http_user_agent' => isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'',
			'http_accept' => isset($_SERVER['HTTP_ACCEPT'])?$_SERVER['HTTP_ACCEPT']:'',
			'http_accept_language' => $http_accept_language,
			'http_accept_encoding' => $http_accept_encoding,
			'http_referer' => $http_referer,
			'request_time_float' => arr_get($_SERVER, 'REQUEST_TIME_FLOAT'),
			'createtime' => $GLOBALS['start_time'],
		);

		$suffix = '';
		if(preg_match('^(?:\/index\.php)?\/admin/i', $request_uri)){
			$suffix = '_admin';
		}
		return $this->db->insert($this->dbPrefix.'statistic'.$suffix, $arr);
	}
	
	public function articleTodayRank(){
		$sql = "SELECT request_uri FROM {$this->dbPrefix}statistic "
				."WHERE request_uri like '/archives/%' "
				."AND createtime > '".strtotime('today')."'";
		$rs = $this->db->query($sql);
		$statistic = array();
		foreach ($rs as $t){
			if( preg_match('/\/archives\/(\d+)/i', $t['request_uri'], $matches) ){
				if( isset($statistic['/archives/'.$matches[1]]) ){
					$statistic['/archives/'.$matches[1]]++;
				}else{
					$statistic['/archives/'.$matches[1]] = 1;
				}
			}
		}
		arsort($statistic);
		return $statistic;
	}
	
	public function getList($offset = 0, $limit = 10){
		$offset = (int)$offset;
		$limit = (int)$limit;
		$sql = "select * from {$this->dbPrefix}statistic order by id desc limit $offset, $limit";
		return $this->db->query($sql);
	}
	
	public function getCount($offset = 0, $limit = 10){
		//$sql = "select COUNT(1) C from {$this->dbPrefix}statistic";
		$rs = $this->db->getOne($this->dbPrefix.'statistic', 'COUNT(1) C');
		return isset($rs['C']) ? $rs['C'] : 0;
	}
	
}
