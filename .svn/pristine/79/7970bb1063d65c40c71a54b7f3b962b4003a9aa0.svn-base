<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      OAuth Login
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class GoogleUser extends OauthUser
{
    /**
     * Raw details provided by google
     * 
     * @var Google_Service_Plus
     */
    private $rawData;
    
    private $rawUserProfile;
    
    public $state;
    public $token;


    public function __construct()
    {
        $this->state = $_SESSION['go_state'] ? $_SESSION['go_state'] : $_SESSION['state'];
        $this->token = $_SESSION['go_token'] ? $_SESSION['go_token'] : $_SESSION['token'];
    }
    
    public function setUserProfile( $details )
    {
        $token = json_decode( $this->token );
        $now = time();
        // algorithm to set user profile
        if( $this->token && (time() < ($token->expires_in + $token->created)) && !$_GET['code'] ){
            $this->setRawProfileDataFromToken();
        }
        else {
            unset( $_SESSION['go_token'], $_SESSION['go_token'], $this->token );
            $this->setRawProfileFromAuthCode($details);
        }
        
        // Google_Service_Plus_people extends Google_Collection... just to make sure we got user profile
        if( is_object($this->rawUserProfile) ){
            $this->profile = $this->filterUserProfile( $this->rawUserProfile );
        }
    }
    
    protected function setRawProfileDataFromToken()
    {
        $client = new Google_Client();
        $client->setAccessToken( $this->token );

        $this->rawData = new Google_Service_Plus( $client );

        $this->rawUserProfile = $this->rawData->people->get( 'me' );
        
    }
    
    protected function setRawProfileFromAuthCode( $details )
    {
        if( isset($_GET['state']) && ($this->state === $_GET['state']) ){
            $client = new Google_Client();
            $client->setApplicationName( $details['applicationName'] );
            $client->setClientId( $details['clientId'] );
            $client->setClientSecret( $details['clientSecret'] );
            $client->setRedirectUri( $details['redirectUrl'] );
            $client->setDeveloperKey( $details['developerKey'] );

            $this->rawData   = new Google_Service_Plus( $client );

            if( isset($_GET['code']) ){
                $client->authenticate( $_GET['code'] );

                // get access and refresh tokens, in a json format
                $jsonTokens = $client->getAccessToken();
                $_SESSION['go_token'] = $this->token = $jsonTokens;

                $this->rawUserProfile = $this->rawData->people->get( 'me' );
            }
        }
    }
    
    protected function filterUserProfile( $rawProfile )
    {
        $name       = $rawProfile->getName();
        $profile['first_name']  = $name->getGivenName();
        $profile['last_name']  = $name->getFamilyName();
        $profile['nickname']  = $rawProfile->getDisplayName();
        $profile['id']  = $rawProfile->getId();
        $profile['gender']  = $rawProfile->getGender();
        $profile['email']  = $rawProfile->getEmails()[0]->getValue();
        $profile['picture'] = $rawProfile->getImage()->getUrl();
        
        return $profile;
    }
    
    protected function getProfilePicture( $uid )
    {
        
    }
}
