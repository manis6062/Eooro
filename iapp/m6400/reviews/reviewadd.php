<?

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
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/configuration.inc.php");


	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------

	setting_get("review_approve", $review_approve);

	unset($reviewObj);
	$reviewObj = new Review();
	
	$reviewObj->setString("item_type", "listing");
	$reviewObj->setString("item_id", $_POST["item_id"]);
	$reviewObj->setString("member_id", $_POST["account_id"]);
	$reviewObj->setString("ip", $_SERVER["REMOTE_ADDR"]);
	$reviewObj->setString("review_title", $_POST["review_title"]);
	$reviewObj->setString("review", $_POST["review"]);
	$reviewObj->setString("reviewer_name", $_POST["name"]);
	$reviewObj->setString("reviewer_email", $_POST["email"]);
	$reviewObj->setString("reviewer_location", $_POST["location"]);
	$reviewObj->setString("rating", $_POST["rating"]);

	if ($review_approve != "on") {
		$reviewObj->setNumber("approved", 1);
    } else {
		$reviewObj->setNumber("approved", 0);
    }

	$reviewObj->Save();
	
	$itemObj = new Listing($reviewObj->item_id);
	
	if ($review_approve != "on") {
		$avg = $reviewObj->getRateAvgByItem("listing", $reviewObj->item_id);
		if (!is_numeric($avg)) $avg = 0;
		$listing = new Listing();
		$listing->setAvgReview($avg, $reviewObj->item_id);
	}
	
	unset($xml_output);
	$xml_output  = "<?xml version=\"1.0\" encoding=\"".EDIR_CHARSET."\"?>\n";
	////$xml_output  .="<feed xmlns=\"http://www.w3.org/2005/Atom\">";

//	if ($reviewObj->getString("review")) {

		setting_get("sitemgr_send_email",$sitemgr_send_email);
		setting_get("sitemgr_email",$sitemgr_email);
		$sitemgr_emails = split(",",$sitemgr_email);
		setting_get("sitemgr_rate_email",$sitemgr_rate_email);
		$sitemgr_rate_emails = split(",",$sitemgr_rate_email);
		if ( ! $reviewObj->getString("reviewer_email") ) $reviewObj->setString("reviewer_email", "anonimous"); 

        // site manager warning message /////////////////////////////////////
        $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_NEWREVIEW);

        $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />"
        ."\"".$itemObj->getString("title")."\" ".system_showText(LANG_NOTIFY_NEWREVIEW_1)." - ".$reviewObj->getString("rating")." ".system_showText(LANG_NOTIFY_NEWREVIEW_2)." <br />"
        .$reviewObj->getString("reviewer_name")." (".$reviewObj->getString("reviewer_email").") ".system_showText(LANG_NOTIFY_NEWREVIEW_4)." ".$reviewObj->getString("reviewer_location")." ".system_showText(LANG_NOTIFY_NEWREVIEW_5).": <br />"
        .$reviewObj->getString("review_title")."<br />"
        .$reviewObj->getString("review")."<br />"
        .format_date($reviewObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
        ."".system_showText(LANG_NOTIFY_NEWREVIEW_3)." :<br />"
        ."<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/review/view.php?id=".$reviewObj->getString("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/review/view.php?id=".$reviewObj->getString("id")."</a><br /><br />";

        system_notifySitemgr($sitemgr_rate_emails, $emailSubject, $sitemgr_msg);
              
        /* send e-mail to listing owner */
        if ($reviewObj->getString('item_type') == 'listing') {
            $contactObj = new Contact($itemObj->getNumber('account_id'));
            if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW, $contactObj->getString("lang"))) {
                setting_get("sitemgr_send_email", $sitemgr_send_email);
                setting_get("sitemgr_email", $sitemgr_email);
                $sitemgr_emails = split(",", $sitemgr_email);
                if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                $subject   = $emailNotificationObj->getString("subject");
                $body      = $emailNotificationObj->getString("body");
                $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                $body      = html_entity_decode($body);
                $subject   = html_entity_decode($subject);
                $error = false;
                system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $reviewObj->item_id, $contactObj->account_id, SYSTEM_NEW_REVIEW);
            }
        }
               
        if (!$review_approve == 'on') {
            /* send e-mail to listing owner */
            if($reviewObj->getString('item_type') == 'listing') {
                $contactObj = new Contact($itemObj->getNumber('account_id'));
                if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
                    setting_get("sitemgr_send_email", $sitemgr_send_email);
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = split(",", $sitemgr_email);
                    if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                    $subject   = $emailNotificationObj->getString("subject");
                    $body      = $emailNotificationObj->getString("body");
                    $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                    $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                    $body      = html_entity_decode($body);
                    $subject   = html_entity_decode($subject);
                    system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $reviewObj->item_id, $contactObj->account_id, SYSTEM_APPROVE_REVIEW);
                }
            }
        }

//    }

	header("Location:review.php?id=".$reviewObj->id);

?>