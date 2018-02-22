<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      GeoLocator
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

abstract class GeoLocatorGod
{
    protected static $locatorInstances;
    /**
     * 
     * @param string $type
     * @return \GeoLocator
     * @throws InvalidArgumentException
     */
    public static function getGeoLocator( $type = null )
    {
        if ( is_null($type) ) {
            $type = GEO_LOCATOR_TYPE;
        }
        
        switch ( strtolower($type) ) {
            case 'maxmind_lite_db':
                    static::$locatorInstances[$type] = new MaxmindGeoliteLocator();
                break;
            
            case 'maxmind_lite_binary':
                    static::$locatorInstances[$type] = new MaxmindGeoliteBinaryLocator();
                break;
            
            case 'freegeoip' :
                    static::$locatorInstances[$type] = new FreeGeoIpLocator();
                break;
            
            default:
                    throw new InvalidArgumentException( 'Service type does not '
                            . 'match available services.' );
                break;
        }
        
        return static::$locatorInstances[$type];
    }
}