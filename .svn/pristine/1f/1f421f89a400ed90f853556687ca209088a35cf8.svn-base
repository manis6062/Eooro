<script>
	console.log("<?=$_POST['case'];?>");
</script>

<?
var_dump("expression");
include("../conf/loadconfig.inc.php");

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$account_id = sess_getAccountIdFromSession();
//sleep(2);

 $date = gmdate( 'Y-m-d h:i:s' );
 $details['date'] = $date;

 $message 		= trim(preg_replace('/\s\s+/', ' ', $_POST['msg']));
 $account_id 	= $_POST['member_id']; 
 $owner_id 		= $_POST['owner_id'];

 $case 			= $_POST['cid'];


 $owner_id 	    = $_POST['owner_id']; 
 $delivery_status = $_POST['delivery_status'];

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


?>