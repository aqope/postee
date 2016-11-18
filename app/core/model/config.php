<?php

/**
 * author: Artur Paklin
 * package: core
 * class: model_config
 */

class Core_Model_Config extends Core_Model_Abstract
{
    public function __construct()
    {
        $this->_table = 'core_config';
    }

    /**
     * Sets query for selecting config values
     *
     * @param $_configKey
     * @return $this|bool
     */
    public function getConfigByKey($_configKey)
    {
        $this->_query = 'SELECT * FROM `' . $this->_table . '` WHERE ';

        if (is_array($_configKey)) {
            foreach ($_configKey as $item) {
                $this->_query .= '`key` = "' . $item . '" OR ';
            }
            $this->_query = strrev(preg_replace(strrev('/ OR /'), strrev(';'), strrev($this->_query), 1));
        } else {

            if (!empty($_configKey)) {
                $this->_query .= '`key` = "' . $_configKey . ';';
            } else {
                return false;
            }
        }

        return $this;
    }

    /**
     * Loads from database configs
     *
     * @return $this
     */
    public function load()
    {
        $sql = new Core_Utils_Sql();
        $result = $sql->runQuery($this->_query);

        $_collection = array();

        while($row = $result->fetch_assoc()) {
            $_collection[$row['key']] = $row['value'];
        }

        $this->_collection = $_collection;
        return $this;
    }
}