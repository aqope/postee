<?php
/*
 * author: Artur Paklin
 * package: core
 * class: extension_layout_autoload
 */
class Core_Extension_Layout_Autoload  {
	
	private $_blocksXML;
	
	/**
	 * Preloads basic blocks froms xmls
	 */
	
	public function __construct()
	{
		// Blocks including part
		$blockPath = Core_Core::$_path . '/etc/blocks.xml';
		if (file_exists($blockPath)) {
			
			$xml = new Core_Utils_Xml();
			$this->_blocksXML = $xml->open($blockPath)
									->blocks;
			var_dump($this->_blocksXML);
		}
		
		// Layout processing entry <defualt>
		$layoutPath = Core_Core::$_path . '/etc/layout.xml';
		if (file_exists($layoutPath)) {
			$xml = new Core_Utils_Xml();
			$layouts = $xml->open($layoutPath);
			foreach($layouts->default->block as $block) {
				$this->includeBlock($block['name']);
			}			
		}
	}
	
	/**
	 * Includes Block by name
	 */
	
	public function includeBlock($_name)
	{
		$blockPath = $this->searchInBlocks($_name);
		var_dump($blockPath);
		if ($blockPath) {
			
			include_once(Router::$_basePath . $blockPath);
		}
	}
	
	/**
	 * Searches in Block Object for specific block by name
	 */
	
	private function searchInBlocks($_name)
	{
		$fullPath = '';
		$class = '';
		if ($this->_blocksXML != null) {
			foreach($this->_blocksXML->block as $block) {
				if ((string)$block->name == $_name && (string)$block->class != '') {
					$fullPath = (string)$block->class;
					var_dump($fullPath);
					break;
				}
			}
		}
		if ($fullPath != '') {
			$fullPath = explode('_', $fullPath);
			foreach($fullPath as $key => $value) {
				$fullPath[$key] = lcfirst($value);
			}
			$fullPath = implode('/', $fullPath);
			$fullPath = '/' . $fullPath . '.php';
			return $fullPath;
		} else {
			return false;
		}
	}
}