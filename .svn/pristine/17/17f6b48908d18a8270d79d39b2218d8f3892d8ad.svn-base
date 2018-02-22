<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      OAuth Login
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

abstract class OauthUser
{
    protected $profile;
        
    abstract public function setUserProfile( $details );
    
    public function __get( $name )
    {
        return $this->profile[ $name ];
    }
    
    /**
     * Returns user profile.
     * If required fields is specified in arrray, like:
     * 
     * getProfile( array( 'first_name', 'last_name') ), only first_name and 
     * last_name are returned from collection of details in user profile.
     * 
     * @param array $returnFields (optional) if specified, only the fields 
     *                          specified in this array will be returned.
     * @return array
     */
    public function getProfile( Array $returnFields = null )
    {
        if( isset($returnFields) && is_array($returnFields) ){
            $return = array_intersect_key( $this->profile, array_flip($returnFields) );
            return $return;
        }
        else {
            return $this->profile;
        }
    }
}