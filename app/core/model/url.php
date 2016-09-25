<?php

class Core_Model_Url extends Core_Model_Abstract
{
    protected $_base_url;
    protected $_absolute_base_url;

    public function __construct()
    {
        // TODO: Load base url from database
        $this->_base_url = 'http://postee.local/index.php/';
        $this->_absolute_base_url = "http://postee.local/";
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