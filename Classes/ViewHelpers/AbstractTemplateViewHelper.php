<?php
namespace CM\Flow\Utilities\ViewHelpers;

use Neos\Flow\Reflection\ReflectionService;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;
use Neos\FluidAdaptor\View\StandaloneView;

abstract class AbstractTemplateViewHelper extends AbstractViewHelper {
    /**
     * @var ReflectionService
     */
    protected $reflectionService;
    
    protected $escapeOutput = false;
    
    protected $templatePath = 'Private/Templates/ViewHelpers/';
    protected $templatePackage = null;
    protected $templateName = null;
    protected $templateFormat = 'html';

    /**
     * @var StandaloneView
     */
    protected $view;
    
    public function initialize() {
        if($this->templatePackage == null) {
            $templatePackage = get_class($this);
            preg_match('/^(.*)\\\\ViewHelpers/i',$templatePackage,$matches);
            $templatePackage = str_replace('\\','.',$matches[1]);
            
            $this->templatePackage = $templatePackage;
        }
        
        if($this->templateName == null) {
            $templateName = get_class($this);
            preg_match('/\\\([^\\\]*)ViewHelper$/i',$templateName,$matches);
            $templateName = $matches[1];
            
            $this->templateName = $templateName;
        }
        
        $this->initializeView();
    }

    public function render() {
        if(method_exists($this,'process')) {
            $this->process();
        } else {
            $this->passArgumentsToView();
        }
        
        return $this->view->render();
    }
    
    protected function initializeView() {
        $this->view = new \Neos\FluidAdaptor\View\StandaloneView();

        $request = $this->view->getRequest();
        $request->setControllerPackageKey($this->templatePackage);

        $this->view->setFormat($this->templateFormat);
        $this->view->setTemplatePathAndFilename(sprintf('resource://%s/%s%s.%s', $this->templatePackage, $this->templatePath, $this->templateName, $this->templateFormat));
        $this->view->setLayoutRootPath(sprintf('resource://%s/Private/Layouts/', $this->templatePackage));
    }
    
    protected function passArgumentsToView() {
        $this->view->assignMultiple($this->arguments);
    }
}