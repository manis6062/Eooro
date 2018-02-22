<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# edirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- edirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /theme/contractors/contractors.php
	# ----------------------------------------------------------------------------------------------------

    setting_get("scheme_custom", $scheme_custom);

    if (!$loadMembersCss) { ?>
    <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/bootstrap.css<?=($isPopup ? "?v=2" : "" )?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=system_getStylePath("bootstrap.css".($isPopup ? "?v=2" : "" ), EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/bootstrap-responsive.css<?=($isPopup ? "?v=2" : "" )?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>
    
    <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/structure.css<?=($isPopup ? "?v=2" : "" )?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=system_getStylePath("structure.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <!--[if lt IE 8]><link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->

    <? if (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) { ?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.css" type="text/css" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], "/".MEMBERS_ALIAS) !== false) && 
        ((string_strpos($_SERVER['PHP_SELF'], "preview.php") === false) || 
        (string_strpos($_SERVER['PHP_SELF'], "invoice.php") === false)) || 
        $loadMembersCss) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/add.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/edit.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], "popup.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "delete_image.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/popup.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("popup.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (((LOAD_MODULE_CSS_HOME == "on") || 
        (
            (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "")) !== false) || 
            (string_strpos($_SERVER['REQUEST_URI'], ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "")) !== false) || 
            (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "")) !== false) || 
            (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "")) !== false) || 
            (string_strpos($_SERVER['REQUEST_URI'], ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "")) !== false) || 
            (string_strpos($_SERVER['REQUEST_URI'], ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "")) !== false)
        ) ||
        (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ALLLOCATIONS_URL_DIVISOR.".php") !== false)) && (ACTUAL_MODULE_FOLDER != BLOG_FEATURE_FOLDER)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/front.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("front.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER || 
        string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/preview.php") !== false) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/blog.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("blog.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], "order_listing.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_event.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_classified.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_article.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_banner.php") !== false) || 
        (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CLAIM_URL_DIVISOR."/") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], MEMBERS_ALIAS."/claim/") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/order.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("order.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (((string_strpos($_SERVER['PHP_SELF'], "favorites") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], "results.php") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CATEGORY_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LOCATION_URL_DIVISOR."/") !== false) ||
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ARCHIVE_URL_DIVISOR."/") !== false) ||
         (string_strpos($_SERVER['PHP_SELF'], "quicklists.php") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_REVIEW_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CHECKIN_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CLAIM_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/index.php") !== false))) { 
        ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/results.css<?=($isPopup ? "?v=2" : "" )?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("results.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((defined("ACTUAL_MODULE_FOLDER") && ACTUAL_MODULE_FOLDER != "")) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/detail.css<?=($isPopup ? "?v=2" : "" )?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("detail.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>
        
    <? if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ADVERTISE_URL_DIVISOR.".php") !== false) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/advertise.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("advertise.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (((string_strpos($_SERVER['PHP_SELF'], "popup.php") !== false && $_GET["pop_type"] == "advertise_preview") || 
        string_strpos($_SERVER['PHP_SELF'], "preview.php"))) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/results.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("results.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />

        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/detail.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("detail.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
        
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/advertise.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("advertise.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/index.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/edit.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/add.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "account/quicklists.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "account/deals.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "account/reviews.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/profile.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("profile.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ($aux_modal_box != "profileLogin") { ?>
    <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/content_custom.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=system_getStylePath("content_custom.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>
    
    <?=system_backgroundImageStyle("get");?>
  
    <?=($scheme_custom == "on" && !DEMO_LIVE_MODE ? colorscheme_generateDynamicCSS() : "")?>