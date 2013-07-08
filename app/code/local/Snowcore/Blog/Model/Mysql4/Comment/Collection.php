<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alex Smith
 * Date: 26.06.13
 * Time: 16:49
 * To change this template use File | Settings | File Templates.
 */
class Snowcore_Blog_Model_Mysql4_Comment_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('blog/comment');
    }
}