<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller {
	protected $data;
	protected $config;
	protected $input;
	protected $lang;
	protected $helper;
	public function __construct() { 
		$this->data = array(); 
		$this->data['base_url'] = base_url();
	}
	public function __get($value) 		{ return ($value==='' || !isset($this->data[$value])) ? NULL : $this->data[$value]; }
	public function __set($key, $value) { if ($key!=='' && $value!=='') { $this->data[$key] = $value; } }
	public function setConfig($config) 	{ $this->config = $config; }
	public function setInput($input) 	{ $this->input = $input; }
	public function setLang($lang)		{ $this->lang = $lang; }
	public function setHelper($helper)		{ $this->helper = $helper; }
	public function render($view='') {
		if (file_exists(VIEWS_PATH.$view.EXT)) {
			extract($this->data);
			include (VIEWS_PATH.$view.EXT);
		} else {
			die ("missing view file: $view");
		}
	}
}

