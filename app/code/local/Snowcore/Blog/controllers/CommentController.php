<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alex Smith
 * Date: 26.06.13
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

class Snowcore_Blog_CommentController extends Mage_Core_Controller_Front_Action
{
    public function submitAction()
    {
        $data = $this->getRequest()->getParams();
        $model = Mage::getModel('blog/comment');
        $model->setData($data);
        $model->save();
        $this->_redirect('blog/'.(string)$data['slug']);
    }

    public function likeAction()
    {
        $data = $this->getRequest()->getParams();
        $model = Mage::getModel('blog/comment');
        $comment = $model->load($data['comment_id']);
        $rating = $comment->getRating();
        if($data['rate'] == 'like') $rating++;
        else $rating--;

        $comment->setRating($rating);
        $comment->save();
        echo $rating;
    }

    public function setCookieAction()
    {
        $data = $this->getRequest()->getParams();
        $commented = unserialize($_COOKIE['cookie']);
        $commented[$data['comment_id']] = 1;
//        $now = Mage::getModel('core/date')->timestamp(time());
        setcookie('cookie', serialize($commented));
//        echo $commented[1],$commented[2],$commented[3];
    }

    public function checkCookieAction()
    {
        $data = $this->getRequest()->getParams();
        $commented = unserialize($_COOKIE['cookie']);
        echo $commented[$data['comment_id']];
    }
}