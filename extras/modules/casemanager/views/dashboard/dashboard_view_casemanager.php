<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_VIEW);

class Dashboard_View_Casemanager extends BaseView
{
    public function display()
    {
        $this->openedCases  = $this->get( 'NoOfCases' );
        $this->cases        = $this->get( 'Cases' );
        $this->unreadMsgs   = $this->get( 'UnreadMessages' );
        
        parent::display();
    }
}