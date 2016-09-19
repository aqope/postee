<?php
/*
 * author: Artur Paklin
 * package: core
 * class: extension_layout_autoload
 */
class Core_Extension_Layout_Autoload  {
    /**
     * Hold blocks loaded from /etc/blocks.xml
     * @var SimpleXMLElement[]
     */
	private $_blocksXML;
	
	/**
	 * Preloads basic blocks froms xmls
	 */
	
	public function __construct()
	{
		// Blocks including part
		$blockPath = Core_Core::$_path . '/etc/blocks.xml';
        $routeLink = Router::$_route_link;

		if (file_exists($blockPath)) {
			$xml = new Core_Utils_Xml();
			$xmlBlocks = $xml->open($blockPath);
            $basePage = '';
            $package = '';
            $content = '';
            if (!empty($xmlBlocks->config->$routeLink)) {
                if (!empty($xmlBlocks->config->$routeLink->base)) {
                    $basePage = $xmlBlocks->config->$routeLink->base;
                } else {
                    $basePage = $xmlBlocks->config->default->base;
                }

                if (!empty($xmlBlocks->config->$routeLink->package)) {
                    $package = $xmlBlocks->config->$routeLink->package;
                } else {
                    $package = $xmlBlocks->config->default->package;
                }

                if (!empty($xmlBlocks->config->$routeLink->content)) {
                    $content = $xmlBlocks->config->$routeLink->content;
                } else {
                    $content = $xmlBlocks->config->default->content;
                }
            } else {
                $package = $xmlBlocks->config->default->package;
                $basePage = $xmlBlocks->config->default->base;
                $content = $xmlBlocks->config->default->content;
            }
			Core_Core::$_layout->setConfig(
				$basePage,
				$package,
                $content
			);
			$this->_blocksXML = $xmlBlocks->blocks;
									
			Core_Core::$_layout->setBlockEnum($this->_blocksXML);

		}
		
		// Layout processing entry <defualt>
		$layoutPath = Core_Core::$_path . '/etc/layout.xml';
		if (file_exists($layoutPath)) {
			$xml = new Core_Utils_Xml();
			$layouts = $xml->open($layoutPath);
			foreach($layouts->default->block as $block) {
				$this->includeBlock($block['name']);
			}


            if ($layouts->$routeLink->block) {
                foreach ($layouts->$routeLink->block as $block) {
                    $this->includeBlock($block['name']);
                }
            }
		}
	}
	
	/**
	 * Includes Block by name
	 */
	
	public function includeBlock($_name)
	{
		$blockPath = $this->searchInBlocks($_name);

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