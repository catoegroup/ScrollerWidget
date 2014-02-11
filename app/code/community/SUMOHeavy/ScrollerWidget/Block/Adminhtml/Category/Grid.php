<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Category_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('scrollerwidgetCategoryGrid');
        $this->setDefaultSort('category_id');
        $this->setDefaultDir('DESC');

        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('scrollerwidget/category')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('category_id', array(
            'header'    => Mage::helper('scrollerwidget')->__('ID'),
            'index'     => 'category_id',
            'type'      => 'number',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('scrollerwidget')->__('Name'),
            'index'     => 'name',
            'type'      => 'text',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('scrollerwidget')->__('Created At'),
            'index'     => 'created_at',
            'type'      => 'date',
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('scrollerwidget')->__('Updated At'),
            'index'     => 'updated_at',
            'type'      => 'date',
        ));

        $this->addColumn('action', array(
            'header'    => Mage::helper('scrollerwidget')->__('Action'),
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption' => Mage::helper('scrollerwidget')->__('Delete'),
                    'url'     => array(
                        'base'=> '*/*/delete',
                    ),
                    'field'   => 'id'
                ),
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
