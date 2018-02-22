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
	# * FILE: /theme/default/frontend/general.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $addSidebar = false;
	$generalPageItemPath = "";
	if (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) {
		$generalPageItemPath = LISTING_FEATURE_FOLDER."/";
        $moduleFolder = LISTING_FEATURE_FOLDER;
        $module_name = "listing";
        $page = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_LISTING_MODULE."/", "", $_SERVER["REQUEST_URI"]);
        $alias_allcategories = ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR;
	} elseif (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) {
		$generalPageItemPath = PROMOTION_DEFAULT_URL."/";
        $moduleFolder = PROMOTION_FEATURE_FOLDER;
        $module_name = "promotion";
        $page = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_PROMOTION_MODULE."/", "", $_SERVER["REQUEST_URI"]);
        $alias_allcategories = ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR;
	} elseif (ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)."/";
        $moduleFolder = EVENT_FEATURE_FOLDER;
        $module_name = "event";
        $page = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_EVENT_MODULE."/", "", $_SERVER["REQUEST_URI"]);
        $alias_allcategories = ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR;
	} elseif (ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)."/";
        $moduleFolder = CLASSIFIED_FEATURE_FOLDER;
        $module_name = "classified";
        $page = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_CLASSIFIED_MODULE."/", "", $_SERVER["REQUEST_URI"]);
        $alias_allcategories = ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR;
	} elseif (ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)."/";
        $moduleFolder = ARTICLE_FEATURE_FOLDER;
        $page = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_ARTICLE_MODULE."/", "", $_SERVER["REQUEST_URI"]);
        $alias_allcategories = ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR;
	} elseif (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)."/";
        $moduleFolder = BLOG_FEATURE_FOLDER;
        $page = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_BLOG_MODULE."/", "", $_SERVER["REQUEST_URI"]);
        $alias_allcategories = ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR;
	}	
    
    if (string_strpos($page, ".php") === false) {
        $page = string_substr($page, 0, string_strpos($page, "/"));
    }
    
    if (!$page) {
        $page = $_SERVER["PHP_SELF"];
        $page = string_substr($page, string_strrpos($page, "/")+1);
        $page = string_substr($page, 0, string_strrpos($page, "."));
    }
    
    if (string_strpos($page, $alias_allcategories) !== false) {
        $allCategoriesPage = true;
        $filePathToInclude = system_getFrontendPath("browsebycategory.php", "frontend", false, $moduleFolder);
    } elseif (string_strpos($page, ALIAS_ALLLOCATIONS_URL_DIVISOR.".php") !== false) {
        $filePathToInclude = EDIRECTORY_ROOT."/alllocationscontent.php";
    } elseif ($page == ALIAS_REVIEW_URL_DIVISOR || $page == ALIAS_CHECKIN_URL_DIVISOR) {
        $filePathToInclude = system_getFrontendPath("commentscontent.php", "frontend", false, $moduleFolder); 
    } elseif ($generalPage == "faq") {
        $filePathToInclude = EDIRECTORY_ROOT."/includes/forms/form_faq_default.php";
    } else {
        
        if (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CONTACTUS_URL_DIVISOR) !== false || string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_LEAD_URL_DIVISOR) !== false) {
            $addSidebar = true;
            $hasContactInfo = false;
            
            //Check if there's at least one contact info to create the sidebar
            setting_get("contact_email", $contact_email);
            setting_get("contact_phone", $contact_phone);
            setting_get("contact_address", $contact_address);
            setting_get("contact_zipcode", $contact_zipcode);
            setting_get("contact_country", $contact_country);
            setting_get("contact_state", $contact_state);
            setting_get("contact_city", $contact_city);
            
            if ($contact_email || $contact_phone || $contact_address || $contact_zipcode || $contact_country || $contact_state || $contact_city) {
                $hasContactInfo = true;
            }
            
            if (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CONTACTUS_URL_DIVISOR) !== false) {
                
                $contentSpanSize = "4";
                $sidebarSpanSize = "8";
                $contactIncludeFile = "contact_map.php";

            } elseif (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_LEAD_URL_DIVISOR) !== false) {
                
                $contentSpanSize = "8";
                $sidebarSpanSize = "4";
                $contactIncludeFile = "lead_contact.php";
            }
            
        }
        
        if (file_exists(EDIRECTORY_ROOT."/".$generalPageItemPath.$page."content.php")) {
            $filePathToInclude = EDIRECTORY_ROOT."/".$generalPageItemPath.$page."content.php";
        } elseif (file_exists(EDIRECTORY_ROOT."/".$generalPage."content.php")) {
            $filePathToInclude = EDIRECTORY_ROOT."/".$generalPage."content.php";
        }
        
    }