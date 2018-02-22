<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules / sitemgr - case setting
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_CONTROLLER);

class Setting_Controller_Sitemgrcase extends BaseController
{
    public function index()
    {
        $this->model->loadSettings();
        $this->view->display();
    }
    
    public function updateSettings( $details )
    {
        $this->model->updateSettings( $details );
        $this->view->display();
    }
}