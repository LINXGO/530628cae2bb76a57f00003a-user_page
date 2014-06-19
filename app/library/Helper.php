<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Helper {
	public function __construct() 		{ }
	public function load($helper_file=''){
		if ($helper_file==='' || !file_exists(HELPER_PATH.$helper_file.EXT)) {
			die('missing helper file: '.$helper_file);
		}

		include_once (HELPER_PATH.$helper_file.EXT);
	}
}

