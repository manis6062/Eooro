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
    # * FILE: /theme/diningguide/layout/header.php
    # ----------------------------------------------------------------------------------------------------

    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", FALSE);
    header("Pragma: no-cache");
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

    //This function returns the variables to fill in the meta tags content below. Do not change this line.
    front_getHeaderTag($headertag_title, $headertag_author, $headertag_description, $headertag_keywords);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

    <head>

        <title><?=$headertag_title?></title>
        <meta name="author" content="<?=$headertag_author?>" />
        <meta name="description" content="<?=$headertag_description?>" />
<!--        <meta name="keywords" content="<? //=$headertag_keywords?>" />-->
        <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <? $metatagHead = true; include(INCLUDES_DIR."/code/smartbanner.php"); ?>

        <!-- This function returns the favicon tag. Do not change this line. -->
        <?=system_getFavicon();?>

        <!-- This function returns the search engine meta tags. Do not change this line. -->
        <?=front_searchMetaTag();?>
        
        <!-- This function returns the meta tags rel="next"/rel="prev" to improve SEO on results pages. Do not change this line. -->
        <?=front_paginationTags($array_pages_code, $aux_items_per_page, $hideResults, $blogHome);?>

        <meta name="ROBOTS" content="index, follow" />

        <!-- This function includes all css files. Do not change this line. -->
        <!-- To change any style, it's better to edit the stylesheet files. -->
        <? front_themeFiles(); ?>

        <!-- This function returns the Default Image style. Do not change this line. -->
        <?=system_getNoImageStyle($cssfile = true);?>

        <!-- This function reads and includes all js and css files (minimized). Do not change this line. -->
        <? script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter); ?>


         <!--[if lt IE 9]>
        <script src="<?=DEFAULT_URL."/scripts/front/html5shiv.js"?>"></script>
        <![endif]-->

                
    </head>

	<!--[if IE 7]><body class="ie ie7"><![endif]-->
	<!--[if lt IE 9]><body class="ie"><![endif]-->
    <!-- [if false]><body><![endif]-->
    
        <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleTagManager();?>
    
        <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
            include(EDIRECTORY_ROOT."/frontend/livebar.php");
        } ?>
    
        <!-- This function returns the code warning users to upgrade their browser if they are using Internet Explorer 6. Do not change this line.  -->
        <? front_includeFile("IE6alert.php", "layout", $js_fileLoader); ?>
        
        <div class="navbar navbar-static-top">
            
            <div class="header-brand container">
                
                <!-- The function "system_getHeaderLogo()" returns a inline style, like style="background-image: url(YOUR LOGO URL HERE)" -->
                <div class="brand-logo">
                    <a class="brand logo" id="logo-link" href="<?=NON_SECURE_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> <?=system_getHeaderLogo();?>>
                        <?=(trim(EDIRECTORY_TITLE) ? EDIRECTORY_TITLE : "&nbsp;")?>
                    </a>
                </div>
                
                <? 
                $addSearchCollapse = false;
                if (    string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR."/") === false && 
                        string_strpos($_SERVER['REQUEST_URI'], ALIAS_CONTACTUS_URL_DIVISOR.".php") === false && 
                        string_strpos($_SERVER['REQUEST_URI'], ALIAS_ADVERTISE_URL_DIVISOR.".php") === false && 
                        string_strpos($_SERVER['REQUEST_URI'], "/order_") === false && 
                        string_strpos($_SERVER['REQUEST_URI'], ALIAS_FAQ_URL_DIVISOR.".php") === false && !$hide_search) {
                    
                    $addSearchCollapse = true;
                    include(EDIRECTORY_ROOT."/searchfront.php");
                }
                ?>
            </div>
            
             <div class="navbar-inner">
                 
                <div class="container">
                    
                    <a class="hidden-desktop brand logo" href="<?=NON_SECURE_URL?>/" <?=system_getHeaderMobileLogo(true);?>>
                        <?=(trim(EDIRECTORY_TITLE) ? EDIRECTORY_TITLE : "&nbsp;")?>
                    </a>
                    
                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" onclick="collapseMenu('menu');">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    
                    <? if ($addSearchCollapse) { ?>
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".search-collapse" onclick="collapseMenu('search')">
                        <span class="icon-search"></span>
                    </a>
                    <? } ?>
                    
                    <div id="nav-collapse" class="nav-collapse collapse">
                        <? include(system_getFrontendPath("header_menu.php", "layout")); ?>
                    </div>
                    
                    <div id="search-collapse" class="search-collapse collapse">
                        <? if ($addSearchCollapse) {

                            $searchResponsive = true;
                            include(system_getFrontendPath("search.php"));
                            $searchResponsive = false;
                        } ?>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
        <div class="image-bg">
            <?=front_getBackground($customimage);?>
        </div>
        
        <div class="well container">
        
            <div class="container-fluid">
                
                <?
                //Breadcrumb
                front_addBreadcrumb();
                
                //Add newsletter only on home pages
                if ($addNewsletter) {
                    include(system_getFrontendPath("newsletter.php"));
                }
                
                //Don't show banners for advertise pages and maintenance page
                if (string_strpos($_SERVER["PHP_SELF"], "/order_") === false && string_strpos($_SERVER["REQUEST_URI"], ALIAS_ADVERTISE_URL_DIVISOR.".php") === false && string_strpos($_SERVER["PHP_SELF"], "/maintenancepage.php") === false) {
                    front_includeBanner($category_id, $banner_section);
                }
                
                //Load Slider only on the home page
                if ($loadSlider) {
                    front_includeFile("slider.php", "frontend", $js_fileLoader);
                }
                ?>