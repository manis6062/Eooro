<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class PluginsHelper
{    
    public static function loadPlugins()
    {
        // get files from plugins directory
        $path   = EDIRECTORY_ROOT . '/fireevent/plugins';
        $files  = scandir( $path );
        // get rid of . and ..
        unset( $files[0] );
        unset( $files[1] );
        
        // get dispatcher
        $dispatcher = PluginRegistry::getDispatcher();
        
        foreach( $files as $class ){
            preg_match( '/([a-zA-Z0-9_.]+)\.php$/', $class, $matches );
            if ( $matches[1] ) {
                $classNames[] = $matches[1];
            }
        }
        
        foreach( $classNames as $className ){
            $className  = ucfirst( $className );
            $object     = new $className;
            $reflection = new ReflectionClass( $object );
            
            // get methods of the class
            $methods = $reflection->getMethods(  ReflectionMethod::IS_PUBLIC );
            
            foreach ( $methods as $reflectionMethod ){
                $onEvent    = $reflectionMethod->getName();
                preg_match( '/on([a-z0-9_.]+)/i', $onEvent, $matches );
                $event      = $matches[1];
                
                $dispatcher->addListener( $event, array($object, $onEvent) );
            }
        }
        
        PluginRegistry::setDispatcher( $dispatcher );
    }
    
    public function getPlugins()
    {
        return $this->plugins;
    }
}
