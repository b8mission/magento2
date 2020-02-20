<?php

namespace Student\PowerModule\Block\Widget;


use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PowerWidget extends Template implements BlockInterface
{

    protected $_template = "widget/powerwidget.phtml";

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getSlidesQuantity() : int
    {
        $slides_quantity = (int)$this->getData('slides_quantity');
        if ($slides_quantity < 1) return 1;

        return $slides_quantity;
    }

}