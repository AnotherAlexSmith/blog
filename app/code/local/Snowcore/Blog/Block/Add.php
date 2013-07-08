<?php
class Snowcore_Blog_Block_Add extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $collection = Mage::getModel('blog/comment')->getCollection();
        $this->setCollection($collection);
    }

    public function loaditemId()
    {
        $slug = $this->getRequest()->getParam('slug');
        $id = $this->getRequest()->getParam('id');
        $item = Mage::getModel('blog/article')->loaditem($slug,$id);
        return $item->getArticleId();
    }
}