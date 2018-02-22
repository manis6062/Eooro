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
	# * FILE: /theme/realestate/realestate.php
	# ----------------------------------------------------------------------------------------------------

?>

    <style type="text/css">
		@font-face {
			font-family:Futura;
			font-style:normal;
			font-weight:normal;
			src: url('<?=THEMEFILE_URL?>/realestate/fonts/futura.eot');
    		src: url('<?=THEMEFILE_URL?>/realestate/fonts/futura.eot?#iefix') format('embedded-opentype'),
         	url('<?=THEMEFILE_URL?>/realestate/fonts/futura.ttf') format('truetype');
		}
    </style>

    <link href="<?=THEMEFILE_URL;?>/realestate/structure.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=system_getStylePath("structure.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />

    <? if (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) { ?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.css" type="text/css" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], "/".MEMBERS_ALIAS) !== false) && 
        ((string_strpos($_SERVER['PHP_SELF'], "preview.php") === false) || 
        (string_strpos($_SERVER['PHP_SELF'], "invoice.php") === false)) || 
        $loadMembersCss) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/add.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/edit.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], "popup.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "delete_image.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/popup.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("popup.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
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
        <link href="<?=THEMEFILE_URL;?>/realestate/front.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("front.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER || 
        string_strpos($_SERVER['PHP_SELF'], "/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/preview.php") !== false) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/blog.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("blog.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], "order_listing.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_event.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_classified.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_article.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "order_banner.php") !== false) || 
        (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CLAIM_URL_DIVISOR."/") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], MEMBERS_ALIAS."/claim/") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/order.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("order.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (((string_strpos($_SERVER['PHP_SELF'], "favorites") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], "results.php") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CATEGORY_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LOCATION_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['PHP_SELF'], "quicklists.php") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_REVIEW_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CHECKIN_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CLAIM_URL_DIVISOR."/") !== false) || 
         (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/index.php") !== false)) && 
        (ACTUAL_MODULE_FOLDER != BLOG_FEATURE_FOLDER)) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/results.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("results.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ((defined("ACTUAL_MODULE_FOLDER") && ACTUAL_MODULE_FOLDER != "") &&
        (ACTUAL_MODULE_FOLDER != BLOG_FEATURE_FOLDER)) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/detail.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("detail.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=THEMEFILE_URL?>/realestate/jquery.ad-gallery.css"/>
    <? } ?>

    <? if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ADVERTISE_URL_DIVISOR.".php") !== false) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/advertise.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("advertise.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if (((string_strpos($_SERVER['PHP_SELF'], "popup.php") !== false && $_GET["pop_type"] == "advertise_preview") || 
        string_strpos($_SERVER['PHP_SELF'], "preview.php")) && 
        ((ACTUAL_MODULE_FOLDER != BLOG_FEATURE_FOLDER))) { ?>
         <link href="<?=THEMEFILE_URL;?>/realestate/advertise.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("advertise.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />

        <link href="<?=THEMEFILE_URL;?>/realestate/results.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("results.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />

        <link href="<?=THEMEFILE_URL;?>/realestate/detail.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("detail.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />

        <link rel="stylesheet" type="text/css" href="<?=THEMEFILE_URL?>/realestate/jquery.ad-gallery.css"/>
    <? } ?>

    <? if ((string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/index.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/edit.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/add.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "account/quicklists.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "account/reviews.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/realestate/profile.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("profile.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

    <? if ($aux_modal_box != "profileLogin") { ?>
        
    <link href="<?=THEMEFILE_URL;?>/realestate/content_custom.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=system_getStylePath("content_custom.css", "realestate");?>" rel="stylesheet" type="text/css" media="all" />

    <link href="<?=THEMEFILE_URL;?>/realestate/print.css" rel="stylesheet" type="text/css" media="print" />
    
    <? } ?>