<?php
abstract class Model{
	public $dbconfig;
	public $db;
	public $dbPrefix;

	public function __construct(){
		$dbconfig = $GLOBALS['dbconfig'];
		$this->dbconfig = $dbconfig;
		$this->db = db();
		$this->dbPrefix = $dbconfig['dbprefix'];
	}
}
