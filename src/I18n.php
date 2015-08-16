<?php

class I18n
{
    public static $dicts = array();
    public static $locale = 'ru';
    public static $path = './lang/';
    public static $locales = array('ru', 'en');
    public static $h = null; 
    
    static function t($key, $dict = 'default')
    {
        if (!isset(self::$dicts[$dict]))
            self::$dicts[$dict] = include_once self::$path . self::$locale . '/' . $dict . '.php';
        
        return isset(self::$dicts[$dict][$key]) ? self::$dicts[$dict][$key] : '';
    }
    
    static function exists($lang)
    {
        return in_array($lang, self::$locales);
    }
    static function setPath($path)
    {
	self::$path = $path."/";
    }
    static function setLocale($lang)
    {
        self::$locale = self::exists($lang) ? $lang : self::$locales[0];
    }
}
