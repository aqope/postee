<?php

class Admin_Model_Session extends Admin_Model_Admin
{
    protected $_table;
    protected $_session_table;

    public function __construct()
    {

        $this->_session_table = 'admin_session';
    }

    public function isLogged($_username)
    {
        $userModel = Core_Core::getModel('admin/user');
        $userCollection = $userModel->addAuthorizeSelect($_username)
            ->load()
            ->getCollection();
        var_dump($userCollection);
    }

    public function createSession()
    {

    }
}