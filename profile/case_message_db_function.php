 <? 
 /**
 * @author          Anuraag Sharma
 * @package      	Case
 * @subpackage      DB Extention
 * @description     Extract data from AJAX function and update it in database, used for updating seen status
 * @copyright 		(c) 2015, www.eooro.com
 * @version         1.0
 * @modification history original
 */

include("../conf/loadconfig.inc.php");

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$account_id = sess_getAccountIdFromSession();

 $date = gmdate( 'Y-m-d h:i:s' );
 $details['date'] = $date;

 $message 		= trim(preg_replace('/\s\s+/', ' ', $_POST['msg']));
 $account_id 	= mysql_real_escape_string($_POST['member_id']); 
 $owner_id 		= mysql_real_escape_string($_POST['owner_id']);
 $case 			= mysql_real_escape_string($_POST['case']);

 $owner_id 	    	= mysql_real_escape_string($_POST['owner_id']); 
 $delivery_status 	= mysql_real_escape_string($_POST['delivery_status']);

if($_POST){
	if ($_POST['msg'])
	{
				$sql = "INSERT INTO Case_Messages (case_id, from_user, to_user, message, date) "
				                . " VALUES ('{$case}', '{$account_id}', "
				                . "'{$owner_id 	}', '{$message}', '{$details['date']}') ";

				$resource = $dbDomain->query( $sql );

				
	} else {

				 $sql = "UPDATE Case_Messages "
		                . "SET delivery_status='{$delivery_status}' "
		                . "WHERE from_user='$owner_id' AND case_id='{$case}' "
		                . "AND delivery_status ='0000-00-00 00:00:00'";
		        
		         $resource = $dbDomain->query( $sql );
		        
	}
}

//Close Case and Keep/Delete Review

$closemethod    = mysql_real_escape_string($_POST['details']['closeMethod']);
$case           = mysql_real_escape_string($_POST['details']['case-id']); 
$accountid      = mysql_real_escape_string($_POST['details']['account-id']);
$rid 			= mysql_real_escape_string($_POST["details"]["rid"]);

if ($closemethod){

            if ($closemethod == 'close-delete'){
                // Close Case and Delete Review  
                $sql = "UPDATE Review  "
                        . "SET is_deleted = '1' "
                        . "WHERE id = '$rid' LIMIT 1";

                $resource = $dbDomain->query( $sql );

            }

                $sql2 = "UPDATE Opened_Cases SET case_status = 'C', closed_date = '$date' , closed_by =  '$accountid' "
                        . "WHERE case_id = '$case' LIMIT 1";
                        
                $resource2 = $dbDomain->query( $sql2 );

}

?>