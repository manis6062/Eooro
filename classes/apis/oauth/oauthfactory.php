<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      OAuth Login
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

abstract class OauthFactory
{
    public static function getApp( $type )
    {
        switch ($type) 
        {
            case 'google':
                    return new GoogleApp();
                break;

            default:
                    throw new InvalidArgumentException( "Your argument '$type' is not supported" );
                break;
        }
    }
}