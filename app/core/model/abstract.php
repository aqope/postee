<?php

class Core_Model_Abstract
{
    protected $_table;
    protected $_collection;
    protected $_query;

    public function __construct()
    {

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
}