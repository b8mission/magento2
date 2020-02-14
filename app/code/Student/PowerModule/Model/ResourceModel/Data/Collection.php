<?php

namespace Student\PowerModule\Model\ResourceModel\Data;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
          'Student\PowerModule\Model\Data',
          'Student\PowerModule\Model\ResourceModel\Data'
        );
    }
}