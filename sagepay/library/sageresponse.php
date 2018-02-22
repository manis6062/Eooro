<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class SageResponse
{
    /**
     * Contains the response string from SagePay. It is in form of
     * name-value pair
     * 
     * @var string
     */
    protected $responseString;
    
    /**
     * Contains information about applied AVSCV2 by sagepay. When sending information
     * to sagepay, this field is optional, hence a default of 0 is used.
     * Sagepay sends response accordingly and its response is present in this
     * variable.
     * Required result is "ALL MATCH"
     * 
     * @var string
     */
    public $AVSCV2;
    
    /**
     * Result of given address. 
     * Required  response is "MATCHED"
     * 
     * @var string
     */
    public $AddressResult;
    
    /**
     * It contains the amount paid by the user.
     * 
     * @var string It is a numeric string 
     */
    public $Amount;
    
    /**
     * 
     * 
     * @var string
     */
    public $CAVV;
    
    /**
     * 
     * @var string
     */
    public $CV2Result;
    
    /**
     * Contains the information about the type of card used by the user.
     * 
     * @var string
     */
    public $CardType;
    
    /**
     * Contains the GiftAid information. If no gift Aid is given it is 0.
     * 
     * @var string 
     */
    public $GiftAid;
    
    /**
     * It contains the last 4 digits of the credit-card 
     * used by the user.
     * 
     * @var string It is a numeric string 
     */
    public $Last4Digits;
    
    /**
     * Contains matched or not matched of the provided post code.
     * 
     * @var string
     */
    public $PostCodeResult;
    
    /**
     * Contains the transaction status information.
     * @var string 
     */
    public $Status;
    
    /**
     * Contains the detail information about the transaction status.
     * 
     * @var string
     */
    public $StatusDetail;
    
    /**
     *  
     * 
     * @var string 
     */
    public $TxAuthNo;
    
    /**
     * Transaction Id as sent by SagePay.
     * It is of the format: "{E4D70827-ACDD-4172-80FE-40218A85D61F}".
     * 
     * @var string
     */
    public $VPSTxId;
    
    /**
     * Contains the VendorTxCode currently sent to sagepay ( every transaction 
     * must have a unique VendorTxCode ).
     * 
     * @var string 
     */
    public $VendorTxCode;

    public function __construct( $responseString )
    {
        $this->responseString = $responseString;
        $this->bindResponse();
    }
    
    /**
     * Binds the key=value pair from SagePay response to corresponding
     * properties 
     */
    protected function bindResponse()
    {
        $responseArray = explode( '&', $this->responseString );
        
        foreach ( $responseArray as $value ){
            $pair = explode( '=', $value );
            $this->$pair[0] = $pair[1];
        }
    }
}