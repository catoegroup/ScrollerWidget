<?php
class SUMOHeavy_ScrollerWidget_Model_Source_Category
    extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element
{
    public function toOptionArray($isMultiselect=false)
    {
        $categories = Mage::getModel('scrollerwidget/category')
            ->getCollection();

        $cats = array(0 => '');
        foreach($categories as $cat) {
            $cats[$cat->getId()] = $cat->getName();
        }

        return $cats;
    }
}
