<?php
/*
 * author: Artur Paklin
 * package: core
 * Class: utils_xml
 *
 * Uses native SimpleXML functionality
 */
class Core_Utils_Xml
{
    private $path;
	
	public function __construct($_path = "")
    {
        $this->path = $_path;
    }
	
	/*
	 * Returns array of xml elements
	 */
	
	public function open($_path = "")
	{
		chdir(__DIR__);
		if (!$_path == "") {
			$this->path = $_path;
		}
		
        if (file_exists($this->path)) {
			return simplexml_load_file($this->path);
        } else {
			return false;
		}
	}
}
