<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config {
	private $data;
		
	public function __construct() 		{ $this->data = array(); }
	public function __get($value) 		{ return ($value==='' || !isset($this->data[$value])) ? NULL : $this->data[$value]; }
	public function __set($key, $value) { if ($key!=='' && $value!=='') { $this->data[$key] = $value; } }
}

