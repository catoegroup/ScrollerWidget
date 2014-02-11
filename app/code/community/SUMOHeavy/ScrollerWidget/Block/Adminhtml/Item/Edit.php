<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Item_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'scrollerwidget';
        $this->_controller = 'adminhtml_item';

        if($this->getRequest()->getParam($this->_objectId) ) {
            $model = Mage::getModel('scrollerwidget/item')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('scrollerwidget_item_data', $model);
        } elseif (($sessVD = Mage::getSingleton('adminhtml/session')->getData('scrollerwidget_item_edit_data', true))) {
            $model = Mage::getModel('scrollerwidget/item')->setData($sessVD);
            Mage::register('scrollerwidget_item_data', $model);
        }
    }

    protected function _prepareLayout()
    {
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head'))) {
            $block->setCanLoadTinyMce(true);
        }
        parent::_prepareLayout();
    }

    public function getHeaderText()
    {
        if( Mage::registry('scrollerwidget_item_data') && Mage::registry('scrollerwidget_item_data')->getId() ) {
            return Mage::helper('scrollerwidget')->__("Edit Scroller Widget Item #%s", $this->htmlEscape(Mage::registry('scrollerwidget_item_data')->getId()));
        } else {
            return Mage::helper('scrollerwidget')->__('New Scroller Widget Item');
        }
    }
}
