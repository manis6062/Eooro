<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class PaymentProcess_Model extends BaseModel
{
    /**
     * Contains the information currently in the cart.
     * 
     * @var Array
     */
    protected $billInfo;
    
    /**
     * Xml data to be sent to sagepay.
     * 
     * @var string 
     */
    protected $billInfoXml;
    
    /**
     * Contains client information
     * 
     * @var Contact
     */
    protected $client;
    
    /**
     * The Basket Object has Information in the format required by SagePay.
     * 
     * @var \Basket
     */
    protected $basket;
    
    /**
     * Object to encrypt / decrypt data
     * @var \Cryptor
     */
    protected $cryptor;
    
    /**
     * It contains the payment setting infromation like username, password, 
     * vendor name etc.
     * 
     * @var object 
     */
    protected $settings;
    
    /**
     *
     * @var \ServerConfig 
     */
    protected $serverConfig;
    
    /**
     * It contains additional billing information about the current item.
     * The additional information are : 
     * Tax, Gross Amount, Total Amount etc.
     * 
     * @var array 
     */
    protected $newBillingInfo;
    
    /**
     * It contains the 128-bit AES encrypted data with PKCS#5 padding and then 
     * encoded in hex.
     * 
     * @var string
     */
    protected $cryptedInformation;
    
    /**
     * It is 'direct' or 'form' depending on the type of integration chosen.
     * @var string
     */
    protected $integrationType;
    /**
     * Billing Codes
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->client       = new Contact(sess_getAccountIdFromSession());
        $this->setIntegrationType();
        // change this if we need xml basket
        $this->setBasket( new NormalBasket() );
        $this->cryptor = Sagefactory::getCryptor();
        $this->setSettings();
        $this->serverConfig   = Sagefactory::getServerConfig( 'SIMULATOR' );
    }
    
    /**
     * 
     * @param array $billInfo
     */
    /**
     * It is the method that is invoked by the controller. All the rest functions 
     * are traversed through it. It processes all the required data for billing.
     * ( used for form integration only )
     * @param array $billInfo
     */
    public function billing( $billInfo )
    {
        
        $this->billInfo     = $billInfo;
        $this->setRequiredDetails();
        $this->generateCrypt();
    }
    
    /**
     * It gets data from user details and encrypts it to the format required by sagePay.
     * 128-bit AES encrypted. and sets it to cryptedInformation variable. 
     */
    protected function generateCrypt()
    {
        $this->cryptedInformation = '';
//        rand(0,9999) . 'L_1.3.2-E_5.6-A_78.456'
        $userData   = $this->getData();
        $fields = array(
                    'VendorTxCode'      => $this->generateVendorTxCode(),
                    'BillingSurname'    => urlencode( $userData['BillingSurname'] ),
                    'BillingFirstnames' => urlencode( $userData['BillingFirstnames'] ),
                    'BillingAddress1'   => urlencode( $userData['BillingAddress1'] ),
                    'BillingAddress2'   => urlencode( $userData['BillingAddress2'] ),
                    'BillingCity'       => urlencode( $userData['BillingCity'] ),
//                    'BillingState'      => $userData['BillingState'],
                    'BillingPostCode'   => urlencode( $userData['BillingPostCode'] ),
                    'BillingCountry'    => urlencode( $userData['BillingCountry'] ),
                    'DeliverySurname'   => urlencode( $userData['BillingSurname'] ),
                    'DeliveryFirstnames'=> urlencode( $userData['BillingFirstnames'] ),
                    'DeliveryAddress1'  => urlencode( $userData['BillingAddress1'] ),
                    'DeliveryCity'      => urlencode( $userData['BillingCity'] ),
                    'DeliveryPostCode'  => urlencode( $userData['BillingPostCode'] ),
                    'DeliveryCountry'   => urlencode( $userData['BillingCountry'] ),
                    'Basket'            => $this->getBasketContents(),
                    'Amount'            => urlencode($this->newBillingInfo['amount']),
                    'Currency'          => urlencode($this->serverConfig->config['currency']),
                    'Description'       => 'Your',
                    'SuccessURL'        => $this->serverConfig->config['success_url'],
                    'FailureURL'        => $this->serverConfig->config['failure_url']
            );          $data = $this->joinData( $fields );
//        print_r($data);
        $this->cryptedInformation = strtoupper( $this->cryptor->setCleanData($data)->setEncryptionCode( $this->settings->password )->encrypt()->getEncryptedData() );
    }
    
    /**
     * Returns client information like firstname, surname, address etc
     * collected from client detail page.
     * The data may be collected via session or post depending on the process.
     * If the item is claimed and payed later, data is obtained from post.
     * else the data is obtained from session.
     * 
     * @return array
     */
    protected function getData()
    {
        $id     = sess_getAccountIdFromSession();
        $data   = $_SESSION[ 'user_'.$id ];
        if ( $data ) {
            $result = array();
            $array  = explode( '&', $data );
            foreach( $array as $pair ){
                $key_value  = explode( '=', $pair );
                $result[ $key_value[0] ] = $key_value[1];
            }
            unset( $_SESSION['user_'.$id] );
            return $result;
        }
        return $_POST;
    }
    
    /**
     * equivalent to http_build_query, It turns an array to name,value pair 
     * separated by ampersand.
     * 
     * @param array $data
     * @return string
     */
    public function joinData( $data )
    {
        foreach ( $data as $key => $value ){
            $joined[] = $key . '=' . $value; 
        }
        return implode( '&', $joined );
    }
    
    /**
     * It creates VendorTXCode depending on current date/time, type of 
     * transaction (listing, event etc.) id.
     * @return string
     */
    protected function generateVendorTxCode()
    {
        $date = date( 'Y-m-d_h-i-s' ); $txcode = '';
        foreach( $this->billInfo as $key => $value ){
            if ( $this->checkKey($key) ) {
                $txcode .= $key.'_';
                foreach ( $value as $id => $val) {
                    $txcode .= $id . '.';
                }
            }
        }
        $vendorTxCode = $date . '.' . $this->client->getString('account_id');
        $this->saveRequest( $vendorTxCode, $date . $txcode );
        return $vendorTxCode;
    }
    
    protected function saveRequest( $vendorTxCode, $request )
    {
        $sql = "INSERT INTO Payment_Request VALUES ( NULL, '{$vendorTxCode}', '{$request}' )";
        $this->domainDb->query( $sql );
    }
    
    /**
     * Returns the encrypted data that SagePay understands. i.e 128 bit AES 
     * encrypted with  PKS#5 padding and then encoded in hex.
     * 
     * @return string
     */
    public function getCryptedInfo()
    {
        return $this->cryptedInformation;
    }
    
    /**
     * @see addTaxAndOthers
     */
    protected function setRequiredDetails()
    {
        $this->newBillingInfo = $this->billInfo;
        $this->addTaxAndOthers();
        
    }
    
    /**
     * To add Tax, Gross Amount, Unit Amount, Total and item type ( listing, 
     * event, banner etc ) to the existing billing information.
     */
    protected function addTaxAndOthers()
    {
        foreach ( $this->billInfo as $key => $value ){
            if ( $this->checkKey($key) ) {
                foreach( $value as $no => $detail ){
                    $this->newBillingInfo[$key][$no]['unitTaxAmount']   = payment_calculateTax( $detail['total_fee'], $this->billInfo['tax_amount'], true, false );
                    $this->newBillingInfo[$key][$no]['unitGrossAmount'] = $this->newBillingInfo[$key][$no]['unitTaxAmount'] + $detail['total_fee']; 
                    // coz currently we are dealing with only one item
                    $this->newBillingInfo[$key][$no]['totalGrossAmount'] = $this->newBillingInfo[$key][$no]['unitGrossAmount'];
                
                    $this->newBillingInfo[$key][$no]['itemType'] = $key;
                } 
            }
        }
    }
    
    /**
     * To set integrationType variable. The value is obtained form the database.
     * It is changed from backend in PaymentSettings.
     */
    public function setIntegrationType()
    {
        $sql    = "SELECT `value` FROM `Setting_Payment` WHERE name='SAGEPAY_INTEGRATIONTYPE' ";
        $result = $this->domainDb->query( $sql );      
        $row    = mysql_fetch_array($result);
        
        $this->integrationType = $row['value'];
    }
    
    /**
     * Returns integration setting (direct/form) as per user settings.
     * @return string
     */
    public function getIntegrationType()
    {
        
        return $this->integrationType;
    }
    
    /**
     * To set the Basket Object. Use Normal basket if basket information is
     * to be sent normally(separated by colon ':') or  
     * xml basket if basket information is to be sent in xml format.
     * 
     * @param Basket $basket
     */
    public function setBasket( Basket $basket )
    {
        $this->basket = $basket;
    }
    
    /**
     * Contains Basket Information
     * @return string
     */
    public function getBasketContents()
    {
        return $this->basket->setRawData($this->newBillingInfo)->prepareBasket()->getContents();
    }
    
    /**
     * Shortcut to check if the key is any transaction type (listings, banners, etc.)
     * @param string $key
     * @return boolean
     */
    private function checkKey( $key )
    {
        if ($key === 'listings' || $key === 'banners' || $key === 'events' || $key === 'classifieds' || $key === 'articles' || $key === 'cases') {
            return true;
        }
        return false;
    }
    
//    protected function modifyArray( $array )
//    {
//        $newArray = array();
//        foreach ( $array as $key => $value ){
//            if ( $key === 'listings' || $key === 'banners' || $key === 'events' || $key === 'classifieds' || $key === 'articles') {
//                foreach ( $value as $item_detail ){
//                    $newArray[] = array( 'item' => $item_detail );
//                }
//            }
//            else{
//                $newArray[ $key ] = $value;
//            }
//        }
//        return $newArray;
//    }
//    
//    public function getItems()
//    {
//        $items = array();
//        foreach ( $this->newBillingInfo as $key => $value ){
//            if ( $this->checkKey($key) ) {
//                foreach( $value as $val ){
//                    $items[] = $val;
//                }
//            }
//        }
//        return $items;
//    }
    
    /**
     * To set the value of $this->setting variable.
     * The variable contains the values from Payment Settings database.
     * The variables can be changed from 
     * backend > settings > payment settings > sagepay.
     */
    protected function setSettings()
    {
        $model2 = Sagefactory::getModel( 'PaymentSettings_Model' );
        $this->settings->vendor     = $model2->getVendor();
        $this->settings->password   = $model2->getPassword();
        $this->settings->username   = $model2->getUsername();
    }
    
    /**
     * Returns PaymentSettings_Model Object. 
     * It contains all the information about payment settings like 
     * vendor name, password, username etc.
     * 
     * @return object
     */
    public function getSettings()
    {
        return $this->settings;
    }



    /**
     * Payment Codes Only for Direct Integration
     */
    
    /**
     * It is a prototype / guideline / reminder for me about sending payment 
     * information to sagepay thorough direct integration.
     */
    public function pay()
    {
        extract( $_POST );
         // These are dummy data for test
        $txcode = 'prefix_' . time() . rand( 0, 9999 );
        $fields = array(
                    'VPSProtocol'   => urlencode( '2.23' ),
                    'TxType'        => urlencode( 'PAYMENT' ),
                    'Vendor'        => urlencode('eooro'),
                    'VendorTxCode'  => urlencode( $txcode ),
                    'Amount'        => urlencode( '2.00' ),
                    'Currency'      => urlencode( 'USD' ),
                    'Description'   => urlencode('desc'),
                    'CardHolder'    => urlencode('holderName'),
                    'CardNumber'    => urlencode(123412341234),
                    'ExpiryDate'    => urlencode(1213),
                    'CV2'           => urlencode(123),
                    'CardType'      => urlencode('VISA'),
                    'BillingSurname'=> urlencode( 'surname' ),
                    'BillingFirstnames'  => urlencode( 'name' ),
                    'BillingAddress1'   => urlencode( 'Address1' ),
                    'BillingCity'       => urlencode( 'City' ),
                    'BillingPostCode'   => urlencode(12345),
                    'BillingCountry'    => urlencode( 'GB' ),
                    'DeliverySurname'   => urlencode( 'surname' ),
                    'DeliveryFirstnames'=> urlencode( 'firstname' ),
                    'DeliveryAddress1'  => urlencode( 'address1'),
                    'DeliveryCity'      => urlencode('city'),
                    'DeliveryPostCode'  => urlencode(12345),
                    'DeliveryCountry'   => urlencode( 'GB' )
            );
        $data = http_build_query( $fields );
        $this->send( $data );
    }
    
    /**
     * It sends user data to sagepay and received response from sagepay.
     * It is used for Direct Integration. (function works)
     * 
     * @param array $data
     */
    public function send( $data )
    {
        // open connection
        $ch = curl_init();
        
        // get url        
        $url = Sagefactory::getServerConfig( 'SIMULATOR' )->config['test'];
        
        // set the url, no of post vars and post data
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
//        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
        curl_setopt ($ch, CURLOPT_HEADER, 1 );
        
        // execute post
        $result = curl_exec( $ch );
        print_r($result);
        
        curl_close( $ch );
    }
    
    /**
     * @todo
     */
    protected function sendToSagePay( $data )
    {
        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => 
                    'Content-Type: text/xml; charset=utf-8 '.
                    "Accept-language: en\r\n " .
                //"Cookie: foo=bar\r\n" .
                    'Content-length: '. strlen($data) . "\r\n",
                'content' => $data
             )
        );

        $context = stream_context_create($opts);

        $fp = fopen('https://test.sagepay.com/Simulator/VSPDirectGateway.asp', 'r', false, $context);
        fpassthru($fp);
        fclose($fp);
    }
    
    public function getXml()
    {
        return $this->billInfoXml;
    }
}
