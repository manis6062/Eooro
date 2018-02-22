<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
abstract class PluginRegistry
{
    protected static $class;
    
    /**
     * Returns EventDispatcher Object
     * 
     * @return \EventDispatcher
     */
    public static function getDispatcher()
    {
        if ( !isset(static::$class['dispatcher']) ) {
            static::$class['dispatcher'] = new EventDispatcher();
        }
        return static::$class['dispatcher'];
    }
    
    /**
     * Returns UserEvent Object
     * 
     * @return \UserEvent
     */
    public static function getEvent( $type )
    {
        if ( !isset(static::$class['event'][$type]) ) {
            static::$class['event'][$type] = new $type;
        }
        return static::$class['event'][$type];
    }
    
    /**
     * To set EventDispatcher to registry.
     * 
     * @param \EventDispatcher $dispatcher
     */
    public static function setDispatcher( EventDispatcher $dispatcher )
    {
        static::$class['dispatcher'] = $dispatcher;
    }
    
}