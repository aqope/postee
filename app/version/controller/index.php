<?php

class Version_Controller_Index
{
	public function indexAction()
	{
		var_dump('action called from version/controller/index');
		var_dump(class_exists(Core_Block_Abstract));
		
	}
}