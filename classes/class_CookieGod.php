<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      God
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class CookieGod
{
    public static function getCountry()
    {
        return $_COOKIE['location_geoip'];
    }
    
    public static function getCountryId()
    {
        return $_COOKIE['location_geoip_id'];
    }
    
    public static function getState()
    {
        return $_COOKIE['location_state'];
    }
    
    public static function getStateId()
    {
        return $_COOKIE['location_state_id'];
    }
    
    public static function get( $cookieName )
    {
        return $_COOKIE[ $cookieName ];
    }
}