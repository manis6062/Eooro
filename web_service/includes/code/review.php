<?php
/* ==================================================================*\
  ######################################################################
  #                                                                    #
  # Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
  #                                                                    #
  # This file may not be redistributed in whole or part.               #
  # eDirectory is licensed on a per-domain basis.                      #
  #                                                                    #
  # ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
  #                                                                    #
  # http://www.edirectory.com | http://www.edirectory.com/license.html #
  ######################################################################
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/review.php
# ----------------------------------------------------------------------------------------------------
include_once(EDIRECTORY_ROOT . "/conf/constants.inc.php");
include_once(CLASSES_DIR . '/class_ReviewCollector.php');
# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------

if (!$_GET['review'] && !$input['review']) {
    unset($review);
}

reset($input);
foreach ($input as $key => $value) {
    $input[$key] = trim($value);
}
reset($_GET);
foreach ($_GET as $key => $value) {
    $_GET[$key] = trim($value);
}

extract($input);

if ($_GET['widget_item_id']) { //get encrypted widget item id
    $widget_review = openssl_decrypt(base64_decode($widget_item_id), 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY);//decrypt widget item id
    parse_str($widget_review);
    $listing_id = Validator::integer($item_id, TRUE);
    $_GET['item_id'] = $listing_id;
    $input["item_id"] = $listing_id;
    include_once(EDIRECTORY_ROOT . "/classes/class_ReviewCollector.php");
    $reviewer_email = $_POST['email'];
    $reviewer_name = $_POST['reviewer_name'];
    $review_title = $_POST['review_title'];

    if ($_POST) {
        $input = $_POST;
    }
}
extract($_GET);

$rating = $input["rating"];
$review = $input["review"];
// Review string sanatize
$review = filter_var($review, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

if ($item_type == "listing") {
    $itemObj = new Listing($item_id);
    $item_name = $itemObj->getString("title");
}

$rating_stars = "";

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

$success_review = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    setting_get("review_manditory", $review_manditory);
    setting_get("review_approve", $review_approve);
    $allowed = true;
    if (!$input["rating"]) {
        $message_review = system_showText(LANG_MSG_REVIEW_SELECTRATING);
        $allowed = false;
    } elseif ($input["rating"] > 5) {
        $message_review = system_showText(LANG_MSG_REVIEW_FRAUD_SELECTRATING);
        $allowed = false;
    } elseif (!trim($input["review"]) || !trim($input["review_title"])) {
        $message_review = system_showText(LANG_MSG_REVIEW_COMMENTREQUIRED);
        $allowed = false;
    }

    if ($review_manditory == "on") {
        if (!trim($input["reviewer_name"])) {
            $message_review = system_showText(LANG_MSG_REVIEW_NAMEEMAILREQUIRED);
            $allowed = false;
        }
    }
    if ($input["reviewer_email"] && !validate_email($input["reviewer_email"])) {
        $message_review = system_showText(LANG_MSG_REVIEW_TYPEVALIDEMAIL);
        $allowed = false;
    }
    if ($allowed) {
        $input["ip"] = $_SERVER["REMOTE_ADDR"];
        $reviewObj = new Review($input);

        if ($review_approve != "on") {
            $reviewObj->setNumber("approved", 1);
        }
        $reviewObj->status = 'P';
        $unique_key = md5(uniqid(rand(), true));
        if ($_GET['widget_item_id']) {
             $campaign_id = 1;

        }else{
             $campaign_id = get_campaign_id();

        }
        $reviewObj->unique_key = $unique_key;
        $review_result = $reviewObj->Save();
        //Build Log
        if ($review_result && LOG_BUILDER == TRUE) {
            $message = "Method_type: " . $input['method_type'] .
                    " Saved to database on " . date("F j, Y, g:i a") . "\r\n";
            file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
        } else {
            $message = "Method_type: " . $input['method_type'] .
                    " Unable to saved to database on " . date("F j, Y, g:i a") . "\r\n";
            file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
        }

        $review_id = $reviewObj->id;
        $originalLinkQuery = "item_id=$review_id&email=$reviewer_email&campaign_id=" . $campaign_id;
        $cryptedQuery = @base64_encode(openssl_encrypt($originalLinkQuery, 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY));
        $activation_reviewObj = new Account_ActivationByReview();
        $activation_reviewObj->save($campaign_id, $reviewer_email, $reviewObj->id, 'Review');
        if ($review_result) {
            echo json_encode(array('status' => 'success', 'msg' => "Thank you! Please click 'Submit' in the confirmation email."));
        } else {
            echo json_encode(array('status' => 'failed', 'msg' => 'Oops, Review failed! There might be something wrong.'));
            exit;
        }

        $updateReceivedOn = ReviewCollector::UpdateRecievedOn($reviewObj->item_id, $reviewObj->member_id, date("Y-m-d h:i:s"));

        // Optional : Check if he has already gave review from this session - Skipped
        if ($email_review) {
            $reviewObj->UpdateIsCollected($reviewObj->id, $reviewObj->item_id);
            ReviewCollector::addEmailAccountToDatabaseFromCollectedReview($email, $campaign_id, $item_id, 'Listing');
        }

        $reviewObj = new Review($reviewObj->getString("id"));

        $value = ($cookie_value) ? $cookie_value . ":" . $item_id : $item_id;

        if ($reviewObj->getString("review")) {

            $account_id = $itemObj->account_id;
            $account1 = new Account($account_id);
            $notify_traffic_listing = $account1->notify_traffic_listing;

            setting_get("sitemgr_rate_email", $sitemgr_rate_email);
            $sitemgr_rate_emails = explode(",", $sitemgr_rate_email);
            if (!$reviewObj->getString("reviewer_email"))
                $reviewObj->setString("reviewer_email", "anonimous");

            // site manager warning message /////////////////////////////////////
            $emailSubject = "[" . EDIRECTORY_TITLE . "] " . system_showText(LANG_NOTIFY_NEWREVIEW);

            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />"
                    . "\"" . $item_name . "\" " . system_showText(LANG_NOTIFY_NEWREVIEW_1) . " - " . $reviewObj->getString("rating") . " " . system_showText(LANG_NOTIFY_NEWREVIEW_2) . " <br />"
                    . $reviewObj->getString("reviewer_name") . " (" . $reviewObj->getString("reviewer_email") . ") " . system_showText(LANG_NOTIFY_NEWREVIEW_4) . " " . $reviewObj->getString("reviewer_location") . " " . system_showText(LANG_NOTIFY_NEWREVIEW_5) . ": <br />"
                    . $reviewObj->getString("review_title") . "<br />"
                    . $reviewObj->getString("review") . "<br />"
                    . format_date($reviewObj->getString("added"), DEFAULT_DATE_FORMAT . " H:i:s", "datetime") . "<br /><br />"
                    . "" . system_showText(LANG_NOTIFY_NEWREVIEW_3) . " :<br />"
                    . "<a href=\"" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/review/view.php?id=" . $reviewObj->getString("id") . "\" target=\"_blank\">" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/review/view.php?id=" . $reviewObj->getString("id") . "</a><br /><br />";

            system_notifySitemgr($sitemgr_rate_emails, $emailSubject, $sitemgr_msg);

            if (!$review_approve == 'on') {
                /* send e-mail to listing owner */
                if ($reviewObj->getString('item_type') == 'listing') {
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if ($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW)) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0])
                            $sitemgr_email = $sitemgr_emails[0];
                        $subject = $emailNotificationObj->getString("subject");
                        $body = $emailNotificationObj->getString("body");
                        $body = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                        $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                        $body = html_entity_decode($body);
                        $subject = html_entity_decode($subject);

                        $send_mail_owner2 = system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_APPROVE_REVIEW);
                        //Build Log
                        if($input['method_type']){
                            
                        if ($send_mail_owner2 && LOG_BUILDER == TRUE) {
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
                }
            }

            /*             * * send email notification to reviewer ** */
            if ($reviewObj->getString('item_type') == 'listing') {
                $orig_query = "review_id=" . $review_id . "&listing_id=" . $input['item_id'];
                $encrypted_query = @base64_encode(openssl_encrypt($orig_query, 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY));
                // activate review
                $linkActivation = DEFAULT_URL . "/web_service/includes/code/review.php?activation_key=" . $cryptedQuery;
                // update review
                $review_details = DEFAULT_URL . "/reviewcollector.php?update_review=" . $encrypted_query;
                $contactObj = new Contact($itemObj->getNumber('account_id'));
                if ($emailNotificationObj = system_checkEmail(56)) {
                    setting_get("sitemgr_send_email", $sitemgr_send_email);
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");
                    $body = str_replace("ACCOUNT_NAME", ($reviewer_name), $body);
                    if ($_GET['widget_item_id']) { 
                        $listing_nam = $_POST['listing_name'];
                    }
                    else{
                        $listing_nam = $itemObj->title;
                    }
                    $listing_name = $listing_nam;
                    $lt_sign = htmlspecialchars('&lt;');
                    $gt_sign = htmlspecialchars('&gt;');
                    $listing_name = str_replace("<" , $lt_sign ,$listing_name);
                    $listing_name = str_replace(">" , $gt_sign ,$listing_name);
                    $body = str_replace("LISTING_NAME", $listing_name, $body);
                    $body = str_replace("RATING", $rating, $body);
                    $body = str_replace("REVIEW", $review, $body);
                    $body = str_replace("TITLE", $review_title, $body);
                    $body = str_replace("LISTING_URL", $linkActivation, $body);
                    $body = str_replace("LISTINGDETAILS", $review_details, $body);
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error = false;
                    if ($_GET['widget_item_id']) {
                        $r_email = $_POST['email'];
                    } else
                        $r_email = $input['reviewer_email'];
                    $send_email_reviewer = system_mail($r_email, $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
                   
                    if($input['method_type']){
                        if ($send_email_reviewer && LOG_BUILDER == TRUE) {
                        $message = "Method_type: " . $input['method_type'] .
                                " Email has been sent to reviewer on " . date("F j, Y, g:i a") . "\r\n\r\n";
                        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
                    } else {
                        $message = "Method_type: " . $input['method_type'] .
                                " Unable to send email to reviewer on " . date("F j, Y, g:i a") . "\r\n\r\n";
                        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
                    }
                        
                    }
                    
                    
                    
                }
            }
        }

        //Check if user is activated or not while writing review part 2
        $activeornot = $input["activeornot"]; //$input["activeornot"] was sent from form_review_review.php
        if ($activeornot == "n") {
            //USER NOT ACTIVE    
            $message_review .= "Thank you for the feedback!"; //system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);
            $message_review .= "<br />" . "<strong>Your review has been noted but will not be posted until you validate your account, please validate it now.</strong> <br/>";
        } else {
            //USER ACTIVE
            $message_review .= '';
            $message_review .= "<strong>Thank you for the feedback!</strong>"; //system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);//system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);
            $message_review .= '<br>' . '';
        }
        //END Check if user is activated or not while writing review part 2  
        if ($review_approve == "on") {
            $message_review .= " " . "Thank you for the feedback!"; //system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);//system_showText(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL);
        }
        //$message_review .='</div>';
        $success_review = true;
    }

    if (!$AppRequest) {
        $input = format_magicQuotes($input);
        $_GET = format_magicQuotes($_GET);
        extract($input);
        extract($_GET);
    }
} elseif ($_GET["activation_key"]) {
    include("../../../conf/loadconfig.inc.php");
    //include("../conf/loadconfig.inc.php");
    include(CLASSES_DIR . "/classes/class_Review.php");
    include(CLASSES_DIR . "/classes/class_Listing.php");
    $postreview = openssl_decrypt(base64_decode($_GET["activation_key"]), 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY);
    parse_str($postreview);
    $review_id = Validator::integer($item_id, TRUE);
    $email = validate_email($email) ? $email : '';
    $campaign_id = Validator::campaignId(trim($campaign_id), true);
    $result = Review::activateReview($campaign_id, $email, $review_id, "Review");
    if ($result) {
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($domain, $review_id, &$execute) {
            $stmt = $domain->prepare("UPDATE Review "
                    . "SET status = 'A'"
                    . "WHERE id = :id");
            $stmt->bindParam(':id', $review_id);

            $execute = $stmt->execute();
        });
        if ($execute) {
            $listing_id = Review::getListingIdFromReviewId($item_id);
            $listing_id = $listing_id['item_id'];
            $listingObj = new Listing($listing_id);
            $item_type = 'listing';
            if ($review_approve != "on") {
                $reviewObj = new Review();
                $average = $reviewObj->getRateAvgByItem($item_type, $listing_id, "Count");
                $avg = $average['rate'];
                $count = $average['review_count'];

                if (!is_numeric($avg))
                    $avg = 0;
                if ($item_type == 'listing') {
                    $listing = new Listing();
                    $listing->setAvgReview($avg, $listing_id, $count);

                    /* send e-mail to listing owner */
                    $itemObj = $listingObj;
                    $friendly_url = $itemObj->friendly_url;
                    $url = DEFAULT_URL . "/company-reviews/" . $friendly_url;
                    $reviewObj = new Review();
                    $reviewObj->id = $review_id;
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
                        $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                        $body = str_replace("LISTING_URL", $url, $body);
                        $body = html_entity_decode($body);
                        $subject = html_entity_decode($subject);
                        $error = false;
                        $send_mail_owner = system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
                        //Build Log
                        if($input['method_type']){                           
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
                }
            }
            header("Location: " . DEFAULT_URL . "/company-reviews/" . $listingObj->friendly_url);
        } else {
            echo "Oops! There is something wrong! Your review activation is failed!";
        }
    }
}
?>