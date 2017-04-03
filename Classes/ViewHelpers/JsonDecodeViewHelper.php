<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

/**
 * check current context
 */
class JsonDecodeViewHelper extends AbstractViewHelper {

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * @param string $decode the json string to decode
     * @param string $as variable name to store result in
     * @param boolean $assoc
     * @return mixed
     */
    public function render($decode, $as, $assoc = true) {
        $result = json_decode($decode,$assoc);
        if($result != null) {
            $this->templateVariableContainer->add($as, $result);
            $output = $this->renderChildren();
            $this->templateVariableContainer->remove($as);

            return $output;
        }

        return $this->renderChildren();
    }
}
?>