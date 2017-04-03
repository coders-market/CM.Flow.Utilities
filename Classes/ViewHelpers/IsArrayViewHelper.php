<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class IsArrayViewHelper extends AbstractViewHelper {
    /**
     * @param string|array|object $array
     * @return boolean
     */
    public function render($array) {
        return is_array($array);
    }
}
?>