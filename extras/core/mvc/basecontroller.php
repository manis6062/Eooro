<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class BaseController
{
    protected $view;
    protected $model;
    
    function __construct()
    {
        $string = get_class($this);
        
        $model  = str_replace( '_Controller_', '_Model_', $string );
        $view   =str_replace( '_Controller_', '_View_', $string );
        
        $this->setModel( $model );
        $this->setView( $view );
    }
    
    public function setModel( $model )
    {
        $parts = explode( '_', $model );
        $path = MODULES_DIR . DIRECTORY_SEPARATOR .strtolower(end($parts)) . DIRECTORY_SEPARATOR 
                    . 'models'. DIRECTORY_SEPARATOR . strtolower($model).'.php';
        if ( file_exists($path) ) {
            require_once $path;
            $this->model = new $model;
        }
    }
    
    public function setView( $view )
    {
        $parts = explode( '_', $view );
        $path = MODULES_DIR . DIRECTORY_SEPARATOR . strtolower(end($parts)) . DIRECTORY_SEPARATOR 
                    . 'views'. DIRECTORY_SEPARATOR .strtolower($parts[0]). DIRECTORY_SEPARATOR . strtolower($view).'.php';
        if ( file_exists($path) ) {
            require_once $path;
            $this->view = new $view( $this, $this->model );
        }
    }
    
    public function index( $params = null )
    {
        $this->view->display();
    }
}