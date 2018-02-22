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
	# * FILE: /index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE URL TO OPEN
    # ----------------------------------------------------------------------------------------------------
    unset($aux_array_url, $alias_names);

    /**
     * Aux constants to alias for modules
     */
    $alias_names[LISTING_FEATURE_FOLDER]    = ALIAS_LISTING_MODULE;
    $alias_names[EVENT_FEATURE_FOLDER]      = ALIAS_EVENT_MODULE;
    $alias_names[ARTICLE_FEATURE_FOLDER]    = ALIAS_ARTICLE_MODULE;
    $alias_names[PROMOTION_FEATURE_FOLDER]  = ALIAS_PROMOTION_MODULE;
    $alias_names[CLASSIFIED_FEATURE_FOLDER] = ALIAS_CLASSIFIED_MODULE;
    $alias_names[BLOG_FEATURE_FOLDER]       = ALIAS_BLOG_MODULE;

    /**
     * Accept pages (home)
     */
    $acceptPages = unserialize(THEME_ACCEPT_PAGES);

    $activeMenuHome = false;

    /**
     * Getting URL to do correct include
     */
    $aux_array_url = explode("/", $_SERVER["REQUEST_URI"]);

    if (EDIRECTORY_FOLDER) {
        $auxFolder = explode("/", EDIRECTORY_FOLDER);
        $searchPos = count($auxFolder);
    } else {
        $searchPos = 1;
    }

    foreach ($acceptPages as $accPage) {
        if (string_strpos($aux_array_url[$searchPos], $accPage."?") !== false && $accPage) {
            $acceptPages[] = $aux_array_url[$searchPos];
        }
    }

    $module_key = array_search($aux_array_url[$searchPos], $alias_names);

    //Modules Pages
    if ($module_key) {

        define("ACTUAL_MODULE_FOLDER", $module_key);

        include(EDIRECTORY_ROOT."/full_modrewrite.php");

    //Front Pages (index, advertise, contact us, faq, sitemap, lead contact form)
    } else {

        if (array_search($aux_array_url[$searchPos], $acceptPages) === false) {
            front_errorPage();
        } else {

            //Advertise Page
            if (string_strpos($aux_array_url[$searchPos], ALIAS_ADVERTISE_URL_DIVISOR.".php") !== false) {
                $loadCache = true;
                $loadValidation = false;
                $sitecontentSection = "Advertise with Us";
                $theme_file = "";
                $controllerFile = EDIR_CONTROLER_FOLDER."/advertise.php";
                $coreFile = EDIRECTORY_ROOT."/".EDIR_CORE_FOLDER_NAME."/advertise.php";
                define("ACTUAL_PAGE_NAME", EDIRECTORY_FOLDER."/advertise.php");

            //Contact US Page
            } elseif (string_strpos($aux_array_url[$searchPos], ALIAS_CONTACTUS_URL_DIVISOR.".php") !== false) {
                $loadCache = false;
                $loadValidation = false;
                $sitecontentSection = "Contact Us";
                $theme_file = THEMEFILE_DIR."/".EDIR_THEME."/body/general.php";
                $controllerFile = EDIR_CONTROLER_FOLDER."/contactus.php";
                $coreFile = "";
                $generalPage = "contactus";
                define("ACTUAL_PAGE_NAME", EDIRECTORY_FOLDER."/contactus.php");

            //Best of Page
            } elseif (string_strpos($aux_array_url[$searchPos], ALIAS_BESTOF_URL_DIVISOR) !== false) {

                $loadCache = true;
                $loadValidation = false;
                $sitecontentSection = "Best Of";
                $theme_file = THEMEFILE_DIR."/".EDIR_THEME."/body/general.php";
                $controllerFile = EDIR_CONTROLER_FOLDER."/".LISTING_FEATURE_FOLDER."/results_bestof.php";
                $coreFile = "";
                $generalPage = "bestof";
                $activeMenuBestof = true;
                define("ACTUAL_PAGE_NAME", EDIRECTORY_FOLDER."/bestof");

                /**
                 * Search by rss on url
                 */
                for ($i = 0; $i < count($aux_array_url); $i++) {
                    if ($aux_array_url[$i] == "rss") {
                        include(EDIR_CONTROLER_FOLDER."/".LISTING_FEATURE_FOLDER."/rss_bestof.php");
                        exit;
                    }
                }

            //FAQ Page
            } elseif (string_strpos($aux_array_url[$searchPos], ALIAS_FAQ_URL_DIVISOR.".php") !== false) {
                $loadCache = true;
                $loadValidation = true;
                $sitecontentSection = "";
                $theme_file = THEMEFILE_DIR."/".EDIR_THEME."/body/faq.php";
                $controllerFile = EDIRECTORY_ROOT."/includes/code/faq.php";
                $coreFile = "";
                $generalPage = "faq";
                define("ACTUAL_PAGE_NAME", EDIRECTORY_FOLDER."/faq.php");

            //Sitemap Page
            } elseif (string_strpos($aux_array_url[$searchPos], ALIAS_SITEMAP_URL_DIVISOR.".php") !== false) {
                $loadCache = true;
                $loadValidation = false;
                $sitecontentSection = "Sitemap";
                $theme_file = THEMEFILE_DIR."/".EDIR_THEME."/body/sitemap.php";
                $controllerFile = "";
                $coreFile = "";
                $generalPage = "sitemap";
                define("ACTUAL_PAGE_NAME", EDIRECTORY_FOLDER."/sitemap.php");

            //Lead Contact Form
            } elseif (string_strpos($aux_array_url[$searchPos], ALIAS_LEAD_URL_DIVISOR.".php") !== false) {
                $loadCache = false;
                $loadValidation = false;
                $sitecontentSection = "Leads Form";
                $theme_file = THEMEFILE_DIR."/".EDIR_THEME."/body/general.php";
                $controllerFile = "";
                $coreFile = "";
                $generalPage = "lead";
                define("ACTUAL_PAGE_NAME", EDIRECTORY_FOLDER."/lead.php");

            //Home Page
            } else {
                $loadCache = true;
                $loadValidation = false;
                $sitecontentSection = "Home Page";
                $theme_file = THEMEFILE_DIR."/".EDIR_THEME."/body/index.php";
                $loadSlider = true;
                $addNewsletter = true;
                $activeMenuHome = true;
            }

            define("ACTUAL_MODULE_FOLDER", "");

            # ----------------------------------------------------------------------------------------------------
            # CACHE
            # ----------------------------------------------------------------------------------------------------
            if ($loadCache) {
                cachefull_header();
            }

            # ----------------------------------------------------------------------------------------------------
            # MAINTENANCE MODE
            # ----------------------------------------------------------------------------------------------------
            verify_maintenanceMode();

            # ----------------------------------------------------------------------------------------------------
            # SESSION
            # ----------------------------------------------------------------------------------------------------
            sess_validateSessionFront();

            # ----------------------------------------------------------------------------------------------------
            # VALIDATION
            # ----------------------------------------------------------------------------------------------------
            if ($loadValidation) {
                include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
            } else {
                include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
            }

            # ----------------------------------------------------------------------------------------------------
            # CODE
            # ----------------------------------------------------------------------------------------------------
            if ($controllerFile && file_exists($controllerFile)) {
                include($controllerFile);
            }

            # ----------------------------------------------------------------------------------------------------
            # SITE CONTENT
            # ----------------------------------------------------------------------------------------------------
            if ($sitecontentSection) {
                $array_HeaderContent = front_getSiteContent($sitecontentSection);
                extract($array_HeaderContent);
            }

            # ----------------------------------------------------------------------------------------------------
            # HEADER
            # ----------------------------------------------------------------------------------------------------
            $headertag_title = $headertagtitle;
            $headertag_description = $headertagdescription;
            $headertag_keywords = $headertagkeywords;
            include(system_getFrontendPath("header.php", "layout"));

            # ----------------------------------------------------------------------------------------------------
            # AUX
            # ----------------------------------------------------------------------------------------------------
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

            # ----------------------------------------------------------------------------------------------------
            # BODY
            # ----------------------------------------------------------------------------------------------------
            if ($theme_file && file_exists($theme_file)) {
                include($theme_file);
            }
            if ($coreFile && file_exists($coreFile)) {
                include($coreFile);
            }

            # ----------------------------------------------------------------------------------------------------
            # FOOTER
            # ----------------------------------------------------------------------------------------------------
            include(system_getFrontendPath("footer.php", "layout"));

            # ----------------------------------------------------------------------------------------------------
            # CACHE
            # ----------------------------------------------------------------------------------------------------
            if ($loadCache) {
                cachefull_footer();
            }

        }
    }

?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56db05ca7cf97e314f2c57f6/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
