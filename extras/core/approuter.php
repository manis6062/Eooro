<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class AppRouter
{
    protected $module;
    
    protected $controller;
    
    protected $action;
    
    protected $parameters;
    
    public function setModule( $module )
    {
        $this->module = $module;
        return $this;
    }
    
    public function setTask( $controller, $action, $parameters )
    {
        $this->controller   = $controller;
        $this->action       = $action;
        $this->parameters   = $parameters;
        
        return $this;
    }
    
    public function route()
    {
        $controller = $this->controller;
        $method     = $this->action;
        $args       = $this->parameters;
        try{
            $filename = MODULES_DIR . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR . $this->module .'.php';
            if ( file_exists($filename) ) {
                require_once $filename;
                $module = new $this->module( $this->controller, $this->action, $this->parameters );
//                if ( $result =  $module->execute() ) {
//                    return $result;
//                }
                return $module->execute();
            }    
        } 
        catch (Exception $ex) {
            echo 'Module '. $method . ' was not created '. $ex->getMessage();
        }
    }
}