<?php

namespace Student\PowerModule\Model\Config\Source;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Category implements \Magento\Framework\Option\ArrayInterface {

  public function __construct(CollectionFactory $collection_factory) {
    $this->collection_factory = $collection_factory;

  }


  public function toOptionArray() {

    return $this->getCategories();
  }


  private $collection_factory;


  private function getCategories() {

    $items = $this->collection_factory->create()
                                      ->addAttributeToSelect('name')
                                      ->addAttributeToSelect('id')
                                      ->getItems();

    $res = [];
    foreach ($items as $item) {

      $res[] = [
        'label' => "[{$item->getId()}] {$item->getName()}",
        'value' => $item->getId(),
      ];
    }

    return $res;
  }


}