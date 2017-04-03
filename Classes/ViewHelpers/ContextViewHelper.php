<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

/**
 * check current context
 */
class ContextViewHelper extends AbstractViewHelper {
    /**
     * Get context
     *
     * @return string context
     */
    public function render() {

        if ($this->objectManager->getContext()->isProduction()) {
            return 'Production';
        } elseif ($this->objectManager->getContext()->isTesting()){
            return 'Testing';
        } elseif ($this->objectManager->getContext()->isDevelopment()) {
            return 'Development';
        } else {
            return 'can\'t get context';
        }
    }
}
?>