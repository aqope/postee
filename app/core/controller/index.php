<?php
/*
 * author: Artur Paklin
 * package: core
 * class: controller_index
 */

class Core_Controller_Index
{

	public function __construct()
	{
		
		if (file_exists(__DIR__ . "/../block/abstract.php"))
		{
			include_once(__DIR__ . "/../block/abstract.php");
			new Core_Block_Abstract();
		}
	}

	public function indexAction()
	{

		var_dump("Default Index Action");
	}

	public function editAction() 
	{
		var_dump("Not Implemented Yet");
	}
}