<?php
class Snowcore_Blog_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout()
            ->renderLayout();
    }

    public function viewAction()
    {
        $this->loadLayout()
            ->renderLayout();
    }
}
