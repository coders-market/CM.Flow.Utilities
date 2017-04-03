<?php
namespace CM\Flow\Utilities\ViewHelpers;

use CM\Flow\Utilities\Service\DateTimeService;
use Neos\Flow\I18n\Locale;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;
use Neos\Flow\Annotations as Flow;

/**
 * check current context
 */
class PrintDateViewHelper extends AbstractViewHelper {
    /**
     * @Flow\Inject
     * @var DateTimeService
     */
    protected $dateTimeUtility;

    /**
     * @param \DateTime $datetime
     * @param Locale $locale
     * @return string
     */
    public function render($datetime,$locale) {
        return $this->dateTimeUtility->formatLocalized($datetime,$locale);
    }
}