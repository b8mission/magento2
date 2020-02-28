<?php

namespace Student\PowerModule\Plugin;

use Vovayatsyuk\Alsoviewed\Block\ListProduct;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Registry;

class AlsoViewedListProduct
{
    private $prod_collection_factory;
    private $catalogSession;
    private $category_repository;
    private $registry;

    public function __construct(
        CollectionFactory $prod_collection_factory,
        CatalogSession $catalogSession,
        CategoryRepository $category_repository,
        Registry $registry
    ) {
        $this->prod_collection_factory = $prod_collection_factory;
        $this->catalogSession = $catalogSession;
        $this->category_repository = $category_repository;
        $this->registry = $registry;
    }

    public function afterGetLoadedProductCollection(
        ListProduct $subject,
        $result
    ) {

        //exit if not our template is used
        if ($subject->getTemplate() !== 'Student_PowerModule::widget/also_viewed_power.phtml') {
            return $result;
        }

        //return empty collection if there are also-viewed products
        if ($result->getSize() > 0){
        return $this->prod_collection_factory
            ->create()
            ->addFieldToFilter('entity_id', 0);
        }

        //else return random entities from the same category
        $category = $this->registry->registry('current_category');

        $result = $this->prod_collection_factory
            ->create()
            ->addCategoryFilter($category)
            ->addAttributeToSelect('*');

        $size = $result->getSize();
        $entities = [];
        $randoms = [];

        $data = $result->getData();

        for ($i = 0; $i < 5 && $i < $size; $i++) {
            $random = random_int(0, count($data) - 1);
            if (in_array($random, $randoms)) {
                continue;
            }

            $randoms[] = $random;
            $entities[] = $data[$random]['entity_id'];
        }

        $result->addFieldToFilter('entity_id', $entities);
        return $result;
    }
}
