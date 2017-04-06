<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\Flow\Exception;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class InArrayViewHelper extends AbstractViewHelper {
    /**
     * @param mixed $needle
     * @param array|\Traversable $haystack
     * @param bool $typeSafety
     * @return boolean
     * @throws Exception
     */
    public function render($needle,$haystack, $typeSafety = true) {
        if(is_array($haystack)) {
            return in_array($needle,$haystack);
        } else if($haystack instanceof \Traversable) {
            foreach($haystack as $value) {
                if($value == $needle) {
                    return true;
                }
            }

            return false;
        }

        if($typeSafety) {
            throw new Exception("'haystack' has to be an array or instance of Traversable.");
        }
        return false;
    }
}
?>