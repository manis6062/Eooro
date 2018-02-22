<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class ClientDetails_Model extends BaseModel
{
    protected $client;
    
    public function __construct()
    {
        parent::__construct();
        $this->client       = new Contact(sess_getAccountIdFromSession());
    }
    
    /**
     * Returns current user information.
     * 
     * @return \Contact
     */
    public function getClient()
    {
        return $this->client;
    }
}
