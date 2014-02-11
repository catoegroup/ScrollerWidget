<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Category_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'scrollerwidget';
        $this->_controller = 'adminhtml_category';

        if($this->getRequest()->getParam($this->_objectId) ) {
            $model = Mage::getModel('scrollerwidget/category')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('scrollerwidget_category_data', $model);
        } elseif (($sessVD = Mage::getSingleton('adminhtml/session')->getData('scrollerwidget_category_edit_data', true))) {
            $model = Mage::getModel('scrollerwidget/category')->setData($sessVD);
            Mage::register('scrollerwidget_category_data', $model);
        }

    }

    public function getHeaderText()
    {
        if( Mage::registry('scrollerwidget_category_data') && Mage::registry('scrollerwidget_category_data')->getId() ) {
            return Mage::helper('scrollerwidget')->__("Edit Scroller Widget Category #%s", $this->htmlEscape(Mage::registry('scrollerwidget_category_data')->getId()));
        } else {
            return Mage::helper('scrollerwidget')->__('New Scroller Widget Category');
        }
    }
}
