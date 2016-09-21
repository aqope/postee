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
	}

	public function editAction() 
	{
	}
}