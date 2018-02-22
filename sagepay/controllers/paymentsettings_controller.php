<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class PaymentSettings_Controller extends BaseController
{
    /**
     * To check if given input is empty of not.
     * 
     * @param array $input
     * @return boolean
     */
    public function verify( $input )
    {
        foreach ( $input as $value ){
            $empty = trim( $value );
            $empty = empty( $empty );
            if ( $empty ) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * It contains the Payment Settings i.e. username, password, vendorname, 
     * type of integration ( form/direct ) .
     * Whenever the information is changed / updated at the backend. This 
     * function is invoked.
     * 
     * @param array $input
     */
    public function setSettings( $input )
    {
        $this->model->setSettings( $input );
    }
    
    /**
     * Return 'on' if SAgepay is activated and 'off' if sagepay is not activated
     * at the backend.
     * 
     * @return string
     */
    public function getActivationStatus()
    {
        return $this->model->getActivationStatus();
    }
}
