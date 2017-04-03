<?php
namespace CM\Flow\Utilities\ViewHelpers\Arrays;

use Neos\Flow\Exception;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class ImplodeViewHelper extends AbstractViewHelper {
    /**
     * @param array $pieces
     * @param string $glue
     * @return string
     * @throws Exception
     */
    public function render($pieces,$glue = ',') {
        return implode($glue,$pieces);
    }
}