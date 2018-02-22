<?php

$pop_type = "reviewformpopup";
$email_review = true;
$item_type = 'listing';

// Get details from url
$rawPostReview = $_GET['postreview'];
$postreview = openssl_decrypt(base64_decode($rawPostReview), 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY);

//Get details from url to update review
$update_post_review = $_GET['update_review'];
$update_review = openssl_decrypt(base64_decode($update_post_review), 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY);

//Get details from website widget
$widget_item_id = $_GET['widget_item_id'];
$widget_review = openssl_decrypt(base64_decode($widget_item_id), 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY);

//after posted review from update link from email
if ($update_review && $_POST['updated_id']) {
    parse_str($update_review);
    $reviews_id = Validator::integer($review_id, TRUE);
    $listing_id = $_POST['updated_id'];
    $listingObject = new Listing();
    $reviewObj = new Review();
    $reviewObj->id = $reviews_id;
    $reviewObj->item_id = $listing_id;
    $reviewObj->item_type = 'listing';
    $reviewObj->added = date("Y-m-d H:i:s");
    $reviewObj->status = 'A';
    $reviewObj->member_id = $_POST['member_id'];
    $reviewObj->ip = $_SERVER["REMOTE_ADDR"];
    $reviewObj->rating = $_POST['rating'];
    $reviewObj->review_title = $_POST['review_title'];
    $reviewObj->review = $_POST['review'];
    $reviewObj->reviewer_name = $_POST['reviewer_name'];
    $reviewObj->approved = 1;
    $review_result = $reviewObj->Save();
    $listingObj = new Listing($listing_id);
    $item_type = 'listing';
    $reviewObj = new Review();
    $average = $reviewObj->getRateAvgByItem($item_type, $listing_id, "Count");
    $avg = $average['rate'];
    $count = $average['review_count'];
    if (!is_numeric($avg))
        $avg = 0;
    if ($item_type == 'listing') {
        $listing = new Listing();
        $listing->setAvgReview($avg, $listing_id, $count);
    }
    $friendly_url = $listingObject->getFriendlyUrl($listing_id);
    header("Location: " . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . $friendly_url);

    /* send e-mail to listing owner */
    $itemObj = $listingObj;
    if ($reviewObj->status = 'A') {
        $url = DEFAULT_URL . "/" . ALIAS_LISTING_MODULE ."/" . $friendly_url;
        $contactObj = new Contact($itemObj->getNumber('account_id'));
        if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW)) {
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = explode(",", $sitemgr_email);
            if ($sitemgr_emails[0])
                $sitemgr_email = $sitemgr_emails[0];
            $subject = $emailNotificationObj->getString("subject");
            $body = $emailNotificationObj->getString("body");
            $body = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
            $body = str_replace("LISTING_URL", $url, $body);
            $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
            $body = html_entity_decode($body);
            $subject = html_entity_decode($subject);
            $error = false;
            $send_mail_owner = system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
            //Build Log
            if ($send_mail_owner && LOG_BUILDER == TRUE) {
                $message = "Method_type: " . $input['method_type'] .
                        " Email has been sent to listing owner on " . date("F j, Y, g:i a") . "\r\n";
                file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
            } else {
                $message = "Method_type: " . $input['method_type'] .
                        " Unable to sent email to listing owner on " . date("F j, Y, g:i a") . "\r\n";
                file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
            }
        }
    }
    die;
}

