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
	# * FILE: /controller/listing/results_bestof.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # MODULE REWRITE
    # ----------------------------------------------------------------------------------------------------
   
    /**
     * Preparing categories to sidebar
     */
    $sqlCategories = "SELECT id, title, friendly_url FROM ListingCategory WHERE category_id = 0 AND title <> '' AND friendly_url <> '' AND enabled = 'y' AND active_listing > 0 ORDER BY title";
    $db = db_getDBObject();
    $result = $db->query($sqlCategories);
    $categoriesSideBar = array();
    
    if (mysql_num_rows($result)) {
        
        $i = 0;
        $categoriesSideBar[$i]["id"]    = null;
        $categoriesSideBar[$i]["title"] = LANG_ALL;
        $categoriesSideBar[$i]["url"]   = DEFAULT_URL."/".ALIAS_BESTOF_URL_DIVISOR;       
        
        while ($row = mysql_fetch_assoc($result)) {
            $i++;
            $categoriesSideBar[$i]["id"]    = $row["id"];
            $categoriesSideBar[$i]["title"] = $row["title"];
            $categoriesSideBar[$i]["url"]   = DEFAULT_URL."/".ALIAS_BESTOF_URL_DIVISOR."/".$row["friendly_url"];            
        }
        
    }
    
    /**
     * Getting category to filter results
     */
    $_GET["url_full"] = $_SERVER["REQUEST_URI"];
    
    if ($_GET["url_full"] && (string_strpos($_GET["url_full"], ALIAS_BESTOF_URL_DIVISOR) !== false )) {

        $url = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_BESTOF_URL_DIVISOR, "", $_GET["url_full"]);

        $parts = explode("/", $url);
        
        /**
         * Get page or letter
         */
        for ($i = 0; $i < count($parts); $i++) {
            switch ($parts[$i]) {
                case 'page':    $_GET["page"] = $parts[$i + 1];
                                break;
            }
        }
        
        /**
         * Preparing to get URL to search category
         */
        if ($_GET["page"]) {
            $url = string_replace_once("/page/".$_GET["page"], "", $url);
        }
        
        if ($url) {
            $category_id = ListingCategory::getObjectByFullFriendlyURL($url);
            $categoryObj = new ListingCategory($category_id);
            $listingsIds = $categoryObj->getListingsByCategoryID();
            $categoryURL = $categoryObj->getString("friendly_url");
            $_GET["category_id"] = $category_id;
        }
    }
    
    unset($searchReturn);

    $searchReturn["from_tables"]    = "Listing_Summary";
    $searchReturn["order_by"]       = "avg_review DESC, level, title";
    $searchReturn["where_clause"]   = "status = 'A'".($listingsIds ? " AND id IN (".$listingsIds.") " : "");
    $searchReturn["select_columns"] = "id";

    $aux_items_per_page = ($_COOKIE["bestof_results_per_page"] ? $_COOKIE["bestof_results_per_page"] : 5);
    $pageObj = new pageBrowsing($searchReturn["from_tables"], $_GET["page"], $aux_items_per_page, $searchReturn["order_by"], "Listing.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing", $searchReturn["group_by"]);
    $listings = $pageObj->retrievePage();
    $paging_url = DEFAULT_URL."/".ALIAS_BESTOF_URL_DIVISOR.($category_id ? "/".$categoryURL : "");

    /*
    * Will be used on:
    * /frontend/results_info.php
    * /frontend/results_filter.php
    * /frontend/results_maps.php
    * functions/script_funct.php
    */
    $aux_module_per_page = "bestof";
    $aux_module_items = $listings;

    /*
    * Preparing Pagination
    */
    $array_pages_code = system_preparePagination($paging_url, "", $pageObj, "", $_GET["page"], $aux_items_per_page, ($_GET["url_full"] ? false : true));
    $user = true;
    $showLetter = false;
?>