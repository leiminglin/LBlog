<?php
class DbSession
{
	protected $link;
	
	protected $dbconfig;
	
	protected $expire_time = 86400;
	
	function open($savePath, $sessionName){
		if(!$this->link){
			$this->dbconfig = &$GLOBALS['dbconfig'];
			$this->link = db();
			
			$table_name = $this->dbconfig['dbprefix'].'session';
			$sql = 'show tables like \''.$table_name.'\'';
			$rs = $this->link->query($sql);
			if(!$rs){
				$sql_create = 'create table '.$table_name.'('
						.'id varchar(50) not null,'
						.'data text not null default \'\','
						.'expires int(11) not null default 0,'
						.'primary key (`id`),'
						.'key `expires`(`expires`)'
						.')ENGINE=MyISAM CHARSET=utf8 COMMENT=\'sessions\'';
				$this->link->query($sql_create);
			}
		}
		return true;
	}

	function close(){
		return true;
	}

	function read($id)
	{
		$rs = $this->link->getOne('select data from ' 
			. $this->dbconfig['dbprefix'] 
			. 'session where id=? and expires>?', array($id, time()));
		if($rs){
			return (string)$rs['data'];
		}
		return '';
	}

	function write($id, $data)
	{
		$rs = $this->link->query('replace into ' . $this->dbconfig['dbprefix'] 
				. 'session set id=?, expires=?, data=?', array($id, time()+$this->expire_time, $data));
		if($rs){
			return true;
		}
		return false;
	}

	function destroy($id)
	{
		$rs = $this->link->delete($this->dbconfig['dbprefix'].'session', 'id=?', array($id));
		if($rs){
			return true;
		}
		return false;
	}

	function gc($maxlifetime)
	{
		$rs = $this->link->delete($this->dbconfig['dbprefix'].'session', '(expires +'.$maxlifetime.') < '.time());
		if($rs){
			return true;
		}
		return false;
	}
}



if ( version_compare(phpversion(), '5.4.0', '>=') ) {
	class DbSessionHandler extends DbSession implements SessionHandlerInterface{}
}


// $handler = new DbSessionHandler();
// session_set_save_handler($handler, true);
// session_start();

// session_set_save_handler(
// array($handler, 'open'),
// array($handler, 'close'),
// array($handler, 'read'),
// array($handler, 'write'),
// array($handler, 'destroy'),
// array($handler, 'gc')
// );














/*

class SysSession implements SessionHandlerInterface
{
	private $link;

	public function open($savePath, $sessionName)
	{
		$link = mysqli_connect("server","user","pwd","mydatabase");
		if($link){
			$this->link = $link;
			return true;
		}else{
			return false;
		}
	}
	public function close()
	{
		mysqli_close($this->link);
		return true;
	}
	public function read($id)
	{
		$result = mysqli_query($this->link,"SELECT Session_Data FROM Session WHERE Session_Id = '".$id."' AND Session_Expires > '".date('Y-m-d H:i:s')."'");
		if($row = mysqli_fetch_assoc($result)){
			return $row['Session_Data'];
		}else{
			return "";
		}
	}
	public function write($id, $data)
	{
		$DateTime = date('Y-m-d H:i:s');
		$NewDateTime = date('Y-m-d H:i:s',strtotime($DateTime.' + 1 hour'));
		$result = mysqli_query($this->link,"REPLACE INTO Session SET Session_Id = '".$id
				."', Session_Expires = '".$NewDateTime."', Session_Data = '".$data."'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function destroy($id)
	{
		$result = mysqli_query($this->link,"DELETE FROM Session WHERE Session_Id ='".$id."'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function gc($maxlifetime)
	{
		$result = mysqli_query($this->link,"DELETE FROM Session WHERE ((UNIX_TIMESTAMP(Session_Expires) + ".$maxlifetime.") < ".$maxlifetime.")");
		if($result){
			return true;
		}else{
			return false;
		}
	}
}


*/
