<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Input {
	private $_post_keys;
	private $_get_keys;
	public function __construct() { 
		$this->_post_keys	= array(); 
		$this->_get_keys 	= array();
		
		if (isset($_POST) && count($_POST)>0) {
			foreach ($_POST as $key=>$value) {
				$cleaned = $this->xss_clean($value);
				if ($cleaned!=='') {
					$this->_post_keys[$key] = $cleaned;
				}
			}
		}
		if (isset($_GET) && count($_GET)>0) {
			foreach ($_GET as $key=>$value) {
				$cleaned = $this->xss_clean($value);
				if ($cleaned!=='') {
					$this->_get_keys[$key] = $cleaned;
				}
			}
		}
	}
	public function get($key) {
		if ($key===NULL) 	{ return $this->_get_keys; } 
		else 				{	 return (isset($this->_get_keys[$key])?$this->_get_keys[$key]:FALSE); }
	}
	
	public function post($key) {
		if ($key===NULL) 	{ return FALSE; }
		else 				{ return (isset($this->_post_keys[$key])?$this->_post_keys[$key]:FALSE); }
	}

	private function xss_clean($data) {
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		do {
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		} while ($old_data !== $data);
		return $data;
	}
}

