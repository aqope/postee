<?php

class Core_Block_Header_Includes extends Core_Block_Abstract
{
    public $_template;

	public function __construct($_template)
	{
	    $model = Core_Core::getModel('core/posts');
	    $this->_template = $_template;
		$this->toHtml();
	}
	public function getBaseUrl()
    {
        return Router::$_basePath;
    }
}