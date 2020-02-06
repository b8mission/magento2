<?php


namespace Student\PowerModule\Block;

use Magento\Catalog\Helper\Catalog;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Collection;
use Magento\TestFramework\Event\Magento;


class PowerBlock extends \Magento\Framework\View\Element\Template {

  /**
   * Constructor
   *
   * @param \Magento\Framework\View\Element\Template\Context $context
   * @param array $data
   * @param CategoryFactory $category_factory
   * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collection_factory
   * @param \Magento\Catalog\Model\CategoryRepository $category_repository
   */
  public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    array $data = [],
    CategoryFactory $category_factory,
    CollectionFactory $collection_factory,
    \Magento\Catalog\Model\CategoryRepository $category_repository
  ) {

    $this->category_factory   = $category_factory;
    $this->collection_factory = $collection_factory;
    $this->category_repository = $category_repository;
    parent::__construct($context, $data);
  }

  private $category_factory;
  private $collection_factory;
  private $category_repository;

  public $text_prop = '[Hello from PowerBlock.php]';

  /**
   * @return string
   */
  public function show() {

    return __((string) $this->text_prop);
  }

  public function showMenuItems() {
    $category_factory = $this->category_factory;

    $all = $category_factory->create();
    $all = $all->getCategories(2, 1);

    $list = '';
    foreach ($all as $item) {

      $list .= '//' . $item->_data['name'];
    }

    return $list;
  }

  public function showMenuItems2() {
    $collection_factory = $this->collection_factory;

    $all = $collection_factory->create();

    $all = $all->addAttributeToFilter('include_in_menu', TRUE)
               ->addAttributeToSelect('name')
               ->load()
               ->getItems();

    $list = '';
    foreach ($all as $item) {
      $list .= $item->getData('name') . '//';
    }

    return $list;

  }


  public function getMyCustomCategory(){
    $cat = $this->category_repository->get(41);

    $prods = ($cat->getProductCollection())->load()->getItems();


    $list = '<br> prod ids: ';
    foreach ($prods as $item){
      $list .= $item ->getId() . '; ';
    }
    return $cat->getName() . $list;
  }

  const COLORS = [
    "AliceBlue",
    "AntiqueWhite",
    "Aqua",
    "Aquamarine",
    "Azure",
    "Beige",
    "Bisque",
    "BlanchedAlmond",
    "Fuchsia",
    "Gainsboro",
    "GhostWhite",
    "Gold",
    "GoldenRod",
    "LawnGreen",
    "LemonChiffon",
    "LightBlue",
  ];

  public function getRandomColor() {
    $quant = count(self::COLORS);
    $index = random_int(0, $quant - 1);

    return self::COLORS[$index] ?? 'N/A';
  }

}
