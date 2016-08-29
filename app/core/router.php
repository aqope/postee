<?php

/*
 * author: Artur Paklin
 * package: core
 * class: Router
 */

class Router 
{
	public static $_routes;
	public static $_basePath;
  public static $_root_path;
  public static $_template_path;

    public static function start()
    {
		// Setting Global Variables
    	self::$_basePath = realpath("app/");
      self::$_root_path = realpath("");
      self::$_template_path = realpath("template/");
    	self::$_routes = array();
    	self::loadCore();
        $url = $_SERVER['REQUEST_URI'];
        $url = substr($url, strpos($url, "index.php"));
        $url = substr($url, strlen("index.php"));
        $urlExp = explode("/", $url);
        
      if ( strlen(implode("", $urlExp))  > 1) {        

        // Since $urlExp[0] is always ""
        if (!empty($urlExp[1])) {
        	$extension = $urlExp[1];	
        }
       	
       	// May be this will be needed to be optimized
        // for better performance
       	
		  // initializing Controller Class
        var_dump($extension);
       	if (!empty($extension) && in_array($extension, self::$_routes)) {
       		if (!empty($urlExp[2])) {
       			$controller = $urlExp[2];
       		}
       		if (!empty($urlExp[3])) {
       			$action = $urlExp[3];	
       		}
       	} else {
       		// default functionality built in into Core
       		if (!empty($urlExp[1])) {
       			$controller = $urlExp[1];
       		}
       		if (!empty($urlExp[2])) {
       			$action = $urlExp[2];	
       		}
       	}
       } else {             
          // Default Index Action in Index Controller
          $extension = "core";
          $controller = "index";
          $action = "index";
       }
       	$controllerPath = self::$_basePath;
       	$actionMethod = array();

       	if (!empty($extension) && $extension != $controller) {
       		$controllerPath .= "/" . $extension;
       		array_push($actionMethod, ucfirst($extension));
       		array_push($actionMethod, ucfirst("controller"));
       	} else {
       		$controllerPath .= "/" . "core";
       		array_push($actionMethod, ucfirst("core"));
       		array_push($actionMethod, ucfirst("controller"));
       	}

       	$controllerPath .= "/controller";

       	if (!empty($controller)) {
       		$controllerPath .= "/" . $controller;
       		array_push($actionMethod, ucfirst($controller));
       	} else {
       		array_push($actionMethod, ucfirst("index"));
       	}

       	$controllerPath .= ".php";
       	
       	if (file_exists($controllerPath)) {
       		include_once($controllerPath);	
       		$actionClass = implode("_", $actionMethod);
       		
       		if (class_exists($actionClass)) {
       		$class = new $actionClass();
	       		if (!empty($action)) {
	       			$method = $action . "Action";	
	       		} else {
	       			$method = "indexAction";
	       		}
	       		
	       		if (method_exists($class, $method)) {
	       			$class->$method();
	       		}
       		}	
       	} else {
          // Handle for 404 existing route
        }
     	
        // self::getExtensions();
    }
	
	private static function loadCore()
	{
		new Core_Core();
	}

	/*
	 * Adds to Extensions array, extension name
	 * if matches then loads controller from
	 * extension directory
	 */

	public static function addPackageRoute($_packageUrl = "")
	{
		if ($_packageUrl != "") {
			array_push(self::$_routes, $_packageUrl);
		}
	}
}

