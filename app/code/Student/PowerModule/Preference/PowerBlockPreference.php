<?php

namespace Student\PowerModule\Preference;

use \Student\PowerModule\Block\PowerBlock;

class PowerBlockPreference extends PowerBlock
{

    public function show()
    {

        $config_text = $this->config->getValue('powermodule_settings/general/display_text');
        $config_text = strip_tags($config_text);
        if (!empty($config_text)) {
            $config_text     = "<h3>Config Text: $config_text</h3>";
            $this->text_prop .= $config_text;
        }

        return '[{PREFERENCE}] ' . $this->text_prop;

    }

}