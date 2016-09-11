<?php

/*
 * author: Artur Paklin
 * package: core
 * class: model_posts
 */
class Core_Model_Posts extends Core_Model_Abstract
{
    protected $_table;
    protected $_collection;
    protected $_query;

    public function __construct()
    {
        $this->_table = 'core_posts';
        $this->_query = 'SELECT * FROM `' . $this->_table . '`';
    }

    /**
     * Returns a collection
     * @return mixed
     */
    public function getCollection()
    {
        return $this->_collection;
    }

    /**
     * Limits return records amount
     * @param $_limit
     * @return $this
     */
    public function limit($_limit)
    {
        if (strpos($this->_query, 'LIMIT')) {
            if (is_int((int)$_limit)) {
                $this->_query .= ' LIMIT ' . (int)$_limit;
            }
        }
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
               'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'author' => $row['author'],
                'published_date' => $row['published_date'],
                'tags' => $row['tags']
            ));
        }

        $this->_collection = $_collection;
        return $this;
    }
}


