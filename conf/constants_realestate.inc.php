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
	# * FILE: /conf/constants_realestate.inc.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# IMAGE PARAMETERS (keep the ratio)
	# ----------------------------------------------------------------------------------------------------

	# LISTING
    define("IMAGE_LISTING_FULL_WIDTH",          650);
    define("IMAGE_LISTING_FULL_HEIGHT",         367);
    define("IMAGE_LISTING_THUMB_WIDTH",         320);
    define("IMAGE_LISTING_THUMB_HEIGHT",        181);
    define("IMAGE_FEATURED_LISTING_WIDTH",      217);
    define("IMAGE_FEATURED_LISTING_HEIGHT",     123);
    # PROMOTION
    define("IMAGE_PROMOTION_FULL_WIDTH",        650);
    define("IMAGE_PROMOTION_FULL_HEIGHT",       367);
    define("IMAGE_PROMOTION_THUMB_WIDTH",       244);
    define("IMAGE_PROMOTION_THUMB_HEIGHT",      138);
    define("IMAGE_PROMOTION_THUMB_BIG_WIDTH",   263);
    define("IMAGE_PROMOTION_THUMB_BIG_HEIGHT",  148);
    define("IMAGE_FEATURED_PROMOTION_WIDTH",    660);
    define("IMAGE_FEATURED_PROMOTION_HEIGHT",   387);
    # EVENT
    define("IMAGE_EVENT_FULL_WIDTH",            650);
    define("IMAGE_EVENT_FULL_HEIGHT",           367);
    define("IMAGE_EVENT_THUMB_WIDTH",           300);
    define("IMAGE_EVENT_THUMB_HEIGHT",          170);
    define("IMAGE_FEATURED_EVENT_WIDTH",        244);
    define("IMAGE_FEATURED_EVENT_HEIGHT",       138);
    # CLASSIFIED
    define("IMAGE_CLASSIFIED_FULL_WIDTH",       650);
    define("IMAGE_CLASSIFIED_FULL_HEIGHT",      367);
    define("IMAGE_CLASSIFIED_THUMB_WIDTH",      300);
    define("IMAGE_CLASSIFIED_THUMB_HEIGHT",     170);
    define("IMAGE_FEATURED_CLASSIFIED_WIDTH",   217);
    define("IMAGE_FEATURED_CLASSIFIED_HEIGHT",  123);
    # ARTICLE
    define("IMAGE_ARTICLE_FULL_WIDTH",          650);
    define("IMAGE_ARTICLE_FULL_HEIGHT",         367);
    define("IMAGE_ARTICLE_THUMB_WIDTH",         300);
    define("IMAGE_ARTICLE_THUMB_HEIGHT",        170);
    define("IMAGE_FEATURED_ARTICLE_WIDTH",      244);
    define("IMAGE_FEATURED_ARTICLE_HEIGHT",     138);
    # BLOG
    define("IMAGE_BLOG_FULL_WIDTH",             650);
    define("IMAGE_BLOG_FULL_HEIGHT",            367);
    define("IMAGE_BLOG_THUMB_WIDTH_FULL",       318);
    define("IMAGE_BLOG_THUMB_HEIGHT_FULL",      179);
    define("IMAGE_BLOG_THUMB_WIDTH",            152);
    define("IMAGE_BLOG_THUMB_HEIGHT",           86);
    # FRONT PAGE
    define("IMAGE_FRONT_LISTING_WIDTH",         244);
    define("IMAGE_FRONT_LISTING_HEIGHT",        138);
    define("IMAGE_FRONT_LISTING_SPECIAL_WIDTH", 487);
    define("IMAGE_FRONT_LISTING_SPECIAL_HEIGHT",274);
    define("IMAGE_FRONT_PROMOTION_WIDTH",       300);
    define("IMAGE_FRONT_PROMOTION_HEIGHT",      170);
    define("IMAGE_FRONT_EVENT_WIDTH",           217);
    define("IMAGE_FRONT_EVENT_HEIGHT",          123);
    define("IMAGE_FRONT_CLASSIFIED_WIDTH",      217);
    define("IMAGE_FRONT_CLASSIFIED_HEIGHT",     123);
    define("IMAGE_FRONT_ARTICLE_WIDTH",         217);
    define("IMAGE_FRONT_ARTICLE_HEIGHT",        123);
    # DESIGNATION
    define("IMAGE_DESIGNATION_WIDTH",           109);
    define("IMAGE_DESIGNATION_HEIGHT",          23);
    # INVOICE
    define("IMAGE_INVOICE_LOGO_WIDTH",          180);
    define("IMAGE_INVOICE_LOGO_HEIGHT",         70);
    # GALLERY
    define("IMAGE_GALLERY_THUMB_WIDTH",         130);
    define("IMAGE_GALLERY_THUMB_HEIGHT",        74);
    # HEADER
    define("IMAGE_HEADER_WIDTH",                400);
    define("IMAGE_HEADER_HEIGHT",               60);
    # HEADER RESPONSIVE
    define("MOBILE_LOGO_WIDTH",                 50); //header
	define("MOBILE_LOGO_HEIGHT",                50); //header
    # SIDEBAR
    define("SIDEBAR_FEATURED_WIDTH",            73);
    define("SIDEBAR_FEATURED_HEIGHT",           41);
    # PROFILE
    define("PROFILE_IMAGE_WIDTH",               86); //front pages
    define("PROFILE_IMAGE_HEIGHT",              86); //front pages
    define("PROFILE_MEMBERS_IMAGE_WIDTH",       90); //sponsors/profile pages
    define("PROFILE_MEMBERS_IMAGE_HEIGHT",      90); //sponsors/profile pages
    # PACKAGE
    define("IMAGE_PACKAGE_FULL_WIDTH",          260);
    define("IMAGE_PACKAGE_FULL_HEIGHT",         260);
    define("IMAGE_PACKAGE_THUMB_WIDTH",         200);
    define("IMAGE_PACKAGE_THUMB_HEIGHT",        150);
    # SLIDER
    define("IMAGE_SLIDER_WIDTH",                1080);
    define("IMAGE_SLIDER_HEIGHT",               611);
    
    # ----------------------------------------------------------------------------------------------------
	# FANCYBOX SIZES
	# ----------------------------------------------------------------------------------------------------

    # Upload image
    define("FANCYBOX_UPIMAGE_WIDTH",          785);
    define("FANCYBOX_UPIMAGE_HEIGHT",         465);
       
    # Modules preview (sponsors/sitemgr)
    define("FANCYBOX_ITEM_PREVIEW_WIDTH",     1110);
    define("FANCYBOX_ITEM_PREVIEW_HEIGHT",    440);
    
    # Modules preview (advertise)
    define("FANCYBOX_FRONT_PREVIEW_WIDTH",    1080);
    define("FANCYBOX_FRONT_PREVIEW_HEIGHT",   440);
        
    # Login box
    define("FANCYBOX_LOGIN_WIDTH",            250);
    define("FANCYBOX_LOGIN_HEIGHT",           342);
    
    # ----------------------------------------------------------------------------------------------------
	# VIDEO SIZE
	# ----------------------------------------------------------------------------------------------------
    define("DETAIL_VIDEO_WIDTH", "650");
    define("DETAIL_VIDEO_HEIGHT", "367");
    
    # ----------------------------------------------------------------------------------------------------
	# GOOGLE ADDS SIZE
	# ----------------------------------------------------------------------------------------------------
    define("GOOGLE_ADS_WIDTH", "200");
    define("GOOGLE_ADS_HEIGHT", "200");
    
    # ----------------------------------------------------------------------------------------------------
	# CATEGORY CONSTANTS
	# ----------------------------------------------------------------------------------------------------

    //Levels per category (all modules except for listings)
    define("CATEGORY_LEVEL_AMOUNT",             5); // Limited to 5
	//Levels per category (listings)
    define("LISTING_CATEGORY_LEVEL_AMOUNT",     5); // Unlimited
    
    # ----------------------------------------------------------------------------------------------------
	# LISTING SPECIAL FIELDS
	# ----------------------------------------------------------------------------------------------------
    
    define("THEME_LISTING_VIDEO_DESC", false);
    define("THEME_LISTING_PRICE", false);
    define("THEME_LISTING_FBPAGE", false);
    define("THEME_LISTING_FEATURES", false);
    define("THEME_LISTING_MENU", false);
    
    # ----------------------------------------------------------------------------------------------------
	# GENERAL SETTINGS
	# ----------------------------------------------------------------------------------------------------
       
    # FACEBOOK COMMENTS WIDTH (BLOG DETAIL)
    define("FB_COMMENTWIDTH_BLOG", 670);
    
    # FACEBOOK COMMENTS WIDTH (LISTING/ARTICLE DETAIL)
    define("FB_COMMENTWIDTH", 285);
    
    # ADD CLEAR BOTH ON FEATURED ITEMS AND RESULTS
    define("ITEM_RESULTS_CLEAR", true);
    
    # SLIDER FEATURE
    define("THEME_SLIDER_FEATURE", "on");
        
    # USE BOOTSTRAP CAROULSEL FOR SLIDER
    define("SLIDER_USE_CAROUSEL", false);
    
    # SLIDER - SUMMARY INFO MAX CHARS
    define("SLIDER_MAX_CHARS", 100);
    
    # GALLERY DETAIL - MAX IMAGES
    define("GALLERY_DETAIL_IMAGES", 4);
    
    # FEATURED LISTING - MAX ITEMS
    define("FEATURED_LISTING_MAXITEMS", 6);

    # FEATURED LISTING - SPECIAL ITEMS
    define("FEATURED_LISTING_MAXITEMS_SPECIAL", 6);
	
	# FEATURED LISTING WITH DEAL - MAX ITEMS (listing home page - theme Default)
    define("FEATURED_LISTING_DEAL_MAXITEMS", 4);

    # FEATURED LISTING WITH DEAL - SPECIAL ITEMS (listing home page - theme Default)
    define("FEATURED_LISTING_DEAL_MAXITEMS_SPECIAL", 1);
    
    # FEATURED EVENT - MAX ITEMS
    define("FEATURED_EVENT_MAXITEMS", 6);
    
    # FEATURED EVENT - SPECIAL ITEMS
    define("FEATURED_EVENT_MAXITEMS_SPECIAL", 6);
    
    # FEATURED CLASSIFIED - MAX ITEMS
    define("FEATURED_CLASSIFIED_MAXITEMS", 6);

    # FEATURED CLASSIFIED - SPECIAL ITEMS
    define("FEATURED_CLASSIFIED_MAXITEMS_SPECIAL", 6);
    
    # FEATURED ARTICLE - MAX ITEMS
    define("FEATURED_ARTICLE_MAXITEMS", 9);
    
    # FEATURED ARTICLE - SPECIAL ITEMS
    define("FEATURED_ARTICLE_MAXITEMS_SPECIAL", 3);
    
    # FEATURED PROMOTION - MAX ITEMS
    define("FEATURED_PROMOTION_MAXITEMS", 8);

    # FEATURED PROMOTION - SPECIAL ITEMS
    define("FEATURED_PROMOTION_MAXITEMS_SPECIAL", 2);
    
    # FOOTER CONFIGURATION
    define("THEME_HAS_FOOTER", false);
       
    # SLIDER WITH PRICE
    define("SLIDER_HAS_PRICE", true);
           
    # Detail sidebar - extra fields
    define("EXTRA_FIELDS_SIDEBAR", true);
       
    # Order by dropdown - Add "Order by Price" 
    define("LISTING_ORDERBY_PRICE", true);
       
    # NEW STYLE FOR DEAL INDEX
    define("THEME_FEATURED_DEAL_BIG", true);
       
    # SLIDER AVAILABLE FOR SLIDER
	define("TOTAL_SLIDER_ITEMS", 5);
    
    # FEATURED CATEGORY
    define("FEATURED_CATEGORY", "on");
    
    # EMAIL TO FRIEND
    define("THEME_EMAIL_TOFRIEND", true);
    
    # EMAIL TO FRIEND
    define("THEME_DETAIL_PRINT", true);
    
    # SHARE LINK
    define("THEME_SHARE_ITEMS", true);
    
    # FAVORITES LINK
    define("THEME_FAVORITES_ICON", false);
    
    # REMOVE FROM FAVORITES - CUSTOM BUTTON
    define("THEME_FAVORITES_BUTTON", false);
    
    # CONTACT US INFORMATION
    define("THEME_CONTACTUS_FIELDS", false);
    
    # HOME PAGE SPECIAL FIELDS
    define("THEME_HOMEPAGE_FIELDS", false);
    
    # IMAGE FOR CATEGORIES
    define("THEME_CATEGORY_IMAGE", false);
    
    # DESCRIPTION FOR CATEGORIES
    define("THEME_CATEGORY_DESCRIPTION", false);
    
    # SHOW BROWSE BY CATEGORY ON SIDEBAR
    define("THEME_CATEGORIES_SIDEBAR", false);
    
    # MAX CATEGORY PER PAGE
    define("MAX_CATEGORY_PER_PAGE", 10);
    
    # ADVANCED SEARCH FOR HOME PAGE
    define("THEME_ADVSEARCH_HOME", false);
    
    # ADVANCED SEARCH - CATEGORIES WITH RADIO BUTTON
    define("THEME_ADVSEARCH_CATEGRADIO", false);
    
    # ADD BOOTSTRAP JAVASCRIPT LIBRARY
    define("THEME_USE_BOOTSTRAP", false);
    
    # FORCE IMAGES RESIZE
    define("THEME_RESIZE_IMAGE", true);
    
    # ADD LIKE/DISLIKE button to reviews
    define("THEME_LIKES_REVIEW", false);
    
    # ADD LISTING INFORMATION ON DEAL SUMMARY
    define("THEME_LISTINGINFO_DEAL", false);
    
    # ADD REVIEWS ON DEAL DETAIL SIDEBAR
    define("THEME_REVIEWS_PROMOTION_SIDEBAR", true);
    
    # BUILD DEAL COUNTDOWN USING CUSTOM LAYOUT
    define("THEME_COUNTDOWN_CUSTOM", false);
    
    # SHOW ONLY ITEM TITLE, MAP LINK AND REVIEW STARS ON GOOGLE MAPS
    define("THEME_MAPS_NEWBALLOON_STYLE", false);
    
    # ADD GOOGLE MAPS TO DEAL DETAIL
    define("THEME_DEAL_DETAIL_MAP", false);
    
    # USE "IMAGE_ID" IN ALL FRONTEND PAGES
    define("THEME_USE_IMAGE_BIG", false);
    
    # SHOW ALL DEAL INFORMATION ON LISTING DETAIL
    define("THEME_LISTING_FULL_DEAL", false);
    
    # BUILD BLOG ARCHIVE USING ACCORDION PLUGIN
    define("THEME_BLOGARCHIVE_ACCORDION", false);
    
    # ADD BANNER TO ADVERTISE PAGE
    define("THEME_ADVERTISE_BANNER", true);
    
    # USE .php TO ALL CATEGORIES LINK
    define("USE_DOT_PHP_ON_ALLCATEGORIES_LINK", "on");
           
    # LOAD USER NAVBAR ON HEADER (FOR NAVIGATION CONFIGURATION)
    define("THEME_ADD_USERNAV_HEADER", false);
    
    # BREADCRUMB SEPARATOR
    define("THEME_BREADCRUMB_SEP", "/");
        
    # SEARCH BY CATEGORY
    define("THEME_SEARCH_CATEGORY_PAGE", false);
    
    # DISABLE MOBILE VERSION AND USE RESPONSIVE LAYOUT
    define("RESPONSIVE_THEME", false);
    
    # DISABLE LISTING HOME PAGE
    define("THEME_DISABLE_HOMELISTING", false);
    
    # PAGINATION - PREV/NEXT LINKS USING LABEL OR ">>"
    define("THEME_PAGINATION_USELABEL", true);
    
    # ENABLE GENERAL RESULTS PAGE (root/results.php)
    define("THEME_GENERAL_RESULTS", true);
    
    # ADD CUSTOM MARKERS TO GOOGLE MAPS
    define("THEME_GMAPS_CUSTOM_MARKER", true);
    
    # NEW FANCYBOX STYLE - FLAT DESIGN
    define("THEME_FLAT_FANCYBOX", false);
    
    # ARTICLE INFORMATION - SPLIT INFO
    define("THEME_ARTICLE_SPLIT_COMPINFO", false);
    
    # ENABLE EXTRA LAYOUTS FOR LISTING TYPE FEATURE
    define("THEME_LISTINGTEMPLATE_LAYOUTS", false);
    
    # USE FANCYBOX GALLERY PLUGIN
    define("THEME_GALLERY_FANCYBOX", false);
    
    # MAX REVIEWS ON DETAIL PAGE
    define("THEME_MAX_REVIEWS", 10);
    
    # ENQUIRE PAGE
    define("THEME_ENQUIRE_PAGE", true);
    
    # FILTER BY LETTER
    define("THEME_FILTER_LETTER", true);
    
    # MODULES CONFIGURATION
    define("CUSTOM_LISTINGTEMPLATE_FEATURE", "on");
    
    # TWITTER WIDGET SIZE
    define("TWITTER_WIDGET_WIDTH", "283");
    define("TWITTER_WIDGET_HEIGHT", "400");
    define("TWITTER_WIDGET_COLOR", "0072BC");
            
    /**
     * Accept Pages by theme
     */
    unset($acceptPages);
    $acceptPages[] = "index.php";
    $acceptPages[] = ALIAS_ADVERTISE_URL_DIVISOR.".php";
    $acceptPages[] = ALIAS_CONTACTUS_URL_DIVISOR.".php";
    $acceptPages[] = ALIAS_SITEMAP_URL_DIVISOR.".php";
    $acceptPages[] = ALIAS_FAQ_URL_DIVISOR.".php";
    $acceptPages[] = ALIAS_LEAD_URL_DIVISOR.".php";
    $acceptPages[] = "";
    define("THEME_ACCEPT_PAGES", serialize($acceptPages));
    
    /*
     * Navigation configuration
     */
    unset($array_navigation);
    $array_navigation["header"][] = array("name" => LANG_MENU_HOME, "url" => "NON_SECURE_URL");

    $array_navigation["header"][] = array("name" => LANG_MENU_LISTING, "url" => "LISTING_DEFAULT_URL");
    $array_navigation["footer"][] = array("name" => LANG_MENU_LISTING, "url" => "LISTING_DEFAULT_URL");

    $array_navigation["header"][] = array("name" => LANG_MENU_EVENT, "url" => "EVENT_DEFAULT_URL", "module" => "EVENT_FEATURE");
    $array_navigation["footer"][] = array("name" => LANG_MENU_EVENT, "url" => "EVENT_DEFAULT_URL", "module" => "EVENT_FEATURE");

    $array_navigation["header"][] = array("name" => LANG_MENU_CLASSIFIED, "url" => "CLASSIFIED_DEFAULT_URL", "module" => "CLASSIFIED_FEATURE");
    $array_navigation["footer"][] = array("name" => LANG_MENU_CLASSIFIED, "url" => "CLASSIFIED_DEFAULT_URL", "module" => "CLASSIFIED_FEATURE");

    $array_navigation["header"][] = array("name" => LANG_MENU_ARTICLE, "url" => "ARTICLE_DEFAULT_URL", "module" => "ARTICLE_FEATURE");
    $array_navigation["footer"][] = array("name" => LANG_MENU_ARTICLE, "url" => "ARTICLE_DEFAULT_URL", "module" => "ARTICLE_FEATURE");

    $array_navigation["header"][] = array("name" => LANG_MENU_PROMOTION, "url" => "PROMOTION_DEFAULT_URL", "module" => "PROMOTION_FEATURE");
    $array_navigation["footer"][] = array("name" => LANG_MENU_PROMOTION, "url" => "PROMOTION_DEFAULT_URL", "module" => "PROMOTION_FEATURE");

    $array_navigation["header"][] = array("name" => LANG_MENU_BLOG, "url" => "BLOG_DEFAULT_URL", "module" => "BLOG_FEATURE");
    $array_navigation["footer"][] = array("name" => LANG_MENU_BLOG, "url" => "BLOG_DEFAULT_URL", "module" => "BLOG_FEATURE");

    $array_navigation["header"][] = array("name" => LANG_MENU_ADVERTISE, "url" => "ALIAS_ADVERTISE_URL_DIVISOR");
    $array_navigation["header"][] = array("name" => LANG_MENU_CONTACT, "url" => "ALIAS_CONTACTUS_URL_DIVISOR");
    
    $array_navigation["header"][] = array("name" => LANG_MENU_ENQUIRE, "url" => "ALIAS_LEAD_URL_DIVISOR");
    $array_navigation["footer"][] = array("name" => LANG_MENU_ENQUIRE, "url" => "ALIAS_LEAD_URL_DIVISOR");
    
    define("THEME_NAVIGATION_MENU", serialize($array_navigation));
    
    /*
    * Site Content Configuration
    */
    
    //content not available according to column "type"
    $arrayBlockedContent = array(
        'Best Of',
        'Leads Form'
    );
    
    define("SITECONTENT_BLOCKED", serialize($arrayBlockedContent));
    unset($arrayBlockedContent);
    
    //content available only for SEO purposes
    $arraySEOContent = array();
    
    define("SITECONTENT_FORSEO", serialize($arraySEOContent));
    unset($arraySEOContent);
    
?>