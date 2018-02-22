<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Location
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class LocationTreeWalker
{
    /**
     * Array that contains all the active locations. Default = array( 1, 3, 4 )
     * 
     * @var array
     */
    protected $activeLocations;
    
    private function __construct()
    {
        //$this->activeLocations = explode( ',', EDIR_DEFAULT_LOCATIONS );
        $this->activeLocations = array( 1, 3, 4 );
    }
    
    private function __clone()
    {    }
    
    /**
     * Returns an instance of LocationTreeWalker Class.
     * 
     * @staticvar self $instance
     * @return \self
     */
    public static function getLocationTreeWalker()
    {
        static $instance;
        if ( !isset($instance) ) {
            $instance = new self();
        }
        
        return $instance;
    }
    
    /**
     * Returns Parent location of current location.
     * For eg. If current location is location 4, and we have locations 1,3,4 active
     * It returns location 3.
     * 
     * @param int $currentLocation id of current location in Location_sth table
     * @param array $allLocationArray active locations array
     * @return int
     */
    public function getParentLocationId( $currentLocation, $allLocationArray )
    {
        $index = (int)array_search( $currentLocation, $allLocationArray );
        if( $index ){ // index 0 for location 1 always
            return false;
        }
        else{
            return $allLocationArray[ $index - 1 ];
        }
    }
    
    /**
     * Returns child location of current location.
     * For eg. If current location is location 1, and  we have locations 1,3,4 active
     * It returns location 3.
     * 
     * @param int $currentLocation id of current location in Location_sth table
     * @param array $allLocationArray active locations array
     * @return int
     */
    public function getChildLocationId( $currentLocation, $allLocationArray )
    {
        $max    = max( $allLocationArray );
        $index  = (int)array_search( $currentLocation, $allLocationArray );
        
        if( $currentLocation == $max ){
            return false;
        }
        else {
            return $allLocationArray[$index + 1];
        }
    }

    /**
     * Returns SQL to get active child locations when parent location and id of 
     * parent is given.
     * For eg. Nepal falls in location 1. Nepal's Id may be 7.
     * So we pass getChildLocation( 1, 7 ) to get child locations.
     *  
     * @param int $currentLocation current location among locations 1,2,3,4.
     *                          ( should be parent )
     * @param int $locationId location id of country, state, city etc.
     * @return string
     */
    public function getChildLocationSQL( $currentLocation, $locationId )
    {
        if( $child = $this->getChildLocationId($currentLocation, $this->activeLocations) ){
            $hasChildren = $this->hasChildren( $child ) ? "'1' as has_children " : "'0' as has_children ";
            $select = "SELECT $hasChildren, '$child' as role, Location_$child.id, Location_$child.name,  CONCAT('location/',";
            
            $from   = " FROM Location_$child ";
            
            $join = '';
            foreach( $this->activeLocations as $parent ){//( 1, 3, 4 )
                if( $parent < $child ){
                    $select .= "Location_$parent.friendly_url,'/',";
                    $join .= " INNER JOIN Location_$parent ON Location_$child.location_$parent = Location_$parent.id ";
                }
            }
            $select .= "Location_$child.friendly_url) as full_friendly_url ";
            $where = " WHERE Location_$currentLocation.id=$locationId ";
            $order  = " ORDER BY Location_$child.name ";
            
            return $select . $from . $join . $where . $order;
        }
    }
    
    /**
     * Returns true or false if any locationLevel has children
     * Same as getChildLocationId but returns boolean.
     * 
     * @param int $currentLevel
     * @return boolean
     */
    public function hasChildren( $currentLevel )
    {
        if( $this->getChildLocationId($currentLevel, $this->activeLocations) ){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function getLocationFourFriendlyUrl($locationId)
    {
        $sql = "SELECT CONCAT(Location_1.friendly_url,'/',Location_3.friendly_url,'/',Location_4.friendly_url) as location "
            . " FROM `Location_4` "
            . " INNER JOIN Location_3 on Location_4.location_3 = Location_3.id "
            . " INNER JOIN Location_1 on Location_4.location_1 = Location_1.id "
            . " WHERE Location_4.id = $locationId";
        
        $main   = db_getDBObject(DEFAULT_DB,true);
         
        $resource = $main->query( $sql );

        if( mysql_num_rows( $resource ) ){
            $result = mysql_fetch_assoc( $resource );
        }
        else {
            $result = false;
        }
        
        return $result;
    }
}