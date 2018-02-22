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
	# * FILE: /profile/edit.php
	# ----------------------------------------------------------------------------------------------------
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=UTF-8", TRUE);

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	if (SOCIALNETWORK_FEATURE == "off") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/profile.php");
    if (MAIL_APP_FEATURE == "on") {
        arcamailer_checkSubscriber();
    }

    $profileObj = new Profile($_SESSION["SESS_ACCOUNT_ID"]);
   
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	// Default CSS class for message box
	$message_style = "errorMessage";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$validate_demodirectoryDotCom = true;
		if (DEMO_LIVE_MODE) {
			$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
		}

		if ($validate_demodirectoryDotCom) {
			if (SOCIALNETWORK_FEATURE == "off") {
				$_POST["publish_contact"] = "n";
			} else {
				if ($_POST["publish_contact"] == "on") {
					$_POST["publish_contact"] = "y";
				} else {
					$_POST["publish_contact"] = "n";
				}
			}

            if ((string_strlen($_POST["password"])) || (string_strlen($_POST["retype_password"]))) {
                $validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
            } else {
                $validate_membercurrentpassword = true;
            }

            $account 		  = new Account($account_id);
            $validate_contact = validate_form("contact", $_POST, $message_contact);
            $validate_contact = true;

			if ($validate_contact) {
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
				$account->setString("publish_contact", $_POST["publish_contact"]);
                
                if ($_POST["newsletter"]) {
                    $actualNewsletter = "y";
                } else {
                    $actualNewsletter = "n";
                }
                
                $account->setString("newsletter", $actualNewsletter);
				$account->Save() ? $success = "true" : $success = "false"; 

				$contact = new Contact($_POST);
				$contact->Save() ? $success = "true" : $success = "false"; 


                if ($actualNewsletter != $lastNewsletter) {

                    //Subscribe
                    if ($actualNewsletter == "y") {
                      
                        $fields["name"] = $contact->getString("first_name")." ".$contact->getString("last_name");
                        $fields["type"] = "profile";
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
                
                if (system_checkEmail(SYSTEM_VISITOR_ACCOUNT_UPDATE) && $_POST["tab"] == "tab_2" && $notifyUser) {
                    system_sendPassword(SYSTEM_VISITOR_ACCOUNT_UPDATE, $_POST["email"], $_POST["username"], $_POST["password"], $_POST["first_name"]." ".$_POST["last_name"]);
                }
			} else {
				$message_stylee = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
				$message_style = "alert-success";		}
		} else {
			$message = "";
			$message_style = "";
		}

	    // removing slashes added if required
	    $_POST = format_magicQuotes($_POST);
	    $_GET  = format_magicQuotes($_GET);

		extract($_GET);
	    extract($_POST);
	}

    # ----------------------------------------------------------------------------------------------------
	# MODE REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");

	unset($info);
	$info = socialnetwork_retrieveInfoProfile($id);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	// required because of the cookie var
	$username = "";

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (sess_getAccountIdFromSession()) {
		$accountObj = new Account(sess_getAccountIdFromSession());
		$contactObj = new Contact(sess_getAccountIdFromSession());
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $accountObj->extract();
            $contactObj->extract();
        }
	} else {
		header("Location: ".DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/index.php");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$sitecontentSection = "Profile Page";
    $array_HeaderContent = front_getSiteContent($sitecontentSection);
    extract($array_HeaderContent);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	$hide_search = true;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
		 include(system_getFrontendPath("header.php", "layout"));
	}

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	$nickname = $profileObj->nickname;  
	if($nickname == ' ') 
    { 
    	echo "<div class=\"content-custom alert alert-danger\"><strong><font color = \"red\">Please fill your nickname.</font></strong></div>";
	}
	
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/profile_edit.php");
	if($_POST){
		echo $success;
	}

	if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
		 include(system_getFrontendPath("footer.php", "layout"));
	}

?>
<script>
$(function() {
            $(".alert").fadeOut(5000);
        });
</script>