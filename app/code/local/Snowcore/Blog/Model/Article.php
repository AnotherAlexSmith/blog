<?php
class Snowcore_Blog_Model_Article extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('blog/article');
    }

    public function loaditem($slug = NULL, $id = NULL)
    {
        if($slug)
        {
            $collection = Mage::getModel('blog/article')->getCollection()
                ->addFieldToFilter('slug',array('eq' => $slug));
            $item = $collection->getFirstItem();
        }
        else
        {

            $item = Mage::getModel('blog/article')->load($id);
        }
        return $item;
    }
}