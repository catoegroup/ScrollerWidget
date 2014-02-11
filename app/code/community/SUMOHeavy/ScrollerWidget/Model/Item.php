<?php
class SUMOHeavy_ScrollerWidget_Model_Item extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('scrollerwidget/item');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        if(!$this->getId()) {
            $this->setCreatedAt(Mage::getSingleton('core/date')->gmtDate());
        }
        $this->setUpdatedAt(Mage::getSingleton('core/date')->gmtDate());
        return $this;
    }

    public function getImagePath()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $this->getImage();
    }
}
