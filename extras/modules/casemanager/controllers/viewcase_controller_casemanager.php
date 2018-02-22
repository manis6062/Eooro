<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_CONTROLLER);

class Viewcase_Controller_Casemanager extends BaseController
{
    public function showCase( $details )
    {
        try{
            $this->model->loadCaseDetails( $details );
        }
        catch( Exception $ex ){
            if ( $ex->getCode() == 5000 ) {
                header("Location: ".DEFAULT_URL.DIRECTORY_SEPARATOR."sponsors/" );
                exit;
            }
        }
        $this->view->show();
    }
    
    public function updateMessage( $details )
    {
        $details = $this->model->saveNewMessage( $details );
        $this->view->updateMessage( $details );
    }
    
    public function updateSeen( $details )
    {
        $this->model->updateSeen( $details );
    }
    
    public function showCaseCloseAgreement( $details )
    {
        //$this->model->closeCase( $details );
        $this->model->loadCaseCloseAgreement( $details );
        $this->view->showCaseCloseAgreement( $details );
    }
    
    public function closeCase( $details )
    {
        $this->model->closeCase( $details );
    }
}
