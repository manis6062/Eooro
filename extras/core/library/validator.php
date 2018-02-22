<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules / Library
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class Validator
{
    public static function integer( $input, $getValue = false )
    {
        if($getValue && !preg_match('/[^0-9]/', $input) ){
            return $input;
        }
        return !preg_match( '/[^0-9]/', $input );
    }
    
    public static function hexCodeWithDash( $input, $getValue = false )
    {
        if($getValue && !preg_match('/[^0-9a-fA-F-]/', $input) ){
            return $input;
        }
        return !preg_match( '/[^0-9]/', $input );
    }
    public static function campaignId( $input, $getValue = false )
    {
        $regex = '/^[\da-f]{8}-[\da-f]{4}-[\da-f]{4}-[\da-f]{4}-[\da-f]{12}$/i';
        if($getValue && preg_match($regex, $input) ){
            return $input;
        }
        return preg_match( $regex, $input );;

    }
    public function numbers( $input )
    {
        return !preg_match( '/[^0-9,\.]/', htmlentities($input) );
    }
    
    public function letters( $input )
    {
        return !preg_match( '/[^a-z]/i', htmlentities($input) );
    }
    
    public function alphaNumeric( $input )
    {
        return !preg_match( '/[^a-z0-9_,\.]/i', htmlentities($input) );
    }
    
    public function paragraph( $input )
    {
        return !preg_match( '/[^\w\s&$@]/', htmlentities($input) );
    }
    
    public function check( $string, $function )
    {
        try{
            if ( !method_exists( $this, $function) ) {
                throw new InvalidArgumentException( 'Method '.$function.' does not exists' );
            }
            if ( self::$function($string) ) {
                return $string;
            }
            else {
                return null;
            }
        } 
        catch (Exception $ex) {
            $ex->getMessage();
            return null;
        }
    }
    
    public function escape( $data )
    {
        if (is_object($data) || is_array($data) ) {
            foreach ( $data as $key => $value ){
                if( is_array($value) ){
                    foreach( $value as $k => $v ){
                        $newData[$key][$k] = addslashes( htmlspecialchars(trim($v)) );
                    }
                }
                else{
                    $newData[$key] = addslashes( htmlspecialchars(trim($value)) );
                }
            }
        }
        else{
            $newData = addslashes( htmlspecialchars(trim($data)) );
        }
        return $newData;
    }
}
