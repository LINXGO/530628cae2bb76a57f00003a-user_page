<?php
 
/* ------------------------------------------------------------- */
/* URL Router class */
/* ------------------------------------------------------------- */
 
class Router {
  private $controller;
  private $action;
  private $params;
  
  public function __construct() {
  	$this->controller = '';
  	$this->action = '';
  }
  
  private function set_routing($url) {
  	$qs = $_SERVER['QUERY_STRING'];
  	// prevent extrar chars
  	$_url = preg_replace('/\&amp\;.*$/', '', htmlentities($url));
  	$_url = preg_replace('/\?.*$/', '', htmlentities($_url));
  	
  	if (strpos($_url, $_SERVER['SCRIPT_NAME']) === 0) {
  		$_url = substr($_url, strlen($_SERVER['SCRIPT_NAME']));
  	} elseif (strpos($_url, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
  		$_url = substr($_url, strlen(dirname($_SERVER['SCRIPT_NAME'])));
  	}  	
  	
  	$qs = str_replace('route='.$_url.'?','', $qs); 
  	
    // process default routes
    $items = explode('/',$_url);
    $arguments = array();
    // process query string
    if ($qs !== '') {
    	$qs = htmlentities($qs);
    	$_params = explode('&amp;',$qs);
    	if (count($_params)>0) {
    		foreach ($_params as $item=>$param) {
    			$_param = explode ('=',$param);
    			if (isset($_param[0]) && isset($_param[1])) {
    				$arguments[$_param[0]] = $_param[1];
    			}
    		}
    	}
    }
    // remove empty blocks
    foreach($items as $key => $value) {
      if (strlen($value) == 0) unset($items[$key]);
    }
    // extract data
    if (count($items)) {
      $this->controller = array_shift($items);
      $this->action = array_shift($items);
    }
    $this->params = (count($arguments)>0)?$arguments:NULL;
  }

  public function init() {
	$url = (isset($_GET['route']))?$_GET['route']:'';
	if ($url!=='') {
		$this->set_routing(urldecode($url));
	}
  	 
  	//if (!strlen($this->controller)) { $this->controller = 'backlinks'; }
  if (!strlen($this->controller)) { $this->controller = 'ads'; }
  	if (!strlen($this->action)) 	{ $this->action 	= 'index'; }
  }
  public function getController() 	{ return $this->controller; }
  public function getAction() 		{ return $this->action; }
  public function getParams() 		{ return $this->params; }
}

?>