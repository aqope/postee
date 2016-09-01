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
		$block = new Core_Block_Abstract();
		$block->getLayout();
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