<?php
namespace CM\Flow\Utilities\ViewHelpers\Json;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

class EncodeViewHelper extends AbstractViewHelper {

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * @param string $value the value to encode
     * @param int $options
     * @param int $depth
     * @return mixed
     */
    public function render($value = null,$options = 0,$depth = 512) {
        if($value == null) {
            $value = json_encode($this->renderChildren());
        }
        
        return json_encode($value,$options,$depth);
    }
}
?>