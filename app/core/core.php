<?php
/*
 * author: Artur Paklin
 * package: core
 * class: core
 */
class Core_Core 
{	
	/*
	 * Loads Package extensions
	 */

	public function __construct()
	{
		// Loading main functionality scripts
		// This may be improved
		include_once(__DIR__ . "/utils/xml.php");
		include_once(__DIR__ . "/extension/extension.php");

		$this->loadPackages();
	}
	
	/*
	 * Executes constructor which loads extensions
	 */

	public function loadPackages() 
	{
		new Core_Extension_Extension();
	}

	public function getTemplate()
	{

	}

	public function getBlock($_block_xpath) 
	{
		// version/page_header
	}
}