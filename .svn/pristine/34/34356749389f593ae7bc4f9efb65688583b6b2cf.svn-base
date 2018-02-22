<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      OAuth Login
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

abstract class OauthApp
{
    /**
     * Details required to requrest required user information
     * eg. array( 'id' => 'xxxxxxxxx', 'clientId' => 'xxxx' ) etc.
     *  
     * @var array
     */
    protected $details;
    
    /**
     * Object that contains all the user information 
     * 
     * @var \OauthUser
     */
    protected $user;
    
    /**
     * Array that contains all the required fields for request. If any field 
     * specified here is not present in $this->details an exception is thrown.
     * 
     * @var array
     */
    protected $requiredDetails;
    
    /**
     * Sets all the details to get user information from foreign account.
     * 
     * @param array $details
     * @return \OauthApp
     */
    abstract public function setDetails( $details );
    
    /**
     * If after a request we get the desired resopnse, it returns an object with
     * all the user profile info.
     * 
     * @return \OauthUser Object contains all the user profile data.
     */
    abstract public function getUser();
    
    /**
     * To Set required fields for successful request and response.
     * 
     * @param array $required
     */
    public function setRequiredDetails( $required )
    {
        $this->requiredDetails = $required;
    }
    
    /**
     * Checks if all the fields required for a successful response is present 
     * provided or not.
     * 
     * @param array $details
     * @throws Exception
     */
    protected function checkRequiredFields( $details )
    {
        foreach( $this->requiredDetails as $value )
        {
            if( !isset($details[$value]) ){
                throw new Exception( 'You have not provided all the required details' );
            }
        }
    }
}

