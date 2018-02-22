<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_CONTROLLER);

class Dashboard_Controller_Casemanager extends BaseController
{
    public function showCaseSummary( $item_id )
    {
        // should be in order
        $this->model->extractCaseDetails( $item_id );
        $this->model->setUnreadMessages( $item_id );
        $this->view->display();
    }
}