//to display review update form
if ($update_review && empty($_POST)) {
    parse_str($update_review);
    $reviews_id = Validator::integer($review_id, TRUE);
    $listing_id = Validator::integer($listing_id, TRUE);
    $review_details = Review::getReviewById($reviews_id);
    if ($review_details['status'] == 'P') {
        include(EDIRECTORY_ROOT . "/includes/code/reviewformpopup.php");
        include(system_getFrontendPath("reviewcollectorview.php", "frontend"));
        include(system_getFrontendPath('review_javascript.php'));
    } else {
        echo '<p class="alert alert-warning">
            You have already updated this review.
              </p>';
    }
} elseif ($postreview) { 
    parse_str($postreview);
    $listing_id = Validator::integer($item_id, TRUE);
    $email = validate_email($email) ? $email : '';
    $campaign_id = Validator::campaignId(trim($campaign_id), true);

    // Check if listing_id, email & campaign is present in database
    $activation_by_review = new Account_ActivationByReview();
    $record = $activation_by_review->getRecord($campaign_id, $email, $listing_id);

    if (empty($record)) {
        // check user account
        $user = ReviewCollector::getUsersFromEmail($email);
        // user exists
        $key = ReviewCollector::getKeyFromForeignAccount($_POST['user_select'], $user);
        if (!empty($user[$key])) {
            $_POST['member_id'] = $user[$key]['id'];
            $_POST['activeornot'] = $user[$key]['active'];
        }//create user account if not exist
        else if (empty($user[$key]) && $_POST['review']) {
            $_POST['signup'] = 'signup';
            $_POST['username'] = $_POST['email'] = $email;
            $_POST["retype_password"] = $_POST["password"] = substr(md5($email), rand(0, 10), 8);
            $_POST['first_name'] = $_POST['reviewer_name'];
            $_POST['last_name'] = '.';
            $_POST['agree_tou'] = true;
            $_POST['active'] = 'y';
            include(EDIRECTORY_ROOT . "/includes/code/login.php");
            $_POST['member_id'] = $account->getNumber('id');
            $_POST['activeornot'] = 'y';
        }
        // show review form
        include(EDIRECTORY_ROOT . "/includes/code/reviewformpopup.php");
        include(system_getFrontendPath("reviewcollectorview.php", "frontend"));
        include(system_getFrontendPath('review_javascript.php'));
    } else {
        echo '<p class="alert alert-warning">
            It seems we have already received your review for this business, however thank you for taking your time to write a review.
              </p>';
    }
} elseif ($widget_review && empty($_POST)) { //to display write review form from widget
    include(EDIRECTORY_ROOT . "/includes/code/reviewformpopup.php");
    include(system_getFrontendPath("reviewcollectorview.php", "frontend"));
    include(system_getFrontendPath('review_javascript.php'));
} elseif ($_POST['from_widget']) { // posted review data from widget
    parse_str($widget_review);
    $listing_id = Validator::integer($item_id, TRUE);
    $_POST['item_id'] = $listing_id;
    $email = $_POST['email'];
    $listingObj = new Listing($listing_id);
    if ($email && $listing_id) {
        // check user account
        $user = ReviewCollector::getUsersFromEmail($email);
        // user exists
        $key = ReviewCollector::getKeyFromForeignAccount($_POST['user_select'], $user);
        if (!empty($user[$key])) {
            $input['member_id'] = $_POST['member_id'] = $user[$key]['id'];
            $input['activeornot'] = $_POST['activeornot'] = $user[$key]['active'];
            include(EDIRECTORY_ROOT . "/web_service/includes/code/review.php");
             echo '<p class="alert alert-warning">
               Thank you for reviewing ' .  $listingObj->title .', Your review has been noted but will only be shown if this review is validated by clicking link sent on email. Please wait while we are redirecting you to the business page.
        </p>';
             header("Location: " . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . $listingObj->friendly_url); 
                                }//create user account if not exist
        else if (empty($user[$key]) && $_POST['review']) {
            $input['signup'] = $_POST['signup'] = 'signup';
            $input['username'] = $_POST['username'] = $_POST['email'] = $email;
            $input["retype_password"] = $_POST["retype_password"] = $_POST["password"] = substr(md5($email), rand(0, 10), 8);
            $input['first_name'] = $_POST['first_name'] = $_POST['reviewer_name'];
            $input['last_name'] = $_POST['last_name'] = '.';
            $input['agree_tou'] = $_POST['agree_tou'] = true;
            $input['active'] = $_POST['active'] = 'y';
            include(EDIRECTORY_ROOT . "/includes/code/login.php");
            $account = new Account($_POST);
	    $account->save();
            $input['member_id'] = $_POST['member_id'] = $account->getNumber('id');
            $input['activeornot'] = $_POST['activeornot'] = 'y';
            include(EDIRECTORY_ROOT . "/web_service/includes/code/review.php");
       echo '<p class="alert alert-warning">
               Thank you for reviewing ' .  $listingObj->title. ' We have noted your review but we will have to verify your email and before your review can be shown. Please wait while we are redirecting you to the business page.
        </p>';
        header("Location: " . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . $listingObj->friendly_url);
        }        
    }
} else {
    echo '<p class="alert alert-warning">
                Sorry, the page you requested does not exist.
        </p>';
}