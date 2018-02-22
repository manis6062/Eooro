<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class PaymentProcess_Controller extends BaseController
{
    /**
     * @todo Used for Direct Integration, not used for now its better if we use
     *          different model for direct integration rather than editing 
     *          current model.
     */
    public function pay()
    {
        $this->model->pay();
        $this->view->displayPayment();
    }
    
    /**
     * It gets the client information, billing data, creates basket, vendorTxCode
     * and prepares the form to send the data to SagePay. ( for Form Integration )
     * 
     * @param array $bill_info It is the default billing information provided
     *                      by edirectory.
     */
    public function billing( $bill_info )
    {
        $this->model->billing( $bill_info );
        $this->view->displayBilling();
    }
}
