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
	# * FILE: /conf/accountpermission.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION SECTION AMOUNT
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_SECTION", 25);

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION ID
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_SITECONTENT", 1);
	define("SITEMGR_PERMISSION_EMAILNOTIFICATIONS", 2);
	define("SITEMGR_PERMISSION_SETTINGS", 4);
	define("SITEMGR_PERMISSION_GOOGLESETTINGS", 8);
	define("SITEMGR_PERMISSION_LOCATIONS", 16);
	define("SITEMGR_PERMISSION_CATEGORIES", 32);
	define("SITEMGR_PERMISSION_ACCOUNTS", 64);
	define("SITEMGR_PERMISSION_PAYMENT", 128);
	define("SITEMGR_PERMISSION_IMPORTEXPORT", 256);
	define("SITEMGR_PERMISSION_ARTICLES", 512);
	define("SITEMGR_PERMISSION_BANNERS", 1024);
	define("SITEMGR_PERMISSION_CLASSIFIEDS", 2048);
	define("SITEMGR_PERMISSION_EVENTS", 4096);
	define("SITEMGR_PERMISSION_GALLERIES", 8192);
	define("SITEMGR_PERMISSION_LISTINGS", 16384);
	define("SITEMGR_PERMISSION_SEOCENTER", 32768);
	define("SITEMGR_PERMISSION_REPORTS", 65536);
	define("SITEMGR_PERMISSION_LANGUAGECENTER", 131072);
	define("SITEMGR_PERMISSION_BLOG", 262144);
	define("SITEMGR_PERMISSION_DOMAIN", 524288);
	define("SITEMGR_PERMISSION_PACKAGES", 1048576);
	define("SITEMGR_PERMISSION_PLUGINS", 2097152);
	define("SITEMGR_PERMISSION_MOBILE", 4194304);
	define("SITEMGR_PERMISSION_MAILAPP", 8388608);
	define("SITEMGR_PERMISSION_LEADS", 16777216);
    
    # ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION AREAS
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_AREAS", "MANAGEMENT,CONTENT,DATA,SEO");
    
	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION (ID,LABEL_SECTION,LABEL_SPAN,AREA,FOLDERS)
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_0", SITEMGR_PERMISSION_SITECONTENT.",".ucfirst(system_showText(LANG_SITEMGR_MENU_SITECONTENT)).",".(system_showText(LANG_SITEMGR_PERM_CONTENT_TIP)).",CONTENT,content");
	define("SITEMGR_PERMISSION_1", SITEMGR_PERMISSION_EMAILNOTIFICATIONS.",".ucfirst(system_showText(LANG_SITEMGR_MENU_EMAILNOTIF)).",,,emailnotifications");
	define("SITEMGR_PERMISSION_2", SITEMGR_PERMISSION_SETTINGS.",".ucfirst(system_showText(LANG_SITEMGR_MENU_SETTINGS)).",".(system_showText(LANG_SITEMGR_PERM_SETTINGS_TIP)).",MANAGEMENT,prefs,googleprefs,emailnotifications");
	define("SITEMGR_PERMISSION_3", SITEMGR_PERMISSION_GOOGLESETTINGS.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS)).",,,googleprefs");
	define("SITEMGR_PERMISSION_4", SITEMGR_PERMISSION_LOCATIONS.",".ucfirst(system_showText(LANG_SITEMGR_SEOCENTER_LABEL_LOCATIONS)).",".(system_showText(LANG_SITEMGR_PERM_LOCATION_TIP)).",DATA,locations");
	define("SITEMGR_PERMISSION_5", SITEMGR_PERMISSION_CATEGORIES.",".ucfirst(system_showText(LANG_SITEMGR_CATEGORIES)).",,,articlecategs,classifiedcategs,eventcategs,listingcategs");
	define("SITEMGR_PERMISSION_6", SITEMGR_PERMISSION_ACCOUNTS.",".ucfirst(system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_ACCOUNT_TIP)).",MANAGEMENT,account,smaccount");
	define("SITEMGR_PERMISSION_7", SITEMGR_PERMISSION_PAYMENT.",".ucfirst(system_showText(LANG_SITEMGR_REVENUECENTER)).",".(system_showText(LANG_SITEMGR_PERM_REVENUE_TIP)).",MANAGEMENT,transactions,invoices,custominvoices,discountcode");
	define("SITEMGR_PERMISSION_8", SITEMGR_PERMISSION_IMPORTEXPORT.",".ucfirst(system_showText(LANG_SITEMGR_DATA)).",".(system_showText(LANG_SITEMGR_PERM_DATA_TIP)).",DATA,import,export");
	define("SITEMGR_PERMISSION_9", SITEMGR_PERMISSION_ARTICLES.",".ucfirst(system_showText(LANG_SITEMGR_ARTICLE_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_ARTICLE_TIP)).",CONTENT,article,review");
	define("SITEMGR_PERMISSION_10", SITEMGR_PERMISSION_BANNERS.",".ucfirst(system_showText(LANG_SITEMGR_BANNER_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_BANNER_TIP)).",CONTENT,banner");
	define("SITEMGR_PERMISSION_11", SITEMGR_PERMISSION_CLASSIFIEDS.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED)).",".(system_showText(LANG_SITEMGR_PERM_CLASSIFIED_TIP)).",CONTENT,classified");
	define("SITEMGR_PERMISSION_12", SITEMGR_PERMISSION_EVENTS.",".ucfirst(system_showText(LANG_SITEMGR_EVENT_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_EVENT_TIP)).",CONTENT,event");
	define("SITEMGR_PERMISSION_13", SITEMGR_PERMISSION_GALLERIES.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_GALLERY)).",,,gallery");
	define("SITEMGR_PERMISSION_14", SITEMGR_PERMISSION_LISTINGS.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_LISTING)).",".(system_showText(LANG_SITEMGR_PERM_LISTING_TIP)).",CONTENT,listing,deal,claim,listingtemplate,review");
	define("SITEMGR_PERMISSION_15", SITEMGR_PERMISSION_SEOCENTER.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_SEOCENTER)).",".(system_showText(LANG_SITEMGR_PERM_SEO_TIP)).",SEO,seocenter");
	define("SITEMGR_PERMISSION_16", SITEMGR_PERMISSION_REPORTS.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_REPORTS)).",".(system_showText(LANG_SITEMGR_PERM_REPORTS_TIP)).",MANAGEMENT,reports");
	define("SITEMGR_PERMISSION_17", SITEMGR_PERMISSION_LANGUAGECENTER.",".ucfirst(system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER)).",".(system_showText(LANG_SITEMGR_PERM_LANGCENTER_TIP)).",MANAGEMENT,langcenter");
	define("SITEMGR_PERMISSION_18", SITEMGR_PERMISSION_BLOG.",".ucfirst(system_showText(LANG_SITEMGR_BLOG)).",".(system_showText(LANG_SITEMGR_PERM_BLOG_TIP)).",CONTENT,blog,blogcategs");
	define("SITEMGR_PERMISSION_19", SITEMGR_PERMISSION_DOMAIN.",".ucfirst(system_showText(LANG_SITEMGR_DOMAIN_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_DOMAIN_TIP)).",MANAGEMENT,domain");
	define("SITEMGR_PERMISSION_20", SITEMGR_PERMISSION_PACKAGES.",".ucfirst(system_showText(LANG_SITEMGR_PACKAGE_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_PACKAGE_TIP)).",MANAGEMENT,package");
	define("SITEMGR_PERMISSION_21", SITEMGR_PERMISSION_PLUGINS.",".ucfirst(system_showText(LANG_SITEMGR_PLUGINS)).",".(system_showText(LANG_SITEMGR_PERM_PLUGINS_TIP)).",DATA,plugins");
	define("SITEMGR_PERMISSION_22", SITEMGR_PERMISSION_MOBILE.",".ucfirst(system_showText(LANG_SITEMGR_MOBILE)).",".(system_showText(LANG_SITEMGR_PERM_MOBILE_TIP)).",MANAGEMENT,mobile");
	define("SITEMGR_PERMISSION_23", SITEMGR_PERMISSION_MAILAPP.",".ucfirst(system_showText(LANG_SITEMGR_MAILAPP)).",".(system_showText(LANG_SITEMGR_PERM_MAILAPP_TIP)).",DATA,".MAILAPP_FOLDER);
	define("SITEMGR_PERMISSION_24", SITEMGR_PERMISSION_LEADS.",".ucfirst(system_showText(LANG_LABEL_LEADS)).",".(system_showText(LANG_SITEMGR_PERM_LEADS_TIP)).",MANAGEMENT,leads");

?>