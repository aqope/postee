<?php
/*
 * author: Artur Paklin
 * package: core
 * class: core
 */
class Core_Core 
{	
	public static $_path;
	public static $_config_path;
	public static $_layout;
	/*
	 * Loads Package extensions
	 */

	public function __construct()
	{
		self::$_path = realpath('app/core');
		self::$_config_path = realpath('app/core/etc');
		// Loading main functionality scripts
		// This may be improved
		include_once(__DIR__ . "/utils/xml.php");
		include_once(__DIR__ . "/extension/extension.php");
		include_once(__DIR__ . "/extension/layout/autoload.php");
		include_once(__DIR__ . "/extension/layout.php");
		self::$_layout = new Core_Extension_Layout();
		if (file_exists(__DIR__ . "/block/abstract.php"))
		{
			include_once(__DIR__ . "/block/abstract.php");
			new Core_Block_Abstract();
		}
		$this->loadPackages();
		$this->layoutAutoload();
	}
	
	/*
	 * Executes constructor which loads extensions
	 */

	public function loadPackages() 
	{
		new Core_Extension_Extension();
	}

	public function getBlock($_block_xpath) 
	{
		// version/page_header
	}
	public function layoutAutoload()
	{
		new Core_Extension_Layout_Autoload();
	}

}