<?php

/*
 * author: Artur Paklin
 * package: core
 * class: model_posts
 */
class Core_Model_Posts extends Core_Model_Abstract
{
    public function __construct()
    {
        $this->_table = 'core_posts';
        $this->_query = 'SELECT * FROM `' . $this->_table . '`';
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


