<?php

namespace Student\PowerModule\Plugin;

use Vovayatsyuk\Alsoviewed\Block\ListProduct;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class AlsoViewedListProduct
{
    private $prod_collection_factory;

    public function __construct(CollectionFactory $prod_collection_factory)
    {
        $this->prod_collection_factory = $prod_collection_factory;
    }

    public function afterToHtml(
        ListProduct $subject,
        $result
    ) {

    }

    public function afterGetLoadedProductCollection(
        ListProduct $subject,
        $result
    ) {

        //exit if not our template is used
        if ($subject->getTemplate() !== 'Student_PowerModule::widget/also_viewed_power.phtml') {
            return $result;
        }

        //$products = $subject->getChildBlock('products');
        $result = $this->prod_collection_factory
            ->create()
            ->addFieldToFilter('entity_id', 0);

        return $result;
    }
}
