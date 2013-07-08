<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alex Smith
 * Date: 25.06.13
 * Time: 14:53
 * To change this template use File | Settings | File Templates.
 */

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$installer->run("
     ALTER TABLE {$this->getTable('blog/comment')} ADD rating int(10);
     ALTER TABLE {$this->getTable('blog/article')} ADD rating float(10);
     ALTER TABLE {$this->getTable('blog/article')} ADD num int(10);
");

$installer->endSetup();