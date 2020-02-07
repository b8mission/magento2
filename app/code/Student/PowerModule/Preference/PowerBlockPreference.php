<?php

namespace Student\PowerModule\Preference;

use \Student\PowerModule\Block\PowerBlock;

class PowerBlockPreference extends PowerBlock {

  public function show() {
    return '[{PREFERENCE UPPER CASE}] ' . strtoupper($this->text_prop);

  }

}