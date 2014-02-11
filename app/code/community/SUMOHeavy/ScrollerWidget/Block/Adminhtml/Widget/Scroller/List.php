<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Widget_Image_List
    extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $newElement = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('btn-chooser')
            ->setLabel($this->__('New Element'))
            ->setDisabled($element->getReadonly());

        $element->setData('after_element_html', $newElement->toHtml());

        $element->setStyle('display:none;');
        $this->_element = $element;
        return $this->toHtml();
    }
}
