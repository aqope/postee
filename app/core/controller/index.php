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
		var_dump('y');
		var_dump(class_exists(Core_Block_Abstract));
		$block = new Core_Block_Header_Includes();
		$block->renderLayout();
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