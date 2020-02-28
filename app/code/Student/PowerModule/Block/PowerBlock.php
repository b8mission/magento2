<?php


namespace Student\PowerModule\Block;

use Magento\Catalog\Helper\Catalog;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Collection;
use Magento\CatalogGraphQl\Model\Resolver\Products\SearchCriteria\CollectionProcessor\FilterProcessor\CategoryFilter;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\TestFramework\Event\Magento;
use Student\PowerModule\Helper\Config;

use Student\PowerModule\Model\DataFactory;


class PowerBlock extends \Magento\Framework\View\Element\Template
{

    private $data_factory;

    private $product_collection_factory;

    private $category_factory;

    private $collection_factory;

    private $category_repository;

    protected $config;

    public $text_prop = '[Hello from PowerBlock.php]';

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

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param CategoryFactory $category_factory
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collection_factory
     * @param \Magento\Catalog\Model\CategoryRepository $category_repository
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Student\PowerModule\Helper\Config $confing
     * @param \Student\PowerModule\Model\DataFactory $data_factory
     */
    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      CategoryFactory $category_factory,
      CollectionFactory $collection_factory,
      \Magento\Catalog\Model\CategoryRepository $category_repository,
      \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
      \Student\PowerModule\Helper\Config $confing,
      DataFactory $data_factory,
      array $data = []
    ) {
        $this->product_collection_factory = $productCollectionFactory;
        $this->category_factory           = $category_factory;
        $this->collection_factory         = $collection_factory;
        $this->category_repository        = $category_repository;
        $this->config                     = $confing;
        $this->data_factory               = $data_factory;
        parent::__construct($context, $data);
    }


    /**
     * @return string
     *
     * This method is not used because of Preference
     */
    public function show()
    {
        return __((string)$this->text_prop);
    }

    public function showMenuItems()
    {
        $category_factory = $this->category_factory;

        $all = $category_factory->create();
        $all = $all->getCategories(2, 1);

        $list = '';
        foreach ($all as $item) {

            $list .= '//' . $item->_data['name'];
        }

        return $list;
    }

    public function showMenuItems2()
    {
        $collection_factory = $this->collection_factory;

        $all = $collection_factory->create();

        $all = $all->addAttributeToFilter('include_in_menu', true)
                   ->addAttributeToSelect('name')
                   ->load()
                   ->getItems();

        $list = '';
        foreach ($all as $item) {
            $list .= $item->getData('name') . '//';
        }

        return $list;

    }



    public function getMyCustomCategory(&$category_name = '')
    {

        $category_id = $this->config->getSelectedCategory();

        try {
            $categ = $this->category_repository->get($category_id);
        } catch (NoSuchEntityException $exception) {
            return '[ERROR] There is no category with id ' . $category_id;
        }

        $factory = $this->product_collection_factory->create();
        $prods   = $factory->addAttributeToSelect('*')
                           ->addCategoryFilter($categ)
                           ->getItems();
        $prods   = array_values($prods);
        $category_name = $categ->getName();

        return $prods;
    }


    public function getRandomColor()
    {
        $quant = count(self::COLORS);
        $index = random_int(0, $quant - 1);

        return self::COLORS[$index] ?? 'N/A';
    }

    public function getEnabled()
    {
        return $this->config->getEnabled();
    }


    public function getDbData()
    {
        $df = $this->data_factory->create()->getCollection()->getData();
        return $df;
    }

}
