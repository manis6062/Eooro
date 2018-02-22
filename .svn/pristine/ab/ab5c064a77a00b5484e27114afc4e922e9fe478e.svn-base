<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 */
defined( 'SJP' ) or die;

class BaseView
{
    protected $model;
    
    protected $controller;
    
    protected $layoutPath = false; // for custom layout path for view
    
    
    public function __construct( $controller, $model )
    {
        $this->controller   = $controller;
        $this->model        = $model;
    }
    
    protected function get( $methodName, $model = false )
    {
        $method = 'get' . ucfirst( $methodName );
        if ( $model ) {
            $data   = $model->$method();
        }
        else{
            $data   = $this->model->$method();
        }
        return $data;
    }
    
    public function setLayoutPath( $path )
    {
        $this->layoutPath = $path;
    }
    
    public function display()
    {
        $this->getLayoutPath();
    }
    
    public function getCurrentViewName()
    {
        $viewname   = explode( '_', strtolower(get_class($this)) );
        return $viewname[0];
    }
    
    protected final function getLayoutPath()
    {
        $viewname   = $this->getCurrentViewName();
        if ( !$this->layoutPath ) {
            include_once SAGE_VIEW_DIR.'/'.$viewname.'/tmpl/default.php';
        }
        else {
            include_once $this->layoutPath;
        }
    }
    
}
