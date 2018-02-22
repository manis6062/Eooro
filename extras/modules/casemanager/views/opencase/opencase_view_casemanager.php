<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_VIEW);

class Opencase_View_Casemanager extends BaseView
{
    public function display( $review )
    {
        $this->review   = $review;
        $this->settings = $this->get( 'Settings' );
        
        parent::display();
    }
    
    public function showResponse()
    {
        $this->response = $this->get( 'Response' );
        
        $this->setLayoutPath( 'response.php' );
        parent::display();
    }
}
