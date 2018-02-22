<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 * @note        Here "Type" refers to listing or Event or Article or....
 */
defined( 'SJP' ) or die;

class Response_Model extends BaseModel
{
    /**
     * @var SageResponse
     */
    protected $response;
    
    /**
     * It is a multidimentional array that contains transaction type and its 
     * corresponding ids.
     * 
     * @var array
     */
    protected $transactionItems;
    
    /**
     * It is a multidimentional array that contains transaction details, according
     * to transaction type and id.
     * The detail contains all the information from database. The details are in 
     * form of: 
     * array key = id and value = detail object
     * @var array
     */
    protected $txClasses;
    
    /**
     * It is "on" or "off" depending on approval requirement settings. 
     * @var string
     */
    protected $approve_required;
    
    /**
     * It contains all the information that is to be logged in the database
     * after the transaction is succesful.
     * 
     * @var array 
     */
    protected $payment_type_log;
    
    /**
     * It is the message that is to be shown to the user when the transaction is
     * complete, aborted, unauthorised etc.
     * 
     * @var array 
     */
    protected $message;
    
    protected $individualTransactionLogger;
    /**
     * It sets response property to sageresponse object as according to the name
     * value pair.
     * @param string $response It is the clean data obtained after decrypting
     *                      response from SAgePay.
     */
    public function setResponse( $response )
    {
        $this->response = new SageResponse( $response );
    }
    
    /**
     * It processes the response sent from SagePay, and returns message to show
     * users.
     * 
     * @return array contains response to user
     */
    public function processResponse()
    {
        if ( strtolower($this->response->Status) === 'ok') {
            // they should be in order
            $this->processVendorTxCode(); // transactionItems are set
            $this->logTransaction( true ); // for complete
        }
        else {
            
            $this->processVendorTxCode(); // transactionItems are set
            $this->logTransaction( false ); // for pending
        }
        $message = $this->getMessage();
        
        return $message;
    }
    
    /**
     * Extracts the information in vendor Tx Code.
     * Vendor Tx code has message in following format:
     * 
     * date-time transaction-types transaction-id-separated-by-dots
     * Eg 2014-10-10_12-10-10Listings_3.4.Event_1.2. etc
     */
    protected function processVendorTxCode()
    {
        preg_match_all( '#[A-Za-z]+_([0-9]+\.)+#', $this->getRequestDetails($this->response->VendorTxCode), $matches);
//        print_r( $matches );
        
        $this->transactionItems = array();
        foreach ( $matches[0] as $value ){
            $value = rtrim( $value, '.' );
            $type = explode( '_', $value );
            
            $this->transactionItems[ $type[0] ] = explode( '.', $type[1] );
        }
        
        // for date-time but not used for now
        preg_match_all( '#\d{2}-\d{2}-\d{2}_\d{2}-\d{2}-\d{2}#', $this->response->VendorTxCode, $matches);
        $this->dateTime = $matches[0];
    }
    
    protected function getRequestDetails( $vendorTxCode )
    {
        $sql    = "SELECT request_details FROM Payment_Request WHERE vendor_tx_code='{$vendorTxCode}'";
        $result = $this->domainDb->query( $sql );
        $row    = mysql_fetch_assoc($result);
        return $row['request_details'];
    }
    /**
     * To get listing, event, article details from database through type id in 
     * transactionItems.
     * It also sets 'txClasses'... tx Classes contains array of objects with
     * array key = transaction id ( may be listing id, event id , article id etc. )
     */
    protected function getTxDetails()
    {
        // get objects
        $inflictor  = Sagefactory::getInflector();
        foreach ( $this->transactionItems as $key => $values ){
            $className = ucfirst( $inflictor->singularize($key) );
            foreach ( $values as $id ){
                if ($className === 'Case'){
                    $className = 'Opened_Cases';
                    $this->txClasses[$className][$id] = 'Opened_Cases';
                    include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_Opened_Cases.php';
                }
                $this->txClasses[$className][$id]  = new $className($id);
            }
        }
        // get price details
        $price['subtotal'] = 0;
        foreach ( $this->txClasses as $key => $values ){
            foreach ( $values as $id => $object ){
                $price['subtotal'] += $object->getPrice();
            }
        }
        setting_get("payment_tax_value", $tax);
        setting_get("payment_tax_status", $status);
        if ($status == "on"){
            $price['tax']   = payment_calculateTax( $price['subtotal'], $tax, true, false );
        } else {
            $price['tax']   = 0;
        }
        //get currency
        $sql    = 'SELECT `value` FROM `Setting_Payment` WHERE name="PAYMENT_CURRENCY"';
        $result = $this->domainDb->query( $sql );
        $row    = mysql_fetch_assoc( $result );
        $price['currency'] = $row['value'];
        
        return $price;
    }
    
