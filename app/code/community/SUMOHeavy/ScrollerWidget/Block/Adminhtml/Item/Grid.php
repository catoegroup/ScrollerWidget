<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Item_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('scrollerwidgetItemGrid');
        $this->setDefaultSort('item_id');
        $this->setDefaultDir('DESC');

        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('scrollerwidget/item')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('item_id', array(
            'header'    => Mage::helper('scrollerwidget')->__('ID'),
            'index'     => 'item_id',
            'type'      => 'number',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('scrollerwidget')->__('Text'),
            'index'     => 'name',
            'type'      => 'text',
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('scrollerwidget')->__('Status'),
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                0 => 'Disabled',
                1 => 'Enabled',
            ),
        ));

        $categories = Mage::getModel('scrollerwidget/category')
            ->getCollection();

        $cats = array();
        foreach($categories as $cat) {
            $cats[$cat->getId()] = $cat->getName();
        }

        $this->addColumn('category_id', array(
            'header'    => Mage::helper('scrollerwidget')->__('Category'),
            'index'     => 'category_id',
            'type'      => 'options',
            'options'   => $cats,
        ));

        $this->addColumn('sort_order', array(
            'header'    => Mage::helper('scrollerwidget')->__('Sort Order'),
            'index'     => 'sort_order',
            'type'      => 'number',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('scrollerwidget')->__('Created At'),
            'index'     => 'created_at',
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
