<?php
abstract class Model{
	public $dbconfig;
	public $db;
	public $dbPrefix;

	public function __construct(){
		$dbconfig = $GLOBALS['dbconfig'];
		$this->dbconfig = $dbconfig;
		if (extension_loaded('pdo_mysql') && extension_loaded('PDO')) {
			$this->db = MysqlPdoEnhance::getInstance($dbconfig);
		} else {
			$this->db = Mysql::getInstance($dbconfig);
		}
		$this->dbPrefix = $dbconfig['dbprefix'];
	}
}
