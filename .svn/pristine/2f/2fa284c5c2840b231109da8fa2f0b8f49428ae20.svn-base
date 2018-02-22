<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class Response_Controller extends BaseController
{
    /**
     * It decrypts the data sent by sagepay and processes them, then returns
     * approprite response to show to users.
     * 
     * @param string $crypt it is the response from SagePay.
     * @return array
     */
    public function interpret( $crypt )
    {
        $cryptor    = Sagefactory::getCryptor();
        $passkey    = Sagefactory::getModel( 'PaymentSettings_Model' )->getPassword();
        $cleanText  = $cryptor->setEncryptedData(ltrim($crypt,'@'))
                        ->setDecryptionCode($passkey)->decrypt()->getCleanData();
        
        $this->model->setResponse( $cleanText );
        $response   = $this->model->processResponse();
        
        return $response;
    }
    
    /**
     * @todo not used till now, kept in case it may be of use in future.
     */
    public function showResponse()
    {
        $this->view->display();
    }
}