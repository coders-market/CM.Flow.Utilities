<?php
namespace CM\Flow\Utilities\ViewHelpers\Request;

use Neos\Flow\Exception;
use Neos\Flow\Mvc\ActionRequest;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractConditionViewHelper;

class IfMatchesViewHelper extends AbstractConditionViewHelper {
    /**
     * @param boolean $useMainRequest use the main request instead of the current one
     * @param string $action
     * @param string $controller
     * @param string $package
     * @param string $subpackage
     * @throws Exception
     * @return string
     */
    public function render($useMainRequest = false,$action = null,$controller = null,$package = null,$subpackage = null) {
        /**
         * @var ActionRequest $request
         */
        $request = $this->controllerContext->getRequest();
        if($useMainRequest && !$request->isMainRequest()) {
            $request = $request->getMainRequest();
        }

        if(
            ($action != null && $request->getControllerActionName() != $action) ||
            ($controller != null && $request->getControllerName() != $controller) ||
            ($package != null && $request->getControllerPackageKey() != $package) ||
            ($subpackage != null && $request->getControllerSubpackageKey() != $subpackage)
        ) {
            return $this->renderElseChild();
        } else {
            return $this->renderThenChild();
        }
    }
}
?>