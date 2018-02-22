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
    # * FILE: /members/googleauth.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");

    require_once CLASSES_DIR.'/apis/Google/autoload.php';

    require_once CLASSES_DIR.'/apis/oauth/oauthapp.php';
    require_once CLASSES_DIR.'/apis/oauth/googleapp.php';
    require_once CLASSES_DIR.'/apis/oauth/oauthuser.php';
    require_once CLASSES_DIR.'/apis/oauth/googleuser.php';
    require_once CLASSES_DIR.'/apis/oauth/oauthfactory.php';
    try {
        
        $_GET['destiny'] = $_SESSION['HTTP_REFER'] ? $_SESSION['HTTP_REFER'] : $_SESSION['red_destiny'];
        $_GET['claim'] = $_SESSION['claim'] ? $_SESSION['claim'] : null;
        $_GET['advertise'] = $_SESSION['advertise'] ? $_SESSION['advertise'] : null;
        $details['clientId']        = GOOGLE_CLIENT_ID;
        $details['clientSecret']    = GOOGLE_CLIENT_SECRET;
        $details['applicationName'] = 'Google server side flow';
        $details['developerKey']    = GOOGLE_DEVELOPER_KEY;
        $details['redirectUrl']     = GOOGLE_REDIRECT_URL;

                    unset($userInfo);
                       
                    if( isset($_GET['state']) && $_GET['error'] ){
                        //the user canceled the authentication
                        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=cancel");
                        exit;
                    }
                    else { //user successfully authenticated
                        $user = OauthFactory::getApp('google')->setDetails($details)->getUser();
                        if( $user ) {
                            $userInfo = $user->getProfile();


                        if ($_GET["advertise"] == "yes" || string_strpos($_GET["destiny"], "/".ALIAS_CLAIM_URL_DIVISOR) !== false) {
                                if (string_strpos($_GET["destiny"], "/".LISTING_FEATURE_FOLDER) !== false) {
                                        $email_notification = SYSTEM_LISTING_SIGNUP;
                                } else if (string_strpos($_GET["destiny"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
                                        $email_notification = SYSTEM_ARTICLE_SIGNUP;
                                } else if (string_strpos($_GET["destiny"], "/".EVENT_FEATURE_FOLDER) !== false) {
                                        $email_notification = SYSTEM_EVENT_SIGNUP;
                                } else if (string_strpos($_GET["destiny"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
                                        $email_notification = SYSTEM_CLASSIFIED_SIGNUP;
                                } else if (string_strpos($_GET["destiny"], "/".BANNER_FEATURE_FOLDER) !== false) {
                                        $email_notification = SYSTEM_BANNER_SIGNUP;
                                } else if (string_strpos($_GET["destiny"], "/".ALIAS_CLAIM_URL_DIVISOR) !== false) {
                                        $email_notification = SYSTEM_CLAIM_SIGNUP;
                                } else {
                                        $email_notification = SYSTEM_NEW_PROFILE;
                                }
                        } else {
                                $email_notification = SYSTEM_NEW_PROFILE;
                        }

                        // store the foreign account info into our system
                        if (system_registerForeignAccount($userInfo, "google", false, $email_notification)) {
                             setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
                                if ($_GET["claim"] == "yes" || $_GET["advertise"] == "yes" || SOCIALNETWORK_FEATURE == "off") {
                                        $accObj = new Account(sess_getAccountIdFromSession());
                                        if ($accObj->getString("is_sponsor") == 'n') {
                                                $accObj->changeMemberStatus(true);
                                                unset( $_SESSION['claim'] ); 
                                                unset( $_SESSION['advertise'] ); 
                                        }

                                        if ($_GET["advertise"] == "yes") {
                                                $destinyUrl = $_GET["destiny"];
                                                $itemID		= $_GET["item_id"];
                                                $item		= $_GET["advertise_item"];

                                                $level              = $_SESSION["go_{$item}_level_{$itemID}"];
                                                $expiration         = $_SESSION["go_{$item}_expiration_setting_{$itemID}"];
                                                $impressions        = $_SESSION["go_{$item}_unpaid_impressions_{$itemID}"];
                                                $template           = $_SESSION["go_{$item}_template_id_{$itemID}"];
                                                $title              = $_SESSION["go_{$item}_title_{$itemID}"];
                                                $discount_id        = $_SESSION["go_{$item}_discount_id_{$itemID}"];
                                                $return_categories  = $_SESSION["go_{$item}_return_categories_{$itemID}"];
                                                $caption            = $_SESSION["go_{$item}_caption_{$itemID}"];
                                                $package_id         = $_SESSION["go_{$item}_package_id_{$itemID}"];
                                                $start_date         = $_SESSION["go_{$item}_start_date_{$itemID}"];
                                                $end_date           = $_SESSION["go_{$item}_end_date_{$itemID}"];

                                                unset(
                                                $_SESSION["go_{$item}_level"],
                                                $_SESSION["go_{$item}_expiration_setting"],
                                                $_SESSION["go_{$item}_unpaid_impressions"],
                                                $_SESSION["go_{$item}_template_id"],
                                                $_SESSION["go_{$item}_title"],
                                                $_SESSION["go_{$item}_discount_id"],
                                                $_SESSION["go_{$item}_return_categories"],
                                                $_SESSION["go_{$item}_caption"],
                                                $_SESSION["go_{$item}_start_date"],
                                                $_SESSION["go_{$item}_end_date"],
                                                $_SESSION["go_{$item}_package_id"]
                                                );

                                                if ($item == "banner") {
                                                        $destinyUrl .= "?type=".$level;
                                                        $destinyUrl .= "&expiration_setting=".$expiration;
                                                        $destinyUrl .= "&caption=".$caption;
                                                } else if ($item == "listing") {
                                                        $destinyUrl .= "?level=".$level;
                                                        if ($template) {
                                                                $destinyUrl .= "&listingtemplate_id=".$template;
                                                        }
                        if ($return_categories) {
                            $destinyUrl .= "&return_categories=".$return_categories;
                        }
                    } elseif ($item == "event") {
                        $destinyUrl .= "?level=".$level;
                        if ($start_date) {
                            $destinyUrl .= "&start_date=".$start_date;
                        }
                        if ($end_date) {
                            $destinyUrl .= "&end_date=".$end_date;
                        }
                    } else {
                        $destinyUrl .= "?level=".$level;
                    }

                    if ($title) {
                        $destinyUrl .= "&title=".$title;
                    }
                    if ($discount_id) {
                        $destinyUrl .= "&discount_id=".$discount_id;
                    }
                    if ($package_id) {
                        $destinyUrl .= "&package_id=".$package_id;
                    }

                                                $_GET["destiny"] = $destinyUrl;
                                        }
                                }
                        } else { //system error
                                header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=error");
                                exit;
                        }
                } else { //user not logged in
                        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=notlogged");
                        exit;
                }
        }

    } catch(ErrorException $e) {
            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=error");
            exit;
    }
    catch( Exception $e ){
        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=error");
        exit;
    }
    header("Location: ".$_GET["destiny"]);
   
    exit;

?>