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
	# * FILE: /conf/loadconfig.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEMONSTRATION MODE
	# ----------------------------------------------------------------------------------------------------

	if (strpos($_SERVER["HTTP_HOST"], "demodirectory") === false) {
		define("DEMO_MODE", 0);
	} else {
		define("DEMO_MODE", 1);
	}
	if (strpos($_SERVER["HTTP_HOST"], "demodirectory.com") === false) {
                define("DEMO_LIVE_MODE", 0);
	} else {
		define("DEMO_LIVE_MODE", 1);
	}
	if ((strpos($_SERVER["HTTP_HOST"], "arcasolutions.com") === false) && (strpos($_SERVER["HTTP_HOST"], "intranet") === false)) {
		define("DEMO_DEV_MODE", 0);
	} else {
		define("DEMO_DEV_MODE", 1);
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINE EDIRECTORY FOLDER
	# ----------------------------------------------------------------------------------------------------
	if (!defined("EDIRECTORY_FOLDER")) define("EDIRECTORY_FOLDER", "/10300");

	# ----------------------------------------------------------------------------------------------------
	# TMP FOLDER PATH DEFINITION
	# ----------------------------------------------------------------------------------------------------
	define("TMP_FOLDER", $_SERVER["DOCUMENT_ROOT"].EDIRECTORY_FOLDER."/custom/tmp");


    # ----------------------------------------------------------------------------------------------------
	# LOGS
	# ----------------------------------------------------------------------------------------------------
    define("ENABLE_LOG", true);
    define("LOG_PATH", $_SERVER["DOCUMENT_ROOT"].EDIRECTORY_FOLDER."/custom/log");
    define("SHOW_REGISTRATION_LOG", false);
    define("ACTIVATION_DEBUG", false);
    define("QUERY_LOG_DB", false); // Save log of queries on DB - SQL_Log
    define("QUERY_LOG_FILE", false);
    define("LOG_SIZE_ROTATE", 5); // Value in MB
    define("ENABLE_CRON_LOG", false);
    define("CRON_LOG_CLEAR_INTERVAL", 7); //days

	# ----------------------------------------------------------------------------------------------------
	# DEFINE EDIRECTORY ROOT
	# ----------------------------------------------------------------------------------------------------
	if (!defined("EDIRECTORY_ROOT")) define("EDIRECTORY_ROOT", $_SERVER["DOCUMENT_ROOT"].EDIRECTORY_FOLDER);

	# ----------------------------------------------------------------------------------------------------
	# PHPINI
	# ----------------------------------------------------------------------------------------------------
	include("phpini.inc.php");

    # ----------------------------------------------------------------------------------------------------
	# DIRECTORY ALIAS DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_ALIAS", "sponsors");
	define("SITEMGR_ALIAS", "sitemgr");

	# ----------------------------------------------------------------------------------------------------
	# DOMAIN CONSTANT
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/custom/domain/domain.inc.php");

	if (!$_inCron){
		if ($_SERVER["HTTP_HOST"]){
			session_start();
		}

		if(function_exists('mb_strtoupper')){
			$host = mb_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
			$host_cookie = str_replace(".", "_", $host);
		}else{
			$host = strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
			$host_cookie = str_replace(".", "_", $host);
		}

		if ($_SERVER["HTTP_HOST"] && !$domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]) {
			echo "Domain unavailable! Please contact the administrator.";
			exit;
		} else {
			if (strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)){
				if (!in_array($_SESSION[$host."_DOMAIN_ID_SITEMGR"], $domainInfo) || $resetDomainSession) {
					if (!in_array($_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"], $domainInfo) || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_SITEMGR", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"];
					}
					define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_SITEMGR"]);
				}
			} else if (strpos ($_SERVER["PHP_SELF"], MEMBERS_ALIAS)){
				if (!in_array($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $domainInfo) || $resetDomainSession) {
					if (!in_array($_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"], $domainInfo) || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_MEMBERS", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"];
					}
					define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_MEMBERS"]);
					define("URL_DOMAIN_ID", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]);

				}
			}
		}

		if ($_SERVER["HTTP_HOST"]) {
			if (strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)){
				if (!$_SESSION[$host."_DOMAIN_ID_SITEMGR"] || $resetDomainSession) {
					if (!$_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"] || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_SITEMGR", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"];
					}
				}
				define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_SITEMGR"]);
			} else if (strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS)){
				if (!$_SESSION[$host."_DOMAIN_ID_MEMBERS"] || $resetDomainSession) {
					if (!$_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"] || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_MEMBERS", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"];
					}
				}
				define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_MEMBERS"]);
				define("URL_DOMAIN_ID", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]);

			} else {
				if (!$_SESSION[$host."_DOMAIN_ID"] || $_SESSION[$host."_DOMAIN_ID"] != $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]) {
					$_SESSION[$host."_DOMAIN_ID"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
				}
				define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID"]);
			}

		}
		if (strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)) {
			setcookie($host."_DOMAIN_ID_TINYMCE_SITEMGR", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_SITEMGR", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
		} else if (strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS)) {
			setcookie($host."_DOMAIN_ID_TINYMCE_MEMBERS", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_MEMBERS", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_SITEMGR", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
		}
		unset($domainInfo);
	}

    if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/timezone.inc.php")) {
        include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/timezone.inc.php");
    }

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GENERAL CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("config.inc.php");
        /**
         * SagePay Modification
         */
        include_once EDIRECTORY_ROOT.'/sagepay/sagepay.php';

        /**
         * Modification to include Plugins
         */
        PluginsHelper::loadPlugins();

        /**
         * To Add modules similar to sagepay
         */
        include_once EDIRECTORY_ROOT.DIRECTORY_SEPARATOR.'extras'.DIRECTORY_SEPARATOR.'modules.php';
        define( 'DEFAULT_COUNTRY_LOCATION', 'United Kingdom' );
        define( 'DEFAULT_COUNTRY_LOCATION_ID', '1' );
        
        define( 'GEO_LOCATOR_TYPE', 'maxmind_lite_binary' );
	//define( 'GEO_LOCATOR_TYPE', 'freegeoip' );
        define( 'GEO_LOCATOR_SERVICE_URL', 'http://freegeoip.net/json/' );

	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH DOMAIN INFORMATION
	# ----------------------------------------------------------------------------------------------------
	db_ArrayDomainInfo();

	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH LANGUAGE INFORMATION
	# ----------------------------------------------------------------------------------------------------
	language_constants();

	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH LEVELS INFORMATION
	# ----------------------------------------------------------------------------------------------------
    if (!$upgradeScript){
        system_ListingLevel_Constant();
    }
	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH SETTING INFORMATION
	# ----------------------------------------------------------------------------------------------------
	setting_constants();

    # ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH THEME TEMPLATE ID
	# ----------------------------------------------------------------------------------------------------
    if (!$upgradeScript){
        system_getThemeTemplate();
    }

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURE
	# MOBILE FEATURE
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	if ((strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS) === false) && (strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS) === false) && (strpos($_SERVER["PHP_SELF"], "/API/api") === false)) {

		$autoMobileDetect = mobile_enableAutoDetect();
		if ($autoMobileDetect == "y") {

			$isiapp = "n";
			if (strpos($_SERVER["PHP_SELF"], "iapp") !== false) {
                $isiapp = "y";
            }
			$isMacMobile = mobile_isMacMobile();
			if (($isiapp == "y") && ($isMacMobile != "y")) {
				header("Location: ".DEFAULT_URL."");
				exit;
			}

			if ($isiapp != "y" && $_COOKIE["mobileFullSite"] != "true") {
				$isMobile = mobile_isMobile();

                //Redirect to /mobile if it's a mobile device
				if (($isMobile == "y") && !defined("EDIRECTORY_MOBILE") && (string_strpos($_SERVER["REQUEST_URI"], "image_resizer") === false)) {

                    include(EDIRECTORY_ROOT."/conf/mobile.inc.php");
                    header("Location: ".DEFAULT_URL."/".EDIRECTORY_MOBILE_LABEL."");
                    exit;

                //Redirect to default url if it's not a mobile device trying to access the mobile version
				} elseif (defined("EDIRECTORY_MOBILE") && (EDIRECTORY_MOBILE == "on") && ( ($isMobile != "y"))) {

                    header("Location: ".DEFAULT_URL."");
                    exit;

				}
			}
		} else {
            if (defined("EDIRECTORY_MOBILE") && (EDIRECTORY_MOBILE == "on") && (RESPONSIVE_THEME)) {

                header("Location: ".DEFAULT_URL."");
                exit;

            }
        }
	}


?>
