<?php
include("../conf/loadconfig.inc.php");

$dbMain = DBConnection::getInstance()->getMain();
$dbDomain = DBConnection::getInstance()->getDomain();
$date = date("Y-m-d H:i:s");

if($_POST['id'])
{
 $id=$_POST['id'];
 $review = new Review($id);
 DBQuery::execute(function() use ($dbDomain,$id,$date){
    $sql = $dbDomain->prepare("update Review set is_deleted=1 where id=:id");
    $sql->bindParam(':id',$id);
    $sql->execute();


    $sql1 = $dbDomain->prepare("update Opened_Cases set case_status='C', closed_date=:date where review_id=:id");
    $sql1->bindParam(':id',$id);
    $sql1->bindParam(':date',$date);
    $sql1->execute();
 });

$average = Review::getRateAvgByItem('listing',$review->item_id, "count");
$set     = Listing::setAvgReview($average['rate'], $review->item_id, $average['review_count']);
}

?>
