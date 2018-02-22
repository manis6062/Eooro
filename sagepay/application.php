<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' )  or die;

class Application
{
    /**
     * Contains the Application Object.
     * 
     * @var \Application
     */
    protected static $instance;
    
    /**
     * @todo Not used 
     * @var array 
     */
    protected static $controllerRegister = array();
    
    /**
     * Name of the controller that is to be used.
     * 
     * @var string
     */
    protected $controller;
    
    /**
     * Name of the method that is to be invoked.
     * 
     * @var string
     */
    protected $action;
    
    /**
     * Arguments that are to be passed to the invoked method.
     * 
     * @var mixed
     */
    protected $parameters;
    
    private function __construct() 
    {
        
    }
    private function __clone() 
    {
        
    }
    
    /**
     * Returns tha application instance.
     * 
     * @return \Application
     */
    public static function getInstance()
    {
        if ( !isset(static::$instance) ) {
            static::$instance = new Application();
        }
        return static::$instance;
    }

    /**
     * Runs the application according to the task specified. Task should be 
     * specifed first for the application to run.
     * It returns the result as according to the argument.
     * 
     * @param boolean $return
     * @return mixed
     */
    public function run( $return = false )
    {
        $controller = $this->getController();
        $method     = $this->action;
        $args       = $this->parameters;
        try{
            if ( $return ) {
                return $controller->$method( $args );
            }
            else{
                $controller->$method( $args );
            }
        } 
        catch (Exception $ex) {
            echo 'Method '. $method . ' not found in '. $controller . ' controller '
                    . $ex->getMessage();
        }
        
    }
    
    /**
     * Sets the parameters that determines which controller > method is to be
     * invoked to run the application.
     * 
     * @param string $controller It is the controller that is to be called.
     * @param string $action    It is the method that is invoked of the called controller.
     * @param mixed $parameters It is the argument that is passed to the method.
     * @return \Application
     */
    public function setTask( $controller, $action = null, $parameters = null )
    {
        $this->controller   = $controller . '_Controller';
        $this->action       = $action ? $action : 'index';
        $this->parameters   = $parameters;
        
        return $this;
    }
    
    /**
     * A controller once created will be registered and returned. So that 
     * multiple instance of the same controller is not created ( If in any case 
     * same controller is used multiple times in the program flow, It is however
     * not implemented coz multiple users can use the application at the same time ).
     * 
     * @return \controller
     */
    public function getController()
    {
//        try{
//            if ( isset(static::$controllerRegister[$this->controller]) ) {
//                $controller = static::$controllerRegister[$this->controller];
//            }
//            else{
//                $controller = new $this->controller;
//                static::$controllerRegister[$this->controller] = $controller;
//            }
//            return $controller;
//        }
//        catch ( Exception $ex ){
//            // @todo 
//            echo 'Controller not available. '. $ex->getMessage();
//        }
        return new $this->controller;
    }
}
