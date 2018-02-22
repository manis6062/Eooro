<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die( 'Restricted Access' );

class BaseController
{
    /**
     *
     * @var BaseModel
     */
    protected $model;
    protected $view;
    
    public function __construct()
    {
//        echo 'this is Base Controller <br/>';
        $this->setDefaultModelView();
    }
    private function setDefaultModelView()
    {
        $controllerClass    = get_class( $this );
        $first  = explode( '_', $controllerClass );
        
        $model  = $first[0].'_Model';
        $view   = $first[0].'_View';
        
        $this->setModel( new $model() );
        $this->setView( new $view( $this, $this->model ) );
    }
    public function setModel( $model )
    {
        $this->model    = $model;
    }
    public function setView( $view )
    {
        $this->view     = $view;
    }
    
    public function index()
    {
        $this->view->display();
    }
}
