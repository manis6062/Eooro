<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      GeoIP
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class GeoLocator
{
    /**
     * Ip address of the Client
     * 
     * @var string
     */
    protected $ip;
    
    /**
     * Url of Web Service that provides details about the ip.
     * 
     * @var string
     */
    protected $serviceUrl;
    
    private function __construct()
    {
        // setting values for default use case
        $this->serviceUrl   = 'http://freegeoip.net/json/';
        $this->ip           = $_SERVER['REMOTE_ADDR']; 
    }
    
    private function __clone()
    {    }
    
    /**
     * Returns a GeoLocator Instance
     * 
     * @staticvar self $instance
     * @return \self
     */
    public static function getGeoLocator()
    {
        static $instance;
        if ( !isset($instance) ) {
            $instance = new self();
        }
        
        return $instance;
    }
    
    /**
     * Returns all the details of the ip
     * 
     * @staticvar mixed $details
     * @param boolean $type True for Object, False for Array
     * @param boolean $newRequest True to make a new request, 
     *                          False to get already requested result.
     * @return mixed
     */
    public function getDetails( $type = true, $newRequest = false )
    {
        static $details;
        
        if ( !isset($details) || $newRequest ) {
            $details = $this->getIpDetails( $this->serviceUrl, $this->ip );
        }
        if ( $type ) {
            return json_decode( $details );
        }
        else{
            return (array)json_decode( $details );
        }
    }
    
    /**
     * Request a service to get details of any IP.
     * 
     * @param type $url
     * @param type $ip
     * @return type
     */
    protected function getIpDetails( $url, $ip )
    {
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, CURLOPT_URL, $url.$ip );

        $response = curl_exec( $curl );
        curl_close( $curl );

        return $response;
    }
    
    public function setIp( $ip )
    {
        $this->ip = $ip;
        return $this;
    }
    
    public function setServiceUrl( $url )
    {
        $this->serviceUrl = $url;
        return $this;
    }
}
