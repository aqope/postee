<?php

/*
 * author: Artur Paklin
 * package: core
 * class: router
 */

class Router 
{
	public static $_routes;
	public static $_basePath;
	public static $_root_path;
	public static $_template_path;
	public static $_route_link;
    public static $_url_data;
	
    public static function start()
    {
		// Setting Global Variables
    	self::$_basePath = realpath("app/");
        self::$_root_path = realpath("");
        self::$_template_path = realpath("template/");
    	self::$_routes = array();
    	$url = $_SERVER['REQUEST_URI'];
        $url = substr($url, strpos($url, "index.php"));
        $url = substr($url, strlen("index.php"));
        $urlExp = explode("/", $url);

        /* Fix for Core Routes */


        if ( strlen(implode("", $urlExp))  > 1) {

        // Since $urlExp[0] is always ""
        if (!empty($urlExp[1])) {
        	$extension = $urlExp[1];	
        }
       	
       	// May be this will be needed to be optimized
        // for better performance
       	
		  // initializing Controller Class
       	if (!empty($extension)) {
       		if (!empty($urlExp[2])) {
       			$controller = $urlExp[2];
       		} else {
                $controller = "index";
            }
       		if (!empty($urlExp[3])) {
       			$action = $urlExp[3];	
       		} else {
       		    $action = "index";
            }
       	} else {
       		// default functionality built in into Core
       		if (!empty($urlExp[1])) {
       			$controller = $urlExp[1];
       		} else {
                $controller = "index";
            }
       		if (!empty($urlExp[2])) {
       			$action = $urlExp[2];	
       		} else {
       		    $action = "index";
            }
       	}
       } else {             
          // Default Index Action in Index Controller
          $extension = "core";
          $controller = "index";
          $action = "index";
       }
        $urlData = array_splice($urlExp, 4);

        if (count($urlData) >= 2) {
            self::$_url_data = array();
            $coin = false;
            foreach($urlData as $item) {
                if ($coin == false) {
                    $key = $item;
                    $coin = true;
                } else {
                    $value = $item;
                    self::$_url_data[$key] = $value;
                    $coin = false;
                }
            }
        }


       	$controllerPath = self::$_basePath;
       	$actionMethod = array();

       	if ( (!empty($controller) && !empty($extension)) && $extension != $controller) {
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

       		
	       		if (!empty($action)) {
	       			$method = $action . "Action";	
	       		} else {
					$action = "index";
	       			$method = "indexAction";
	       		}
       		}
       	} else {
          // Handle for 404 existing route
        }

        if ($extension) {
            self::$_route_link = $extension;

            if ($controller) {
                self::$_route_link .= '_' . $controller;
                if ($action) {
                    self::$_route_link .= '_' . $action;
                } else {
                    self::$_route_link .= '_index';
                }
            }
        }
		self::loadCore();
		if (!empty($actionClass) && class_exists($actionClass)) {
			$class = new $actionClass();
			if (!empty($method) && method_exists($class, $method)) {
	       			$class->$method();
            }
		}
		var_dump(self::$_route_link);

     	
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

