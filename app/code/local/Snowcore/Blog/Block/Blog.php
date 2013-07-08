<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alex Smith
 * Date: 25.06.13
 * Time: 16:19
 * To change this template use File | Settings | File Templates.
 */

class Snowcore_Blog_Block_Blog extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $collection = Mage::getModel('blog/article')->getCollection();
        $this->setCollection($collection);
    }

    public function loaditem()
    {
        $slug = $this->getRequest()->getParam('slug');
        $id = $this->getRequest()->getParam('id');
        return Mage::getModel('blog/article')->loaditem($slug, $id);
    }
}