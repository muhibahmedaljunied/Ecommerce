<?php

namespace App\Helpers;

class LanguageHelper
{
    private static $rtlLanguages = ['ar'];
    
    public static function isRTL($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return in_array($locale, self::$rtlLanguages);
    }
    
    public static function getDirection($locale = null)
    {
        return self::isRTL($locale) ? 'rtl' : 'ltr';
    }
    
    public static function getDirectionClass($locale = null)
    {
        return 'dir-' . self::getDirection($locale);
    }
    
    public static function getCSSPath($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        if (self::isRTL($locale)) {
            return 'css-rtl';
        }
        return 'css';
    }
    
    public static function getSCSSPath($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        if (self::isRTL($locale)) {
            return 'scss-rtl';
        }
        return 'scss';
    }
}
