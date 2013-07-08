<?php
class Snowcore_Blog_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml';

        parent::__construct();

        $this->_updateButton('save','label',$this->__('Save Article'));
        $this->_updateButton('delete','label',$this->__('Delete Article'));
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
}