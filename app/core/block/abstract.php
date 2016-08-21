<?php

class Core_Block_Abstract
{
	public $block_template_path;
	public $block_base_path;
	public $blocks_enumurated;
	public $block_class;
	public $package;

	public function __construct()
	{
		// It is not recommended to call abstract construct elsewhere
		$callClass = get_class($this);
		$callClass = substr($callClass, strpos($callClass, 'Block_') + 6);
		$callClass = explode("_", $callClass);
		foreach($callClass as $key => $value) {
			$callClass[$key] = lcfirst($value);
		}
		$callClass = implode("_", $callClass);
		var_dump($callClass);
		$xml = new Core_Utils_Xml();
		$this->blocks_enumurated = $xml->open(realpath(__DIR__ . '/blocks.xml'));
		var_dump($this->blocks_enumurated->$callClass);
		var_dump($this->blocks_enumurated);
		$this->block_class = $callClass;
		if (!empty($this->blocks_enumurated)) {
			$packageTheme = $this->blocks_enumurated->package;
			$basePage = $this->blocks_enumurated->base;	
			$this->block_base_path = Router::$_template_path . "/" . $packageTheme . "/";
			$this->package = $packageTheme;
			include_once($this->block_base_path . $basePage . ".phtml");
			
		}

	}

	public function renderBlock($_block_name)
	{
		$blockClass = $this->block_class;
		foreach($this->blocks_enumurated->$blockClass->block as $block) {			
			if ($block->name == $_block_name) {
				if ($block->class && (string)$block->class != "") {
					// using specified class
					$blockPaths = explode("_", $block->class);
					foreach ($blockPaths as $key => $value) {
						$blockPaths[$key] = lcfirst($value);
					}

					$blockPaths = implode("/", $blockPaths) . ".php";
					var_dump($blockPaths);
					if (file_exists(Router::$_basePath . "/" . $blockPaths)) {
						include_once(Router::$_basePath . "/" . $blockPaths);
						$class = (string)$block->class;
						new $class();
					}

				} else {
					// use Core_Block_Abstract					
					if (file_exists($this->block_base_path . $block->template . ".phtml")) {
						include_once($this->block_base_path . $block->template . ".phtml");	
					}
				}
				break;
			}
		}
	}	
}