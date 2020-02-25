<?php

namespace Student\PowerModule\Plugin;

use \Magento\Widget\Model\Widget as BaseWidget;

class WidgetURL
{

    public function beforeGetWidgetDeclaration(
      BaseWidget $subject,
      $type,
      $params = [],
      $asIs = true
    ) {
        if (!key_exists("image", $params)) {
            goto END;
        }

        $url = $params["image"];
        if (strpos($url, '/pub/media/') !== false) {

            $elements        = explode('/', $url);
            $params["image"] = $elements[-1 + count($elements)];
        }

        END:
        return [$type, $params, $asIs];
    }

}