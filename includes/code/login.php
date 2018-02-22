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
	# * FILE: /includes/code/login.php
	# ----------------------------------------------------------------------------------------------------

    $members_section = true;
    
    if ($_GET["np"]) {
		$message_login = system_showText(LANG_MSG_NO_PERMISSION)."<br />";
		$message_login .= "<a href=\"".DEFAULT_URL."/".ALIAS_ADVERTISE_URL_DIVISOR.".php\">".system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS)."</a> ";
		if (SOCIALNETWORK_FEATURE == "on") {
			$message_login .= system_showText(LANG_OR)." <a href=\"".SOCIALNETWORK_URL."\">".system_showText(LANG_MSG_GO_PROFILE)."</a>";
		}
	}

	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
        if($_POST['claim_listing_redirect'] == 'y'){
            $destiny = DEFAULT_URL.'/sponsors/claim/listing.php?claimlistingid='.$_POST['claim_listings_id'];
        }else{
          $destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
        }
	$destiny = urldecode($destiny);
	if ($destiny) {
		$destiny = system_denyInjections($destiny);
		if (string_strpos($destiny, "://") !== false) {
			if (string_strpos($destiny, $_SERVER["HTTP_HOST"]) === false) {
				$destiny = "";
			}
		}
	}
	if ($_SERVER["QUERY_STRING"]) {
		if (string_strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = string_substr($_SERVER["QUERY_STRING"], string_strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($query) {
		$query = system_denyInjections($query);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_POST["userform"] == "currentuser" && ($_POST["claim"] || $_POST["advertise"])) {
			if ($destiny) {
				$url = $destiny;
				if ($query) $url .= "?".$query;
			} else {
				$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/".MEMBERS_ALIAS."/";
			}
			$accountObj = new Account($_POST["acc"]);
			$accountObj->changeMemberStatus(true);

			$accDomain = new Account_Domain($accountObj->getNumber("id"), SELECTED_DOMAIN_ID);
			$accDomain->Save();
			$accDomain->saveOnDomain($accountObj->getNumber("id"), $accountObj);

			$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

			setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

			header("Location: ".$url);
			exit;
		} else {

			if($_POST['signup'] == 'login') {
				if (sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage)) { 

					sess_registerAccountInSession($_POST["username"]);
					setcookie("username_members", $_POST["username"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

					setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

					$AccountObj = db_getFromDB("account", "username", db_formatString($_POST["username"]));
					if ($_POST["automatic_login"]) {
						setcookie("automatic_login_members", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
						$_POST["password"] = string_strtolower(PASSWORD_ENCRYPTION) == "on" ? md5($_POST["password"]) : $_POST["password"];
						$aux = md5(MEMBERS_LOGIN_PAGE.trim($_POST["username"]).$_POST["password"]);
						setcookie("complementary_info_members", $aux, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

						$AccountObj->Save();
						
					} else {
						setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					}
					if ($destiny) {
						$url = $destiny;
						if ($query) $url .= "?".$query;
					} else {
						$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/".MEMBERS_ALIAS."/";
					}

					$profileObj = new Profile(sess_getAccountIdFromSession());
					$profileObj->setNumber("account_id", sess_getAccountIdFromSession());
					$profileObj->Save();

					$accountObj = new Account(sess_getAccountIdFromSession());
					if ($_POST["advertise"] || $_POST["claim"]) {
						$accountObj->changeMemberStatus(true);
					}

					$accDomain = new Account_Domain($accountObj->getNumber("id"), SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($accountObj->getNumber("id"), $accountObj, false, $profileObj);

					if($_POST['loginType'] && $_POST['loginType'] == 'popup') {
						$url = str_replace('destiny=', '', $url);  
					}
					else {
					if ((string_strpos($_SERVER["HTTP_REFERER"], "".MEMBERS_ALIAS."") === false || string_strpos($_SERVER["HTTP_REFERER"], "".MEMBERS_ALIAS."/login.php")) && !$_POST["advertise"] && !$_POST["claim"]) {
						if (($AccountObj->getString("is_sponsor") == "y" || SOCIALNETWORK_FEATURE == "off") && (string_strpos($url, "profile") === false)) {
							$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
						} else {
							if (SOCIALNETWORK_FEATURE == "off"){
								$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
							} else {
								$url = SOCIALNETWORK_URL."/";
							}
						}

						//Check to see if the user has any business, else send him to review page
						$listings = Listing::getListingCountByAccountId($AccountObj->id);
						if ($listings > 0){
							$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
						} else {
							$url = SOCIALNETWORK_URL."/";
						}
					}
				}
				

					
					
					$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

					setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

					if ($_GET['userperm'] == true) {
						$_x_http_refer = $_SESSION["HTTP_REFER"];
						unset($_SESSION["HTTP_REFER"]);
						
						if ($_x_http_refer) {
							header("Location: ".$_x_http_refer);
						} else {
							header("Location: ".$_SERVER["HTTP_REFERER"]);
						}
						
					} else {
						header("Location: ".$url);
					}
					exit;

				}
		}

		elseif($_POST['signup'] == 'signup') {
	        $_POST["retype_password"] = $_POST["password"];
	        
			$validate_account = validate_addAccount($_POST, $message_account);
			$validate_contact = validate_form("contact", $_POST, $message_contact);

			if ($validate_account && $validate_contact) {

				$account = new Account($_POST);
				$account->save();
	            
	            if ($_POST["newsletter"]) {
	                $_POST["name"] = $_POST["first_name"]." ".$_POST["last_name"];
	                $_POST["type"] = "sponsor";
	                arcamailer_addSubscriber($_POST, $success, $account->getNumber("id"));
	            }

				$contact = new Contact($_POST);
				$contact->setNumber("account_id", $account->getNumber("id"));
				$contact->save();

				$profileObj = new Profile(sess_getAccountIdFromSession());
				$profileObj->setNumber("account_id", $account->getNumber("id"));
				if (!$profileObj->getString("nickname")) {
					$profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
				}
				$profileObj->Save();

				$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

				/**************************************************************************************************/
				/*                                                                                                */
				/* E-mail notify                                                                                  */
				/*                                                                                                */
				/**************************************************************************************************/
				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = explode(",",$sitemgr_email);
				if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
				setting_get("sitemgr_account_email",$sitemgr_account_email);
				$sitemgr_account_emails = explode(",",$sitemgr_account_email);

 			if(isset($email_review) && $email_review===true){
				// sending e-mail to user if from Review Collecter //////////////////////////////////////////////////////////////////////////
                $emailNotificationObj = system_checkEmail(46);
                if ($emailNotificationObj) {
                            $listingObj = new Listing($listing_id);
                            $listing_name = $listingObj->title;
                            $change_password_link = DEFAULT_URL."/sponsors/forgot.php";
		            $subject = $emailNotificationObj->getString("subject");
		            $body = $emailNotificationObj->getString("body");	            
					$login_info = "Email:".$email."\n"."Password:".$_POST['password'];
					$body = str_replace('LISTING_NAME', ucwords(htmlspecialchars($listing_name)), $body);
					$body = str_replace('CHANGE_PASSWORD_LINK', $change_password_link, $body);
					$body = str_replace('REVIEWER_EMAIL', $email, $body);
					$body = str_replace('PASSWORD', $_POST['password'], $body);
		            $body = system_replaceEmailVariables($body, $account->getNumber("id"), "account");
		            $subject = system_replaceEmailVariables($subject, $account->getNumber("id"), "account");
		            $body = html_entity_decode($body);
		            $subject = html_entity_decode($subject);
		            $return = system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contact->account_id, 46); 				
	 			}
	 		} else {
				// sending e-mail to user //////////////////////////////////////////////////////////////////////////
                $emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_SIGNUP);
                if ($emailNotificationObj) {

					$row["account_id"] = $account->getNumber("id");
		            $row["unique_key"] = md5(uniqid(rand(), true));
		            $row["entered"]    = date("Y-m-d");
	        
	                //Remove old activation entries
	                $acc_activationObj = new Account_Activation();
	                $acc_activationObj->deletePerAccount($acc_id);

	                //Create new activation
	                unset($acc_activationObj);
	                $acc_activationObj = new Account_Activation($row);
	                $acc_activationObj->save();

	                $linkActivation = DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?activation_key=".$row["unique_key"];
		            $subject = $emailNotificationObj->getString("subject");
		            $body = $emailNotificationObj->getString("body");	            

		            $body = system_replaceEmailVariables($body, $account->getNumber("id"), "account");
					$login_info = trim(system_showText(LANG_LABEL_USERNAME)).": ".$_POST["username"];
					$login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
					$login_info .= trim(system_showText(LANG_LABEL_PASSWORD)).": ".$_POST["password"];
					$body = str_replace("ACCOUNT_LOGIN_INFORMATION", $login_info, $body);
	                $body = str_replace("LINK_ACTIVATE_ACCOUNT", $linkActivation, $body);
		            $subject = system_replaceEmailVariables($subject, $account->getNumber("id"), "account");
		            $body = html_entity_decode($body);
		            $subject = html_entity_decode($subject);
		            $return = system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contact->account_id, SYSTEM_CLAIM_SIGNUP);

				}
			}
				////////////////////////////////////////////////////////////////////////////////////////////////////
            // do not register session if we came from reviewcollector
            if(!isset($email_review) && !$email_review){
                sess_registerAccountInSession($account->getString("username"));
                setcookie("username_members", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

                header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                exit;
            }

			} else {
				// removing slashes added if required
				$_POST = format_magicQuotes($_POST);
				$_GET  = format_magicQuotes($_GET);
				extract($_POST);
				extract($_GET);
			}

			}
		
		}

		$username = $_POST["username"];

		$message_login = $authmessage;

	} elseif ($_GET["facebookerror"]) {

		$facebookerror = $_GET["facebookerror"];
		$message_login = $facebookerror;
		$username = $_COOKIE["username_members"];

	} elseif ($_GET["googleerror"]) {

		$googleerror = $_GET["googleerror"];
		
		if ($googleerror){;

			if ($googleerror == "cancel"){
				$message_login = system_showText(LANG_MSG_GOOGLE_CANCEL);
			} else {
				$message_login = system_showText(LANG_MSG_OPENID_ERROR);
			} 
		}

	} elseif ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "members")) {

			$accountObj = new Account($forgotPasswordObj->getString("account_id"));

			if ($accountObj->getNumber("id")) {

				sess_registerAccountInSession($accountObj->getString("username"));
				setcookie("username_members", $accountObj->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

                if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME."/login.php") !== false) {
                    $resetLink = ((SSL_ENABLED == "on" && FORCE_PROFILE_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/".MEMBERS_ALIAS."/resetpassword.php?key=".$_GET["key"];
                } else {
                    $resetLink = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/".MEMBERS_ALIAS."/resetpassword.php?key=".$_GET["key"];
                }
                
				header("Location: ".$resetLink);
				exit;

			} else {
				$message_login = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$message_login = system_showText(LANG_MSG_WRONG_KEY);
		}

	} elseif ($_GET["activation_key"]) {

		$activationObj = new Account_Activation($_GET["activation_key"]);

		if ($activationObj->getString("unique_key")) {

			$accountObj = new Account($activationObj->getString("account_id"));

			if ($accountObj->getNumber("id")) {

				sess_registerAccountInSession($accountObj->getString("username"));
				setcookie("username_members", $accountObj->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
                
                $accountObj->setString("active", "y");
                $accountObj->save();


		        #----------------------------------------------------------------
				#  Once the user is active, calculate the reviews he has done
				#  And find out the average and update listing column.
				#----------------------------------------------------------------
                
                //Extract all the listings he has reviewed on 

                $reviewObj 	= new Review();
                $allReviews = $reviewObj->getAllListingsByReviewerId($accountObj->getNumber("id"));

                foreach ($allReviews as $review) {

	                $listing = new Listing($review['item_id']);
	                $average = $reviewObj->getRateAvgByItem("listing", $listing->id,"Count");
	                $avg     = $average['rate'];
                	$count   = $average['review_count'];

	                $listing->setAvgReview($avg, $listing->id, $count);
	            }

                $activationObj->delete();
                
                if ($accountObj->getString("is_sponsor") == "y") {
//                    header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/account/index.php?messageAct=1");
                    // todo: successfully activated message not shown
                    header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/index.php?messageAct=1");
                } else {
                    header("Location: ".SOCIALNETWORK_URL."/index.php?messageAct=1");
                }			
                exit;

			} else {
				$message_login = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$message_login = system_showText(LANG_MSG_WRONG_ACTIVATION_KEY);
		}

	} else {

		$username = $_COOKIE["username_members"];
		if ($_COOKIE["automatic_login_members"] == "true") $checked = "checked";
		else $checked = "";

	}

	setting_get("foreignaccount_google", $foreignaccount_google);	

?>