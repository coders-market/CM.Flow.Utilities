<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;
use Neos\FluidAdaptor\View\StandaloneView;

/**
 * check current context
 */
class RenderExternalViewHelper extends AbstractViewHelper {
    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * @param string $partial
     * @param string $packageKey
     * @param array $arguments
     * @param string $format
     * @param string $sectionName
     * @return boolean
     */
    public function render($partial,$packageKey,$arguments = array(),$format = 'html',$sectionName = null) {
        $arguments = $this->loadSettingsIntoArguments($arguments);

        $standaloneView = new StandaloneView();

        $request = $standaloneView->getRequest();
        $request->setControllerPackageKey($packageKey);
        $request->setFormat($format);

        $templatePathAndFilename = sprintf('resource://%s/Private/Partials/%s.%s', $packageKey, $partial, $format);
        $standaloneView->setTemplatePathAndFilename($templatePathAndFilename);
        $standaloneView->assignMultiple($arguments);

        return $standaloneView->render();
    }

    /**
     * If $arguments['settings'] is not set, it is loaded from the TemplateVariableContainer (if it is available there).
     *
     * @param array $arguments
     * @return array
     */
    protected function loadSettingsIntoArguments($arguments) {
        if (!isset($arguments['settings']) && $this->templateVariableContainer->exists('settings')) {
            $arguments['settings'] = $this->templateVariableContainer->get('settings');
        }
        return $arguments;
    }
}
?>