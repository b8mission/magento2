<?php


namespace Student\PowerModule\Block;

use Magento\Catalog\Helper\Catalog;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Collection;
use Magento\TestFramework\Event\Magento;


class PowerBlock extends \Magento\Framework\View\Element\Template {

  /**
   * Constructor
   *
   * @param \Magento\Framework\View\Element\Template\Context $context
   * @param array $data
   * @param \Magento\Catalog\Model\ResourceModel\CategoryFactory $category_factory
   */
  public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    array $data = [],
    CategoryFactory $category_factory
  ) {

    $this->category_factory = $category_factory;


    parent::__construct($context, $data);
  }

  private $category_factory;

  public $text_prop = '[Hello from PowerBlock.php]';

  /**
   * @return string
   */
  public function show() {

    return __((string) $this->text_prop);
  }

  public function showMenuItems() {
    $category_factory = $this->category_factory;

    //$all = $category_factory->create(['include_in_menu' => TRUE]);
    $all = $category_factory->create();
    $all = $all->getCategories(2, 1);

    $list = '';
    foreach ($all as $item) {

      $list .= '//' . $item->_data['name'];
    }

    return $list;
  }

  const COLORS = [
    "AliceBlue",
    "AntiqueWhite",
    "Aqua",
    "Aquamarine",
    "Azure",
    "Beige",
    "Bisque",
    "Black",
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
