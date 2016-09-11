<?php

/*
 * author: Artur Paklin
 * package: core
 * class: extension_extension
 */
 class Core_Extension_Extension
 {
	 private $_configPath = "../../config/config.xml";
	 
	 /*
	  * Loads Packages from config.xml
	  */
	 public function __construct()
	 {
		$xml = new Core_Utils_Xml($this->_configPath);
		$configArray = $xml->open()->extensions;
		
		foreach ($configArray as $item) {
			if ($item->active) {
				Router::addPackageRoute($item->getName());
				$this->loadPackage($item->path);
			}
		}		
	 }
	 
	 /*
	  * Initializes every loader class file
	  */
	 
	 private function loadPackage($_path)
	 {
		 if($_path) {
			 $fullPath = Router::$_basePath . "/" .$_path . ".php";

			 if (file_exists($fullPath)) {
				include_once($fullPath);
				
				$package = ucfirst(substr($_path, 0, strpos($_path, '/')));
				$loader = ucfirst(substr($_path, strpos($_path, '/') + 1));
				$class = $package . "_" . $loader;
				new $class();
			 }
		 } else {
			 return false;
		 }
	 }
 }
