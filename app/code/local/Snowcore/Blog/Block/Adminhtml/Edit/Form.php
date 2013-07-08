<?php
class Snowcore_Blog_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('blog_form');
        $this->setTitle($this->__('Edit Article'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('article');

        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save',array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset',array(
            'legend'    => Mage::helper('blog')->__('Add new article'),
            'class'     => 'fieldset-wide'
        ));

        if($model->getId()){
            $fieldset->addField('article_id','hidden',array(
                'name' => 'article_id',
            ));
        }

        $fieldset->addField('title','text',array(
            'name'      => 'title',
            'label'     => Mage::helper('blog')->__('Article Name'),
            'title'     => Mage::helper('blog')->__('Article Name'),
            'required'  => true
        ));
        $fieldset->addField('content','editor',array(
            'name'      => 'content',
            'label'     => Mage::helper('blog')->__('Article Text'),
            'title'     => Mage::helper('blog')->__('Article Text'),
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'wysiwyg'   => true,
            'required'  => false
        ));
        $fieldset->addField('last_modified','label',array(
            'name'      => 'last_modified',
            'label'     => Mage::helper('blog')->__('Last Modified'),
            'title'     => Mage::helper('blog')->__('Last Modified'),
            'required'  => false
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}