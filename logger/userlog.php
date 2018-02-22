<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class UserLog extends SLog
{
    public $session_id;
    public $hash_user_id;
    public $user_id;
    public $timestamp;
    public $page;
    public $ip;
    public $useragent;
    public $country;
    public $state;
    public $city;

    public function createLog()
    {
        $this->timestamp       = $this->getTimeStamp();
        $this->session_id      = $this->getSessionId();
        $this->page            = $this->getCurrentPage();
        $this->ip              = $this->getIp();

        $userId                = sess_getAccountIdFromSession();
        if ( $userId ) {
            $this->user_id     = md5( $userId );
        }
        else{
           $this->user_id      = '';
        }
        $this->hash_user_id    = $this->getHashId();
        $this->useragent       = $this->getUseragent();
        $this->storeIpDetails();
        
        return $this;
    }

    /**
     * For the session to reset after browser close, we have to make changes 
     * in php.ini file.
     * We have to set session.cookie_lifetime to 0 for it to work as desired. 
     * 
     * @return string
     */
    protected function getSessionId()
    {
        if ( $_SESSION[ 'hash_sess_id' ] ) {
            return $_SESSION[ 'hash_sess_id' ];
        }
        else {
            $_SESSION['hash_sess_id']  = md5( rand(1000, 9999).gmdate('Ymd').rand(1000, 9999).date('His') );
            return $_SESSION['hash_sess_id'];
        }
    }

    protected function getHashId()
    {
        if ( $_COOKIE['hash'] ) {
            return $_COOKIE[ 'hash' ];
        }
        else {
            $hash   = md5( rand(1000, 9999).gmdate('Ymd').rand(1000, 9999).date('His') );
            setcookie( 'hash', $hash, time() + ( 365 * 86400 ) );
            return $hash;
        }
    }

    protected function getTimeStamp()
    {
        return gmdate( 'YmdHis' );
    }

    protected function getCurrentPage()
    {
        return $_SERVER['REQUEST_URI'];
    }

    protected function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
    
    protected function getUseragent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    
    protected function storeIpDetails()
    {
        if ( $_SESSION['country'] || $_SESSION['city'] ) {
            $this->country  = $_SESSION['country'];
            $this->city     = $_SESSION['city'];
        }
        else {
            $geoLocator = GeoLocatorGod::getGeoLocator();
            $details    = $geoLocator->setIp( $this->ip )->getDetails();

            $this->country  = $_SESSION['country'] = $details->country_name;
            $this->city     = $_SESSION['city'] = $details->city;
        }
        if( CountryLoader::getStateId(CountryLoader::getCountryId()) ){
            $this->state    = CountryLoader::getStateName(CountryLoader::getCountryId());
        }
    }
}