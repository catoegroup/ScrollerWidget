<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Item
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'scrollerwidget';
        $this->_controller = 'adminhtml_item';
        $this->_headerText = Mage::helper('scrollerwidget')->__('Scroller Widget - Item');
        parent::__construct();
    }
}
