<?php 

class Version_Block_Version extends Core_Block_Abstract
{
    public $_template;

	public function __construct($_template)
	{
		$this->_template = $_template;
        $this->toHtml();
	}

	public function getVersion()
    {
        return '1.0';
    }
}