<?php

namespace Student\PowerModule\Helper;


class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

    public function getSelectedCategory()
    {
        $val = $this->scopeConfig->getValue('powermodule_settings/general/category');
        return $val ?? -1;
    }

    public function getEnabled()
    {
        $val = $this->scopeConfig->getValue('powermodule_settings/general/enable');

        return $val ?? false;
    }

    public function getValue($field){
        return $this->scopeConfig->getValue($field);
    }

}