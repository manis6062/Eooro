<?php

include("../conf/loadconfig.inc.php");

if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    header("Location:" . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/");
    exit;
}

if (!strpos($_SERVER['HTTP_REFERER'], SOCIALNETWORK_URL) > -1) {
    header("Location:" . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/");
    exit;
}

$dbMain = DBConnection::getInstance()->getMain();
$dbDomain = DBConnection::getInstance()->getDomain();
$account_id = sess_getAccountIdFromSession();

if ($_POST['ajax_type'] == 'review_delete') {
    $review_id = $_POST['review_id'];
    $reviewer_id = $_POST['reviewer_id'];

    //Check if account_id from session matches reviewer id
    if ($account_id != $reviewer_id) {
        echo "false";
        die();
    }

    //Check if review belongs to reviewer
    $review_exist = Review::checkIfReviewBelongsToUser($review_id, $reviewer_id);
    if (!$review_exist) {
        echo "false";
        die();
    }

    $review = new Review($review_id);
    $deleted = Review::deleteReview($review_id);
    $close_case = Review::CloseCaseOfReview($review_id);

    $average = Review::getRateAvgByItem('listing', $review->item_id, "count");
    $set = Listing::setAvgReview($average['rate'], $review->item_id, $average['review_count']);

    if ($deleted == true) {
        echo "true";
    }
} elseif ($_POST['ajax_type'] == 'review_message') {
    DBQuery::execute(function() use ($_POST,$dbDomain){
        $date = gmdate('Y-m-d h:i:s');
        $details['date'] = $date;
        $message = $_POST['msg'];
        $account_id = $_POST['member_id'];
        $owner_id = $_POST['owner_id'];
        $case = $_POST['cid'];
        $delivery_status = $_POST['delivery_status'];       
        if ($_POST) {
            if ($_POST['msg']) {  
                $sql = $dbDomain->prepare("INSERT INTO Case_Messages"
                            . " ("
                            . " case_id,"
                            . " from_user,"
                            . " to_user,"
                            . " message,"
                            . " date"
                            . " )"
                            . " VALUES"
                            . " ("
                            . " :case,"
                            . " :account_id,"
                            . " :owner_id,"
                            . " :message,"
                            . " :details_date"
                            . " )");
                $parameters = array(
                    ':case' => $case,
                    ':account_id' => $account_id,
                    ':owner_id' => $owner_id,
                    ':message' => $message,
                    ':details_date' => $details['date']
                );
                $resource = $sql->execute($parameters);
            } else {
                 $sql = $dbDomain->prepare("UPDATE Case_Messages SET delivery_status =:delivery_status WHERE from_user =:owner_id AND case_id =:case AND delivery_status ='0000-00-00 00:00:00'");
                    $param = array(
                        ':delivery_status' => $delivery_status,
                        ':owner_id' => $owner_id,
                        ':case' => $case
                    );
                   $resource = $sql->execute($param);
            }
        }
    });
} elseif ($_POST['ajax_type'] == 'close_case') {

    $date = gmdate('Y-m-d h:i:s');
    $details['date'] = $date;

    //Close Case and Keep/Delete Review
    $closemethod = $_POST['details']['closeMethod'];
    $case = $_POST['details']['case-id'];
    $accountid = $_POST['details']['account-id'];
    $review_id = $_POST["details"]["review-id"];
    
    if ($closemethod) {

        if ($closemethod == 'close-delete') {

            $review = new Review($review_id);
            $deleted = Review::deleteReview($review_id);
            $close_case = Review::CloseCaseOfReview($review_id);

            $average = Review::getRateAvgByItem('listing', $review->item_id, "count");
            $set = Listing::setAvgReview($average['rate'], $review->item_id, $average['review_count']);

            if ($resource == true && $resource2 == true) {
                echo "true";
            }
        } elseif ($closemethod == 'close-keep') {
            
            $review = new Review($review_id);
          $average = Review::getRateAvgByItemCloseCase('listing', $review->item_id, "count");
            $set = Listing::setAvgReview($average['rate'], $review->item_id, $average['review_count']);
   
            DBQuery::execute(function() use ($dbDomain,$date,$accountid,$case){
                $sql2 = $dbDomain->prepare("UPDATE Opened_Cases SET case_status ='C',closed_date =:date,closed_by =:account_id WHERE case_id =:case LIMIT 1");
                   $param = array(
                       ':date' => $date,
                       ':account_id' => $accountid,
                       ':case' => $case
                   );
                  $resource2 = $sql2->execute($param);
            });
            if ($resource2 == true) {
                echo "true";
            }
        }
    }
}
