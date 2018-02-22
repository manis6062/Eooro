<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      GeoLocator
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
abstract class GeoLocator
{
    /**
     * Ip address of the Client
     * 
     * @var string
     */
    protected $ip;
    
    /**
     * Url of Web Service, file, database that provides details about the ip.
     * 
     * @var string
     */
    protected $serviceUrl;
    
    protected $requiredDetails;
    
    public function __construct()
    {
        // setting values for default use case
        $this->serviceUrl   = GEO_LOCATOR_SERVICE_URL;
        $this->ip           = $_SERVER['REMOTE_ADDR'];
    }
    
    /**
     * Returns all the details of the ip
     * 
     * @param boolean $type True for Object, False for Array
     * @param boolean $newRequest True to make a new request, 
     *                          False to get already requested result.
     * @return mixed
     */
    abstract public function getDetails( $type = true, $newRequest = false );
    
    public function setRequiredDetails( $requiredDetails )
    {
        $this->requiredDetails = $requiredDetails;
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