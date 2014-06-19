<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lang {
	private $data;
	private $default_lang;
	public function __construct($default_lang='') 		{ 
		$this->data = array();
		// set default lang if exits
		$this->default_lang = ($default_lang === '')?'':$default_lang.'/';
		// by default allways load site lang
		$this->load('site');
	}
	public function __get($value) 		{ return ($value==='' || !isset($this->data[$value])) ? NULL : $this->data[$value]; }
	public function __set($key, $value) { if ($key!=='' && $value!=='') { $this->data[$key] = $value; } }
	public function load($lang_file=''){
		if ($lang_file==='' || !file_exists(LANG_PATH.$this->default_lang.$lang_file.EXT)) {
			die('missing lang file: '.$lang_file);
		}
		require_once (LANG_PATH.$this->default_lang.$lang_file.EXT);
		foreach ($lang as $key_name=>$lang_line) {
			$this->$key_name = $lang_line;
		}
	}
}

