<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 05.07.13
 * Time: 15:09
 * To change this template use File | Settings | File Templates.
 */
class Snowcore_Blog_Adminhtml_CommentController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('blog/comment')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Comment Manager'), Mage::helper('adminhtml')->__('Comment Manager'));
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->renderLayout();
    }

    public function approveAction()
    {
        $commentIds = $this->getRequest()->getParam('comment_id');
        if(!is_array($commentIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog/comment')->__('Please, select comments to approve.'));
        }
        else
        {
            $model = Mage::getModel('blog/comment');
            foreach($commentIds as $commentId)
            {
                $model->load($commentId)->setApproved(1);
                $model->save();
            }
        }
        $this->_redirect('*/*/index');
    }

    public function disapproveAction()
    {
        $commentIds = $this->getRequest()->getParam('comment_id');
        if(!is_array($commentIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog/comment')->__('Please, select comments to approve.'));
        }
        else
        {
            $model = Mage::getModel('blog/comment');
            foreach($commentIds as $commentId)
            {
                $model->load($commentId)->setApproved(0);
                $model->save();
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        $commentIds = $this->getRequest()->getParam('comment_id');
        if(!is_array($commentIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog/comment')->__('Please, select comments to approve.'));
        }
        else
        {
            $model = Mage::getModel('blog/comment');
            foreach($commentIds as $commentId)
            {
                $model->load($commentId)->delete();
            }
        }
        $this->_redirect('*/*/index');
    }
}