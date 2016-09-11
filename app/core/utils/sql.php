<?php

/*
 * author: Artur Paklin
 * package: core
 * Class: utils_sql
 *
 * Native SQL functionality
 */

class Core_Utils_Sql
{
    private $_configPath = "../../config/config.xml";
    private $_credential;

    /**
     * Loads config and sets credential
     * Core_Utils_Sql constructor.
     */
    public function __construct()
    {
        $xml = new Core_Utils_Xml($this->_configPath);
        $this->_credential = $xml->open()->database;
    }

    /**
     * Opens SQL Connection with database
     * @return mysqli|null
     */
    private function openConnection()
    {
        $conn = mysqli_connect(
            $this->_credential->server,
            $this->_credential->user,
            $this->_credential->password,
            $this->_credential->db
            );
        if (!$conn->connect_error) {
            return $conn;
        } else {
            // error report that could not login into database
            return null;
        }
    }

    /**
     * Runs Native SQL
     * @param $sql
     * @return bool|mysqli_result|null
     */
    public function runQuery($sql)
    {
        if ($sql) {
            $conn = $this->openConnection();

            if ($conn) {
                $result = $conn->query($sql);
                $conn->close();
                return $result;
            }
        }
        $conn->close();
        return null;
    }
}