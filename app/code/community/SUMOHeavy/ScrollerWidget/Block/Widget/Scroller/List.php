<?php
class SUMOHeavy_ScrollerWidget_Block_Widget_Scroller_List
    extends Mage_Catalog_Block_Product_New
    implements Mage_Widget_Block_Interface
{
    protected $_cache = 'SUMOHEAVY_SCROLLERWIDGET';

    protected function _construct()
    {
        $this->addData(array(
            'cache_lifetime'    => 1800,
            'cache_tags'        => array($this->_cache),
            'cache_key'         => $this->_cache.'_'.$this->getScrollerwidgetCategory(),
        ));
        parent::_construct();
    }

    public function getItems()
    {
        $items = Mage::getModel('scrollerwidget/item')
            ->getCollection()
            ->addFieldToFilter('category_id', $this->getScrollerwidgetCategory())
            ->addFieldToFilter('status', 1);

        $items->getSelect()->order('sort_order ASC');

        return $items;
    }
}
