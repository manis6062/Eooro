<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class ModRegistry
{
    protected static $instance;
    
    protected static $data;
    
    private function __construct()
    {
        static::$data = array();
    }
    private function __clone()
    {
        ;
    }
    
    /**
     * 
     * @return \ModRegistry
     */
    public static function getInstance()
    {
        if ( !isset(static::$instances) ) {
            static::$instances = new ModRegistry();
        }
        return static::$instance;
    }
    
    public function register( $object, $name )
    {
        static::$data[$name] = $object;
    }
    
    public function retrieve( $name )
    {
        if ( !isset(static::$data[$name]) ) {
            throw new Exception( 'Data '.$name.' not found in registry' );
        }
        return static::$data[$name];
    }
}