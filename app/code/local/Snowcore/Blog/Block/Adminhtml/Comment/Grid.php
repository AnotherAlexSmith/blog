<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 05.07.13
 * Time: 14:33
 * To change this template use File | Settings | File Templates.
 */

class Snowcore_Blog_Block_Adminhtml_Comment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('blogCommentsGrid');
        $this->setDefaultSort('comment_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('blog/comment')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('approved', array(
            'header'    => Mage::helper('blog/comment')->__('approved'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'approved',
        ));

        $this->addColumn('article_id', array(
            'header'    => Mage::helper('blog/comment')->__('article ID'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'article_id',
        ));

        $this->addColumn('comment_id', array(
            'header'    => Mage::helper('blog/comment')->__('comment ID'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'comment_id',
        ));

        $this->addColumn('user_name', array(
            'header'    => Mage::helper('blog/comment')->__('Username'),
            'align'     => 'left',
            'index'     => 'content',
        ));

        $this->addColumn('user_email', array(
            'header'    => Mage::helper('blog/comment')->__('e-mail'),
            'align'     => 'left',
            'index'     => 'content',
        ));

        $this->addColumn('content', array(
            'header'    => Mage::helper('blog/comment')->__('Content'),
            'align'     => 'left',
            'index'     => 'content',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('comment_approvation');
        $this->getMassactionBlock()->setFormFieldName('comment_id');
        $this->getMassactionBlock()->addItem('approve', array(
            'label'=> Mage::helper('blog/comment')->__('Approve'),
            'url'  => $this->getUrl('*/*/approve', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
        ));
        $this->getMassactionBlock()->addItem('disapprove', array(
            'label'=> Mage::helper('blog/comment')->__('Disapprove'),
            'url'  => $this->getUrl('*/*/disapprove', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
        ));
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('blog/comment')->__('Delete'),
            'url'  => $this->getUrl('*/*/delete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
        ));

        return $this;
    }
}