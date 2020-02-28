<?php

namespace Student\PowerModule\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;


class Recurring implements InstallSchemaInterface
{

    public function install(
      SchemaSetupInterface $setup,
      ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        $connection = $installer->getConnection();

        $table_name = 'student_powermodule_thing';

        $table_obj = new Table();
        $table_obj->setName($table_name)
                  ->addColumn('test', Table::TYPE_INTEGER, 5);

        if (!($installer->tableExists($table_name))) {
            $connection->createTable($table_obj);
        }

        $installer->endSetup();
    }

}
