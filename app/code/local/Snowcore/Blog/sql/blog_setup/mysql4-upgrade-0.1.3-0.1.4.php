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
DROP TABLE IF EXISTS {$this->getTable('blog_comments')};
CREATE TABLE {$this->getTable('blog_comments')} (
`comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`article_id` int(10) unsigned NOT NULL,
`slug` varchar(150) NOT NULL,
`user_name` text,
`user_email` text,
`content` text,
`meta_keywords` varchar(255) NOT NULL DEFAULT '',
`meta_description` varchar(160) NOT NULL DEFAULT '',
`created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`comment_id`)
) ENGINE=InnoBD DEFAULT CHARSET=utf8;
");

$installer->endSetup();