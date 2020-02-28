<?php

namespace Student\PowerModule\Plugin;

use Magento\Catalog\Pricing\Price\FinalPrice;

class PricePlugin
{

    public function afterGetValue(FinalPrice $object, $result)
    {

        return $result + 0.05;
    }

}