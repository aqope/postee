<?php

class Core_Extension_Version
{
    protected $_table;
    protected $_extensions;
    protected $_collection;

    public function __construct()
    {
        $this->_table = 'core_extension';
        $this->load();
    }

    public function load()
    {
        $query = "SELECT `extension_name`, `version` FROM `" . $this->_table . "`;";
        $sql = new Core_Utils_Sql();
        $result = $sql->runQuery($query);
        $_collection = array();
        while($row = $result->fetch_assoc()) {
            array_push($_collection, array(
                'name' => $row['extension_name'],
                'version' => $row['version']
            ));
        }
        $this->_collection = $_collection;
    }

    public function getCollection()
    {
        return $this->_collection;
    }
}