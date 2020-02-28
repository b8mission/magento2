<?php

namespace Student\PowerModule\Model;

use Magento\Framework\Model\AbstractModel;

class Data extends AbstractModel
{

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Student\PowerModule\Model\ResourceModel\Data');
    }

}