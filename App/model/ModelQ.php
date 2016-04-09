<?php
class ModelQ extends Model{

	public $table_name = '';

	public function __construct($name){
		$this->table_name = $name;
		parent::__construct();
	}
}
