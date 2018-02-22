<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_CONTROLLER);

class Searchcase_Controller_Sitemgrcase extends BaseController
{
    public function index()
    {
        $this->view->display();
    }
    
    public function search( $details )
    {
        $this->model->loadPaginatedSearchData( $details );
        $this->view->showSearchedCases( $details );
    }
}
