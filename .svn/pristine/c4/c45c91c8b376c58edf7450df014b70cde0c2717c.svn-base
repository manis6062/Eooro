<!--<?

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
	# * FILE: /conf/ssl.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	define("SSL_ENABLED",       "on");
        define("FORCE_PROFILE_SSL", "off");
	define("FORCE_MEMBERS_SSL", "off");
	define("FORCE_ORDER_SSL",   "off");
	define("FORCE_CLAIM_SSL",   "off");
	define("FORCE_SITEMGR_SSL", "off");

	define("MEMBERS_BILL_LOGIN_SSL", "on");

	# ----------------------------------------------------------------------------------------------------
	# SSL
	# ----------------------------------------------------------------------------------------------------
    if (SSL_ENABLED == "on" && (string_strpos($_SERVER["PHP_SELF"], "iapp") === false)) {
		if (FORCE_PROFILE_SSL == "on") {
			if ((HTTPS_MODE != "on") && (string_strpos($_SERVER["PHP_SELF"], "/profile") !== false) && (string_strpos($_SERVER["PHP_SELF"], "/profile/login.php") === false) && (string_strpos($_SERVER["PHP_SELF"], "/profile/logout.php") === false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
		if (FORCE_MEMBERS_SSL == "on") {
			if ((HTTPS_MODE != "on") && (string_strpos($_SERVER["PHP_SELF"], "/sponsors") !== false) && (string_strpos($_SERVER["PHP_SELF"], "facebookauth.php") === false) && (string_strpos($_SERVER["PHP_SELF"], "facebookimage.php") === false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
			if ((HTTPS_MODE != "on") && (FORCE_ORDER_SSL == "on") && (string_strpos($_SERVER["PHP_SELF"], "order_") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
            if ((HTTPS_MODE != "on") && (FORCE_CLAIM_SSL == "on") && (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CLAIM_URL_DIVISOR."/") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
		if (FORCE_SITEMGR_SSL == "on") {
			if ((HTTPS_MODE != "on") && (string_strpos($_SERVER["PHP_SELF"], "/sitemgr") !== false) && (string_strpos($_SERVER["PHP_SELF"], "/registration.php") === false) && (string_strpos($_SERVER["PHP_SELF"], "&popup=1") === false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}

		if (MEMBERS_BILL_LOGIN_SSL == "on") {	

				/**
				 * @ Login and Billing Page
				 */ 

			if (	
					// (strpos($_SERVER["PHP_SELF"], "sponsors/login.php") != true) 
					// && (strpos($_SERVER["PHP_SELF"], "profile/login.php") != true) 
					// && 
				    (strpos($_SERVER["PHP_SELF"], "sponsors/billing/pay.php") != true) 
					&& (strpos($_SERVER["PHP_SELF"], "sponsors/billing/processpayment.php") != true)
					//ADD Page
					&& (strpos($_SERVER["PHP_SELF"], "sponsors/claim/addpayment.php") != true)
					//CLAIM Page
					&& (strpos($_SERVER["PHP_SELF"], "sponsors/claim/payment.php") != true)
                    //update payment method page
                    && (strpos($_SERVER["REQUEST_URI"], "subscription_info.php") != true)
                    && (strpos($_SERVER["REQUEST_URI"], "update_paymentmethod_form.php") != true)
                    && (strpos($_SERVER["REQUEST_URI"], "process_update_paymentmethod.php") != true)
					&& (strpos($_SERVER["REQUEST_URI"], "sponsors") != true)
					&& (strpos($_SERVER["REQUEST_URI"], "login.php") != true)
					&& (strpos($_SERVER["REQUEST_URI"], "extras") != true)
					// && (strpos($_SERVER["REQUEST_URI"], "captcha.php") != true)
					&& (strpos($_SERVER["REQUEST_URI"], "check_friendlyurl.php") != true)
					//Order Listing
					//&& (strpos($_SERVER["PHP_SELF"], "order_listing.php") != true)
					//Login Popup
					//&& (strpos($_SERVER['REQUEST_URI'], "profile_login") != true)

				){
				if($_SERVER['HTTPS'] == "on"){
					header("Location: "."http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
					exit;
				}
	
			} else {

				if($_SERVER['HTTPS'] != "on" && strpos($_SERVER["REQUEST_URI"], "login.php") != true
											 //&& strpos($_SERVER["REQUEST_URI"], "captcha.php") != true
                                             && strpos($_SERVER["REQUEST_URI"], "check.php") != true){
					header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
					exit;
				}
			}

		}


	} else {
		if (HTTPS_MODE == "on") {
			header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
			exit;
		}
	}

?>-->
