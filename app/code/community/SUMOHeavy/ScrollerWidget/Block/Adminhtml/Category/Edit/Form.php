<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Category_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $catData = Mage::registry('scrollerwidget_category_data');
        $hlp = Mage::helper('scrollerwidget');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('general_form', array(
            'legend' => $hlp->__('General')
        ));

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => $hlp->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
        ));

        if($catData) {
            $form->setValues($catData->getData());
        }

        return parent::_prepareForm();
    }

}
