<?php

namespace Student\PowerModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Data extends AbstractDb
{

    /**
     * Define main table
     */
    protected function _construct()
    {
        //$this->_init('student_powermodule_thing', 'id');
        $this->_init('student_powermodule_thing', 'test');
    }

}