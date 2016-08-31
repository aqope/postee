<?php

class Core_Extension_Layout_Autoload  {
	public function __construct()
	{
		$layoutPath = Core_Core::$_path . '/etc/layout.xml';
		if (file_exists($layoutPath)) {
			$xml = new Core_Utils_Xml();
			$layouts = $xml->open($layoutPath);
			foreach($layouts['default'] as $block) {
				var_dump($block->getName());
			}
			
		}
	}
}