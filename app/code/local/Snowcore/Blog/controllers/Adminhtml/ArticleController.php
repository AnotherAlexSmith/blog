<?php
class Snowcore_Blog_Adminhtml_ArticleController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('blog/article')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Articles Manager'), Mage::helper('adminhtml')->__('Articles Manager'));
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction();
        $id = $this->getRequest()->getParam('id');
        $article = Mage::getModel('blog/article');
        if(!empty($id)) {
            $article = Mage::getModel('blog/article')->load($id);
            $this->_title('Edit Article');
        }
        else {
            $this->_title('New Article');
        }
        $data = Mage::getSingleton('adminhtml/session')->getArticleData(true);

        if(!empty($data)){
            $article->setData($data);
        }
        Mage::register('article',$article);
        $this#->_addContent($this->getLayout()->createBlock('blog/adminhtml_edit')->setData('action',$this->getUrl('*/*/save')))
            ->renderLayout();
    }

    public function saveAction()
    {
        try{
            $data = $this->getRequest()->getParams();
            $model = Mage::getModel('blog/article')->load($data['article_id']);
            $time = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
            $data['last_modified'] = $time;
            $data['slug'] = $this->str2url($data['title']);
            $model->setData($data);
            $model->save();
            if(!$data['article_id'])
            {
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Article added!'));
            }
            else
            {
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Article edited!'));
            }

            $this->_redirect('*/*/');
        }
        catch(Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__($e->getMessage()));
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {
            $data = $this->getRequest()->getParams();
//            var_dump($data);
//            exit;
            $model = Mage::getModel('blog/article');
            $article = $model->load($data['article_id']);
            $article->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Article deleted!'));
            $this->_redirect('*/*/');
        }
        catch(Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__($e->getMessage()));
            $this->_redirect('*/*/');
        }
    }

    public function rus2translit($string) {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

        );

        return strtr($string, $converter);

    }

    public function str2url($str) {

        // переводим в транслит

        $str = $this->rus2translit($str);

        // в нижний регистр

        $str = strtolower($str);

        // заменям все ненужное нам на "-"

        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

        // удаляем начальные и конечные '-'

        $str = trim($str, "-");

        return $str;

    }
}