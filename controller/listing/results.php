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
	# * FILE: /controller/listing/results.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # MODULE REWRITE
    # ----------------------------------------------------------------------------------------------------
    /**
    * modification
    */
    if( !isset($_POST['keyword']) && !isset($_POST['zjletter']) && strpos($_SERVER['REQUEST_URI'], 'location')!==false ){
        header('Location: '.DEFAULT_URL.'/'.ALIAS_LISTING_MODULE.'/alllocations.php' );
    }

    include(EDIR_CONTROLER_FOLDER."/".LISTING_FEATURE_FOLDER."/rewrite.php");
    include( CLASSES_DIR.'/class_God.php' );
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
    include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    
    if ($category_id) {
        $catObj = new ListingCategory($category_id);
        if (!$catObj->getString("title")) {
            header("Location: ".LISTING_DEFAULT_URL."/");
            exit;
        }
    }

    # ----------------------------------------------------------------------------------------------------------------------
    # RESULTS
    # ----------------------------------------------------------------------------------------------------------------------
    
    $search_lock = false;
    $search_lock_word = false;
    if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
        /**
         * modification
         */
//        if( !isset($_POST['keyword']) && !isset($_POST['zjletter']) && strpos($_SERVER['REQUEST_URI'], 'location')!==false ){
//            header('Location: '.DEFAULT_URL.'/'.ALIAS_LISTING_MODULE.'/alllocations.php' );
//        }
        if (!$enable_search_lock) {
            $_GET["id"] = 0;
            $search_lock = true;
        } else {
            if ($_GET["keyword"] && string_strlen($_GET["keyword"]) < (int) FT_MIN_WORD_LEN && !$_GET["where"]) {
                $_GET["id"] = 0;
                $search_lock = true;
                $search_lock_word = true;
            } else if ($_GET["keyword"] && !$_GET["where"]) {
                $aux = explode(" ", $_GET["keyword"]);
                $search_lock = true;
                $search_lock_word = true;
                for ($i = 0; $i < count($aux); $i++) {
                    if (string_strlen($aux[$i]) >= (int) FT_MIN_WORD_LEN) {
                        $search_lock = false;
                        $search_lock_word = false;
                    }
                }
                if ($search_lock) {
                    $_GET["id"] = 0;
                }
            }

            if ($_GET["where"] && string_strlen($_GET["where"]) < (int) FT_MIN_WORD_LEN && !$_GET["keyword"]) {
                $_GET["id"] = 0;
                $search_lock = true;
                $search_lock_word = true;
            } else if ($_GET["where"] && !$_GET["keyword"]) {
                $aux = explode(" ", $_GET["where"]);
                $search_lock = true;
                $search_lock_word = true;
                for ($i = 0; $i < count($aux); $i++) {
                    if (string_strlen($aux[$i]) >= (int) FT_MIN_WORD_LEN) {
                        $search_lock = false;
                        $search_lock_word = false;
                    }
                }
                if ($search_lock) {
                    $_GET["id"] = 0;
                }
            }

            if ($_GET["keyword"] && string_strlen($_GET["keyword"]) < (int) FT_MIN_WORD_LEN && $_GET["where"] && string_strlen($_GET["where"]) < (int) FT_MIN_WORD_LEN) {
                $_GET["id"] = 0;
                $search_lock = true;
                $search_lock_word = true;
            }
        }
    }

    // replacing useless spaces in search by "where"
    if ($_GET["where"]) {
        while (string_strpos($_GET["where"], "  ") !== false) {
            str_replace("  ", " ", $_GET["where"]);
        }
        if ((string_strpos($_GET["where"], ",") !== false) && (string_strpos($_GET["where"], ", ") === false)) {
            str_replace(",", ", ", $_GET["where"]);
        }
    }

    unset($searchReturn);

    if (!$search_lock) {

//        $searchReturn = (isset($_POST['zjletter']) && $_POST['zjletter'] === 'zjletter' ) ? God::getSearch('listing')->setQuery($_POST['keyword'])->getLetterSearchArray() : search_frontListingSearch($_GET, "listing_results");
        if( isset($_POST['zjletter']) && $_POST['zjletter'] === 'zjletter' ){
            $searchReturn = God::getSearch('listing')->setQuery($_POST['keyword'])->getLetterSearchArray();
        }
        else { 
            $searchReturn = ( EDIR_THEME == 'stremline' || EDIR_THEME === 'review' ) ? God::getSearch('listing')->setQuery(strtolower($_GET['keyword']))->getPageBrowsingArray() : search_frontListingSearch($_GET, "listing_results");
        }
        
        // if zjletter is set keep this more than 40.
        $aux_items_per_page = isset($_POST['zjletter']) ? 120 : ($_COOKIE["listing_results_per_page"] ? $_COOKIE["listing_results_per_page"] : 10);
        // $pageObj = new pageBrowsing($searchReturn["from_tables"], ($_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Listing_Summary.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing_Summary", $searchReturn["group_by"]);
        $pageObj = new pageBrowsing($searchReturn["from_tables"], $screen, $aux_items_per_page, $searchReturn["order_by"], "Listing_Summary.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing_Summary", $searchReturn["group_by"], $force_main = false, $selected_domain_id = false, $having = false, $query_keyword = $searchReturn['query']);
        $listings = $pageObj->retrievePage("array", $searchReturn["total_listings"]);
        $paging_url = LISTING_DEFAULT_URL . "/results.php";

        //if only 1 result, then, redirect to the Co. detail page        
        $count = count($listings);
        if($count == 1)
        {
            $detailLink = LISTING_DEFAULT_URL."/".htmlspecialchars($listings[0]["friendly_url"]);
            header('Location: '.$detailLink);
            exit;
        }

        /*
        * Will be used on:
        * /frontend/results_info.php
        * /frontend/results_filter.php
        * /frontend/results_maps.php
        * functions/script_funct.php
        */
        $aux_module_per_page = "listing";
        $aux_module_items = $listings;
        $aux_module_itemRSSSection = "listing";

        /*
        * Will be used on
        * /frontend/browsebycategory.php
        */
        $aux_CategoryObj = "ListingCategory";
        $aux_CategoryModuleURL = LISTING_DEFAULT_URL;
        $aux_CategoryNumColumn = 3;
        $aux_CategoryActiveField = 'active_listing';

        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");

        $array_search_params = array();
        $array_search_params_map = array();

        if ($_GET["url_full"]) {
            if ($browsebycategory) {
                $paging_url = LISTING_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR;
                $aux = str_replace(EDIRECTORY_FOLDER."/".ALIAS_LISTING_MODULE."/".ALIAS_CATEGORY_URL_DIVISOR."/", "", $_GET["url_full"]);
            } else if ($browsebylocation) {
                $paging_url = LISTING_DEFAULT_URL."/".ALIAS_LOCATION_URL_DIVISOR;
                $aux = str_replace(EDIRECTORY_FOLDER."/".ALIAS_LISTING_MODULE."/".ALIAS_LOCATION_URL_DIVISOR."/", "", $_GET["url_full"]);
            }

            $parts = explode("/", $aux);

            for ($i = 0; $i < count($parts); $i++) {
                if ($parts[$i]) {
                    if ($parts[$i] != "page" && $parts[$i] != "letter" && $parts[$i] != "orderby") {
                        $array_search_params[] = "/" . urlencode($parts[$i]);
                    } else {
                        if ($parts[$i] != "page" && $parts[$i] != "letter") {
                            $array_search_params[] = "/" . $parts[$i] . "/" . $parts[$i + 1];
                            $i++;
                        } else {
                            $array_search_params_map[] = "/" . $parts[$i] . "/" . $parts[$i + 1];
                            $i++;
                        }
                    }
                }
            }

            $url_search_params = implode("/", $array_search_params);

            if (string_substr($url_search_params, -1) == "/") {
                $url_search_params = string_substr($url_search_params, 0, -1);
            }
            $url_search_params = str_replace("//", "/", $url_search_params);

            $url_search_params_map = implode("/", $array_search_params_map);
        } else {

            $paging_url = LISTING_DEFAULT_URL . "/results.php";

            foreach ($_GET as $name => $value) {
                if ($name != "screen" && $name != "letter" && $name != "url_full") {
                    if ($name == "keyword" || $name == "where") {
                        $array_search_params[] = $name . "=" . urlencode($value);
                    } else {
                        $array_search_params[] = $name . "=" . $value;
                    }
                } elseif ($name != "url_full") {
                    $array_search_params_map[] = $name."=".$value;
                }
            }

            $url_search_params = implode("&amp;", $array_search_params);
            $url_search_params_map = implode("&amp;", $array_search_params_map);
        }
    
        /*
        * Preparing Pagination
        */
        unset($letters_menu);
        $letters_menu = system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "title", false, false, false, LISTING_SCALABILITY_OPTIMIZATION);
        $array_pages_code = system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, ($_GET["url_full"] ? $page  : $screen), $aux_items_per_page, ($_GET["url_full"] ? false : true));
        $user = true;
        $showLetter = true;

        setting_get('commenting_edir', $commenting_edir);
        setting_get("review_listing_enabled", $review_enabled);
        $db = db_getDBObject();
        $sql = "SELECT count(*) as nunberOfReviews FROM Review WHERE item_type = 'listing' AND status = 'A'";

        $result = $db->unbuffered_query($sql);
        $result = mysql_fetch_assoc($result);
        $numberOfReviews = $result['nunberOfReviews'];

        if ($review_enabled && $commenting_edir && $numberOfReviews) {
            $orderBy = array(LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY, LANG_PAGING_ORDERBYPAGE_POPULAR, LANG_PAGING_ORDERBYPAGE_RATING);
        } else {
            $orderBy = array(LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY, LANG_PAGING_ORDERBYPAGE_POPULAR);
        }

        if (LISTING_ORDERBY_PRICE) {
            array_unshift($orderBy, LANG_PAGING_ORDERBYPAGE_PRICE);
        }

        $orderbyDropDown = search_getOrderbyDropDown($_GET, ($paging_url_mobile ? $paging_url_mobile : $paging_url), $orderBy, system_showText(LANG_PAGING_ORDERBYPAGE) . " ", "this.form.submit();", $parts, false, false, ($paging_url_mobile ? true : false));
        unset($numberOfReviews);
        
        //Prepare tab "Map view"
        $listViewURL = $paging_url;
        if ($_GET["url_full"]) {
            $listViewURL .= ($url_search_params ? "$url_search_params" : "").($url_search_params_map ? $url_search_params_map : "");
        } else {
            $listViewURL .= ($url_search_params ? "?".str_replace("openMap=1", "", $url_search_params) : "").($url_search_params_map ? "&".$url_search_params_map : "");
        }

        setting_get("gmaps_max_markers", $maxMarkers);
        $maxMarkers = ($maxMarkers ? $maxMarkers : GOOGLE_MAPS_MAX_MARKERS);

        $hideTabMap = false;
        
        if (($array_pages_code["total"] > $maxMarkers) || ($array_pages_code["total"] == 0)) {
            $hideTabMap = true;
            unset($openMap);
            unset($_GET["openMap"]);
        }
    }

    if (!$listings && !$letter){
        $showLetter = false;
    }
?>