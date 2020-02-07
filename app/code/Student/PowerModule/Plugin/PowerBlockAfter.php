<?php

namespace Student\PowerModule\Plugin;

use Student\PowerModule\Block\PowerBlock;

class PowerBlockAfter {

  public function afterShow(
    PowerBlock $subject,
    $result
    //$functionParam
  ) {
    return $result . '[\'after_plugin\']';
  }


  public function beforeShow(
    PowerBlock $subject
  ) {

    $subject->text_prop = '[\'before_plugin\']' . $subject->text_prop;
  }

  public function aroundShow(PowerBlock $subject, callable $proceed) {

    $subject->text_prop = '[\'around plugin\']' . $subject->text_prop;

    return $proceed();
  }


}
