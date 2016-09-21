<?php

class Admin_Controller_Index
{
    public function __construct()
    {
        $block = new Admin_Block_Admin();
        $block->getLayout();
        $block->renderLayout();
    }

    public function indexAction()
    {
        var_dump('h');
    }

    public function authorizeAction()
    {
        $username = $_POST['user'];
        $pass = $_POST['pass'];

        $session = Core_Core::getModel('admin/session');
        $session->isLogged($username);


        var_dump($username);
        var_dump($pass);
    }
}