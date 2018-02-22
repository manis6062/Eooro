<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      OAuth Login
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class GoogleApp extends OauthApp
{
    public function __construct( $details = null )
    {
        $this->user     = new GoogleUser();
        $this->details  = $details;
        $this->requiredDetails = array(
                    'clientId', 'clientSecret', 'applicationName',
                    'developerKey', 'redirectUrl'
                );
    }
    
    /**
     * 
     * @param array $details
     * @return \GoogleApp
     */
    public function setDetails( $details )
    {
        $this->checkRequiredFields( $details );
        $this->details = $details;
        return $this;
    }
        
    public function getUser()
    {
        if( !$this->user->getProfile() ){
            $this->fetchUserDetails( $this->details );
        }
        return $this->user;
    }
    
    private function fetchUserDetails( $details )
    {
        $this->user->setUserProfile( $details );
    }
    
}