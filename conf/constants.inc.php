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
	# * FILE: /conf/constants.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php")) {
		include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php");
	} else {
		# ****************************************************************************************************
		# MODULES
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("EVENT_FEATURE",         "on");
		define("BANNER_FEATURE",        "on");
		define("CLASSIFIED_FEATURE",    "on");
		define("ARTICLE_FEATURE",       "on");
		define("PROMOTION_FEATURE",     "on");
		define("BLOG_FEATURE",          "on");
		define("ZIPCODE_PROXIMITY",     "on");

		# ****************************************************************************************************
		# FEATURES
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("CUSTOM_INVOICE_FEATURE",    "on");
		define("CLAIM_FEATURE",             "on");
		define("LISTINGTEMPLATE_FEATURE",   "on");
		define("MOBILE_FEATURE",            "off");
		define("MULTILANGUAGE_FEATURE",     "on");
		define("MAINTENANCE_FEATURE",       "on");

		# ****************************************************************************************************
		# EXTRA FEATURES
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("SITEMAP_FEATURE", "on");
		# ****************************************************************************************************
		# CUSTOMIZATIONS
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# ****************************************************************************************************
		define("BRANDED_PRINT", "on");

		# ****************************************************************************************************
		# PAYMENT SYSTEM FEATURE
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("PAYMENTSYSTEM_FEATURE", "on");
		
		# ----------------------------------------------------------------------------------------------------
		# EDIRECTORY TITLE
		# ----------------------------------------------------------------------------------------------------
		define("EDIRECTORY_TITLE", "Demo Directory");
		
		# ----------------------------------------------------------------------------------------------------
		# GEO IP CONFIGURATION
		# ----------------------------------------------------------------------------------------------------
		define("GEOIP_FEATURE", "on");

		# ----------------------------------------------------------------------------------------------------
		# SHOW BANNER MODE
		# NOTE: This flag is only to the front view
		# ----------------------------------------------------------------------------------------------------
		define("SHOW_INACTIVE_BANNER", "off");
		       
        # ----------------------------------------------------------------------------------------------------
        # CACHE SETTINGS
        # ----------------------------------------------------------------------------------------------------
        define("CACHE_FULL_FEATURE", "off"); 
        define("CACHE_FULL_ZLIB_COMPRESSION_IF_AVAILABLE", "off"); 
        define("CACHE_FULL_VERBOSE_MODE", "off"); 
        define("CACHE_FULL_LOG_EXPIRATION_QUERIES", "off"); 
        define("CACHE_FULL_INCLUDE_CACHE_COMMENT_AT_PAGE", "off");
        define("CACHE_FULL_REMOVE_FILES_WHEN_DISABLED", "off");
        
        # ----------------------------------------------------------------------------------------------------
        # CACHE FULL FEATURE CONTENT SETTINGS
        # ----------------------------------------------------------------------------------------------------
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_LISTING", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_DEAL", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_CLASSIFIED", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_EVENT", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_ARTICLE", "on");
        
        # ----------------------------------------------------------------------------------------------------
        # CACHE PARTIAL SETTINGS
        # ----------------------------------------------------------------------------------------------------
        define("CACHE_PARTIAL_FEATURE", "off");
        
        # ----------------------------------------------------------------------------------------------------
        # FRONT SEARCH
        # ----------------------------------------------------------------------------------------------------
        define("SEARCH_FORCE_BOOLEANMODE", "on");
        
        # ----------------------------------------------------------------------------------------------------
        # GALLERY IMAGES
        # - Turn on the constant GALLERY_FREE_RATIO to remove the crop for wide images.
        # - Remember to turn off the constant RESIZE_IMAGES_UPGRADE.
        # - ATTENTION! The thumb preview in the upload window will not be shown when this constant is turned on.
        # - You can also force all jpg images to be saved as png for better quality by turning on the constant FORCE_SAVE_JPG_AS_PNG.
        # ----------------------------------------------------------------------------------------------------
        define("GALLERY_FREE_RATIO", "off");
        define("FORCE_SAVE_JPG_AS_PNG", "off");
        
        # ----------------------------------------------------------------------------------------------------
        # SITEMAP LINKS
        #  - Turn on to add "www" to sitemap links.
        # ----------------------------------------------------------------------------------------------------
        define("SITEMAP_ADD_WWW", "off");
	}
    
    define("SITMGR_FEEDBACK_EMAIL", "feedback@edirectory.com");

	if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php")) {
		include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php");
	} else {
		define("SOCIALNETWORK_FEATURE", "on");
	}

	# ****************************************************************************************************
	# PASSWORD ENCRYPTION (DEFAULT ON)
	# ****************************************************************************************************
	define("PASSWORD_ENCRYPTION", "on");
	# ****************************************************************************************************
	# ANTIALIASED (DEFAULT OFF)
	# ****************************************************************************************************
	define("FORCE_ANTIALIASED_IMAGES", "off");
	# ****************************************************************************************************
	# SOCIAL BOOKMARKING (DEFAULT ON)
	# ****************************************************************************************************
	define("SOCIAL_BOOKMARKING", "on");
	# ****************************************************************************************************
	# RENAME ITEM LEVEL (DEFAULT ON)
	# ****************************************************************************************************
	define("ABLE_RENAME_LEVEL", "on");
	# ****************************************************************************************************
	# SUGARCRM FEATURE
	# ****************************************************************************************************
	if (DEMO_LIVE_MODE){ 
		define("SUGARCRM_FEATURE", "on"); //DON'T CHANGE THIS! Always enabled in demodirectory.com
	} else {
		define("SUGARCRM_FEATURE", "off");
	}
    # ****************************************************************************************************
	# GOOGLE MAPS KEY FOR DEMODIRECTORY.COM
	# ****************************************************************************************************
    define("GOOGLE_MAPS_APP_DEMO", "AIzaSyDM5pcvIu56ezCjKvI8VC0hR3BlduzBXYA");
    
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY VERSION
	# NOTE: Do not alter this area of the code manually.
	# Any changes will require eDirectory to be activated again.
	# ----------------------------------------------------------------------------------------------------
	define("VERSION", "v.10.3.00");
    
    # ----------------------------------------------------------------------------------------------------
    # CONTROLER FOLDER
    # ----------------------------------------------------------------------------------------------------
    define("EDIR_CORE_FOLDER_NAME", "edir_core");
    define("EDIR_CONTROLER_FOLDER", EDIRECTORY_ROOT."/controller");

	# ----------------------------------------------------------------------------------------------------
	# ITEM CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_FEATURE_FOLDER",		"listing");
	define("LISTING_EDIRECTORY_ROOT",		EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/".LISTING_FEATURE_FOLDER);

	define("PROMOTION_FEATURE_FOLDER",		"deal");
    define("PROMOTION_EDIRECTORY_ROOT",		EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/".PROMOTION_FEATURE_FOLDER);
	
	define("EVENT_FEATURE_FOLDER",			"event");
    define("EVENT_EDIRECTORY_ROOT",			EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/".EVENT_FEATURE_FOLDER);
	
	define("CLASSIFIED_FEATURE_FOLDER",		"classified");
    define("CLASSIFIED_EDIRECTORY_ROOT",	EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/".CLASSIFIED_FEATURE_FOLDER);
	
	define("ARTICLE_FEATURE_FOLDER",		"article");
    define("ARTICLE_EDIRECTORY_ROOT",		EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/".ARTICLE_FEATURE_FOLDER);
	
	define("BLOG_FEATURE_FOLDER",			"blog");
    define("BLOG_EDIRECTORY_ROOT",			EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/".BLOG_FEATURE_FOLDER);

	define("BANNER_FEATURE_FOLDER",			"banner");
	

    # ----------------------------------------------------------------------------------------------------
	# PROFILE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SOCIALNETWORK_FEATURE_NAME",	"profile");
	define("SOCIALNETWORK_ROOT",			EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME);
	define("SOCIALNETWORK_URL",				NON_SECURE_URL."/".SOCIALNETWORK_FEATURE_NAME);

	# ----------------------------------------------------------------------------------------------------
	# PACKAGE SETTINGS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_PACKAGE_DOMAIN", 1);
    
    # ----------------------------------------------------------------------------------------------------
	# LISTING PRICE LEVELS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_PRICE_LEVELS", 4);
    
	# ----------------------------------------------------------------------------------------------------
	# BLOG CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BLOG_WITH_WORDPRESS", "off");
	
	# ----------------------------------------------------------------------------------------------------
	# BACKLINK CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BACKLINK_FEATURE", "on");
	   
	# ----------------------------------------------------------------------------------------------------
	# DISCOUNT CODE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("DISCOUNTCODE_LABEL", "promotional code"); // layout works for: "discount code" and "promotional code" (available to any label)

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("ZIPCODE_US", "on"); // on/off
	define("ZIPCODE_CA", "off"); // on/off
	define("ZIPCODE_UK", "off"); // on/off
	define("ZIPCODE_AU", "off"); // on/off

	# ----------------------------------------------------------------------------------------------------
	# FRIENDLY URL CONSTANTS
	# IMPORTANT - PAY ATTENTION
	# Any changes here need to be done in all .htaccess (modrewrite)
	# ----------------------------------------------------------------------------------------------------
	define("FRIENDLYURL_SEPARATOR",         "-");
	define("FRIENDLYURL_VALIDCHARS",        "a-zA-Z0-9");
	define("FRIENDLYURL_REGULAREXPRESSION", "/^[".FRIENDLYURL_VALIDCHARS.FRIENDLYURL_SEPARATOR."]{1,}/");

	# ----------------------------------------------------------------------------------------------------
	# DIRECTORY PATH DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_EDIRECTORY_ROOT",   EDIRECTORY_ROOT."/".MEMBERS_ALIAS);
	define("SM_EDIRECTORY_ROOT",        EDIRECTORY_ROOT."/".SITEMGR_ALIAS);

	# ----------------------------------------------------------------------------------------------------
	# SITE MANAGER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SM_LOGIN_PAGE",     DEFAULT_URL."/".SITEMGR_ALIAS."/login.php");
	define("SM_LOGOUT_PAGE",    DEFAULT_URL."/".SITEMGR_ALIAS."/logout.php");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_LOGIN_PAGE",    DEFAULT_URL."/".MEMBERS_ALIAS."/login.php");
	define("MEMBERS_LOGOUT_PAGE",   DEFAULT_URL."/".MEMBERS_ALIAS."/logout.php");

	# ----------------------------------------------------------------------------------------------------
	# UPLOAD CONSTANTS
	# ----------------------------------------------------------------------------------------------------.
	define("UPLOAD_MAX_SIZE",               "1.5"); //in MB
	define("BANNER_UPLOAD_MAX_SIZE",        "400"); //in KB
	define("BANNER_UPLOAD_MAX_SIZE_INBYTE", "409600"); //in BYTES
	define("SLIDER_UPLOAD_MAX_SIZE_INBYTE", "409600"); //in BYTES

	# ----------------------------------------------------------------------------------------------------
	# IMAGE FOLDER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("IMAGE_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/image_files");
	define("IMAGE_DIR",             EDIRECTORY_ROOT.IMAGE_RELATIVE_PATH);
	define("IMAGE_URL",             DEFAULT_URL.IMAGE_RELATIVE_PATH);

	define("PROFILE_IMAGE_RELATIVE_PATH",   "/custom/profile");
	define("PROFILE_IMAGE_DIR",             EDIRECTORY_ROOT.PROFILE_IMAGE_RELATIVE_PATH);
	define("PROFILE_IMAGE_URL",             DEFAULT_URL.PROFILE_IMAGE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# EXTRA FILES CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("EXTRAFILE_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/extra_files");
	define("EXTRAFILE_DIR",             EDIRECTORY_ROOT.EXTRAFILE_RELATIVE_PATH);
	define("EXTRAFILE_URL",             DEFAULT_URL.EXTRAFILE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# TEMPLATE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("TEMPLATE_LAYOUTIDS",        "0,1,2,3");
	define("TEMPLATE_LAYOUTNAMES",      "Default,Double Column - Content Left,Double Column - Content Right,Slim");
	define("TEMPLATE_LAYOUTSAMPLES",    "templatesample_default.png,templatesample_1.png,templatesample_2.png,templatesample_3.png");

	# ----------------------------------------------------------------------------------------------------
	# CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("CLASSES_DIR",   EDIRECTORY_ROOT."/classes");
	define("INCLUDES_DIR",  EDIRECTORY_ROOT."/includes");
	define("FUNCTIONS_DIR", EDIRECTORY_ROOT."/functions");

	# ----------------------------------------------------------------------------------------------------
	# EXPIRE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("DEFAULT_LISTING_DAYS_TO_EXPIRE",    60);
	define("DEFAULT_EVENT_DAYS_TO_EXPIRE",      60);
	define("DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE", 10);
	define("DEFAULT_ARTICLE_DAYS_TO_EXPIRE",    60);

	# ----------------------------------------------------------------------------------------------------
	# LAST TWEETS COUNT
	# ----------------------------------------------------------------------------------------------------
	define("MAX_TWEETS_FRONT",      2);
	define("MAX_TWEETS_MEMBERS",    5);

	# ----------------------------------------------------------------------------------------------------
	# KEYWORD CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_KEYWORDS", 10);
    
    # ----------------------------------------------------------------------------------------------------
	# SITEMGR DASHBOARD - MAX RECENT ACTIVITIES
	# ----------------------------------------------------------------------------------------------------
	define("DASHBOARD_MAX_ACTIVITIES", 10);
    
    # ----------------------------------------------------------------------------------------------------
	# SITEMGR DASHBOARD - MAX ITEMS TO BE APPROVED
	# ----------------------------------------------------------------------------------------------------
	define("DASHBOARD_MAX_TO_APPROVED", 5);
    
    # ----------------------------------------------------------------------------------------------------
	# SITEMGR DASHBOARD - MAX PENDING REVIEWS
	# ----------------------------------------------------------------------------------------------------
    define("DASHBOARD_MAX_PENDING_REVIEWS", 3);
    
    # ----------------------------------------------------------------------------------------------------
	# THEME CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/conf/constants_".EDIR_THEME.".inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CATEGORY CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	//Total categories per item (all modules except for listings)
    define("MAX_CATEGORY_ALLOWED",              5); // Limited to 5
	//Total categories per item (listings)
    define("LISTING_MAX_CATEGORY_ALLOWED",      5); // Unlimited
	
    define("SHOW_CATEGORY_COUNT",               "on");
    define("MAX_SHOW_ALL_CATEGORIES",           1000); // Max of categories to show
    define("FEATUREDCATEGORY_LEVEL_AMOUNT",     CATEGORY_LEVEL_AMOUNT > LISTING_CATEGORY_LEVEL_AMOUNT ? CATEGORY_LEVEL_AMOUNT: LISTING_CATEGORY_LEVEL_AMOUNT); // Max Levels (All modules)
    
	# RESIZE IMAGES AFTER UPGRADE
	# on (DEFAULT) - all images will be stretched to fit the new dimensions
	# off - all images will keep the same size, but the layout can be affected
	if (!defined("RESIZE_IMAGES_UPGRADE")) {
        define("RESIZE_IMAGES_UPGRADE", "on");
    }
	
	# TURN ON THIS CONSTANT FOR UPGRADED PROJECTS. IT WILL FIX THE BADGES IMAGES
	define("IS_UPGRADE", "off");
	
	if (strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."") === false) {
		define("IMAGE_HEADER_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo.png");
	} else {
		define("IMAGE_HEADER_PATH", "/custom/domain_".URL_DOMAIN_ID."/content_files/img_logo.png");
	}
    
    # ----------------------------------------------------------------------------------------------------
	# TESTIMONIAL IMAGE
	# ----------------------------------------------------------------------------------------------------
	define("IMAGE_TESTIMONIAL_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_testimonial.png");
    
	# ----------------------------------------------------------------------------------------------------
	# NOIMAGE
	# ----------------------------------------------------------------------------------------------------
	define("NOIMAGE_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
	define("NOIMAGE_NAME",      "noimage");
	define("NOIMAGE_IMGEXT",    "gif");
	define("NOIMAGE_CSSEXT",    "css");
    
    # ----------------------------------------------------------------------------------------------------
	# BACKGROUND IMAGE - DINING GUIDE
	# ----------------------------------------------------------------------------------------------------
	define("BKIMAGE_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
	define("BKIMAGE_NAME",      "bkimage");
	define("BKIMAGE_CSSEXT",    "css");
    
    # ----------------------------------------------------------------------------------------------------
	# HTML EDITOR - HEADER AND FOOTER FILES
	# ----------------------------------------------------------------------------------------------------
    define("HTMLEDITOR_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/editor");
	define("HTMLEDITOR_FOLDER",                 EDIRECTORY_ROOT.HTMLEDITOR_FOLDER_RELATIVE_PATH);
	define("HTMLEDITOR_URL",                    DEFAULT_URL.HTMLEDITOR_FOLDER_RELATIVE_PATH);
    
    # ----------------------------------------------------------------------------------------------------
	# HTML EDITOR - LANGUAGE FILES
	# ----------------------------------------------------------------------------------------------------
    define("HTMLEDITOR_LANG_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/lang/editor");
	define("HTMLEDITOR_LANG_FOLDER",                 EDIRECTORY_ROOT.HTMLEDITOR_LANG_FOLDER_RELATIVE_PATH);
	define("HTMLEDITOR_LANG_URL",                    DEFAULT_URL.HTMLEDITOR_LANG_FOLDER_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# MAX GALLERY ALLOWED
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_MAX_GALLERY",    1);
	define("EVENT_MAX_GALLERY",      1);
	define("CLASSIFIED_MAX_GALLERY", 1);
	define("ARTICLE_MAX_GALLERY",    1);
    
    # ----------------------------------------------------------------------------------------------------
	# FANCYBOX SIZES
	# ----------------------------------------------------------------------------------------------------   
    # Image captions
    define("FANCYBOX_IMAGECAPTIONS_WIDTH",    600);
    define("FANCYBOX_IMAGECAPTIONS_HEIGHT",   235);
    
    # Delete image
    define("FANCYBOX_DELIMAGE_WIDTH",         300);
    define("FANCYBOX_DELIMAGE_HEIGHT",        180);

    # Email to friend / send email box
    define("FANCYBOX_TOFRIEND_WIDTH",         580);
    define("FANCYBOX_TOFRIEND_HEIGHT",        520);

    # Front gallery box
    define("FANCYBOX_GALLERY_WIDTH",          600);
    define("FANCYBOX_GALLERY_HEIGHT",         400);

    # Send to phone and Click to call boxes
    define("FANCYBOX_TWILIO_WIDTH",           330);
    define("FANCYBOX_TWILIO_HEIGHT",          335);

    # Deal redeem box
    define("FANCYBOX_DEAL_WIDTH",             650);
    define("FANCYBOX_DEAL_HEIGHT",            400);

    # Review box
    define("FANCYBOX_REVIEW_WIDTH",           600);
    define("FANCYBOX_REVIEW_HEIGHT",          475);
    
    # Modules preview (sponsors/sitemgr)
    if (!defined("FANCYBOX_ITEM_PREVIEW_WIDTH") && !defined("FANCYBOX_ITEM_PREVIEW_HEIGHT")) {
        define("FANCYBOX_ITEM_PREVIEW_WIDTH",     1000);
        define("FANCYBOX_ITEM_PREVIEW_HEIGHT",    440);
    }

	# ----------------------------------------------------------------------------------------------------
	# REPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_REPORT_SUMMARY_VIEW",       1);
	define("LISTING_REPORT_DETAIL_VIEW",        2);
	define("LISTING_REPORT_CLICK_THRU",         3);
	define("LISTING_REPORT_EMAIL_SENT",         4);
	define("LISTING_REPORT_PHONE_VIEW",         5);
	define("LISTING_REPORT_FAX_VIEW",           6);
	define("LISTING_REPORT_SMS",                7);
	define("LISTING_REPORT_CLICKTOCALL",        8);
	define("PROMOTION_REPORT_SUMMARY_VIEW",     1);
    define("PROMOTION_REPORT_DETAIL_VIEW",      2);
	define("BANNER_REPORT_CLICK_THRU",          1);
	define("BANNER_REPORT_VIEW",                2);
	define("ARTICLE_REPORT_SUMMARY_VIEW",       1);
	define("ARTICLE_REPORT_DETAIL_VIEW",        2);
	define("EVENT_REPORT_SUMMARY_VIEW",         1);
	define("EVENT_REPORT_DETAIL_VIEW",          2);
	define("CLASSIFIED_REPORT_SUMMARY_VIEW",    1);
	define("CLASSIFIED_REPORT_DETAIL_VIEW",     2);
	define("POST_REPORT_SUMMARY_VIEW",          1);
	define("POST_REPORT_DETAIL_VIEW",			2);
	define("REPORT_DAYS_SHOW",                  20);

	# ----------------------------------------------------------------------------------------------------
	# BANNER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BANNER_EXPIRATION_IMPRESSION",   1);
	define("BANNER_EXPIRATION_RENEWAL_DATE", 2);

	# ----------------------------------------------------------------------------------------------------
	# USER ATRIBUTES
	# ----------------------------------------------------------------------------------------------------
	define("USERNAME_MAX_LEN", 80); // don't forget to verify the field in DB
	define("USERNAME_MIN_LEN",  4);
	define("PASSWORD_MAX_LEN", 50); // don't forget to verify the field in DB
	define("PASSWORD_MIN_LEN",  4);

	# ----------------------------------------------------------------------------------------------------
	# EMAIL NOTIFICATIONS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("RENEWAL_30",                            1);
	define("RENEWAL_15",                            2);
	define("RENEWAL_7",                             3);
	define("RENEWAL_1",                             4);
	define("SYSTEM_SPONSOR_ACCOUNT_CREATE",         5);
	define("SYSTEM_SPONSOR_ACCOUNT_UPDATE",         6);
	define("SYSTEM_VISITOR_ACCOUNT_CREATE",         7);
	define("SYSTEM_VISITOR_ACCOUNT_UPDATE",         8);
	define("SYSTEM_FORGOTTEN_PASS",                 9);
	define("SYSTEM_NEW_LISTING",                    10);
	define("SYSTEM_NEW_EVENT",                      11);
	define("SYSTEM_NEW_BANNER",                     12);
	define("SYSTEM_NEW_CLASSIFIED",                 13);
	define("SYSTEM_NEW_ARTICLE",                    14);
	define("SYSTEM_NEW_CUSTOMINVOICE",              15);
	define("SYSTEM_ACTIVE_LISTING",                 16);
	define("SYSTEM_ACTIVE_EVENT",                   17);
	define("SYSTEM_ACTIVE_BANNER",                  18);
	define("SYSTEM_ACTIVE_CLASSIFIED",              19);
	define("SYSTEM_ACTIVE_ARTICLE",                 20);
	define("SYSTEM_EMAIL_TOFRIEND",                 21);
	define("SYSTEM_LISTING_SIGNUP",                 22);
	define("SYSTEM_EVENT_SIGNUP",                   23);
	define("SYSTEM_BANNER_SIGNUP",                  24);
	define("SYSTEM_CLASSIFIED_SIGNUP",              25);
	define("SYSTEM_ARTICLE_SIGNUP",                 26);
	define("SYSTEM_CLAIM_SIGNUP",                   27);
	define("SYSTEM_CLAIM_AUTOMATICALLY_APPROVED",   28);
	define("SYSTEM_CLAIM_APPROVED",                 29);
	define("SYSTEM_CLAIM_DENIED",                   30);
	define("SYSTEM_APPROVE_REPLY",                  31);
	define("SYSTEM_APPROVE_REVIEW",                 32);
	define("SYSTEM_NEW_REVIEW",                     33);
	define("SYSTEM_INVOICE_NOTIFICATION",           34);
	define("SYSTEM_NEW_PROFILE",					35);
	define("SYSTEM_EMAIL_TRAFFIC",					36);
    define("SYSTEM_NEW_DEAL",                       37);
    define("SYSTEM_DEAL_DONE",                      38);
    define("SYSTEM_ACTIVATE_ACCOUNT",               39);
    define("SYSTEM_NEW_LEAD",                       40);
    define("SYSTEM_REVIEWCOLLECTOR_ACTIVATION",                   55);
    define("REVIEWED_AN_ITEM",                   56);
    define("NEW_APP_USER",                        57);
    define("REVIEWED_AN_ITEM_FROM_WEBPORTAL",                        58);
    define("REVIEW_LATER",                        59);
    define("REMOVE_CLAIMED_BUSINESS",             60);
   define("SYSTEM_LASTEMAIL_ID",                  60);
   
	# ----------------------------------------------------------------------------------------------------
	# EXPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_LIMIT",             10000);
	define("ACCOUNT_LIMIT",             10000);
	define("CLASSIFIED_LIMIT",          10000);
	define("EVENT_LIMIT",               10000);
	define("ARTICLE_LIMIT",             10000);
	define("BANNER_LIMIT",              10000);
	define("INVOICE_LIMIT",             10000);
	define("PAYMENT_LIMIT",             10000);
	define("DEFAULT_EXPORT_EXTENSION",  "xls");
	define("DEFAULT_EXPORT_ZIPPED",     "y");

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("CUSTOM_INVOICE_ITEMS_NUMBER", 10);

	# ----------------------------------------------------------------------------------------------------
	# RSS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("RSS_LOGO_WIDTH",    300);
	define("RSS_LOGO_HEIGHT",   130);
	define("RSS_LOGO_PATH",     "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo_rss.png");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MOBILE_LOGO_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo_mobile.png");
    define("IMAGE_SCREEN_IOS_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_screen_ios.png");
    define("IMAGE_SCREEN_ANDROID_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_screen_android.png");
    define("MOBILE_SCREEN_WIDTH", "60");
    define("MOBILE_SCREEN_HEIGHT", "60");
    define("MOBILE_ADVERT_WIDTH", "290");
    define("MOBILE_ADVERT_HEIGHT", "50");
    //demodirectory.com configuration
    include(EDIRECTORY_ROOT."/conf/smartbanner.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_LOGO_WIDTH",    253);
	define("SITEMGR_LOGO_HEIGHT",   97);
	define("SITEMGR_LOGO_PATH",     "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo_sitemgr.png");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT FOLDER
	# ----------------------------------------------------------------------------------------------------
	define("IMPORT_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/import_files");
	define("IMPORT_FOLDER",                 EDIRECTORY_ROOT.IMPORT_FOLDER_RELATIVE_PATH);
	define("IMPORT_URL",                    DEFAULT_URL.IMPORT_FOLDER_RELATIVE_PATH);
    
    # ----------------------------------------------------------------------------------------------------
	# EXPORT FOLDER
	# ----------------------------------------------------------------------------------------------------
	define("EXPORT_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/export_files");
	define("EXPORT_FOLDER",                 EDIRECTORY_ROOT.EXPORT_FOLDER_RELATIVE_PATH);
	
	# ----------------------------------------------------------------------------------------------------
	# IMPORT SETTINGS
	# ----------------------------------------------------------------------------------------------------
    $serverMax = ini_get("upload_max_filesize");
    $l = substr($serverMax, -1);
    if ($l == "M") {
        $serverMax = str_replace("M", "", $serverMax);
    } else {
       $serverMax = 5;
    }
	define("MAX_MB_FILE_SIZE_ALLOWED",      ($serverMax < 5 ? $serverMax : 5));
	define("MAX_MB_FILE_SIZE_ALLOWED_FTP",  100);
	unset($serverMax);
	unset($l);
    
	# ----------------------------------------------------------------------------------------------------
	# GOOGLE SETTINGS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("GOOGLE_ADS_SETTING",                1);
	define("GOOGLE_MAPS_SETTING",               2);
	define("GOOGLE_ANALYTICS_SETTING",          3);
	define("GOOGLE_ANALYTICS_FRONT_SETTING",    4);
	define("GOOGLE_ANALYTICS_MEMBERS_SETTING",  5);
	define("GOOGLE_ANALYTICS_SITEMGR_SETTING",  6);
	define("GOOGLE_ADS_CHANNEL_SETTING",        7);
	define("GOOGLE_ADS_STATUS",                 8);
	define("GOOGLE_MAPS_STATUS",                9);
	define("GOOGLE_ADS_TYPE",                   10);
	define("GOOGLE_TAG_STATUS",                 11);
	define("GOOGLE_TAG_SETTING",                12);
	define("GOOGLE_MAPS_IMAGE_WIDTH",           50);
	define("GOOGLE_MAPS_IMAGE_HEIGHT",          50);
	define("GOOGLE_MAPS_DEBUG",                 "off");
	define("GOOGLE_MAPS_MAX_MARKERS",           "1000");
    define("GOOGLE_MAPS_LIMITDRAGGABLE",        "off");

	# ----------------------------------------------------------------------------------------------------
	# LOCATION CONSTANTS
	# ----------------------------------------------------------------------------------------------------
    define("LOCATION1_LABEL",   "country");
    define("LOCATION2_LABEL",   "region");
    define("LOCATION3_LABEL",   "state");
    define("LOCATION4_LABEL",   "city");
    define("LOCATION5_LABEL",   "neighborhood");

    define("FEATURED_LOCATION1",            "on");
	define("FEATURED_LOCATION2",            "on");
	define("FEATURED_LOCATION3",            "on");
	define("FEATURED_LOCATION4",            "on");
	define("FEATURED_LOCATION5",            "on");
	define("FEATURED_LOCATION",             "on");
	define("FEATUREDLOCATION_LEVEL_AMOUNT", 5);
       
	# ----------------------------------------------------------------------------------------------------
	# AUTOCOMPLETE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("AUTOCOMPLETE_MAXITENS",     25);
	define("AUTOCOMPLETE_MINCHARS",     3);
	define("AUTOCOMPLETE_KEYWORD_URL",  DEFAULT_URL.'/autocomplete_keyword.php');
	define("AUTOCOMPLETE_LOCATION_URL", DEFAULT_URL.'/autocomplete_location.php');

	# ----------------------------------------------------------------------------------------------------
	# URL PROTOCOL
	# ----------------------------------------------------------------------------------------------------
	define("URL_PROTOCOL", "http,https,ftp");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY CHARSET
	# ----------------------------------------------------------------------------------------------------
	define("EDIR_CHARSET", "UTF-8");

	# ----------------------------------------------------------------------------------------------------
	# SITEMAP CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SITEMAP_MAXURL",                "20000");
	define("SITEMAP_HASLISTINGLOCATION",    "y");
	define("SITEMAP_HASLISTINGCATEGORY",    "y");
	define("SITEMAP_HASLISTINGDETAIL",      "y");
	define("SITEMAP_HASPROMOTIONLOCATION",  "y");
	define("SITEMAP_HASPROMOTIONCATEGORY",  "y");
    define("SITEMAP_HASPROMOTIONDETAIL",    "y");
	define("SITEMAP_HASEVENTLOCATION",      "y");
	define("SITEMAP_HASEVENTCATEGORY",      "y");
	define("SITEMAP_HASEVENTDETAIL",        "y");
	define("SITEMAP_HASCLASSIFIEDLOCATION", "y");
	define("SITEMAP_HASCLASSIFIEDCATEGORY", "y");
	define("SITEMAP_HASCLASSIFIEDDETAIL",   "y");
	define("SITEMAP_HASARTICLECATEGORY",    "y");
	define("SITEMAP_HASARTICLEDETAIL",      "y");
	define("SITEMAP_HASARTICLENEWS",        "y");
	define("SITEMAP_HASBLOGCATEGORY",       "y");
	define("SITEMAP_HASBLOGDETAIL",         "y");
	define("SITEMAP_HASCONTENT",            "y");

	# ----------------------------------------------------------------------------------------------------
	# FAIL LOGIN
	# ----------------------------------------------------------------------------------------------------
	define("FAILLOGIN_MAXFAIL",     "4"); // FAILLOGIN_MAXFAIL + 1 = block account
	define("FAILLOGIN_TIMEBLOCK",   "60"); // minutes

	# ----------------------------------------------------------------------------------------------------
	# BLOG CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BLOG_MAX_CHARACTERS", 700);

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR / MEMBERS SEARCH
	# ----------------------------------------------------------------------------------------------------
	define("RESULTS_PER_PAGE", 50);

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM FOLDER PERMISSION
	# ----------------------------------------------------------------------------------------------------
	define("PERMISSION_CUSTOM_FOLDER", "0755");

	# ----------------------------------------------------------------------------------------------------
	# LOADING WEB PERFORMANCE
    # Some server don't support gzip
	# ----------------------------------------------------------------------------------------------------
	define("WEBLOADING_PERFORMANCE", "on");
	
	# ----------------------------------------------------------------------------------------------------
	# Settings with path of files to plugins/api
	# ----------------------------------------------------------------------------------------------------
	define("SUGAR_FILE_PATH",       EDIRECTORY_ROOT."/custom/sugar_files");
	define("WORDPRESS_FILE_PATH",   EDIRECTORY_ROOT."/custom/wordpress_files");
	define("PLUGIN_FILE_PATH",      EDIRECTORY_ROOT."/custom/plugin");
    define("EDIRAPI_FILE_PATH",     EDIRECTORY_ROOT."/custom/api_files");
    
    # ----------------------------------------------------------------------------------------------------
	# Gallery max images
	# ----------------------------------------------------------------------------------------------------
	define("GALLERY_ITEM_MAX_IMAGES",    20);
	
	# ----------------------------------------------------------------------------------------------------
	# Settings to Twilio
	# ----------------------------------------------------------------------------------------------------
	define("TWILIO_MAX_CHARACTERS", 160);
	define("TWILIO_API_VERSION",    "2010-04-01");
	
	# ----------------------------------------------------------------------------------------------------
	# Settings to Twitter
	# ----------------------------------------------------------------------------------------------------
	define("TWITTER_CACHE_TIME", 300); //cache time in seconds
	
	# ----------------------------------------------------------------------------------------------------
	# Scalability info - suggestions to turn on the module scalability when the total items is higher than the following numbers
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_SCALABILITY_NUMBER",            100000);
	define("PROMOTION_SCALABILITY_NUMBER",          50000);
	define("EVENT_SCALABILITY_NUMBER",              100000);
	define("BANNER_SCALABILITY_NUMBER",             50000);
	define("CLASSIFIED_SCALABILITY_NUMBER",         100000);
	define("ARTICLE_SCALABILITY_NUMBER",            100000);
	define("BLOG_SCALABILITY_NUMBER",               100000);
	define("LISTINGCATEGORY_SCALABILITY_NUMBER",    20);
	define("EVENTCATEGORY_SCALABILITY_NUMBER",      20);
	define("CLASSIFIEDCATEGORY_SCALABILITY_NUMBER", 20);
	define("ARTICLECATEGORY_SCALABILITY_NUMBER",    20);
	define("BLOGCATEGORY_SCALABILITY_NUMBER",       20);
    
    # ----------------------------------------------------------------------------------------------------
    # CACHE SETTINGS
    # ----------------------------------------------------------------------------------------------------
    define("CACHE_FULL_DIR", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cache_full");
    define("CACHE_FULL_UPDATETOKEN", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cacheUpdateToken/cacheUpdateToken");
    define("CACHE_FULL_VERBOSE_FILE", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cacheVerbose/cacheVerbose"); 
    define("CACHE_FULL_LOG_EXPIRATION_QUERIES_FILE", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cacheExpirationQueries/cacheExpirationQueries");
    
    # ----------------------------------------------------------------------------------------------------
    # CACHE PARTIAL SETTINGS
    # ----------------------------------------------------------------------------------------------------
    define("CACHE_PARTIAL_DIR", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cache_partial/");
    define("CACHE_PARTIAL_TIME", "43200");
    
    # ----------------------------------------------------------------------------------------------------
    # CACHE FILTER SETTINGS
    # ----------------------------------------------------------------------------------------------------
    define("CACHE_FILTER_FOLDER", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cache_filter/");
    
    # ----------------------------------------------------------------------------------------------------
    # EDIRECTORY API
    # ----------------------------------------------------------------------------------------------------
    define("API_USE_JSON", false);
    
    # ----------------------------------------------------------------------------------------------------
    # MAILAPP
    # ----------------------------------------------------------------------------------------------------
    define("MAIL_APP_FEATURE", "on");
    define("MAILAPP_FOLDER", "arcamailer");
    define("MAILAPP_LIVE_URL", "http://www.arcamailer.com/");
    
    # ----------------------------------------------------------------------------------------------------
    # ARCALOGIN USERNAME
    # ----------------------------------------------------------------------------------------------------
    define("ARCALOGIN_USERNAME", "arcalogin@arcasolutions.com");
    
    # ----------------------------------------------------------------------------------------------------
    # APP BUILDER
    # ----------------------------------------------------------------------------------------------------
    /*
     * Navigation configuration
     */
    unset($array_tabbar);
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_LISTING, "url" => "listings");
    $array_tabbar["tabbar"][] = array("name" => LANG_LABEL_NEARBY, "url" => "nearby");
    $array_tabbar["tabbar"][] = array("name" => LANG_REVIEW_PLURAL, "url" => "reviews");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_EVENT, "url" => "events", "module" => "EVENT_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_CLASSIFIED, "url" => "classifieds", "module" => "CLASSIFIED_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_ARTICLE, "url" => "articles", "module" => "ARTICLE_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_PROMOTION, "url" => "deals", "module" => "PROMOTION_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_FAVORITES, "url" => "favorites");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_ACCOUNT, "url" => "account");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_ABOUT, "url" => "about");
    
    define("APPBUILDER_MENU", serialize($array_tabbar));
    
    # ABOUT / LOGO IMAGE
    define("IMAGE_ABOUT_WIDTH", 400);
    define("IMAGE_ABOUT_HEIGHT", 150);
    
    # ----------------------------------------------------------------------------------------------------
	# IMAGES PATH
	# ----------------------------------------------------------------------------------------------------
	define("IMAGE_APPBUILDER_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
        
        
    define('REVIEW_COLLECTOR_EMAIL_LINK_KEY', 'zAqwe147!');
    
    define("LOG_BUILDER", TRUE); // true/false
    
     define("ANDROID_LINK", "https://play.google.com/store/apps/details?id=com.app.eooro"); 
     
     define("ANDROID_IMG", NON_SECURE_URL . IMAGE_RELATIVE_PATH . "/android.png"); 

     define("IOS_LINK", "https://itunes.apple.com/us/app/review-collector-eooro/id1148388292"); 
     
      define("IOS_IMG", NON_SECURE_URL . IMAGE_RELATIVE_PATH . "/ios.png"); 

//      define("MICROSOFT_APP_LINK", "https://play.google.com/store/apps/details?id=com.app.eooro");
    
    define("DATA_SITEKEY", "6Ld09CgTAAAAAH4hvLsHBL-HFvoe9atQbz1IhVjZ"); 
    define("DATA_SECRETKEY", "6Ld09CgTAAAAAC3yLgJ6cjTdz1cvJ15eQnW3MPDV"); 
    
    
    //LIVE GOOGLE RECAPTCHA KEY
//    define("DATA_SITEKEY", "6Ld15ykTAAAAAGfWbChjx3cdwwpW_VKznjtFAIz4"); 
//    define("DATA_SECRETKEY", "6Ld15ykTAAAAAC29A2V_TdgnclCHEiBLWFhMNhov"); 
?>
