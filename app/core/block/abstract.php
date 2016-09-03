<?php

class Core_Block_Abstract
{
	public $block_template_path;
	public $block_base_path;
	public $blocks_enumurated;
	public $block_class;
	public $package;
	public $blocks;
	public $layout;
    public $defaultLayout;

	public function __construct()
	{
		// let it be dummy for now	
	}


	/*
	 * This functions is only called from template file, otherwise
	 * it may cause instability
	 */
	public function renderBlock($_block_name)
	{
        if (Core_Core::$_layout->containsInLayout($_block_name, $this->layout)
            || (Core_Core::$_layout->containsInLayout($_block_name, $this->defaultLayout))) {
            foreach(Core_Core::$_layout->getBlockEnum()->block as $block) {
                if ($block->name == $_block_name) {
                    if ($block->class && (string)$block->class != "") {
                        // using specified class
                        $blockPaths = explode("_", $block->class);
                        foreach ($blockPaths as $key => $value) {
                            $blockPaths[$key] = lcfirst($value);
                        }

                        $blockPaths = implode("/", $blockPaths) . ".php";
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
	public function dummy()
	{

	}

	public function renderLayout()
	{
		if (!empty($this->layout) || !empty($this->defaultLayout)) {
		    $packageTheme = Core_Core::$_layout->getConfigPackage();
			$basePage = Core_Core::$_layout->getConfigBase();
			$this->block_base_path = Router::$_template_path . "/" . $packageTheme . "/";
			$this->package = $packageTheme;

			include_once($this->block_base_path . $basePage . ".phtml");
		}
	}

	public function getLayout()
    {
		$blocksXMLPath = Core_Core::$_config_path . '/layout.xml';
		if ($blocksXMLPath) {
			$xml = new Core_Utils_Xml();
			$layout = $xml->open($blocksXMLPath);
			$handle = Router::$_route_link;
			$this->layout = $layout->$handle->block;
            $this->defaultLayout = $layout->default->block;
		}
	}

	public function getBlock()
    {

    }
}