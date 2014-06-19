<?php
	if (!defined('DS'))	define('DS', DIRECTORY_SEPARATOR);
	define ('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	define ('BASEPATH', dirname(__FILE__));
	define ('APPPATH', BASEPATH.DS.'app'.DS);
	define ('CONTROLLERS_PATH', APPPATH.'controllers'.DS);
	define ('VIEWS_PATH', APPPATH.'views'.DS);
	define ('LIBRARY_PATH', APPPATH.'library'.DS);
	define ('HELPER_PATH', APPPATH.'helpers'.DS);
	define ('LANG_PATH', APPPATH.'lang'.DS);
	define ('EXT','.php');
	if (!defined('MAX_PAGES_PER_BLOCK')) define ('MAX_PAGES_PER_BLOCK', 5);
	
	// debug
	define ('TESTING_MODE', false);

	if (TESTING_MODE) {
		ini_set('display_errors', 'On');
		error_reporting(E_ALL);
	} else {
		error_reporting(0);
	}	
	
	// require system
	require_once(APPPATH.'config.php');
	require_once(LIBRARY_PATH.'api_linxgo'.DS.'linxgo_api_lib.php');
	require_once(LIBRARY_PATH.'Router.php');
	require_once(LIBRARY_PATH.'Config.php');
	require_once(LIBRARY_PATH.'Input.php');
	require_once(LIBRARY_PATH.'Lang.php');
	require_once(LIBRARY_PATH.'Helper.php');
	require_once(LIBRARY_PATH.'Controller.php');
	require_once(LIBRARY_PATH.'Encoding.php');


	$router = new Router();
	$router->init();
	$controller = $router->getController();
	$action 	= $router->getAction();
	$arguments 	= $router->getParams();
		
	if (!function_exists('base_url')) {
		function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
			if (isset($_SERVER['HTTP_HOST'])) {
				$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$hostname = $_SERVER['HTTP_HOST'];
				$dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
				$core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
				$core = $core[0];
				$tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
				$end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
				$base_url = sprintf( $tmplt, $http, $hostname, $end );
			}
			else {
				$base_url = 'http://localhost/';
			}
			if ($parse) {
				$base_url = parse_url($base_url);
				if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
			}
	
			return $base_url;
		}
	}
	
	if (file_exists(CONTROLLERS_PATH.$controller.EXT))  { require_once (CONTROLLERS_PATH.$controller.EXT); } 
	else 												{ die ("page does not exits. controller: {$controller}, base url: ".base_url()); }
	
	$class = new $controller();
	if ($arguments && count($arguments)>0) {
		foreach ($arguments as $key=>$value) {
			$class->$key = $value;
		}
	}
	// process config data and pass it to controller
	$Config = new Config();
	foreach ($config as $key=>$value) 	{ $Config->$key = $value; }
	$class->setConfig($Config);
	$class->setInput(new Input());
	// Init Lang
	$Lang = new Lang($Config->api_config['lang']);
	$class->setLang($Lang);
	$Helper = new Helper();
	$class->setHelper($Helper);
	if (method_exists($class, $action)) { $class->$action(); }
	else 								{ die('method does not exits'); }
?>