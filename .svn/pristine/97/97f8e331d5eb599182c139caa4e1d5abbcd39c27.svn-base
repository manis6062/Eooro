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
	# * FILE: /contactuscontent.php
	# ----------------------------------------------------------------------------------------------------

	if ($_POST) {
		$senderror = false;
//		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
//			$captchaerror = true;
//		}
		$emailerror = false;
		if (!validate_email($_POST["email"])) {
			$emailerror = true;
		}
		$nameerror = false;
		if (!$_POST["name"]) {
			$nameerror = true;
		}
		$titleerror = false;
		if (!$_POST["title"]) {
			$titleerror = true;
		}
		$messageerror = false;
		if (!$_POST["messageBody"]) {
			$messageerror = true;
		}
		if (!$captchaerror && !$emailerror && !$nameerror && !$titleerror && !$messageerror) {
            
			$_POST["email"] = stripslashes($_POST["email"]);
			$_POST["name"] = stripslashes($_POST["name"]);
			$_POST["title"] = stripslashes($_POST["title"]);
			$_POST["messageBody"] = stripslashes($_POST["messageBody"]);
			$from_email = $_POST["email"];
			$from_name = $_POST["name"];
			$subject = $_POST["title"];
			$messageBody = LANG_MESSAGE_SENT_BY.$from_email."<br /><br />";
			$messageBody .= $_POST["messageBody"];
			$messageBody = str_replace("\r\n", "\n", $messageBody);
			$messageBody = str_replace("\n", "\r\n", $messageBody);
			$messageBody .= "<br /><br />----------------------------<br /><br />";
			$messageBody .= LANG_THIS_IS_A_AUTOMATIC_MESSAGE;
			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = explode(",", $sitemgr_email);
			setting_get("sitemgr_contactus_email", $sitemgr_contactus_email);
			$sitemgr_contactus_emails = explode(",", $sitemgr_contactus_email);
            
            setting_get("contact_email", $contact_email);
            $extraMail = array();
            if ($contact_email) {
                $extraMail[] = $contact_email;
            }
            
            $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_CONTACTUS)." - ".stripslashes(htmlspecialchars_decode($subject));
            system_notifySitemgr($sitemgr_contactus_emails, $emailSubject, stripslashes($messageBody), true, "", "", true, $extraMail, "$from_name <$from_email>", $from_email);
            
            $message_style = "successMessage";
            $contactus_message = system_showText(LANG_CONTACTMSGSUCCESS);
            unset($_POST["email"]);
            unset($_POST["name"]);
            unset($_POST["title"]);
            unset($_POST["messageBody"]);
			
		}
        
		if ($nameerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_NAME)."<br />";
		}
		if ($emailerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		}
		if ($titleerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_SUBJECT)."<br />";
		}
		if ($messageerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />";
		}
//		if ($captchaerror) {
//			$existerror = true;
//			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
//		}
		
		if ($existerror) {
			$message_style = "errorMessage";
			if (!$senderror) {
				$contactus_message .= system_showText(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN);
			}
		}
	}
    
    if (THEME_CONTACTUS_FIELDS) {
    
        $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
        $contactMap = "";
        
        setting_get("contact_email", $contact_email);
        setting_get("contact_phone", $contact_phone);
        setting_get("contact_address", $contact_address);
        setting_get("contact_zipcode", $contact_zipcode);
        setting_get("contact_country", $contact_country);
        setting_get("contact_state", $contact_state);
        setting_get("contact_city", $contact_city);
        
        $contact_separaror = "";
        if ($contact_city && $contact_state) {
            $contact_separator = ", ";
        }
        
        if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
            
            setting_get("contact_latitude", $contact_latitude);
            setting_get("contact_longitude", $contact_longitude);
            setting_get("contact_mapzoom", $contact_mapzoom);
            
            if ($contact_latitude && $contact_longitude) {
                
                $google_maptuning = $contact_latitude.",".$contact_longitude;
                $google_mapzoom = $contact_mapzoom;

                $show_html = false;
                include(INCLUDES_DIR."/views/view_google_maps.php");
                $contactMap = $google_maps;
                $google_maps = "";
            }
        }
    
    }
    
	include(system_getFrontendPath("contactus.php", "frontend"));
    
?>