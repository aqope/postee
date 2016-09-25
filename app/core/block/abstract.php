<?php

class Core_Block_Abstract
{
    public $_template;
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
        if (Core_Core::$_layout->containsInLayout($_block_name)) {
            foreach(Core_Core::$_layout->getBlockEnum() as $block) {
                if ($block['name'] == $_block_name) {
                    if ($block['class'] && (string)$block['class'] != "") {
                        // using specified class
                        $blockPaths = explode("_", $block['class']);
                        foreach ($blockPaths as $key => $value) {
                            $blockPaths[$key] = lcfirst($value);
                        }

                        $blockPaths = implode("/", $blockPaths) . ".php";
                        if (file_exists(Router::$_basePath . "/" . $blockPaths)) {
                            include_once(Router::$_basePath . "/" . $blockPaths);
                            $class = (string)$block['class'];
                            new $class($this->block_base_path . $block['template']);
                        }

                    } else {
                        // use Core_Block_Abstract
                        if (file_exists($this->block_base_path . $block['template'])) {
                            include_once($this->block_base_path . $block['template']);
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
		    $packageTheme = $this->layout->getConfigPackage();
			$basePage = $this->layout->getConfigBase();
			$this->block_base_path = Router::$_template_path . "/" . $packageTheme . "/";
			$this->package = $packageTheme;

            if (file_exists($this->block_base_path . $basePage . ".phtml")) {
                include_once($this->block_base_path . $basePage . ".phtml");
            } elseif (file_exists($this->block_base_path . $this->layout->getDefaultConfigBase() . ".phtml")) {
                include_once($this->block_base_path . $this->layout->getDefaultConfigBase() . ".phtml");
            } else {
                $this->block_base_path = Router::$_template_path . "/" . $this->layout->getDefaultConfigPackage() . "/";
                include_once($this->block_base_path . $this->layout->getDefaultConfigBase() . ".phtml");
            }

		}
	}

	public function getLayout()
    {
        $this->layout = Core_Core::$_layout;
        $this->blocks = $this->layout->getBlockEnum();

        return $this;
	}

	public function getContent()
    {
        $contentPage = Core_Core::$_layout->getConfigContent();
        if ($contentPage) {
            if (file_exists($this->block_base_path . $contentPage . '.phtml')) {
                include_once($this->block_base_path . $contentPage . '.phtml');
            }
        }

        // return nothing;
    }

	protected function toHtml()
    {
        if ($this->_template) {
            include_once($this->_template);
        }
    }

    public function getBaseUrl()
    {
        $urlModel = Core_Core::getModel('core/url');
        return $urlModel->getBaseUrl();
    }

    public function getAbsoluteUrl()
    {
        $urlModel = Core_Core::getModel('core/url');
        return $urlModel->getAbsoluteBaseUrl();
    }
}