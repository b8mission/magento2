<?php

namespace Student\PowerModule\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(
      SchemaSetupInterface $setup,
      ModuleContextInterface $context
    ) {


        if (version_compare($context->getVersion(), "3.0.3", "<")) {

            $setup->getConnection()
                  ->addColumn($setup->getTable('student_powermodule_thing'),
                    'upgrade_col', [
                      'type'     => Table::TYPE_TEXT,
                      'length'   => 50,
                      'nullable' => false,
                      'comment'  => 'no comment',
                    ]);
        }

    }

}