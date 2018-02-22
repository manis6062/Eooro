<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class PaymentProcess_View extends BaseView
{    
    /**
     * For Form Integration
     */
    public function displayBilling()
    {
        $this->crypt    = $this->get( 'CryptedInfo' );
        
        $this->settings   = $this->get( 'settings' );
        
        $layout   = $this->get( 'IntegrationType' );
        $this->setPath( strtolower($layout) . 'billing' ); // formbilling, directbilling etc.
        parent::display();
    }
    
    /**
     * For direct Integration
     */
    public function displayPayment()
    {
        $this->setPath( 'payment' );
        parent::display();
    }
    
    protected function setPath( $filename )
    {
        $path = SAGE_VIEW_DIR .'/'. $this->getCurrentViewName() .'/tmpl/'. $filename . '.php';
        $this->setLayoutPath($path);
    }
}
