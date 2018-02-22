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
	# * FILE: /loadcategoryfilter.php
	# ----------------------------------------------------------------------------------------------------
    
    //Do not load this code for requests from API/api2.php
    if (!$filterApi) {
        
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
       
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$_POST["prefix"] = system_denyInjections($_POST["prefix"]);
	$_POST["category"] = system_denyInjections($_POST["category"]);
    
    }
      
    //query string without "categories". Used to perform the search
    $postCategs = array();
    
    //auxilary array with all query string ($_GET). Used to build the link for each filter option
    $auxArray = array();
    //auxilary array with all query string ($_GET), except for screen, page, letter, url_full. Use to create var $url_search_paramsFilters
    $array_search_paramsFilters = array();

    if ($arrayGet) {
        //loop to build the arrays $postCategs, $auxArray, $array_search_paramsFilters
        foreach ($arrayGet as $key => $value) {
            $valInfo = explode(",", $value);
            
            //check for magic quotes on to remove slashes
            if (get_magic_quotes_gpc()) {
                $valInfo[1] = stripslashes($valInfo[1]);
            }
            if ($valInfo[0] != "categories") {
                if ($valInfo[0] != "url_full" && $valInfo[0] != "category_id" && $valInfo[0] != "rating" && $valInfo[0] != "filter_price" && $valInfo[0] != "filter_deal" && string_strpos($valInfo[0], "filter_location_") === false) {
                    $postCategs[$valInfo[0]] = $valInfo[1];
                }
            } else {
                //auxiliary var to add class "active" to selected categories
                $categories = $valInfo[1];
            }
            
            if ($valInfo[0] == "categories") {
                //remove father category from $auxArray, if needed
                $auxCat = explode("-", $valInfo[1]);
                $newAuxCat = array();
                foreach ($auxCat as $cat) {
                    if ($cat != $category_id) {
                        $newAuxCat[] = $cat;
                    }
                }
                $valInfo[1] = implode("-", $newAuxCat);
            }
            
            $auxArray[$valInfo[0]] = $valInfo[1];
            
            if ($valInfo[0] != "screen" && $valInfo[0] != "page" && $valInfo[0] != "letter" && $valInfo[0] != "url_full") {
                if ($valInfo[0] == "keyword" || $valInfo[0] == "where") {
                    $array_search_paramsFilters[] = $valInfo[0] . "=" . urlencode($valInfo[1]);
                } else {
                    $array_search_paramsFilters[] = $valInfo[0] . "=" . $valInfo[1];
                }
            }
            
        }
        unset($_POST["arrayGet"]);
    }

    //Remove duplicated content
    $array_search_paramsFilters = array_unique($array_search_paramsFilters);
    //Used to build the link for each filter option
    $url_search_paramsFilters = implode("&amp;", $array_search_paramsFilters);
    
    // CREATING CACHE
    
    $cachefilterName = "filter_subcateg_father-".$category_id."categs-$categories";
    foreach ($postCategs as $key=>$value) {
        $cachefilterName .= $key."_".$value;
    }
    
    $objCache = new cache($cachefilterName, true);
    if ($objCache->caching || $filterApi) {
        
        if ($filter_item == LISTING_FEATURE_FOLDER) {

            //Search with all parameters except for "categories"
            $searchReturnCategories = search_frontListingSearch($postCategs, "listing_results");

            //URL to concat filters with all parameters
            $filterLink = ($actual_module == "root" ? DEFAULT_URL : LISTING_DEFAULT_URL)."/results.php?".$url_search_paramsFilters;

            //Get categories
            $db = db_getDBObject();
            $sub_sql = "SELECT id FROM ".$searchReturnCategories["from_tables"]." WHERE ".$searchReturnCategories["where_clause"];
            $sql = "SELECT DISTINCT category_id FROM Listing_Category WHERE listing_id IN (".$sub_sql.")";
            $result = $db->query($sql);

        } elseif ($filter_item == PROMOTION_FEATURE_FOLDER) {

            //Search with all parameters except for "categories"
            $searchReturnCategories = search_frontPromotionSearch($postCategs, "promotion_results");

            //URL to concat filters with all parameters
            $filterLink = PROMOTION_DEFAULT_URL."/results.php?".$url_search_paramsFilters;

            //Get categories
            $db = db_getDBObject();
            $sub_sql = "SELECT listing_id FROM ".$searchReturnCategories["from_tables"]." WHERE ".$searchReturnCategories["where_clause"];
            $sql = "SELECT category_id FROM Listing_Category WHERE listing_id IN (".$sub_sql.")  AND category_id != category_root_id";
            $result = $db->query($sql);

        } elseif ($filter_item == EVENT_FEATURE_FOLDER || $filter_item == CLASSIFIED_FEATURE_FOLDER || $filter_item == ARTICLE_FEATURE_FOLDER) {

            if ($filter_item == EVENT_FEATURE_FOLDER) {

                //Search with all parameters except for "categories"
                $searchReturnCategories = search_frontEventSearch($postCategs, "event");
                //URL to concat filters with all parameters
                $filterLink = EVENT_DEFAULT_URL."/results.php?".$url_search_paramsFilters;

            } elseif ($filter_item == CLASSIFIED_FEATURE_FOLDER) {

                //Search with all parameters except for "categories"
                $searchReturnCategories = search_frontClassifiedSearch($postCategs, "classified");
                //URL to concat filters with all parameters
                $filterLink = CLASSIFIED_DEFAULT_URL."/results.php?".$url_search_paramsFilters;

            } elseif ($filter_item == ARTICLE_FEATURE_FOLDER) {

                //Search with all parameters except for "categories"
                $searchReturnCategories = search_frontArticleSearch($postCategs, "article");
                //URL to concat filters with all parameters
                $filterLink = ARTICLE_DEFAULT_URL."/results.php?".$url_search_paramsFilters;

            }

            //Get categories
            $db = db_getDBObject();
            $sql = "SELECT 
                            cat_1_id,
                            parcat_1_level1_id,
                            parcat_1_level2_id,
                            parcat_1_level3_id,
                            parcat_1_level4_id,
                            cat_2_id, 
                            parcat_2_level1_id,
                            parcat_2_level2_id,
                            parcat_2_level3_id,
                            parcat_2_level4_id,
                            cat_3_id,
                            parcat_3_level1_id,
                            parcat_3_level2_id,
                            parcat_3_level3_id,
                            parcat_3_level4_id,
                            cat_4_id, 
                            parcat_4_level1_id,
                            parcat_4_level2_id,
                            parcat_4_level3_id,
                            parcat_4_level4_id,
                            cat_5_id,
                            parcat_5_level1_id,
                            parcat_5_level2_id,
                            parcat_5_level3_id,
                            parcat_5_level4_id

                    FROM ".$searchReturnCategories["from_tables"]." WHERE ".$searchReturnCategories["where_clause"];

            $result = $db->query($sql);

        }

        $categoryObj = new ListingCategory();
        $arrayCategories = array();
        $arrayCategAux = array();
        $arrayTotal = array();

        while ($row = mysql_fetch_assoc($result)) {

            if ($filter_item == LISTING_FEATURE_FOLDER || $filter_item == PROMOTION_FEATURE_FOLDER) {
                $arrayCategAux[] = $row["category_id"];
            } else {

                for ($k = 1; $k <= MAX_CATEGORY_ALLOWED; $k++) {

                    if ($row["cat_{$k}_id"] && !in_array($row["cat_{$k}_id"], $arrayCategories)) {
                        $arrayCategories[] = $row["cat_{$k}_id"];
                    }

                    for ($j = MAX_CATEGORY_ALLOWED - 1; $j >= 1; $j--) {

                        if ($row["parcat_{$k}_level{$j}_id"] && !in_array($row["parcat_{$k}_level{$j}_id"], $arrayCategories)) {
                            $arrayCategories[] = $row["parcat_{$k}_level{$j}_id"];
                        }

                    }

                }

            }

        }
        mysql_free_result($result);

        if ($filter_item == LISTING_FEATURE_FOLDER || $filter_item == PROMOTION_FEATURE_FOLDER) {

            $sql = "SELECT id FROM ListingCategory WHERE title <> '' AND enabled = 'y' AND category_id = ".db_formatNumber(!$filterApi ? $category_id : $father_category);
            $result = $db->query($sql);
            while ($row = mysql_fetch_assoc($result)) {
                if (in_array($row["id"], $arrayCategAux)) {
                    $arrayCategories[] = $row["id"];
                } else {
                    unset($childCategories);
                    $childCategories = $categoryObj->getHierarchy($row["id"], true);
                    $childCategories = explode(",", $childCategories);
                    foreach ($childCategories as $catC) {
                        if (in_array($catC, $arrayCategAux)) {
                            $arrayCategories[] = $catC;
                        }
                    }
                }
            }

        }

        if (!$filterApi) {

            $return = system_buildCategoriesFilter($arrayCategories, $arrayTotal, $categories, $filterLink, $postCategs, true, $category_id, $filter_item, false, $auxArray);

            echo $return;

        } else {

            $filters[0]["filters"] = system_buildCategoriesFilter($arrayCategories, $arrayTotal, $categories, $filterLink, $postCategs, true, $father_category, $filter_item, true);

        }
        
    }
    $objCache->close();

?>