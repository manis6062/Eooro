<?

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
# * FILE: /includes/code/login.php
# ----------------------------------------------------------------------------------------------------

$members_section = true;


$_GET = format_magicQuotes($_GET);
$input = format_magicQuotes($input);
$destiny = $_GET["destiny"] ? $_GET["destiny"] : $input["destiny"];
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
        $query = string_substr($_SERVER["QUERY_STRING"], string_strpos($_SERVER["QUERY_STRING"], "query=") + 6);
    } else {
        $query = $_GET["query"] ? $_GET["query"] : $input["query"];
        $query = urldecode($query);
    }
} else {
    $query = $_GET["query"] ? $_GET["query"] : $input["query"];
    $query = urldecode($query);
}
if ($query) {
    $query = system_denyInjections($query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($input['signup'] == 'signup') {
        $input["retype_password"] = $input["password"];

        $validate_account = validate_addAccount($input, $message_account);
        $validate_contact = validate_form("contact", $input, $message_contact);

        if ($validate_account && $validate_contact) {

            $account = new Account($input);
            $account->save();

            if ($input["newsletter"]) {
                $input["name"] = $input["first_name"] . " " . $input["last_name"];
                $input["type"] = "sponsor";
                arcamailer_addSubscriber($input, $success, $account->getNumber("id"));
            }

            $contact = new Contact();
            $contact->setNumber("account_id", $account->getNumber("id"));
            $contact->setString("first_name", $input["first_name"]);
            $contact->setString("last_name", $input["last_name"]);
            $contact->setString("email", $input["reviewer_email"]);
            $contact->save();

            $profileObj = new Profile(sess_getAccountIdFromSession());
            $profileObj->setNumber("account_id", $account->getNumber("id"));
            if (!$profileObj->getString("nickname")) {
                $profileObj->setString("nickname", $input["first_name"] . " " . $input["last_name"]);
            }
            $profileObj->Save();

            $accDomain = new Account_Domain();
            $accDomain->account_id = $account->getNumber('id');
            $accDomain->domain_id = SELECTED_DOMAIN_ID;
            $accDomain->Save();
            $accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

            /*             * *********************************************************************************************** */
            /*                                                                                                */
            /* E-mail notify                                                                                  */
            /*                                                                                                */
            /*             * *********************************************************************************************** */
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = explode(",", $sitemgr_email);
            if ($sitemgr_emails[0])
                $sitemgr_email = $sitemgr_emails[0];
            setting_get("sitemgr_account_email", $sitemgr_account_email);
            $sitemgr_account_emails = explode(",", $sitemgr_account_email);

            
                // sending e-mail to user if from Review Collecter //////////////////////////////////////////////////////////////////////////
                $emailNotificationObj = system_checkEmail(46);
                if ($emailNotificationObj) {
                    $listingObj = new Listing($input['item_id']);
                    $listing_name = $listingObj->title;
                    $change_password_link = DEFAULT_URL . "/sponsors/forgot.php";
                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");
                    $login_info = "Email:" . $input['reviewer_email'] . "\n" . "Password:" . $input['password'];
                    $body = str_replace('FIRSTNAME', ucwords(htmlspecialchars($contact->first_name)), $body);
                    $body = str_replace('LASTNAME', ucwords(htmlspecialchars($contact->last_name)), $body);
                    $body = str_replace('LISTING_NAME', ucwords(htmlspecialchars($listing_name)), $body);
                    $body = str_replace('CHANGE_PASSWORD_LINK', $change_password_link, $body);
                    $body = str_replace('REVIEWER_EMAIL', $input['reviewer_email'], $body);
                    $body = str_replace('PASSWORD', $input['password'], $body);
                    $body = system_replaceEmailVariables($body, $account->getNumber("id"), "account");
                    $subject = system_replaceEmailVariables($subject, $account->getNumber("id"), "account");
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $return = system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contact->account_id, 46);
                }
             
            ////////////////////////////////////////////////////////////////////////////////////////////////////
            // do not register session if we came from reviewcollector
//            if (!isset($email_review) && !$email_review) {
//                sess_registerAccountInSession($account->getString("username"));
//                setcookie("username_members", $account->getString("username"), time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
//
//                header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/claim/getlisting.php?claimlistingid=" . $claimlistingid);
//                exit;
//            }
        } else {
            
            extract($input);
            extract($_GET);
        }
    }
}

$username = $input["username"];

$message_login = $authmessage;
?>