<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_CONTROLLER);

class Manage_Controller_Sitemgrcase extends BaseController
{
    public function index( $details )
    {
        $this->model->loadCasesWithPagination( $details );
        $this->view->listCases( $details );
    }
}