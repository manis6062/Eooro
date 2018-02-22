<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once 'library/validator.php';
class ModFactory
{
    protected static $instances;
    
    /**
     * 
     * @return \ModApp
     */
    public static function getApplication()
    {
        if ( !isset(static::$instances['application']) ) {
            static::$instances['application'] = new ModApp();
        }
        return static::$instances['application'];
    }
    
    /**
     * 
     * @return \DocumentLoader
     */
    public static function getDocumentLoader()
    {
        if ( !isset(static::$instances['document']) ) {
            static::$instances['document'] = new DocumentLoader();
        }
        return static::$instances['document'];
    }
    
    /**
     * 
     * @return \Validator
     */
    public static function getValidator()
    {
        return new Validator();
    }
    
}