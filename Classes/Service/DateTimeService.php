<?php
namespace CM\Flow\Utilities\Service;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\I18n\Locale;
use Neos\Flow\Security\Exception\MissingConfigurationException;

/**
 * @Flow\Scope("singleton")
 */
class DateTimeService {
    /**
     * @Flow\InjectConfiguration(setting="dateFormats", package="Axovis.SelfTrackingPortal.Core")
     * @var array
     */
    protected $dateFormats;

    /**
     * @param \DateTime $date
     * @param Locale $locale
     * @throws MissingConfigurationException
     * @return string
     */
    public function formatLocalized($date,$locale) {
        $format = $this->getLocaleDateFormat($locale);

        return $this->format($date,$format);
    }

    /**
     * @param Locale $locale
     * @throws MissingConfigurationException
     * @return string
     */
    public function getLocaleDateFormat($locale) {
        return $this->dateFormats[$this->getLanguageKeyForLocale($locale)]['date'];
    }

    /**
     * @param Locale $locale
     * @return string
     */
    public function getLocaleTimeFormat($locale) {
        return $this->dateFormats[$this->getLanguageKeyForLocale($locale)]['time'];
    }

    /**
     * @param Locale $locale
     * @throws MissingConfigurationException
     * @return string
     */
    private function getLanguageKeyForLocale($locale) {
        if(!isset($this->dateFormats['default'])) {
            throw new MissingConfigurationException('default date format is missing');
        }

        $languageKey = $locale->getLanguage();
        if(!isset($this->dateFormats[$languageKey])) {
            return 'default';
        }

        return $languageKey;
    }

    /**
     * @param \DateTime $date
     * @param string $format
     * @return string
     */
    public function format($date,$format) {
        return $date->format($format);
    }

    /**
     * @param string $value
     * @return \DateTime
     */
    public function parseDate($value) {
        if(!$this->validateDate($value)) {
            return null;
        }

        $timestamp = strtotime($value);
        if($timestamp === false) {
            return null;
        }

        $datetime = new \DateTime();
        $datetime->setTimestamp($timestamp);

        return $datetime;
    }

    /**
     * @param string $value
     * @return \DateTime
     */
    public function parseDateTime($value) {
        if(!$this->validateDateTime($value)) {
            return null;
        }

        $timestamp = strtotime($value);
        if($timestamp === false) {
            return null;
        }

        $datetime = new \DateTime();
        $datetime->setTimestamp($timestamp);

        return $datetime;
    }


    /**
     * @param $value
     * @return bool
     */
    public function validateDateTime($value) {
        $parts = explode(' ',$value,2);
        if(count($parts) < 2) {
            return false;
        }

        if(!$this->validateDate(trim($parts[0]))) {
            return false;
        }

        if(!$this->validateTime(trim($parts[1]))) {
            return false;
        }

        return true;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validateDate($value) {
        return preg_match('/(^\d\d?\.\d\d?\.\d\d\d\d?$)|(^\d\d?[\/-]\d\d?[\/-]\d\d(\d\d)?$)/',$value) === 1;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validateTime($value) {
        return preg_match('/(^t?\d\d[.:]\d\d$)|(^\d?\d[.:]\d?\d ?(p\.?m\.?|a\.?m\.?)$)/i',$value) === 1;
    }

    public function phpToJsFormat($format) {
        return str_replace(array('j','d','n','m','y','Y'),array('d','dd','m','mm','yy','yyyy'),$format);
    }
}