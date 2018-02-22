<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_CONTROLLER);

class Opencase_Controller_Casemanager extends BaseController
{
    public function initialize()
    {
//        echo 'opencase controller';
    }
    
    public function showPopup( $review = null )
    {
        $this->review = $review;
        $this->view->display( $review );
    }
    
    public function registerCase( $details )
    {
        if ( $this->model->verifyCase($details) ) {
            $this->model->saveCaseDetails( $details );
        }
        $this->view->showResponse();
    }
}
