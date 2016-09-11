<?php

/*
 * author: Artur Paklin
 * package: core
 * class: block_posts
 */
class Core_Block_Posts extends Core_Block_Abstract
{
    public $_template;

    public function __construct($_template)
    {
        $this->_template = $_template;
        $this->toHtml();
    }

    /**
     * Returns first 5 posts
     * WIP
     * @return mixed
     */
    public function getPostsCollection()
    {
        $postsCollection = Core_Core::getModel('core/posts')
            ->load()
            ->limit(5)
            ->getCollection();
        return $postsCollection;
    }
}