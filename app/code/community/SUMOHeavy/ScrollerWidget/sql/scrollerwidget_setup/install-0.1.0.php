<?php
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('scrollerwidget/category'))
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Category Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
        ), 'Name')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Updated At')
    ->setComment('Scroller Widget Category Table');
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('scrollerwidget/item'))
    ->addColumn('item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Item Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Name')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
        'default'  => 1,
        ), 'Status')
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => true,
        ), 'Category')
    ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'default'  => 1,
        ), 'Sort Order')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Updated At')
    ->addIndex($installer->getIdxName('scrollerwidget/item', array('category_id')),
        array('category_id'))
    ->addForeignKey($installer->getFkName('scrollerwidget/item', 'category_id', 'scrollerwidget/category', 'category_id'),
        'category_id', $installer->getTable('scrollerwidget/category'), 'category_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Scroller Widget Item Table');
$installer->getConnection()->createTable($table);

$installer->endSetup();
