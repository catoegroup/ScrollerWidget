<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Category
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'scrollerwidget';
        $this->_controller = 'adminhtml_category';
        $this->_headerText = Mage::helper('scrollerwidget')->__('Scroller Widget - Category');
        parent::__construct();
    }
}
