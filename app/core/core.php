<?php
/*
 * author: Artur Paklin
 * package: core
 * class: core
 */
class Core_Core 
{	
	public static $_path;
	/*
	 * Loads Package extensions
	 */

	public function __construct()
	{
		self::$_path = realpath('app/core');
		// Loading main functionality scripts
		// This may be improved
		include_once(__DIR__ . "/utils/xml.php");
		include_once(__DIR__ . "/extension/extension.php");
		include_once(__DIR__ . "/extension/layout/autoload.php");

		if (file_exists(__DIR__ . "/block/abstract.php"))
		{
			var_dump(__DIR__);
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