<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class ArrayKeysViewHelper extends AbstractViewHelper {
    /**
     * @param array $array
     * @return array
     */
    public function render($array) {
        return array_keys($array);
    }
}
?>