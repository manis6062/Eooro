<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

abstract class MainModule
{
    protected $controller;
    
    protected $action;
    
    protected $parameters;
    
    function __construct( $controller, $action = null, $parameters = null )
    {
        $this->controller   = $controller.'_controller_'. strtolower( get_class($this) );
        $this->action       = $action ? $action : 'index';
        $this->parameters   = $parameters;
    }
    
    public function execute()
    {
        $controller = $this->getController();
        $method     = $this->action;
        $args       = $this->parameters;
        
        $result     = new stdClass();
        try{
            $result->result = $controller->$method( $args );
            return $result;
        } 
        catch (Exception $ex) {
            echo 'Method '. $method . ' not found in '. $controller . ' controller '
                    . $ex->getMessage();
        }
    }
    
    protected function getController()
    {
        $path = MODULES_DIR.DIRECTORY_SEPARATOR.  end(explode('_', $this->controller))
                .DIRECTORY_SEPARATOR . 'controllers'.DIRECTORY_SEPARATOR .$this->controller . '.php';
        
        if ( file_exists($path) ) {
            require_once $path;
            return new $this->controller;
        }
        else{
            throw new Exception( 'Controller not found', 1111 );
        }
    }
    
}

