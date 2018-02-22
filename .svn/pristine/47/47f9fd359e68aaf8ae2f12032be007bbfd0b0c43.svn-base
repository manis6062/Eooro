<?php 

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    if (MAIL_APP_FEATURE == "on") {
        arcamailer_checkSubscriber();
    }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	// required because of the cookie var
	$username = "";

	// Default CSS class for message box
	$message_style = "errorMessage";
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$validate_demodirectoryDotCom = true;
		if (DEMO_LIVE_MODE) {
			$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
		}

		if ($validate_demodirectoryDotCom) {
			if (SOCIALNETWORK_FEATURE == "off") {
				$_POST["publish_contact"] = 'n';
			} else {
				if ($_POST['publish_contact'] == "on") {
					$_POST["publish_contact"] = 'y';
				} else {
					$_POST["publish_contact"] = 'n';
				}
			}
            $_POST['notify_traffic_listing'] = ($_POST['notify_traffic_listing'] ? 'y' : 'n');

			if ((string_strlen($_POST["password"])) || (string_strlen($_POST["retype_password"]))) {
				$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
			} else {
				$validate_membercurrentpassword = true;
			}

			if ($validate_demodirectoryDotCom) {
				if ((string_strlen($_POST["password"])) || (string_strlen($_POST["retype_password"]))) {
					$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
				} else {
					$validate_membercurrentpassword = true;
				}

				$account = new Account($account_id);
				$validate_account = validate_MEMBERS_account($_POST, $message_account, sess_getAccountIdFromSession());
				$validate_contact = validate_form("contact", $_POST, $message_contact);
			}

			if ($validate_demodirectoryDotCom && $validate_membercurrentpassword && $validate_account && $validate_contact) {
				$account = new Account($account_id);
				
                $lastNewsletter = $account->getString("newsletter");
				if ($account->getString("foreignaccount") == "y") {
					$account->setString("foreignaccount_done", "y");
					$account->save();
				}
                
                $notifyUser = false;
				if ($_POST["password"]) {
                    $notifyUser = true;
					$account->setString("password", $_POST["password"]);
					$account->updatePassword();
				}
                if ($_POST["username"]) {
                    if ($account->getString("username") != $_POST["username"]) {
                        $notifyUser = true;
                    }
                    $account->setString("username", $_POST["username"]);
                }
				
				$account->setString("notify_traffic_listing", $_POST['notify_traffic_listing']);
				$account->setString("publish_contact", $_POST["publish_contact"]);
                
                if ($_POST["newsletter"]) {
                    $actualNewsletter = "y";
                } else {
                    $actualNewsletter = "n";
                }
                
                $account->setString("newsletter", $actualNewsletter);
                
				$account->Save();
				// changed by vivek
				$country = new Location1($_POST['country']);

			$_POST['country'] = $country->getString('name');
//			$_POST['state']   = mysql_real_escape_string($_POST['state']);
//			$_POST['city']    = mysql_real_escape_string($_POST['city']);
//			$_POST['zip']     = mysql_real_escape_string($_POST['zip']);
//			$_POST['phone']   = mysql_real_escape_string($_POST['phone']);
//			$_POST['fax']     = mysql_real_escape_string($_POST['fax']);
//			$_POST['company']     = mysql_real_escape_string($_POST['company']);
//			$_POST['address']     = mysql_real_escape_string($_POST['address']);
//			$_POST['address2']     = mysql_real_escape_string($_POST['address2']);
//			$_POST['first_name']     = mysql_real_escape_string($_POST['first_name']);
//			$_POST['last_name']     = mysql_real_escape_string($_POST['last_name']);

				$contact = new Contact($_POST);
				$success = $contact->Save();
                
                if ($actualNewsletter != $lastNewsletter) {

                    //Subscribe
                    if ($actualNewsletter == "y") {
                      
                        $fields["name"] = $contact->getString("first_name")." ".$contact->getString("last_name");
                        $fields["type"] = "sponsor";
                        $fields["email"] = $contact->getString("email");
                        arcamailer_addSubscriber($fields, $success, $account->getNumber("id"));
                        
                    //Unsubscribe
                    } else {
                        arcamailer_Unsubscribe($contact->getString("email"), $account->getNumber("id"));
                    }
                    
                }

				$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact);
                
                if (system_checkEmail(SYSTEM_SPONSOR_ACCOUNT_UPDATE) && $_POST["type"] == "tab_2" && $notifyUser) {
                    system_sendPassword(SYSTEM_SPONSOR_ACCOUNT_UPDATE, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name']);
                }

				$message = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
				$message_style = "alert-success";
			} else {
				$message = "";
				$message_style = "";
			}
		} else {
			$message = "";
			$message_style = "";
		}

	    // removing slashes added if required
//	    $_POST = format_magicQuotes($_POST);
//	    $_GET  = format_magicQuotes($_GET);

		extract($_GET);
	    extract($_POST);
	}



//Pass value back
if($success == true){
	echo "true";
} else {
	echo "false";
}

