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
        $sessionModel = Core_Core::getModel('admin/session');
        $urlModel = Core_Core::getModel('core/url');
        if ($sessionModel->isLogged()) {
            $sessionModel->updateSessionCookie();
            echo "<h1> YOU ARE LOGGED IN </h1>";
        } else {
            $urlModel->redirect(
                $urlModel->getBaseUrl() . "admin/index/login/"
            );
        }
    }

    public function authorizeAction()
    {
        $username = $_POST['user'];
        $pass = md5($_POST['pass']);

        $urlModel = Core_Core::getModel('core/url');
        $sessionModel = Core_Core::getModel('admin/session');
        $authorized = $sessionModel->isLogged();

        if ($authorized == false) {
            $sessionModel->createSession($username, $pass);
            $urlModel = Core_Core::getModel('core/url');
            $urlModel->redirect($urlModel->getBaseUrl() . 'admin/index/index/',
                array('key' => $sessionModel->getPublicKey()));
        } else {
           $urlModel->redirect($urlModel->getBaseUrl() . 'admin/index/index/',
               array('key' => $sessionModel->getPublicKey()));

        }
    }
}