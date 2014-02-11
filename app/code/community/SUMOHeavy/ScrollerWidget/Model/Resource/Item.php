<?php
class SUMOHeavy_ScrollerWidget_Model_Resource_Item
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('scrollerwidget/item', 'item_id');
    }

}
