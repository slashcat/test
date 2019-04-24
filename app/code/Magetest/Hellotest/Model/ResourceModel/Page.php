<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magetest\Hellotest\Model\ResourceModel;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Model\Page as CmsPage;
use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;


/**
 * Cms page mysql resource
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Page extends AbstractDb
{
    

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cms_page', 'page_id');
    }


    public function getCmsStoreByWId($id)
    {
	    $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
	    $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
	    $connection = $resource->getConnection();
	    $tableNamebb = $resource->getTableName('store'); //gives table name with prefix
	    $tableb = $resource->getTableName('cms_page_store'); //gives table name with prefix
	    $sqlb = "select * from ".$tableNamebb." where website_id=".$id;
	    return  $connection->fetchAll($sqlb); // gives associated array, table fields as key in array.
    }


}
