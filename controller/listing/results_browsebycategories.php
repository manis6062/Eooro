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
	# * FILE: /controller/listing/results_browsebycategories.php
	# ----------------------------------------------------------------------------------------------------
   
    /**
     * Preparing to get category_id
     */
    $_GET["url_full"] = $_SERVER["REQUEST_URI"];
    
    if ($_GET["url_full"] && (string_strpos($_GET["url_full"], ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR) !== false )) {

        $url = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_LISTING_MODULE."/".ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR, "", $_GET["url_full"]);

        $parts = explode("/", $url);
        
        /**
         * Get page or letter
         */
        for ($i =0; $i < count($parts); $i++) {
            switch ($parts[$i]) {
                case 'page': $_GET["page"] = $parts[$i + 1];
                    break;
                case 'letter': $_GET["letter"] = $parts[$i + 1];
                    break;
            }
        }
        
        /**
         * Preparing to get URL to search category
         */
        if ($_GET["page"]) {
            $url = string_replace_once("/page/".$_GET["page"], "", $url);
        }
        if ($_GET["letter"]) {
            $url = string_replace_once("/letter/".$_GET["letter"], "", $url);
        }
        
        if ($url) {
            $category_id = ListingCategory::getObjectByFullFriendlyURL($url);
        }
    }
    
    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
    include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    
    unset($searchReturn);
    $searchReturn["from_tables"] = "ListingCategory";
    $searchReturn["order_by"] = "title";
    $searchReturn["where_clause"] = "category_id = ".($category_id ? $category_id : "0")." AND title <> '' AND friendly_url <> '' AND enabled = 'y'";
    $searchReturn["select_columns"] = "id, title, friendly_url, active_listing, summary_description, image_id";
    
    $aux_items_per_page = ($_COOKIE["listingcategory_results_per_page"] ? $_COOKIE["listingcategory_results_per_page"] : 10);
    $pageObj = new pageBrowsing($searchReturn["from_tables"], $page, $aux_items_per_page, $searchReturn["order_by"], "ListingCategory.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "ListingCategory");
    $categories = $pageObj->retrievePage();
    $paging_url = LISTING_DEFAULT_URL . "/".ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR;
    
    /*
    * Will be used on:
    * /frontend/results_info.php
    * /frontend/results_filter.php
    * /frontend/results_maps.php
    * functions/script_funct.php
    */
    $aux_module_per_page = "listingcategory";
    $aux_module_items = $categories;
    $aux_array_rss["link"] = $paging_url.$url."/rss/";

    /*
    * Preparing Pagination
    */
    unset($letters_menu);
    $letters_menu = system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, "", $letter, "title", false, false, false, LISTINGCATEGORY_SCALABILITY_OPTIMIZATION);
    $array_pages_code = system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, ($_GET["url_full"] ? $page  : $screen), $aux_items_per_page, ($_GET["url_full"] ? false : true));
    $user = true;
    $showLetter = true;

    if (!$categories && !$letter) {
        $showLetter = false;
    }
?>