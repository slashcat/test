<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magetest\Hellotest\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface {

  public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
         $tableName = $setup->getTable('store');

        if (version_compare($context->getVersion(), '1.2.0', '<')) {
         

            $setup->getConnection()->addColumn(
                    $setup->getTable('store'), 'hreflang', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 50,
                'nullable' => true,
                'default' => '',
                'comment' => 'hreflang'
                    ]
            );
        }


        $setup->endSetup();

    }

    
}
