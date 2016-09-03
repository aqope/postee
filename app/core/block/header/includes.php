<?php

class Core_Block_Header_Includes extends Core_Block_Abstract
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getBaseUrl()
    {
        return Router::$_basePath;
    }
}