<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class StripSpacesViewHelper extends AbstractViewHelper {
    /**
     *
     * @param string $content
     * @return string
     */
    public function render($content = null) {
        if($content == null) {
            $content = $this->renderChildren();
        }

        return str_replace(" ", "", $content);
    }
}