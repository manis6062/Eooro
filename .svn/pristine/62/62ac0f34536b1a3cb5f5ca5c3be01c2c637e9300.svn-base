<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class ModApp
{
    /**
     *
     * @var \AppRouter
     */
    protected $router;
    
    protected $dispatcher;
    
    public function __construct()
    {
        $this->router = new AppRouter();
    }
    
    public function initialize()
    {
        // dispatch events before initialize
        // initializing code
        // dispatch events after initialize
    }
    
    public function setOptions( $module, $controller, $action = null, $parameters = null )
    {
        $this->router->setModule($module)
                    ->setTask($controller, $action, $parameters);
        return $this;
    }
    
    public function run( $return = false )
    {
        // dispatch event before running a task
        if ( $return ) {
            return $this->router->route();
        }
        else{
            $this->router->route();            
        }
        // dispatch event after running a task
    }
}