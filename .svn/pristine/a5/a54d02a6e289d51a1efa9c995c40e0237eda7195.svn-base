<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Facebook
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

require_once CLASSES_DIR.'/apis/facebook/autoload.php';

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequestException;
use Facebook\FacebookRequest;
use Facebook\GraphUser;

class FacebookHelper
{
    /**
     *
     * @var FacebookRedirectLoginHelper
     */
    protected $facebookRedirectLoginHelper;
    
    /**
     *
     * @var FacebookSession
     */
    protected $facebookSession;
    
    /**
     *
     * @var GraphUser
     */
    protected $userProfile;
    
    /**
     * Access token from facebook
     * 
     * @var string
     */
    protected $accessToken;
    
    /**
     *
     * @var int
     */
    protected $userId;
    
    public static function getFBInstance( &$instance )
    {
        $instance = new static();
        $instance->initialize();
        $instance->setAccessToken($session);                
    }
    
    public function initialize()
    {
        FacebookSession::setDefaultApplication( FACEBOOK_API_ID, FACEBOOK_API_SECRET );
        
        $this->facebookRedirectLoginHelper = new FacebookRedirectLoginHelper( FACEBOOK_REDIRECT_URI );

    }
    public function setAccessToken( &$session )
    {
        try{
            $this->facebookSession = $this->facebookRedirectLoginHelper->getSessionFromRedirect();
            
            if( $this->facebookSession ){
                $_SESSION['fb_access_token'] = $session = $this->facebookSession->getToken();
            }
        }
        catch( FacebookRequestException $ex ){
            echo $ex->getResponse();
        }
        catch (Exception $ex) {

        }
    }
    
    public function setSessionFromAccessToken()
    {
        FacebookSession::setDefaultApplication( FACEBOOK_API_ID, FACEBOOK_API_SECRET );
        $this->facebookSession = new FacebookSession( $_SESSION['fb_access_token'] );
    }
    
    /**
     * 
     * @param type $userInfo
     * @param type $extraInfo
     * @return array with fields uid, picture, nickname, last_name, 
     *          first_name, email, birthday_date
     */
    public function getUserInfo( &$userInfo, &$extraInfo )
    {
        if( !isset($this->userProfile) ){
            $this->getUserProfile();
        }
        $this->getProfilePicture();
        $userInfo['uid']        = $this->userProfile->getId();
        //set_in_session
        $_SESSION['fb_user_id'] = $userInfo['uid'];
        $userInfo['picture']    = $this->getProfilePicture();
        $userInfo['nickname']   = $this->userProfile->getName();
        $userInfo['last_name']  = $this->userProfile->getLastName();
        $userInfo['first_name'] = $this->userProfile->getFirstName();
        $userInfo['email']      = $this->userProfile->getEmail();
        $userInfo['birthday_date']  = $this->userProfile->getBirthday()->format( 'Y-m-d' );
    }
     
    protected function fetchUserInfoFromFacebook( $FBsession )
    {
        $request    = new FacebookRequest( $FBsession, 'GET', '/me');
        $response   = $request->execute();
        $userProfile = $response->getGraphObject(GraphUser::classname());
    
        return $userProfile;
    }
    
    public function getUser()
    {
        if( isset($_SESSION['fb_user_id']) ){
            return $_SESSION['fb_user_id'];
        }
        if( !isset($this->userProfile) ){
            $this->getUserProfile();
        }
        return $this->userProfile->getId();
    }
    
    protected function getUserProfile()
    {
        $this->userProfile      = $this->fetchUserInfoFromFacebook( $this->facebookSession );
    }
    
    /**
     * 
     * @return FacebookRedirectLoginHelper
     */
    public function getHelper()
    {
        return $this->facebookRedirectLoginHelper;
    }
    
    /**
     * Returns URL of profile picture.
     * 
     * @return string
     */
    public function getProfilePicture()
    {
        $request = new FacebookRequest( $this->facebookSession,
                            'GET', '/me/picture',
                            array (
                                'redirect' => false,
                                'height' => '200',
                                'type' => 'normal',
                                'width' => '200',
                              ));
        $response = $request->execute();
        $graphObject = $response->getGraphObject( GraphUser::classname() );
        
        return $graphObject->getProperty( 'url' );
    }
    
    /**
     * Encapsulating facebook REquest Object so as to make it backward compatible.
     * 
     * @param type $path
     * @param type $method
     * @param type $parameters
     * @param type $returnProp
     * @return type
     */
    public function api( $path, $method, $parameters = null, $returnProp )
    {
        try{
            $request = new FacebookRequest( $this->facebookSession, $method, $path, $parameters );
            $response = $request->execute();
            $graphObject = $response->getGraphObject();
        }
        catch ( Exception $ex ){
            $ex->getMessage();
        }
        return $graphObject->getProperty( $returnProp );
    }
    
    /**
     * Generate the facebook button according to type param
     * Eg:
     * 	$params = array (
     * 		"onclick"	=> "fnOnClick",
     * 		"perms"		=> "email,user_birthday,status_update,publish_stream"
     *  );
     * 	Facebook::getButtonCode("login-button", $params);
     * 
     * @author Arca Solutions, Inc
     * @access Public
     * @version 9.0
     * @param string $type
     * @param string $params
     * @return string $returnTag
     */
    public static function getButtonCode($type, $params) {
            unset($bOpenTag, $bCloseTag);
            switch ($type) {
                    case "like":
                            $bOpenTag = "<fb:like [PARAMS]>";
                            $bCloseTag = "</fb:like>";
                            break;
                    case "login-button":
                            $bOpenTag = "<fb:login-button [PARAMS]>";
                            $bCloseTag = "</fb:login-button>";
                            break;
                    case "comments":
                            $bOpenTag = "<fb:comments [PARAMS]>";
                            $bCloseTag = "</fb:comments>";
                            break;
            }

            if (is_array($params)) {
                    unset($paramList);
                    foreach ($params as $param => $value) {
                            $paramList .= " $param=\"$value\"";
                    }
            } else {
                    $paramList = $params;
            }

            $returnTag = str_replace("[PARAMS]", $paramList, $bOpenTag) . $bCloseTag;
            return $returnTag;
    }
    
    /**
     * Encapsulates Facebook access token.
     * 
     * @return string
     */
    public function getAccessToken()
    {
        return $this->facebookSession->getToken();
    }
}