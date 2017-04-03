<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class StripTagsViewHelper extends AbstractViewHelper {
    /**
     * @param array|null $allowed
     * @param string $content
     * @return array
     */
    public function render($allowed = null,$content = null) {
        if($content == null) {
            $content = $this->renderChildren();
        }

        $allowedTags = null;
        if(is_array($allowed)) {
            $allowedTags = '';
            foreach($allowed as $allowedTag) {
                $allowedTags .= '<' . $allowedTag . '>';
            }
        }

        return strip_tags($content,$allowedTags);
    }
}