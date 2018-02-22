<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      GeoLocator
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class FreeGeoIpLocator extends GeoLocator
{
    public function __construct()
    {
        // setting values for default use case
        parent::__construct(); // service url should be like: http://freegeoip.net/json/ <- trailing / is a must
    }
    
    public function getDetails($type = true, $newRequest = false)
    {
        if ( !isset($this->details) || $newRequest ) {
            $this->details = $this->getIpDetails( $this->serviceUrl, $this->ip );
        }
        if ( $type ) {
            return json_decode( $this->details );
        }
        else{
            return (array)json_decode( $this->details );
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

}
