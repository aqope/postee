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
        $blockXMLPath = Router::$_basePath . '/config/layout.xml';
        $routeLink = Router::$_route_link;

        if (file_exists($blockXMLPath)) {
            $xml = new Core_Utils_Xml();
            $xmlBlocks = $xml->open($blockXMLPath);
            $configs = array();

            // including default config information and
            // default blocks

            $configs['base'] = (string)$xmlBlocks->config->base;
            $configs['package'] = (string)$xmlBlocks->config->package;
            $configs['content'] = (string)$xmlBlocks->config->content;

            Core_Core::$_layout->setDefaultConfig(
                $configs['base'],
                $configs['package'],
                $configs['content']
            );
            $blockEnum = array();
            $defaultBlocks = $xmlBlocks->blocks->default;

            if (count($defaultBlocks->block) > 0) {
                foreach ($defaultBlocks->block as $block) {
                    $item = array(
                        'name' => (string)$block['name'],
                        'class' => (string)$block['class'],
                        'template' => (string)$block['template']
                    );

                    if (array_search((string)$block['name'],
                           array_column($blockEnum, 'name')) === false ) {
                        array_push($blockEnum, $item);
                    }
                }
            }

            $extensionName = explode('_', $routeLink)[0];
            $routeExtensionDefaults = $xmlBlocks->blocks->$extensionName;

            if (count($routeExtensionDefaults) > 0) {
                if (!empty($routeExtensionDefaults->config)) {
                    if (!empty($routeExtensionDefaults->config->base)) {
                        $configs['base'] = (string)$routeExtensionDefaults->config->base;
                    }

                    if (!empty($routeExtensionDefaults->config->package)) {
                        $configs['package'] = (string)$routeExtensionDefaults->config->package;
                    }

                    if (!empty($routeExtensionDefaults->config->content)) {
                        $configs['content'] = (string)$routeExtensionDefaults->config->content;
                    }
                }

                foreach ($routeExtensionDefaults->block as $block) {
                    $item = array(
                        'name' => (string)$block['name'],
                        'class' => (string)$block['class'],
                        'template' => (string)$block['template']
                    );

                    if (array_search((string)$block['name'],
                            array_column($blockEnum, 'name')) === false ) {
                        array_push($blockEnum, $item);
                    }
                }
            }

            $routeBlocks = $xmlBlocks->blocks->$routeLink;

            if (count($routeBlocks) > 0) {
                if (!empty($routeBlocks->config)) {
                    if (!empty($routeBlocks->config->base)) {
                        $configs['base'] = (string)$routeBlocks->config->base;
                    }

                    if (!empty($routeBlocks->config->package)) {
                        $configs['package'] = (string)$routeBlocks->config->package;
                    }

                    if (!empty($routeBlocks->config->content)) {
                        $configs['content'] = (string)$routeBlocks->config->content;
                    }
                }

                foreach ($routeBlocks->block as $block) {
                    $item = array(
                        'name' => (string)$block['name'],
                        'class' => (string)$block['class'],
                        'template' => (string)$block['template']
                    );

                    if (array_search((string)$block['name'],
                            array_column($blockEnum, 'name')) === false ) {
                        array_push($blockEnum, $item);
                    }
                }
            }
            $this->_blocksXML = $blockEnum;
            Core_Core::$_layout->setConfig(
                $configs['base'],
                $configs['package'],
                $configs['content']
            );
            Core_Core::$_layout->setBlockEnum($this->_blocksXML);

            foreach($this->_blocksXML as $block) {
                if (!empty((string)$block['class'])) {
                    $this->includeBlock($block['name']);
                }
            }
        }
    }

    /**
     * Includes block class and dependencies
     * @param $_name
     */
	
	public function includeBlock($_name)
	{
		$item = $this->searchInBlocks($_name);
		if ($item['full_path']) {
		    if (file_exists(Router::$_basePath . $item['full_path'])) {
		        if ($this->loadDependencyByClass($item['class'])) {
                    include_once(Router::$_basePath . $item['full_path']);
                }
            }
		}
	}

    /**
     * Loads Dependencies for Block by Class
     * One to one same as for Model
     * @param $_class
     * @return bool
     */
    private function loadDependencyByClass($_class)
    {
        $classElements = explode('_', $_class);

        foreach ($classElements as $key => $value) {
            $classElements[$key] = lcfirst($value);
        }
        $path = implode('/', $classElements);
        $path = Router::$_basePath . '/' . $path . '.php';

        $fp = fopen($path,'r');
        $buffer = fread($fp, filesize($path));
        $extendClass = null;
        while ($buffer) {
            if (preg_match('/(extends)\s(\w+)/', $buffer, $matches)) {
                $extendClass = $matches[2];
                break;
            }
            $buffer = fread($fp, filesize($path));
        }
        if ($extendClass) {
            if (self::loadDependencyByClass($extendClass)) {
                include_once($path);
                return true;
            }
        } else {
            include_once($path);
            return true;
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
			foreach($this->_blocksXML as $block) {
				if ((string)$block['name'] == $_name && (string)$block['class'] != '') {
					$fullPath = (string)$block['class'];
                    $class = (string)$block['class'];
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
            $result = array(
                'full_path' => $fullPath,
                'class' => $class
            );
			return $result;
		} else {
			return false;
		}
	}
}