<?php


namespace Student\PowerModule\Block;

class PowerBlock extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }


    public $text_prop = '<hr>Hello from PowerBlock.php';
  /**
   * @return string
   */
    public function show()
    {
        //Your block code
        return __((string)$this->text_prop);
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
        "LightBlue",];

    public function getRandomColor()
    {
        $quant = count(self::COLORS);
        $index = random_int(0,$quant-1);

        return self::COLORS[$index] ?? 'N/A';
    }
}
