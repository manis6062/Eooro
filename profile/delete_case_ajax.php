<?php
include("../conf/loadconfig.inc.php");

$dbMain = db_getDBObject(DEFAULT_DB, true); 
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain); 
$date = date("Y-m-d H:i:s");

if($_POST['id'])
 {
 $id=mysql_escape_String($_POST['id']);
 $review = new Review($id);

 $sql = "update Review set is_deleted=1 where id='$id'";
 $sql1 = "update Opened_Cases set case_status='C', closed_date='$date' where review_id='$id'";

 $resource = $dbDomain->query( $sql );
 $resource = $dbDomain->query( $sql1 );

$average = Review::getRateAvgByItem('listing', $review->item_id, "count");
$set     = Listing::setAvgReview($average['rate'], $review->item_id, $average['review_count']);

 }

?>
