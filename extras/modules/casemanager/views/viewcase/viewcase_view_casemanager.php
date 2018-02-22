<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_VIEW);

class Viewcase_View_Casemanager extends BaseView
{
    public function show()
    {
        $this->caseDetails  = $this->get( 'caseDetails' );
        $this->caseMessages = $this->get( 'caseMessages' );
        $this->currentUser  = $this->get( 'currentUser' );
        $this->toUser       = $this->get( 'toUser' );
        $this->listing      = $this->get( 'listing' );
        $this->settings     = $this->get( 'setting' );
        
        $this->display();
    }
    
    public function display()
    {
        if ( !$this->layoutPath ) {
            $this->setLayoutPath( 'default.php' );
        }
        include_once $this->getLayoutPath( 'head' );
        // include_once $this->getLayoutPath( 'details_'.$this->currentUser->getUserType() );
        include_once $this->getLayoutPath( 'messages' );
        include_once $this->getLayoutPath( 'foot' );
    }
    
    public function updateMessage( $details )
    {
        $this->details = $details;
        $this->setLayoutPath( 'reply.php' );
        parent::display();
    }
    
    public function showCaseCloseAgreement( $details )
    {
        $this->caseCloseAgreement = $this->get( 'CaseCloseAgreement' );
        $this->details = $details;
        $this->setLayoutPath( 'agreement.php' );
        parent::display();
    }
}