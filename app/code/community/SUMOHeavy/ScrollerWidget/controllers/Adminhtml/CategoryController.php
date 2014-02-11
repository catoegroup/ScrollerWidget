<?php
class SUMOHeavy_ScrollerWidget_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
             ->_setActiveMenu('cms/scrollerwidget/category')
             ->_addBreadcrumb($this->__('Scroller Widget Category'), Mage::helper('scrollerwidget')->__('CMS'));

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->_initAction()
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction()
            ->renderLayout();
    }

    public function saveAction()
    {
        if($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('scrollerwidget/category');
            $id = $this->getRequest()->getParam('id');
            if($id) {
                $model->load($id);
            }
            $model->setData($data);

            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if($id) {
                    $model->setId($id);
                }
                $model->save();

                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('scrollerwidget')->__('Error when saving category.'));
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('scrollerwidget')->__('Category was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                // The following line decides if it is a "save" or "save and continue"
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if ($model && $model->getId()) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
            }

            return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('scrollerwidget')->__('No data found to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('scrollerwidget/category');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('scrollerwidget')->__('The category has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('scrollerwidget')->__('Unable to find the category to delete.'));
        $this->_redirect('*/*/');
    }
}
