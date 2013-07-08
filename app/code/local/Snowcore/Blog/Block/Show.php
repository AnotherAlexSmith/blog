<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alex Smith
 * Date: 26.06.13
 * Time: 18:21
 * To change this template use File | Settings | File Templates.
 */

class Snowcore_Blog_Block_Show extends Mage_Core_Block_Template
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