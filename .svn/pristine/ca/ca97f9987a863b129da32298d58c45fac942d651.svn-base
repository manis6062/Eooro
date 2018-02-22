<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      GeoLocator
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class MaxmindGeoliteBinaryLocator extends GeoLocator
{
    protected $details;
    
    protected $rawDetails;
    
    public function __construct()
    {
        parent::__construct();
        $this->details = new stdClass();
    }
    
    public function getDetails( $type = true, $newRequest = false )
    {
        if ( !isset($this->details->ip) || $newRequest ) {
            $this->rawDetails = geoip_record_by_name( $this->ip );
            $this->filterAndSetDetails();
        }
        
        if( $type ){
            return $this->details;
        }
        else {
            return (array)$this->details;
        }
    }
    
    protected function filterAndSetDetails()
    {
        $sql = "SELECT `name` FROM `Location_3` WHERE `abbreviation`='{$this->rawDetails['region']}'";
        $db = db_getDBObject( DEFAULT_DB, TRUE );
        $resource = $db->query( $sql );
        $result = mysql_fetch_assoc($resource);
        
        $this->rawDetails['region_name'] = $result['name'];
        $this->details->ip = $this->ip;
        if( isset($this->rawDetails['country_name']) ){
            $this->details->country_code  = $this->rawDetails['country_code'];
            $this->details->country_name  = $this->rawDetails['country_name'];
            $this->details->region_code   = $this->rawDetails['region'];
            $this->details->region_name   = $this->rawDetails['region_name'];
            $this->details->city          = $this->rawDetails['city'];
            $this->details->zipcode       = $this->rawDetails['postal_code'];
            $this->details->latitude      = $this->rawDetails['latitude'];
            $this->details->longitude     = $this->rawDetails['longitude'];
            $this->details->metro_code    = $this->rawDetails['dma_code']; // not sure
            $this->details->area_code     = $this->rawDetails['area_code'];
        }
        else {
            $this->details->country_name = 'unknown';
        }
    }
}