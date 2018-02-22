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
	# * FILE: /includes/code/listingcontact.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$message_style = "errorMessage";

		if ($_POST["id"]) $listing = new Listing($_POST["id"]);

		$to = system_denyInjections($to);
		$subject = trim(system_denyInjections($subject));
		$body = trim(system_denyInjections($body, true));
		$error = "";
		if (!$name) $error .= system_showText(LANG_MSG_CONTACT_ENTER_NAME)."<br />";
		if (!validate_email($to)) $error .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		if (!validate_email($from)) $error .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		if (!$body) $error .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />";

//		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"] && !$noCaptcha) {
//			$error .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
//		}

		if (empty($error)) {

			if (empty($subject)) $subject = LANG_LISTING_CONTACTSUBJECT_ISNULL_1." ".$listing->getString("title")." ".LANG_LISTING_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;

			$body = str_replace("<br />", "", $body);
            
            $name = stripslashes(html_entity_decode($name));
			
			$body = ucfirst(system_showText(LANG_FROM)).": ".$name."\n\n".system_showText(LANG_LABEL_EMAIL).": ".$from."\n\n".system_showText(LANG_LABEL_MESSAGE).": ".$body;
			
			$subject = stripslashes(html_entity_decode($subject));
			$body 	 = stripslashes($body);

			$subject = "[".system_showText(LANG_CONTACTPRESUBJECT)." ".EDIRECTORY_TITLE."] ".$subject;

			$return = system_mail($to, htmlspecialchars_decode($subject), $body, $from, 'text/plain', '', '', $error, '', '', $from, $listing->id, $listing->account_id);

			if ($return) {
				$error = system_showText(LANG_CONTACTMSGSUCCESS);
				$message_style = "successMessage";
			}	else {
				$error = system_showText(LANG_CONTACTMSGFAILED).($error ? '<br />'.$error : '')."<br />";
			}

			if ($return) {
				report_newRecord("listing", $_POST["id"], LISTING_REPORT_EMAIL_SENT);
				unset($from, $subject, $body, $name);
			}

		}
	}

?>