<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class PaymentSettings_View extends BaseView
{
    /**
     * To display the form for payment settings at the backend.
     */
    public function display() 
    {
        $this->username = $this->get( 'username' );
        $this->vendor   = $this->get( 'vendor' );
        $this->password = $this->get( 'password' );
        $this->status   = $this->get( 'activationStatus' );
        $this->integration_type = $this->get( 'integrationType' );
        
        parent::display();
    }
    
}
