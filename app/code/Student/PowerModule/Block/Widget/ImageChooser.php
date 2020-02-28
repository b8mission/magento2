<?php

namespace Student\PowerModule\Block\Widget;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement as Element;
use Magento\Framework\Data\Form\Element\Factory;

class ImageChooser extends Template {

    public function __construct(Template\Context $context, Factory $elementFactory ,array $data = [])
    {
        $this->elementFactory=$elementFactory;
        parent::__construct($context, $data);
    }

    protected $elementFactory;
    public function prepareElementHtml(Element $element){
        $config = $this->_getData('config');
        $sourceUrl = $this->getUrl('cms/wysiwyg_images/index',
          ['target_element_id' => $element->getId(), 'type' => 'file']);
        /** @var \Magento\Backend\Block\Widget\Button $chooser */
        $chooser = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
                        ->setType('button')
                        ->setClass('btn-chooser')
                        ->setLabel($config['button']['open'])
                        ->setOnClick('MediabrowserUtility.openDialog(\''. $sourceUrl .'\')')
                        ->setDisabled($element->getReadonly());
        /** @var \Magento\Framework\Data\Form\Element\Text $input */
        $input = $this->elementFactory->create("text", ['data' => $element->getData()]);
        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setClass("widget-option input-text admin__control-text");
        $input->addCustomAttribute('readonly' ,'true');
        if ($element->getRequired()) {
            $input->addClass('required-entry');
        }
        $element->setData('after_element_html', $input->getElementHtml() . $chooser->toHtml());
        return $element;
    }
}