    /**
     * To log the current transaction in Payment_Log table.
     * All the required details are fetched from either SagePay Response or
     * Database.
     * 
     * After logging in Payment_Log table, we should log it in corresponding log
     * (Listing, event, Banner ) etc. It is then later delegated to other 
     * functions.
     * 
     * @param array $txStatus Contains information about price, currency,
     *                      subtotal amount of a transaction.
     */
    protected function logTransaction( $txStatus )
    {
        $txDetails  = $this->getTxDetails();
        $userId     = sess_getAccountIdFromSession();
        $account    = new Account( $userId );
        
        $transactionLog['account_id']           = $userId;
        $transactionLog['username']             = $account->getString('username');
        $transactionLog['ip']                   = $_SERVER["REMOTE_ADDR"];
        $transactionLog['transaction_id']       = $this->response->VendorTxCode;
        $transactionLog['transaction_status']   = $txStatus ? 'Complete' : 'Failed';
        $transactionLog['transaction_datetime'] = date("Y-m-d H:i:s");
        $transactionLog['transaction_tax']      = $txDetails['tax'];
        $transactionLog['transaction_subtotal'] = $txDetails['subtotal'];
        $transactionLog['transaction_amount']   = $transactionLog['transaction_subtotal'] + $transactionLog['transaction_tax'];
        $transactionLog['transaction_currency'] = $txDetails['currency'];
        $transactionLog['system_type']          = 'sagepay';
        $transactionLog['recurring']            = 'n';
        $transactionLog['return_fields']        = serialize( $this->response );
        $transactionLog['notes']                = '';
    
        $paymentLogObj = new PaymentLog( $transactionLog );
        $paymentLogObj->save();
        
        $this->logIndividualTransaction( $paymentLogObj, $txStatus );
        $this->updateType($txStatus);
        return ($this->response->VendorTxCode);
    }
    
    /**
     * To Log current item type transaction in their corresponding database
     * tables.
     * item type = listing, event, atricle, etc
     * item level = listing level, event level .. etc.
     * 
     * @param PaymentLog $paymentLogObj
     * @param $txStatus Tells if the transaction was completed or failed.
     */
    protected function logIndividualTransaction( $paymentLogObj, $txStatus )
    {
        foreach ( $this->txClasses as $type => $array ){
            $this->individualTransactionLogger = Sagefactory::getLogger($type); 
            //Listing Pending to Listing Modification
            if($type == "Listing"){
                foreach ($array as $key => $value){
                    
                    if($value->renewal_date == "0000-00-00"){
                        
                        //Migrate ListingPending to Listing
                        $lisitingPending = new ListingPending($key);

                        //Assign ListingPending the values of listing table
                        $listingarray = (array) $value;
                        $pendingarray = (array) $lisitingPending;
                        $both         = array_intersect_key($pendingarray, $listingarray);

                        foreach ($both as $k => $v)
                        {
                            $value->$k = $v;
                        }

                        $lisitingPending->delete($key);

                    }
                    
                }

            }

            $this->individualTransactionLogger->logIndividualTransaction($paymentLogObj, $txStatus, $type, $array);
        }
    }
    
    /**
     * After payment has been made, "Renewal Date" of the transacted item must 
     * be updated (till next year). Also, its status must me set to "pending" or
     * "active" as according to settings.
     * It updates renewal date and status of the transaction.
     * 
     * @param $txStatus Tells if the transaction was completed or failed.
     */
    protected function updateType($txStatus)
    {
        $status = new ItemStatus();
        foreach ( $this->txClasses as $type => $array ){
            
                $this->individualTransactionLogger = Sagefactory::getLogger($type);
                $this->approve_required = $this->individualTransactionLogger->updateType($txStatus, $status, $type, $array);
            
        }
    }
    
    /**
     * Returns Response Object.
     * @return \SageResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * Returns the message that is to be sent to user as according to 
     * response status sent by SagePay.
     * 
     * @return array
     */
    public function getMessage()
    {
        $fail = true;
        if ( strtolower($this->response->Status) === 'ok') {
            $message['payment_message'] = '<p class="successMessage"><br/>Your Transaction was sucessful.<br/>';
            
            if ( $this->approve_required === 'on' ) {
                $message['payment_message'] .= system_showText(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED)."<br />\n"
                                        ."See <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">"
                                        .system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a> ";
                
            }else {
                $message['payment_message'] .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_COMPLETED)." <br />\n"
                                        ."See <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">"
                                        .system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a> ";
            }
            
            $message['payment_success'] = 'y';
            $message['id']  = $this->response->VendorTxCode;
            $fail = false;
        }
        elseif ( strtolower($this->response->Status) === 'notauthed' ) {
            $message['payment_message_head'] = '<p class="errorMessage"><br/>Your Transaction was not sucessful due to card verification error.<br/>';
            $message['payment_message'] = system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_CANCELED)." <br />\n";        
            $message['payment_success'] = 'n';
        }
        elseif( strtolower($this->response->Status) === 'abort' ){
            $message['payment_message_head'] = '<p class="errorMessage"><br/>Your Transaction was not sucessful due to user interruption.<br/>';
            $message['payment_message'] = system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_CANCELED)." <br />\n";
            $message['payment_success'] = 'a';
        }
        else{
            $message['payment_message_head'] = '<p class="errorMessage"><br/>Your Transaction was not sucessful.<br/>';
            $message['payment_message'] = system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_CANCELED)." <br />\n";
        }
        if ( $fail ) {
            $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
            $message['payment_message'] .= $try_again_message."\n</p>";
        }
        
        return $message;
    }
}