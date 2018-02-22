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
	# * FILE: /leadcontent.php
	# ----------------------------------------------------------------------------------------------------

    require(CLASSES_DIR."/class_Formbuilder.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
			$captchaerror = true;
		}
        
		$emailerror = false;
		if (!validate_email($_POST["email"])) {
			$emailerror = true;
		}
        
		$nameerror = false;
		if (!$_POST["first_name"] || !$_POST["last_name"]) {
			$nameerror = true;
		}
        
		$subjecterror = false;
		if (!$_POST["subject"]) {
			$subjecterror = true;
		}
        
		$messageerror = false;
		if (!$_POST["messageBody"]) {
			$messageerror = true;
		}
        
        $editorerror = false;
        
        $editorFolder = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/editor/lead";

        if (file_exists($editorFolder."/save.json")) {

            $jsonstr = file_get_contents($editorFolder."/save.json");
            $arrayJson = array("form_structure" => $jsonstr);
            $form = new Formbuilder($arrayJson);
            $results = $form->process();

            if (!empty($results["errors"])) {
                $editorerror = true;
                $editorMessage = system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."<br />";
                foreach ($results["errors"] as $err) {
                    $editorMessage .= "&#149;&nbsp;".$err."<br />";
                }
            }
        }
        
		if (!$captchaerror && !$emailerror && !$nameerror && !$subjecterror && !$messageerror && !$editorerror) {
            
			$_POST["email"] = stripslashes($_POST["email"]);
			$_POST["first_name"] = stripslashes($_POST["first_name"]);
			$_POST["last_name"] = stripslashes($_POST["last_name"]);
			$_POST["phone"] = stripslashes($_POST["phone"]);
			$_POST["subject"] = stripslashes($_POST["subject"]);
			$_POST["messageBody"] = stripslashes($_POST["messageBody"]);
            
			$from_email = $_POST["email"];
			$from_name = $_POST["first_name"]." ".$_POST["last_name"];
            $from_phone = $_POST["phone"];
			$subject = $_POST["subject"];
            
            $messageBody = array();
			$messageBody["LANG_LABEL_NAME"] = $from_name."\n";
			$messageBody["LANG_LABEL_EMAIL"] = $from_email."\n";
			$messageBody["LANG_LABEL_PHONE"] = $from_phone."\n";
			$messageBody["LANG_LABEL_MESSAGE"] = "\n".$_POST["messageBody"]."\n";
            
            $checkboxGroups = array();
            $lastKeyCheckbox = false;
            
            if (!empty($results["results"])) {

                foreach ($results["results"] as $key => $value) {
                    //Check if the field is a checkbox to prepare the message properly
                    if (in_array($key, $_POST["checkboxes"])) {
                        if ($value) {
                            $value = system_showText(LANG_YES);
                        } else {
                            $value = system_showText(LANG_NO);
                        }
                        //Check from which group the checkbox belongs
                        $thisGroup = $form->getCheckboxGroup($key, $results["checkboxes"]);
                        if (!in_array($thisGroup, $checkboxGroups)) {
                            //Concat the group name to the message
                            $checkboxGroups[] = $thisGroup;
                            $messageBody[string_ucwords(str_replace("_", " ", $thisGroup))] = "";
                        }
                        //Add the checkbox option to the message
                        $messageBody["- ".string_ucwords(str_replace("_", " ", $key))] = $value;
                        
                        //The variables below are used to add a line break after the last checkbox from a group and before the next element
                        $lastKeyCheckbox = true;
                        $lastKey = "- ".string_ucwords(str_replace("_", " ", $key));
                    } else {
                        
                        if ($lastKeyCheckbox) {
                            //Add a line break if the previous element was a checkbox
                            $lastKeyCheckbox = false;
                            $messageBody[$lastKey] = $messageBody[$lastKey]."\n";
                        }
                        
                        $messageBody[string_ucwords(str_replace("_", " ", $key))] = "\n".($value ? $value."\n" : "");
                    }
                }
            }
            
			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = explode(",", $sitemgr_email);
			setting_get("sitemgr_lead_email", $sitemgr_lead_email);
			$sitemgr_lead_emails = explode(",", $sitemgr_lead_email);
                        
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />";
            $sitemgr_msg .= system_showText(LANG_NOTIFY_NEWLEAD);
            $sitemgr_msg .= "<br /><br /><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/leads/index.php?item_type=general\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/leads/index.php?item_type=general</a><br /><br />";
            $sitemgr_msg .= EDIRECTORY_TITLE;
            
            $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_LEAD_ENQUERY)." - ".stripslashes(htmlspecialchars_decode($subject));
            system_notifySitemgr($sitemgr_lead_emails, $emailSubject, $sitemgr_msg, true, "", "", true, "", "$from_name <$from_email>", $from_email);
            			
            $leadInfo["item_id"] = 0;
            $leadInfo["member_id"] = sess_getAccountIdFromSession();
            $leadInfo["first_name"] = $_POST["first_name"];
            $leadInfo["last_name"] = $_POST["last_name"];
            $leadInfo["email"] = $_POST["email"];
            $leadInfo["phone"] = $_POST["phone"];
            $leadInfo["subject"] = $_POST["subject"];
            $leadInfo["message"] = serialize($messageBody);
            $leadInfo["type"] = "general";

            $leadObj = new Lead();
            $leadObj->makeFromRow($leadInfo);
            $leadObj->save();
            
            $message_style = "successMessage";
            $lead_message = system_showText(LANG_LEAD_THANKYOU);
            unset($_POST);

		}
        
		if ($nameerror) {
			$existerror = true;
			$lead_message .= system_showText(LANG_LEAD_TYPE_NAME)."<br />";
		}
		if ($emailerror) {
			$existerror = true;
			$lead_message .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		}
		if ($subjecterror) {
			$existerror = true;
			$lead_message .= system_showText(LANG_MSG_CONTACT_TYPE_SUBJECT)."<br />";
		}
		if ($messageerror) {
			$existerror = true;
			$lead_message .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />";
		}
		if ($captchaerror) {
			$existerror = true;
			$lead_message .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}
        if ($editorMessage) {
            $existerror = true;
            $lead_message .= $editorMessage;
        }
		
		if ($existerror) {
			$message_style = "errorMessage";
		}
	}
     
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
    
    if (sess_getAccountIdFromSession()) {
        $userInfo = new Contact(sess_getAccountIdFromSession());
        if (!$userInfo->getNumber("account_id")) {
            unset($userInfo);
        }
    }
    
	include(system_getFrontendPath("lead.php", "frontend"));
    
?>