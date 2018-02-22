<?php
    /*==================================================================*\
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
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/code/review.php
    # ----------------------------------------------------------------------------------------------------
include_once(CLASSES_DIR.'/class_ReviewCollector.php');
    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
/**
 * @Modification 
 * POST  data is sanitized in validator.php
 */
$validator = ModFactory::getValidator();
//$_POST = $validator->escape( $_POST );  

if (!$item_type && !$item_id && !$AppRequest) {
        header("location: ".DEFAULT_URL."/index.php");
        exit;
    }
    if ($item_type == "listing") {
        $itemObj = new Listing($item_id);
        $item_name = $itemObj->getString("title");
    } else if ($item_type == "promotion") {
        $itemObj = new Promotion($item_id);
        $item_name = $itemObj->getString("name");
    } else if ($item_type == "article") {
        $itemObj = new Article($item_id);
        $item_name = $itemObj->getString("title");
    }

    $rating_stars = "";

    $hostReview = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
    $host_cookieReview = str_replace(".", "_", $hostReview);


    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------

    $success_review = false;
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        setting_get("review_manditory", $review_manditory);
        setting_get("review_approve", $review_approve);

        if ($_COOKIE[$host_cookieReview."review"]) {
            $cookie_value = $_COOKIE[$host_cookieReview."review"];
            $cookie_arr   = explode(":",$_COOKIE[$host_cookieReview."review"]);
        }

        $allowed = true;

        if (!$_POST["rating"]) {
            $message_review = system_showText(LANG_MSG_REVIEW_SELECTRATING);
            $allowed = false;
        } elseif ($_POST["rating"] > 5 ) {
            $message_review = system_showText(LANG_MSG_REVIEW_FRAUD_SELECTRATING);
            $allowed = false;
        } elseif (!trim($_POST["review"]) || !trim($_POST["review_title"])) {
            $message_review = system_showText(LANG_MSG_REVIEW_COMMENTREQUIRED);
            $allowed = false;
        }

        if ($review_manditory == "on") {
            if (!trim($_POST["reviewer_name"]) ) {
                $message_review = system_showText(LANG_MSG_REVIEW_NAMEEMAILREQUIRED);
                $allowed = false;
            }
        }

        if ($_POST["reviewer_email"] && !validate_email($_POST["reviewer_email"])) {
            $message_review = system_showText(LANG_MSG_REVIEW_TYPEVALIDEMAIL);
            $allowed = false;
        }

        if (!$AppRequest && !$_GET['postreview']) {
//            if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
//                $message_review = system_showText(LANG_MSG_CONTACT_TYPE_CODE);
//                $allowed = false;
//            }

    #############################################################################################################            
    
    # LETTING USER IN WITHOUT CAPTCHA KEY, HENCE COMMENTED OUT

    #############################################################################################################
        
        //TODO : Check if this space if it allows user to post multiple comment in quick succession.
            // if ($cookie_arr) {
            //     foreach ($cookie_arr as $eah_cookie_value) {
            //         if ($item_id == $eah_cookie_value) {
            //             $message_review = system_showText(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION);
            //             $allowed = true;
            //         }
            //     }
            // }
        }
        
        //TODO: Check this space if it allows user to post multiple comment for same listing.
        // $reviewObj = new Review();
        // $denied_ips = $reviewObj->getDeniedIpsByItem($item_type, $itemObj->getString("id"));
        // if ($denied_ips) {
        //     foreach ($denied_ips as $each_ip) {
        //         if ($_SERVER["REMOTE_ADDR"] == $each_ip) {
        //             $message_review = system_showText(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION);
        //             $allowed = true;
        //         }
        //     }
        // }
    #############################################################################################################
        // for ($i = 1; $i < 6; $i++) {
        //  $img  = "<img ";
        //  $img .= ($i <= $rating) ? "src=\"".DEFAULT_URL."/images/content/img_rate_star_on.gif\" alt=\"Star On\"" : "src=\"".DEFAULT_URL."/images/content/img_rate_star_off.gif\" alt=\"Star Off\"";
        //  $img .= "onclick=\"setRatingLevel($i)\"";
        //  $img .= "onmouseout=\"resetRatingLevel()\"";
        //  $img .= "onmouseover=\"setDisplayRatingLevel($i)\"";
        //  $img .= "name=\"star$i\" />";
        //  $rating_stars .= $img;
        // }

        if ($allowed) {
                    
            $_POST["ip"] = $_SERVER["REMOTE_ADDR"];
            $reviewObj = new Review($_POST);
            $reviewer_account_id = $_POST['account_id'];

            if ($review_approve != "on") {
                $reviewObj->setNumber("approved", 1);
            }
            
            $reviewObj->Save();
            $updateReceivedOn = ReviewCollector::UpdateRecievedOn($reviewObj->item_id, $reviewObj->member_id, date("Y-m-d h:i:s"));
            if($activation_by_review) { //only if review is from email (emailer review)
            $activation_by_review->save($campaign_id, $email, $listing_id , 'Review');    
        }

            // If session_id from reviewcollector matches, then review column is_collected
//                $sess_id = $_SESSION['hash_sess_id'];
//                $check   = ReviewCollector::CheckSession($sess_id, $reviewObj->item_id);
            // Optional : Check if he has already gave review from this session - Skipped
                if($email_review){
                    $reviewObj->UpdateIsCollected($reviewObj->id, $reviewObj->item_id);
                    ReviewCollector::addEmailAccountToDatabaseFromCollectedReview($email, $campaign_id, $item_id, 'Listing');
                }

            /**
             * To send email or post on facebook wall when a user reviews 
             * something.
             */
            // OLD CODE DISPATCHER
//            $reviewAdapter  = PluginRegistry::getEvent( 'ReviewEvent' );
//            $reviewAdapter->setReview( $reviewObj );
//            $reviewAdapter->setItem( $itemObj );
//            $dispatcher     = PluginRegistry::getDispatcher();
//            $dispatcher->dispatch( 'UserReview', $reviewAdapter );
                
                
                     /*             * * New Code  send email notification to reviewer ** */
//       
                $contactObj = new Contact($reviewer_account_id);
                $detailLink           = LISTING_DEFAULT_URL."/".$itemObj->friendly_url;
                if ($emailNotificationObj = system_checkEmail(58)) {
                    setting_get("sitemgr_send_email", $sitemgr_send_email);
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");
                    $body = str_replace("ACCOUNT_NAME", $reviewObj->reviewer_name, $body);
                    $listing_name = $itemObj->title;
                    $lt_sign = htmlspecialchars('&lt;');
                    $gt_sign = htmlspecialchars('&gt;');
                    $listing_name = str_replace("<" , $lt_sign ,$listing_name);
                    $listing_name = str_replace(">" , $gt_sign ,$listing_name);
                    $body = str_replace("LISTING_NAME", $listing_name, $body);
                    $body = str_replace("REVIEW", $reviewObj->review, $body);
                    $body = str_replace("LISTING_URL",$detailLink, $body);
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error = false;

                    $send_email_reviewer = system_mail($contactObj->email, $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
                    if ($send_email_reviewer && LOG_BUILDER == TRUE) {
                        $message = "Method_type: " . $input['method_type'] .
                                " Email has been sent to reviewer through web on " . date("F j, Y, g:i a") . "\r\n\r\n";
                        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
                    } else {
                        $message = "Method_type: " . $input['method_type'] .
                                " Unable to send email to reviewer through web on " . date("F j, Y, g:i a") . "\r\n\r\n";
                        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
                    }
                }
            
            
            if ($review_approve != "on") {
                $average = $reviewObj->getRateAvgByItem($item_type, $item_id,"Count");
                $avg     = $average['rate'];
                $count   = $average['review_count'];

                if (!is_numeric($avg)) $avg = 0;
                if ($item_type == 'listing') {
                    
                    $listing = new Listing();
                    $listing->setAvgReview($avg, $item_id, $count);
                }

            }

            $reviewObj = new Review($reviewObj->getString("id"));

            $value = ($cookie_value) ? $cookie_value.":".$item_id : $item_id;

            setcookie($host_cookieReview."review", "$value", time()-3600, "".EDIRECTORY_FOLDER."/");
            setcookie($host_cookieReview."review", "$value", time()+60*60*24*30*120, "".EDIRECTORY_FOLDER."/");

            if ($reviewObj->getString("review")) {
                //var_dump($itemObj);
                $account_id = $itemObj->account_id; //var_dump($account_id);
                $account1 = new Account($account_id); //var_dump($account1);
                $notify_traffic_listing = $account1->notify_traffic_listing;
               
                setting_get("sitemgr_rate_email", $sitemgr_rate_email);
                $sitemgr_rate_emails = explode(",", $sitemgr_rate_email);
                if ( ! $reviewObj->getString("reviewer_email") ) $reviewObj->setString("reviewer_email", "anonimous");

                // site manager warning message /////////////////////////////////////
                $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_NEWREVIEW);
                
                $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />"
                                ."\"".$item_name."\" ".system_showText(LANG_NOTIFY_NEWREVIEW_1)." - ".$reviewObj->getString("rating")." ".system_showText(LANG_NOTIFY_NEWREVIEW_2)." <br />"
                                .$reviewObj->getString("reviewer_name")." (".$reviewObj->getString("reviewer_email").") ".system_showText(LANG_NOTIFY_NEWREVIEW_4)." ".$reviewObj->getString("reviewer_location")." ".system_showText(LANG_NOTIFY_NEWREVIEW_5).": <br />"
                                .$reviewObj->getString("review_title")."<br />"
                                .$reviewObj->getString("review")."<br />"
                                .format_date($reviewObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
                                ."".system_showText(LANG_NOTIFY_NEWREVIEW_3)." :<br />"
                                ."<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/review/view.php?id=".$reviewObj->getString("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/review/view.php?id=".$reviewObj->getString("id")."</a><br /><br />";
                
                system_notifySitemgr($sitemgr_rate_emails, $emailSubject, $sitemgr_msg);
                
                /* send e-mail to listing owner */
                if($reviewObj->getString('item_type') == 'listing') {
                    
                 $detailLink = LISTING_DEFAULT_URL."/".$itemObj->friendly_url;
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW)) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                        $subject   = $emailNotificationObj->getString("subject");
                        $body      = $emailNotificationObj->getString("body");
                         $body = str_replace("LISTING_URL",$detailLink, $body);
                        $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                        $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                        $body      = html_entity_decode($body);
                        $subject   = html_entity_decode($subject);
                        $error = false;
                        // var_dump($notify_traffic_listing);
                        if($notify_traffic_listing == "y"){
                            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
                        }
                    }
                }
                
                /* send e-mail to article owner */
                if($reviewObj->getString('item_type') == 'article') {
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW)) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                        $subject   = $emailNotificationObj->getString("subject");
                        $body      = $emailNotificationObj->getString("body");
                        $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
                        $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
                        $body      = html_entity_decode($body);
                        $subject   = html_entity_decode($subject);
                        system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
                    }
                }
                 /* send e-mail to promotion owner */
                if($reviewObj->getString('item_type') == 'promotion') {
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW)) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                        $subject   = $emailNotificationObj->getString("subject");
                        $body      = $emailNotificationObj->getString("body");
                        $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'promotion');
                        $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'promotion');
                        $body      = html_entity_decode($body);
                        $subject   = html_entity_decode($subject);
                        system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_REVIEW);
                    }
                }

                /* */
                
                if (!$review_approve == 'on') {
                    /* send e-mail to listing owner */
                    if($reviewObj->getString('item_type') == 'listing') {
                        $contactObj = new Contact($itemObj->getNumber('account_id'));
                        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW)) {
                            setting_get("sitemgr_send_email", $sitemgr_send_email);
                            setting_get("sitemgr_email", $sitemgr_email);
                            $sitemgr_emails = explode(",", $sitemgr_email);
                            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                            $subject   = $emailNotificationObj->getString("subject");
                            $body      = $emailNotificationObj->getString("body");
                            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                            $body      = html_entity_decode($body);
                            $subject   = html_entity_decode($subject);
                            // var_dump($notify_traffic_listing);
                            if($notify_traffic_listing == "y"){
                                system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_APPROVE_REVIEW);
                            }
                        }
                    }
                    
                    /* send e-mail to article owner */
                    if($reviewObj->getString('item_type') == 'article') {
                        $contactObj = new Contact($itemObj->getNumber('account_id'));
                        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW)) {
                            setting_get("sitemgr_send_email", $sitemgr_send_email);
                            setting_get("sitemgr_email", $sitemgr_email);
                            $sitemgr_emails = explode(",", $sitemgr_email);
                            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                            $subject   = $emailNotificationObj->getString("subject");
                            $body      = $emailNotificationObj->getString("body");
                            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
                            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
                            $body      = html_entity_decode($body);
                            $subject   = html_entity_decode($subject);
                            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_APPROVE_REVIEW);
                        }
                    }
                    /* send e-mail to promotion owner */
                    if($reviewObj->getString('item_type') == 'promotion') {
                        $contactObj = new Contact($itemObj->getNumber('account_id'));
                        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW)) {
                            setting_get("sitemgr_send_email", $sitemgr_send_email);
                            setting_get("sitemgr_email", $sitemgr_email);
                            $sitemgr_emails = explode(",", $sitemgr_email);
                            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                            $subject   = $emailNotificationObj->getString("subject");
                            $body      = $emailNotificationObj->getString("body");
                            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'promotion');
                            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'promotion');
                            $body      = html_entity_decode($body);
                            $subject   = html_entity_decode($subject);
                            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_APPROVE_REVIEW);
                        }
                    }

                    /* */
                }

            }

        //Check if user is activated or not while writing review part 2
        

            $activeornot = $_POST["activeornot"]; //$_POST["activeornot"] was sent from form_review_review.php
            
            if ($activeornot == "n") {
                //USER NOT ACTIVE    
                $message_review  .= "Thank you for the feedback!";//system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);
                $message_review .= "<br />" . "<strong>Your review has been noted but will not be posted until you validate your account, please validate it now.</strong> <br/>";
            } else { 
                //USER ACTIVE
                 $message_review  .= '';
                 $message_review .= "<strong>Thank you for the feedback!</strong>";//system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);//system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);
                 $message_review .= '<br>' . '';
                }
        //END Check if user is activated or not while writing review part 2  
            if ($review_approve == "on") {
                $message_review .= " "."Thank you for the feedback!";//system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);//system_showText(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL);
            }
            //$message_review .='</div>';
            $success_review = true;

        }

        if (!$AppRequest) {
            $_POST = format_magicQuotes($_POST);
            $_GET  = format_magicQuotes($_GET);
            extract($_POST);
            extract($_GET);
        }
    }
    
        
    # ----------------------------------------------------------------------------------------------------
    # FORM DEFINES
    # ----------------------------------------------------------------------------------------------------
    if (!$AppRequest) {
        $socialObj = new SettingSocialNetwork($item_type."_rate");
        $status = $socialObj->getString('value');
        
        if($email_review){
            $id = $user[$key]['id'];
            $reviewerAcc = new Account($id);
            $reviewerInfo = new Contact($id);
            $reviewerProfile = new Profile($id);
        }
        elseif ($status == "yes" || sess_getAccountIdFromSession()) {
            $id = sess_getAccountIdFromSession();
            $reviewerAcc = new Account($id);
            $reviewerInfo = new Contact($id);
            $reviewerProfile = new Profile($id);
        }
    }
?>