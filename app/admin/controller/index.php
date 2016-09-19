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
}