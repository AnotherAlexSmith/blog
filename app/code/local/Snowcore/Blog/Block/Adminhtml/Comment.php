<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 05.07.13
 * Time: 14:18
 * To change this template use File | Settings | File Templates.
 */
class Snowcore_Blog_Block_Adminhtml_Comment extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_comment';
        $this->_blockGroup = 'blog';
        $this->_headerText = Mage::helper('blog/comment')->__('Comments Manager');
        $this->_removeButton('id_40ad8d1105213afe7a1dc026b12570a5');
        parent::__construct();
    }
}