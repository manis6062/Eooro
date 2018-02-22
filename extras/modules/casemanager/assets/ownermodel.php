<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once 'usermodel.php';
class OwnerModel extends UserModel
{
    function __construct()
    {
        $this->userType = 'owner';
    }
    
    public function getSentMessageSQL( $details )
    {
        $sql = "INSERT INTO Case_Messages (case_id, from_user, to_user, message, date) "
                . " VALUES ('{$details['case']}', '{$details['account_id']}', "
                . "'{$details['member_id']}', '{$details['msg']}', '{$details['date']}') ";
                
        return $sql;
    }
    
    public function getMessageSeenSQL($details)
    {
        $sql = "UPDATE Case_Messages "
                . "SET delivery_status='{$details['date']}' "
                . "WHERE from_user='{$details['member_id']}' AND case_id='{$details['case']}' "
                . "AND delivery_status='0000-00-00 00:00:00'";
        
        return $sql;
    }
}