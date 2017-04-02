<?php
namespace CM\Flow\Utilities\ViewHelpers\Request;

use TYPO3\Flow\Exception;
use TYPO3\Flow\Annotations as Flow;

class SubpackageViewHelper extends RequestValueViewHelper {
    protected $requestProperty = 'controllerSubpackageKey';
}
?>