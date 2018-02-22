<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, Subigya Jyoti Panta
 * @version         1.0
 */
defined( 'SJP' ) or die;

class Mediator
{
    protected $events = array();
    
    protected static $instance;
    
    private function __construct()
    {    }
    
    public static function getInstance()
    {
        if ( !isset(static::$instance) ) {
            static::$instance = new Mediator();
        }
        return static::$instance;
    }

    public function attach( $eventName, $function, $class = null )
    {
        if ( !isset($eventName) ) {
            $this->events[$eventName] = array();
        }
        $this->events[$eventName][] = $class.'-'.$function;
    }
    
    public function trigger( $eventName, $args )
    {
        foreach ( $this->events[$eventName] as $handlers ){
            $exp    = explode( '-', $handlers );
            list( $class, $function ) = $exp;
            $class->$function( $args );
        }
    }
}

