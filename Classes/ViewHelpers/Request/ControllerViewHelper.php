<?php
namespace CM\Flow\Utilities\ViewHelpers\Request;

use TYPO3\Flow\Exception;
use TYPO3\Flow\Annotations as Flow;

class ControllerViewHelper extends RequestValueViewHelper {
    protected $requestProperty = 'controllerName';
}
?>