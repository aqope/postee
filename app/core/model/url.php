<?php

class Core_Model_Url extends Core_Model_Config
{
    protected $_base_url;
    protected $_absolute_base_url;

    public function __construct()
    {
        $this->_table = 'core_config';
        $col =  $this->getConfigByKey(array("base_url", "absolute_base_url"))
            ->load()
            ->getCollection();

        $this->_base_url = $col['base_url'];
        $this->_absolute_base_url = $col['absolute_base_url'];
    }

    public function getBaseUrl()
    {
        return $this->_base_url;
    }

    public function getAbsoluteBaseUrl()
    {
        return $this->_absolute_base_url;
    }

    public function redirect($_url, $_params = array())
    {
        $values = "";
        if (!empty($_params)) {
            foreach ($_params as $key => $value) {
                $values .= $key . '/' . $value .'/';
            }
        }
        header("Location: " . $_url . $values);
    }

}