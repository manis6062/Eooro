<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class UserType
{
    protected static $instances;
    
    public static function getUser( $type, $id )
    {
        switch( $type ){
            case 'OwnerModel' :
                $obj = new OwnerModel();
                break;
            
            case 'ReviewerModel' :
                $obj = new ReviewerModel();
                break;
            
            default:
                throw new BadMethodCallException();
        }
        $obj->setUser($id);
        return $obj;
    }
}