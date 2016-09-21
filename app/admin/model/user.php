<?php

class Admin_Model_User extends Admin_Model_Admin
{
    public function __construct()
    {
        $this->_table = 'core_users';
        $this->_query = "SELECT ";
    }

    public function addColSelect($_col)
    {

    }

    public function addAuthorizeSelect($_username)
    {
        $this->_query = "SELECT `username`, `password`, `role`, `session` 
            FROM `core_users` WHERE `username` = '" . $_username . "';";

        return $this;
    }

    /**
     * Loads posts data from database and stores
     * in Collection array
     * @return $this
     */
    public function load()
    {
        $sql = new Core_Utils_Sql();
        $result = $sql->runQuery($this->_query);
        $_collection = array();

        while($row = $result->fetch_assoc()) {
            array_push($_collection, array(
                'username' => $row['username'],
                'password' => $row['password'],
                'role' => $row['role'],
                'session' => $row['session']
            ));
        }

        $this->_collection = $_collection;
        return $this;
    }

}