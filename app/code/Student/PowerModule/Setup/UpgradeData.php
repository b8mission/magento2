<?php

namespace Student\PowerModule\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{

    private const CHARS = 'qwertyuiopasdfghjklzxcvbnm';

    public function upgrade(
      ModuleDataSetupInterface $setup,
      ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.2.4', '<')) {
            $setup->getConnection()
                  ->insertArray($setup->getTable('student_powermodule_thing'),
                    ['test', 'upgrade_col'],
                    $this->getRandomValues(20));

            $setup->endSetup();
        }
    }


    private function getRandomValues($quant)
    {
        $chars_len = strlen(self::CHARS);
        $res       = [];
        for ($i = 0; $i < $quant; $i++) {

            $res[] = [
              'test'        => random_int(0, 100),
              'upgrade_col' => self::CHARS[random_int(0, $chars_len - 1)],
            ];

        }


        return $res;
    }

}