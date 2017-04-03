<?php
namespace CM\Flow\Utilities\ViewHelpers\Html;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

/**
 * Convert array with key:value to html5 data attribute with data-key="value"
 */
class DataTagViewHelper extends AbstractViewHelper {

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * @param array $values the array with key:values
     * @return string
     */
    public function render($values) {
        $output = '';

        if(is_array($values)){
            foreach ($values as $key=>$value){

                $key = $this->fromCamelCase($key);
                $output = $output . 'data-'.$key.'="'.$value.'" ';
            }
        }

        return $output;
    }

    /**
     * Change from camelCase to camel-case
     *
     * @param string $input
     * @return string
     */
    private function fromCamelCase($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('-', $ret);
    }
}
?>