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
	header("Content-type: text/xml"); 
	$backButton = false;
	$mapresultsButton = false;
	$listresultsButton = false;
	$backButtonLink = "";
	$headerTitle = LANG_M_LISTINGHOME;
	$languageButton = false;
	$homeButton = true;
	$searchButton = false;
	$searchButtonLink = "";
	
    $_POST['agree_tou'] = 1;
    //$_POST['retype_password'] = $_POST['password'];

	$validate_account = validate_addAccount($_POST, $message_account);
	//$validate_contact = validate_form("contact", $_POST, $message_contact);
	if ($validate_account) {
	    //$_POST['publish_contact'] = ($_POST['publish_contact']?'y':'n');
	    
	    $_POST['publish_contact'] = 'y';
		$account = new Account($_POST);
	
		$account->Save();
		$contact = new Contact($_POST);
		$contact->setNumber("account_id", $account->getNumber("id"));
		$contact->Save();
	
		$profileObj = new Profile($_POST);
		$profileObj->setNumber("account_id", $account->getNumber("id"));
		$profileObj->setString("nickname", $contact->first_name . ' ' . $contact->last_name);
		$profileObj->Save();

		$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
		$accDomain->Save();
		$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

		sess_registerAccountInSession($_POST["username"]);
		//setcookie("username", $_POST['username'], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/".MEMBERS_ALIAS);
	
		/*****************************************************
		*
		* E-mail notify
		*
		******************************************************/
		setting_get("sitemgr_send_email",$sitemgr_send_email);
		setting_get("sitemgr_email",$sitemgr_email);
		$sitemgr_emails = split(",",$sitemgr_email);
		setting_get("sitemgr_account_email",$sitemgr_account_email);
		$sitemgr_account_emails = split(",",$sitemgr_account_email);
	
		// sending e-mail to user //////////////////////////////////////////////////////////////////////////
		$error = false;
		$body = system_showText(LANG_DEAR)." ".$contact->getString("first_name")." ".$contact->getString("last_name").",\n".system_showText(LANG_MSG_THANK_YOU_FOR_SIGNING_UP)." ".EDIRECTORY_TITLE." (".DEFAULT_URL.").\n".system_showText(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT)."\n\n".system_showText(LANG_LABEL_USERNAME).": ".$_POST["username"]."\n".system_showText(LANG_LABEL_PASSWORD).": ".$_POST["password"]."\n\n".system_showText(LANG_MSG_YOU_CAN_SEE).":\n".system_showText(LANG_MSG_YOUR_ACCOUNT_IN)." ".DEFAULT_URL."/".MEMBERS_ALIAS."/account/\n";
		system_mail($contact->getString("email"), "[".EDIRECTORY_TITLE."] ".system_showText(LANG_LABEL_SIGNUP_NOTIFICATION), $body, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/plain', '', '', $error, "", "", "", "", $contact->account_id);
		////////////////////////////////////////////////////////////////////////////////////////////////////
	
		// site manager warning message /////////////////////////////////////
        $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_NEWACCOUNTAPP);
        $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />".system_showText(LANG_NOTIFY_NEWACCOUNTAPP_1)."<br />".system_showText(LANG_NOTIFY_NEWACCOUNTAPP_2)."<br /><br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_USERNAME).": </b>".$account->getString("username")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_FIRST_NAME).": </b>".$contact->getString("first_name")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_LAST_NAME).": </b>".$contact->getString("last_name")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_COMPANY).": </b>".$contact->getString("company")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_ADDRESS).": </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_CITY).": </b>".$contact->getString("city")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_STATE).": </b>".$contact->getString("state")."<br />";
        $sitemgr_msg .= "<b>".string_ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_PHONE).": </b>".$contact->getString("phone")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_FAX).": </b>".$contact->getString("fax")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_URL).": </b>".$contact->getString("url")."<br />";
        $sitemgr_msg .= "<b>".system_showText(LANG_IGREETERMS).": </b>".(($account->getString("agree_tou") ==1) ? system_showText(LANG_YES) : system_showText(LANG_NO))."<br />";
        $sitemgr_msg .="<br /><a href=\"".((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".SITEMGR_ALIAS."/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".SITEMGR_ALIAS."/account/view.php?id=".$account->getNumber("id")."</a><br /><br />";

        system_notifySitemgr($sitemgr_account_emails, $emailSubject, $sitemgr_msg);

	}
	
	$message_account = str_replace("&#149;&nbsp;", "", $message_account);
	$message_account = str_replace("<br />", "\n", $message_account);
	
	unset($xml_output);
	$xml_output  = "<?xml version=\"1.0\" encoding=\"".EDIR_CHARSET."\"?>\n";

	$xml_output  .= "<eDirectoryData>\n";
	$xml_output  .= "<ListingData>\n";
	
	$xml_output  .= "<entry>";
	
	
	if (!$validate_account)
	{
		$xml_output .= "<validate>false</validate>";
		$xml_output  .= "<message>".$message_account."</message>";
		
		$xml_output  .= "</entry>\n";
	
		$xml_output  .= "</ListingData>\n";
		$xml_output  .= "</eDirectoryData>\n";

		echo $xml_output; 
		
		return;

	}
	else
	{
		$xml_output .= "<validate>true</validate>";
	}
	
	
	
	
	if (sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage))
	{
		$xml_output  .= "<authenticateAccount>true</authenticateAccount>";
		$Account = db_getFromDB("account", "username", db_formatString($_POST["username"]));
		
		//$Profile = new Profile($Account->id);

		$Contact = new Contact($Account->id);

		$xml_output  .= "<id>".$Account->id."</id>";
		$xml_output  .= "<username>".$Account->username."</username>";
		
		$xml_output  .= "<name>".$Contact->first_name." ".$Contact->last_name."</name>";
		$xml_output  .= "<first_name>".$Contact->first_name."</first_name>";
		$xml_output  .= "<last_name>".$Contact->last_name."</last_name>";
		$xml_output  .= "<email>".$Contact->email."</email>";
		$xml_output  .= "<location>".$Contact->city.", ".$Contact->state."</location>";
		$xml_output  .= "<ip>".$_SERVER["REMOTE_ADDR"]."</ip>";
	}	
	else
	{
		$xml_output  .= "<authenticateAccount>false</authenticateAccount>";
		$xml_output  .= "<authmessage>".$authmessage."</authmessage>";
	}		
	
	
	$xml_output  .= "</entry>\n";
	
	$xml_output  .= "</ListingData>\n";
	$xml_output  .= "</eDirectoryData>\n";

	

	echo $xml_output; 
	
?>