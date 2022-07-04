<?php
namespace OmnyfyCustomization\UploadFile\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('changi_resource_file'))
            ->addColumn('entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'ID')
            ->addColumn('file_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 20, [], 'File Name')
            ->setComment('File Upload');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}