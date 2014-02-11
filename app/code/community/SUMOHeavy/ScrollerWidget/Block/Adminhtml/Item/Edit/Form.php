<?php
class SUMOHeavy_ScrollerWidget_Block_Adminhtml_Item_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $itemData = Mage::registry('scrollerwidget_item_data');
        $hlp = Mage::helper('scrollerwidget');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')
            ->getConfig(
                array(
                    'add_variables' => false,
                    'add_widgets' => false,
                    'files_browser_window_url' => $this->getUrl().'admin/cms_wysiwyg_images/index/'
                )
            );

        $fieldset = $form->addFieldset('general_form', array(
            'legend' => $hlp->__('General')
        ));

        $fieldset->addField('name', 'editor', array(
            'name'      => 'name',
            'label'     => $hlp->__('Text'),
            'class'     => 'required-entry',
            'style'     => 'width:700px;height:175px;',
            'config'    => $wysiwygConfig,
            'wysiwyg'   => true,
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => $hlp->__('Status'),
            'class'     => 'required-entry',
            'required'  => true,
            'options'   => array(
                0 => 'Disabled',
                1 => 'Enabled',
            ),
        ));

        $categories = Mage::getModel('scrollerwidget/category')
            ->getCollection();

        $cats = array('' => '');
        foreach($categories as $cat) {
            $cats[$cat->getId()] = $cat->getName();
        }

        $fieldset->addField('category_id', 'select', array(
            'name'      => 'category_id',
            'label'     => $hlp->__('Category'),
            'class'     => 'required-entry validate-select',
            'required'  => true,
            'options'   => $cats,
        ));

        $fieldset->addField('sort_order', 'text', array(
            'name'      => 'sort_order',
            'label'     => $hlp->__('Sort Order'),
            'class'     => 'required-entry',
            'required'  => true,
            'value'   => 0,
        ));

        if($itemData) {
            $form->setValues($itemData->getData());
        }

        return parent::_prepareForm();
    }

}
