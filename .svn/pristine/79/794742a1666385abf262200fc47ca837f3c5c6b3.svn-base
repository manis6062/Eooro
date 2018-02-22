<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      GeoLocator
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
use MaxMind\Db\Reader;

class MaxmindGeoliteLocator extends GeoLocator
{
    private $rawDetails;
    
    private $details;
    
    public function __construct()
    {
        parent::__construct();
        $this->details = new stdClass();
    }
    
    public function getDetails($type = true, $newRequest = false)
    {
        if ( !isset($this->details->ip) || $newRequest ) {
            $reader = new Reader( $this->serviceUrl );
            $this->rawDetails = $reader->get( $this->ip );
            $reader->close();
            
            $this->filterAndSetDetails();
        }
        if ( $type ) {
            return $this->details;
        }
        else {
            return (array)$this->details;
        }
    }
    
    protected function filterAndSetDetails()
    {
        $this->details->ip = $this->ip;
        
        if( $this->rawDetails ){
            $this->details->country_code  = $this->rawDetails['country']['iso_code'];;
            $this->details->country_name  = $this->rawDetails['country']['names']['en'];;
            $this->details->region_code   = $this->rawDetails['subdivisions'][0]['iso_code'];
            $this->details->region_name   = $this->rawDetails['subdivisions'][0]['names']['en'];
            $this->details->city          = $this->rawDetails['city']['names']['en'];
            $this->details->zipcode       = $this->rawDetails['postal']['code'];
            $this->details->latitude      = $this->rawDetails['location']['latitude'];
            $this->details->longitude     = $this->rawDetails['location']['longitude'];
            $this->details->metro_code    = $this->rawDetails['location']['metro_code'];
            $this->details->area_code     = '';
        }
        else{
            $this->details->country_name = 'unknown';
        }
    }
}