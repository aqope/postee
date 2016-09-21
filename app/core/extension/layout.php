<?php

class Core_Extension_Layout
{
    private $_blockEnum;
    private $_config;
    private $_defaultConfig;
    
    public function __construct()
    {
        $this->_blockEnum = '';
    }
    
    public function getBlockEnum()
    {
        return $this->_blockEnum;
    }
    
    public function setBlockEnum($_blockXML)
    {
        $this->_blockEnum = $_blockXML;
    }
    
    public function setConfig($_base, $_package, $_content)
    {
        $this->_config = array();
        $this->_config['base'] = $_base;
        $this->_config['package'] = $_package;
        $this->_config['content'] = $_content;
    }
    
    public function getConfigBase()
    {
        if (!empty($this->_config['base'])) {
            return $this->_config['base'];
        } else {
            return false;
        }
    }
    
    public function getConfigPackage()
    {
        if (!empty($this->_config['package'])) {
            return $this->_config['package'];
        } else {
            return false;
        }
    }

    public function getConfigContent()
    {
        if (!empty($this->_config['content'])) {
            return $this->_config['content'];
        } else {
            return false;
        }
    }

    public function setDefaultConfig($_base, $_package, $_content)
    {
        $this->_defaultConfig = array();
        $this->_defaultConfig['base'] = $_base;
        $this->_defaultConfig['package'] = $_package;
        $this->_defaultConfig['content'] = $_content;
    }

    public function getDefaultConfigBase()
    {
        if (!empty($this->_defaultConfig['base'])) {
            return $this->_defaultConfig['base'];
        } else {
            return false;
        }
    }

    public function getDefaultConfigPackage()
    {
        if (!empty($this->_defaultConfig['package'])) {
            return $this->_defaultConfig['package'];
        } else {
            return false;
        }
    }

    public function getDefaultConfigContent()
    {
        if (!empty($this->_defaultConfig['content'])) {
            return $this->_defaultConfig['content'];
        } else {
            return false;
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
		if ($this->_blockEnum != null) {
			foreach($this->_blockEnum->block as $block) {
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

	public function containsInLayout($_name)
    {
        foreach ($this->_blockEnum as $block) {
            if ($block['name'] == $_name) {
                return true;
            }
        }

        return false;
    }
}