<?php
class SUMOHeavy_ScrollerWidget_Adminhtml_ItemController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
             ->_setActiveMenu('cms/scrollerwidget/item')
             ->_addBreadcrumb($this->__('Scroller Widget Item'), Mage::helper('scrollerwidget')->__('CMS'));

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
            $model = Mage::getModel('scrollerwidget/item');
            $id = $this->getRequest()->getParam('id');
            if($id) {
                $model->load($id);
            }

            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                try {
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('image');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);

                    $path  = Mage::getBaseDir() . DS . "media" . DS . 'imageslistwidget';
                    $uploader->save($path, $_FILES['image']['name']);
                    $data['image'] = 'imageslistwidget' . DS . $uploader->getUploadedFileName();
                } catch (Exception $e) {}
            } elseif(isset($data['image']['value'])) {
                if(isset($data['image']['delete'])) {
                    $data['image'] = '';
                } else {
                    $data['image'] = $data['image']['value'];
                }
            }

            $model->setData($data);

            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if($id) {
                    $model->setId($id);
                }
                $model->save();

                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('scrollerwidget')->__('Error when saving item.'));
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('scrollerwidget')->__('Item was successfully saved.'));
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
                $model = Mage::getModel('scrollerwidget/item');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('scrollerwidget')->__('The item has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('scrollerwidget')->__('Unable to find the item to delete.'));
        $this->_redirect('*/*/');
    }
}
