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
	# * FILE: /search_filters.php
	# ----------------------------------------------------------------------------------------------------
	
    extract($_GET);
    
    /*
     * Available Filters:
     * Rating (listing, article, deal)
     * Categories
     * Price (listing - theme Dining Guide)
     * Deal (listing)
     * Location (listing, classified, event, deal)
     * Valid for (deal)
     */
    
    //Get location levels enabled
    $locationsToShow = system_retrieveLocationsToShow("array");

    /*
     * The code below removes all parameters of filters from URL. This way, all filters will be always related to the original search performed by the user. Exception for location and valid_for
     * The resulting array will be used by search funct to perform the search and return the content for each filter type
     */
    $postFilter = $_GET;
    unset($postFilter["rating"]);
    unset($postFilter["categories"]);
    unset($postFilter["filter_price"]);
    unset($postFilter["filter_deal"]);
    /*
     * Filter by location has a particular behavior. See more details on the code that prepares the location filter.
     */
    $postFilterLocation = $postFilter;
    unset($postFilterLocation["filter_location_".end($locationsToShow)]);
    if ($locationsToShow) {
        foreach ($locationsToShow as $locShow) {
            unset($postFilter["filter_location_".$locShow]);
        }
    }

    //array with all values from $_GET, except for screen, page, letter and url_full
    $array_search_paramsFilters = array();
    //array with all values from $_GET, except for screen, page, letter, url_full and filter options
    $array_search_paramsNoFilters = array();
    
    foreach ($_GET as $name => $value) {
        if ($name != "screen" && $name != "page" && $name != "letter" && $name != "url_full") {
            if ($name == "keyword" || $name == "where") {
                $array_search_paramsFilters[] = $name . "=" . urlencode($value);
                $array_search_paramsNoFilters[] = $name . "=" . urlencode($value);
            } else {
                $array_search_paramsFilters[] = $name . "=" . $value;
                
                //Remove filter options
                if (    $name != "categories" &&
                        string_strpos($name, "filter_location_") === false && 
                        $name != "filter_deal" && 
                        $name != "filter_price" && 
                        $name != "rating" && 
                        $filter_valid_for != "filter_valid_for") {
                    
                            $array_search_paramsNoFilters[] = $name . "=" . $value;
                
                        }
            }
        }
    }
    
    $url_search_paramsFilters = implode("&amp;", $array_search_paramsFilters);
    $url_search_paramsNoFilters = implode("&amp;", $array_search_paramsNoFilters);
    
    $filters = array();
    $posFilter = 0;
    
    /**
     * Create a file to save cache
     */
    if (isset($category_id)) {
        $aux_filename[] = "category_id=".$category_id;    
    }
    if (isset($location_1)) {
        $aux_filename[] = "location_1=".$location_1;
    }
    if (isset($location_2)) {
        $aux_filename[] = "location_2=".$location_2;
    }
    if (isset($location_3)) {
        $aux_filename[] = "location_3=".$location_3;
    }
    if (isset($location_4)) {
        $aux_filename[] = "location_4=".$location_4;
    }
    if (isset($location_5)) {
        $aux_filename[] = "location_5=".$location_5;
    }
    
    if ($locationsToShow) {
        $auxLastLocLevel = end($locationsToShow);
        foreach ($locationsToShow as $locShow) {
            if (isset(${"filter_location_".$locShow}) && $locShow != $auxLastLocLevel) {
                $aux_filename[] = "filter_location_$locShow=".${"filter_location_".$locShow};
            }
        }
    }

    if (isset($keyword)) {
        $aux_filename[] = "keyword=".$keyword;
    }
    if (isset($where)) {
        $aux_filename[] = "where=".$where;
    }
    $aux_original_search = $aux_filename;
    
    if (is_array($aux_filename)) {
        $filename = md5($filter_item.implode("-",$aux_filename).($filterApi ? "_app" : "")).".php";
        $filename = CACHE_FILTER_FOLDER.$filename;
    }    
    
    if (isset($filename)) {
        
        if (file_exists($filename) && filesize($filename) > 0) {
            $file_filter_cache = fopen($filename, "r");
            $contents = fread($file_filter_cache, filesize($filename));
            $data_from_cache = unserialize($contents);

            /**
             * Preparing Arrays
             */
            $arrayCategories    = $data_from_cache["categories"];
            $filter_location    = $data_from_cache["locations"];
            $array_filter_price = $data_from_cache["price"];
            $filter_rating      = $data_from_cache["rating"];
            $enable_filter_deal = $data_from_cache["deal"];
        } else {
            $file_filter_cache = fopen($filename, "w+");
        }
    }

    if ($filter_item == LISTING_FEATURE_FOLDER) {

        //Auxiliary var to build filter by rate
        setting_get("review_listing_enabled", $review_enabled);

        //Search with all parameters except for filters options
        $searchReturnFilter = "\$searchReturnFilter = search_frontListingSearch(\$postFilter, \"listing_results\");";
        //Search with all parameters, removing all filter options except for location levels
        $searchReturnFilterLocation = "\$searchReturnFilterLocation = search_frontListingSearch(\$postFilterLocation, \"listing_results\");";

        //Available filters for listing
//        $availableFilters = array("location","category","deal","rating","price"); modification
        $availableFilters = array();

        //URL to concat filters with all parameters
        $filterLink = LISTING_DEFAULT_URL."/results.php?".$url_search_paramsFilters;
        
        //URL to concat filters with all parameters, except for filter options
        $filterLinkNoFilter = LISTING_DEFAULT_URL."/results.php?".$url_search_paramsNoFilters;

        //Category Obj
        $categObj = "ListingCategory";

        //Aux to check review by level
        $use_level_to_ratings = true;

    } elseif ($filter_item == PROMOTION_FEATURE_FOLDER) {

        //Auxiliary var to build filter by rate
        setting_get("review_promotion_enabled", $review_enabled);

        //Search with all parameters except for filters options
        $searchReturnFilter = "\$searchReturnFilter = search_frontPromotionSearch(\$postFilter, \"promotion_results\");";
        //Search with all parameters, removing all filter options except for location levels
        $searchReturnFilterLocation = "\$searchReturnFilterLocation = search_frontPromotionSearch(\$postFilterLocation, \"promotion_results\");";

        //Available filters for deal
        $availableFilters = array("category","location","rating", "week_filter");
        
        //URL to concat filters with all parameters
        $filterLink = PROMOTION_DEFAULT_URL."/results.php?".$url_search_paramsFilters;
        
        //URL to concat filters with all parameters, except for filter options
        $filterLinkNoFilter = PROMOTION_DEFAULT_URL."/results.php?".$url_search_paramsNoFilters;

        //Category Obj
        $categObj = "ListingCategory";

        //Aux to check review by level
        $use_level_to_ratings = false;
        
    } elseif ($filter_item == EVENT_FEATURE_FOLDER) {

        //Search with all parameters except for filters options
        $searchReturnFilter = "\$searchReturnFilter = search_frontEventSearch(\$postFilter, \"event\");";
        //Search with all parameters, removing all filter options except for location levels
        $searchReturnFilterLocation = "\$searchReturnFilterLocation = search_frontEventSearch(\$postFilterLocation, \"event\");";

        //Available filters for event
        $availableFilters = array("location","category");
        
        //URL to concat filters with all parameters
        $filterLink = EVENT_DEFAULT_URL."/results.php?".$url_search_paramsFilters;
        
        //URL to concat filters with all parameters, except for filter options
        $filterLinkNoFilter = EVENT_DEFAULT_URL."/results.php?".$url_search_paramsNoFilters;

        //Category Obj
        $categObj = "EventCategory";
        
    } elseif ($filter_item == CLASSIFIED_FEATURE_FOLDER) {

        //Search with all parameters except for filters options
        $searchReturnFilter = "\$searchReturnFilter = search_frontClassifiedSearch(\$postFilter, \"classified\");";
        //Search with all parameters, removing all filter options except for location levels
        $searchReturnFilterLocation = "\$searchReturnFilterLocation = search_frontClassifiedSearch(\$postFilterLocation, \"classified\");";

        //Available filters for classified
        $availableFilters = array("location","category");
        
        //URL to concat filters with all parameters
        $filterLink = CLASSIFIED_DEFAULT_URL."/results.php?".$url_search_paramsFilters;
        
        //URL to concat filters with all parameters, except for filter options
        $filterLinkNoFilter = CLASSIFIED_DEFAULT_URL."/results.php?".$url_search_paramsNoFilters;

        //Category Obj
        $categObj = "ClassifiedCategory";
        
    } elseif ($filter_item == ARTICLE_FEATURE_FOLDER) {
        
        //Auxiliary var to build filter by rate
        setting_get("review_article_enabled", $review_enabled);

        //Search with all parameters except for filters options
        $searchReturnFilter = "\$searchReturnFilter = search_frontArticleSearch(\$postFilter, \"article\");";
        
        //Available filters for article
        $availableFilters = array("category", "rating");
        
        //URL to concat filters with all parameters
        $filterLink = ARTICLE_DEFAULT_URL."/results.php?".$url_search_paramsFilters;
        
        //URL to concat filters with all parameters, except for filter options
        $filterLinkNoFilter = ARTICLE_DEFAULT_URL."/results.php?".$url_search_paramsNoFilters;

        //Category Obj
        $categObj = "ArticleCategory";
        
        //Aux to check review by level
        $use_level_to_ratings = false;
        
    } else {
        if ($filterApi) {
            echo "Invalid Resource";
            exit;
        }
    }

    $db = db_getDBObject();

    //Category
    if (in_array("category", $availableFilters)) {

        if (!isset($arrayCategories)) {
            if ($category_id) {
                
                $arrayCategories = array();
                
                if ($filter_item == LISTING_FEATURE_FOLDER || $filter_item == PROMOTION_FEATURE_FOLDER) {

                    $catObj = new ListingCategory();
                    $aux_categories = $catObj->getAllCategoriesHierarchyXML(NULL, $category_id, 0, SELECT_DOMAIN_ID);

                    if ($aux_categories) {
                        $xml_categories = simplexml_load_string($aux_categories);
                        
                        if (count($xml_categories->info) > 0) {
                            for ($i = 0; $i < count($xml_categories->info); $i++) {
                                unset($aux_categories);
                                foreach ($xml_categories->info[$i]->children() as $key => $value) {
                                    $aux_categories[$key] = $value;
                                }
                                if ($aux_categories) {
                                    $arrayCategories[] = (int)$aux_categories["id"];
                                }
                            }
                        }
                    }

                } else {

                    $sql_categories = "SELECT id FROM ".$categObj." WHERE category_id = ".db_formatNumber($category_id)." AND title <> '' AND enabled = 'y' ORDER BY title";
                    $aux_categories = db_getFromDBBySQL($categObj, $sql_categories, "array", true, SELECTED_DOMAIN_ID);
                    if (is_array($aux_categories)) {
                        foreach ($aux_categories as $aux_categ) {
                            $arrayCategories[] = $aux_categ["id"];
                        }
                    }
                }
                
            } else {

                if (!is_array($searchReturnFilter)) {
                    eval($searchReturnFilter);
                }

                if ($filter_item == LISTING_FEATURE_FOLDER || $filter_item == PROMOTION_FEATURE_FOLDER) {
                    $sub_sql = "SELECT ".($filter_item == PROMOTION_FEATURE_FOLDER ? "listing_id" : "id")." FROM ".$searchReturnFilter["from_tables"]." WHERE ".$searchReturnFilter["where_clause"];
                    $sql = "SELECT category_id, category_root_id FROM Listing_Category WHERE listing_id IN (".$sub_sql.") ORDER BY category_id";
                
                } else {
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
                                    
                            FROM ".$searchReturnFilter["from_tables"]." WHERE ".$searchReturnFilter["where_clause"];
                }
                $result = $db->unbuffered_query($sql);

                unset($filter_category);

                $arrayCategories = array();

                while ($row = mysql_fetch_assoc($result)) {
                    
                    if ($filter_item == LISTING_FEATURE_FOLDER || $filter_item == PROMOTION_FEATURE_FOLDER) {
                    
                        if (!in_array($row["category_root_id"], $arrayCategories)) {
                            $arrayCategories[] = $row["category_root_id"];
                        }
                    
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

            }
            
            /**
            * Generating cache for categories
            */
            $data_to_cache["categories"] = $arrayCategories;
        }
        
        if (count($arrayCategories) > 0) {
            $filters[$posFilter]["type"] = ($filterApi ? "categories" : "category");
            
            if ($filterApi) {
                $filters[$posFilter]["filters"] = system_buildCategoriesFilter($arrayCategories, $arrayTotal, $categories, $filterLink, $_GET, false, 0, $filter_item, true);
            }
            
            $posFilter++;
        }
    }

    //Location
    if (in_array("location", $availableFilters)) {

        $locationsToShow = system_retrieveLocationsToShow("array");
        
        if ($locationsToShow) {
            
            foreach ($locationsToShow as $locShow) {
                //Used to add class "active"
                ${"aux_filter_location_".$locShow} = explode("-", ${"filter_location_".$locShow});
            }
                           
            $_locations = explode(",", EDIR_LOCATIONS);

            $defaultLocationsToShow = false;
            $nonDefaultLocationsToShow = false;
            $last_default_level = false;
            $last_default_id = false;

            if (EDIR_DEFAULT_LOCATIONS) {
                $defaultLocations = explode (",", EDIR_DEFAULT_LOCATIONS);
                $defaultLocationsToShow = array_intersect($defaultLocations, $locationsToShow);
                $nonDefaultLocationsToShow = array_diff($locationsToShow, $defaultLocationsToShow);
                system_retrieveLastDefaultLevel($last_default_level, $last_default_id);
            } else {
                $nonDefaultLocationsToShow = $locationsToShow;
            }
                
            if ($nonDefaultLocationsToShow) {

                $nonDefaultLocationsToShow = array_reverse($nonDefaultLocationsToShow);
                $_location_father_level = $last_default_level;
                $_location_father_level_id = $last_default_id;

                /*
                * The code below defines which location level will be used to build the location filter.
                * This filter has a different behavior from other filters. It's possible to filter by two or more locations only for the last default level.
                * Ex: eDirectory uses Country, State and City.
                * Searching by any keyword, the location filter will show initially only available countries.
                * After filtering by a country, the location filter from the next results set will show only the states from that country.
                * Filtering by a state, the location filter from the next results set will show the cities from that state.
                * From now on, it's possible to filter by two or more cities.
                */

                //This auxiliary variable is used to define the location level to be used to build the filter.
                $aux_locationToFilter = "";

                //Check if user already searched by location (advanced search or browse by location section), starting from the last location level until the first one.
                foreach ($nonDefaultLocationsToShow as $auxLocation) {

                    /*
                    * If any location parameter from $_GET is found, it will be used to get the next child level to build the filters.
                    * Ex: searching by Country (location_1), $aux_locationToFilter will be set as "1"
                    */

                    if (${"location_".$auxLocation}) {
                        $aux_locationToFilter = $auxLocation;
                        break; //force to stop the loop after the level is found.
                    }

                }

                //If $aux_locationToFilter is empty, repeat the process to check if user already filtered by any location level, starting from the last location level until the first one.
                if (!$aux_locationToFilter) {

                    foreach ($nonDefaultLocationsToShow as $auxLocation) {

                        /*
                        * If any filter_location parameter from $_GET is found, it will be used to get the next child level to build the filters.
                        * Ex: Filtering by State (filter_location_3) $aux_locationToFilter will be set as "3"
                        */
                        if (${"filter_location_".$auxLocation}) {
                            $aux_locationToFilter = $auxLocation;
                            break; //force to stop the loop after the level is found.
                        }

                    }

                }

                //If $aux_locationToFilter is empty, means that user a performing a search without any location info
                $isLastLocationLevel = false;
                if (!$aux_locationToFilter) {
                    //Defines the location level as the highest level enabled to build the filter. Ex: Country
                    $_location_level = end($nonDefaultLocationsToShow);
                } else {
                    //$aux_locationToFilter defined, get it's child level. Ex: $aux_locationToFilter = 1 (Country), $_location_child_level = 3 (State)
                    system_retrieveLocationRelationship($_locations, $aux_locationToFilter, $_location_father_level, $_location_child_level);

                    //Child level found. Ex: State (3)
                    if ($_location_child_level) {
                        $_location_level = $_location_child_level;                      
                    } else {
                        //Child level not found (last level)
                        $isLastLocationLevel = true;
                        $_location_level = $aux_locationToFilter;
                    }
                }

                if (!isset($filter_location)) {

                    if (!is_array($searchReturnFilterLocation)) {
                        eval($searchReturnFilterLocation);
                    }

                    //Get location ids according to search params
                    if ($filter_item == PROMOTION_FEATURE_FOLDER) {
                        $sql = "    SELECT listing_location".$_location_level." AS location_id

                                    FROM ".$searchReturnFilterLocation["from_tables"]." 

                                    WHERE ".$searchReturnFilterLocation["where_clause"]." AND listing_location".$_location_level." > 0";

                    } else {
                        $sql = "    SELECT location_".$_location_level." AS location_id

                                    FROM ".$searchReturnFilterLocation["from_tables"]." 

                                    WHERE ".$searchReturnFilterLocation["where_clause"]." AND location_".$_location_level." > 0";
                    }

                    $result = $db->unbuffered_query($sql);

                    $locIds = array();
                    while ($row = mysql_fetch_assoc($result)) {
                        if (!in_array($row["location_id"], $locIds)) {
                            $locIds[] = $row["location_id"];
                        }
                    }
                    mysql_free_result($result);

                    $objLocationLabel = "Location".$_location_level;
                    ${"Location".$_location_level} = new $objLocationLabel;

                    if (is_array($locIds) && count($locIds)) {
                        ${"locations".$_location_level} = ${"Location".$_location_level}->retrieveAllLocation($locIds, "id, name");
                    }

                    if (${"locations".$_location_level} && (count(${"locations".$_location_level}) > 1 || !$isLastLocationLevel)) {
                        $i = 0;
                        foreach (${"locations".$_location_level} as $each_location) {

                            $filter_location[$i]["level"]       = ($filterApi ? (float)$_location_level : $_location_level);
                            $filter_location[$i][($filterApi ? "label" : "title")]       = $each_location["name"];
                            $filter_location[$i][($filterApi ? "value" : "id")]          = ($filterApi ? (float)$each_location["id"] : $each_location["id"]);

                            $i++;

                        }

                        /**
                        * Generating cache for locations
                        */
                        $data_to_cache["locations"] = $filter_location;
                    }
                }
            }

            if (count($filter_location) > 0) {
                $filters[$posFilter]["type"] = ($filterApi ? "filter_location_".$_location_level : "location");
                $filters[$posFilter]["filters"] = $filter_location;
                $posFilter++;
            }

        }

    }

    //Deal
    if (in_array("deal", $availableFilters)) {

        if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {
            
            if (!isset($enable_filter_deal)) {

                $levelsWithDeal = system_retrieveLevelsWithInfoEnabled("has_promotion");
                
                if (is_array($levelsWithDeal)) {
                    
                    if (!is_array($searchReturnFilter)) {
                        eval($searchReturnFilter);
                    }
                    
                    $sql = "SELECT id FROM ".$searchReturnFilter["from_tables"]." WHERE ".$searchReturnFilter["where_clause"]." AND promotion_id > 0 AND level IN (".(implode(", ", $levelsWithDeal)).")";
                    $result = $db->query($sql);
                    $listingIDs = array();

                    if (mysql_num_rows($result) > 0) {
                        while ($row = mysql_fetch_assoc($result)) {
                            $listingIDs[] = $row["id"];
                        }
                    }
                    mysql_free_result($result);

                    if (count($listingIDs) > 0) {

                        $searchDeal["listing_IDs"] = implode(",", $listingIDs);
                        $searchReturnFilter_aux = search_frontPromotionSearch($searchDeal, "promotion_results");
                        $sql = "SELECT id FROM ".$searchReturnFilter_aux["from_tables"]." WHERE ".$searchReturnFilter_aux["where_clause"];
                        $result = $db->query($sql);
                        if (mysql_num_rows($result) > 0) {
                            $enable_filter_deal = true;
                            $data_to_cache["deal"] = $enable_filter_deal;
                        }

                    }
                }

            }
        
            if ($enable_filter_deal) {
                $filters[$posFilter]["type"] = ($filterApi ? "filter_deal" : "deal");
                if (!$filterApi) {
                    $filters[$posFilter]["filters"] = true;
                } else {
                    $filterApp[0]["label"] = LANG_LABEL_DEAL_FILTER;
                    $filterApp[0]["value"] = true;
                    $filters[$posFilter]["filters"] = $filterApp;
                }
                $posFilter++;
            }
            
        }
        
    }

    //Price
    if (in_array("price", $availableFilters) && THEME_LISTING_PRICE && !$price) {

        //Used to add class "active"
        $aux_filter_price = explode("-", $filter_price);
        
        if (!isset($array_filter_price)) {
            $fieldsListing = system_getFormFields("listing", "", "price");
            setting_get("listing_price_symbol", $listing_price_symbol);

            if (is_array($fieldsListing)) {

                if (!is_array($searchReturnFilter)) {
                    eval($searchReturnFilter);
                }
                
                $sql = "    SELECT price

                            FROM ".$searchReturnFilter["from_tables"]."

                            WHERE ".$searchReturnFilter["where_clause"]." AND price > 0 AND level IN (".implode(", ", $fieldsListing).")";

                $result = $db->unbuffered_query($sql);
                
                $i = 0;
                $arrayPrice = array();
                while ($row = mysql_fetch_assoc($result)) {
                    if (!in_array($row["price"], $arrayPrice)) {
                        if (!$filterApi) {
                            $array_filter_price[$i]["price"] = $row["price"];
                        } else {
                            $array_filter_price[$i]["label"] = $row["price"];
                            $array_filter_price[$i]["value"] = (float)$row["price"];
                        }
                        $arrayPrice[] = $row["price"];
                        $i++;
                    }
                }
                mysql_free_result($result);
                
                /**
                 * Generating cache for price 
                 */
                $data_to_cache["price"] = $array_filter_price;
            }
        } else {
            unset($arrayPrice);
            for ($i = 0; $i < count($array_filter_price); $i++) {
                $arrayPrice[] = $array_filter_price[$i]["price"];
            }
        }
        
        if (count($array_filter_price) > 0) {
            rsort($array_filter_price);
            $filters[$posFilter]["type"] = ($filterApi ? "filter_price" : "price");
            $filters[$posFilter]["filters"] = $array_filter_price;
            $posFilter++;
        }
    }

    //Rating
    if (in_array("rating", $availableFilters) && !$avg_review) {
        
        setting_get("commenting_edir", $commenting_edir);
        
        //Used to add class "active"
        $ratingArray = explode("-", $rating);

        if ($review_enabled == "on" && $commenting_edir) {
            
            if (!isset($filter_rating)) {
                
                if ($use_level_to_ratings) {
                    $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
                }

                if (is_array($levelsWithReview) || ($filter_item == PROMOTION_FEATURE_FOLDER) || ($filter_item == ARTICLE_FEATURE_FOLDER)) {

                    if (!is_array($searchReturnFilter)) {
                        eval($searchReturnFilter);
                    }
                    
                    $sql = "    SELECT avg_review AS rating 

                                FROM ".$searchReturnFilter["from_tables"]." 

                                WHERE ".$searchReturnFilter["where_clause"]." AND avg_review > 0 ".($use_level_to_ratings ? "AND level IN (".(implode(", ", $levelsWithReview)).")" : "");

                    $result = $db->unbuffered_query($sql);
                    unset($filter_rating);

                    $i = 0;
                    $arrayReview = array();
                    while ($row = mysql_fetch_assoc($result)) {
                        if (!in_array($row["rating"], $arrayReview)) {
                            if (!$filterApi) {
                                $filter_rating[$i]["rating"] = $row["rating"];
                            } else {
                                $filter_rating[$i]["label"] = $row["rating"];
                                $filter_rating[$i]["value"] = (float)$row["rating"];
                            }
                            $arrayReview[] = $row["rating"];
                            $i++;
                        }
                    }
                    mysql_free_result($result);
                    
                    /**
                     * Generating cache for rating
                     */
                    $data_to_cache["rating"] = $filter_rating;

                }
            }
            
            if (count($filter_rating) > 0) {
                rsort($filter_rating);
                $filters[$posFilter]["type"] = "rating";
                $filters[$posFilter]["filters"] = $filter_rating;
                $posFilter++;
            }
            
        }
    }

    //Filter to Deal
    if (in_array("week_filter", $availableFilters)) {

        if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {

            if (!$search_lock) {
                $levelsWithDeal = system_retrieveLevelsWithInfoEnabled("has_promotion");

                if (is_array($levelsWithDeal) && (count($filters) > 0)) {

                    if ($filter_valid_for) {

                        unset($aux_filter_lang);
                        $filters[$posFilter]["type"] = "valid_for";

                        if ($filter_valid_for == "deal_week") {
                            $aux_filter_lang = array("deal_week", LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK);
                        } elseif ($filter_valid_for == "deal_1_day") {
                            $aux_filter_lang = array("deal_1_day", LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS);
                        } elseif ($filter_valid_for == "deal_2_day") {
                            $aux_filter_lang = array("deal_2_day",LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS);
                        }

                        $filters[$posFilter]["filters"][] = $aux_filter_lang;
                        $posFilter++;

                    } else {

                        $visibility_start = date('H')*60+date('i');
                        $visibility_end = date('H')*60+date('i');

                        $where_clause = " ((Promotion.visibility_start <= $visibility_start AND Promotion.visibility_end >= $visibility_end ) OR (Promotion.visibility_start = 24 AND Promotion.visibility_end = 24)) ";

                        $sql = "SELECT  if (end_date > DATE_FORMAT(adddate(now(), interval 1 week), '%Y-%m-%d'), 1, 0 ) as count_week,
                                        if (end_date <= DATE_FORMAT(adddate(now(), interval 1 day), '%Y-%m-%d'), 1, 0 ) as count_1_day,
                                        if (end_date > DATE_FORMAT(adddate(now(), interval 2 day), '%Y-%m-%d'), 1 ,0 ) as count_2_day
                                 FROM Promotion 
                                 WHERE Promotion.listing_status = 'A' AND 
                                       Promotion.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND 
                                       Promotion.start_date <= DATE_FORMAT(NOW(), '%Y-%m-%d') AND 
                                       ".$where_clause." AND
                                       Promotion.listing_id > 0 AND 
                                       Promotion.listing_level IN (".(implode(", ", $levelsWithDeal)).") 
                                 GROUP BY count_week, count_1_day, count_2_day";

                        $result = $db->unbuffered_query($sql);

                        $aux_count_week  = 0;
                        $aux_count_1_day = 0;
                        $aux_count_2_day = 0;

                        while ($row = mysql_fetch_assoc($result)) {

                            if ($row["count_week"] == 1) {
                                $aux_count_week++;
                            }
                            if ($row["count_1_day"] == 1) {
                                $aux_count_1_day++;
                            }
                            if ($row["count_2_day"] == 1) {
                                $aux_count_2_day++;
                            }

                        }

                        $array_filter_deal = array();

                        if ($aux_count_week > 0) {
                            if (!$filterApi) {
                                $array_filter_deal[] = array("deal_week", LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK);
                            } else {
                                $array_filter_deal[] = array("value" => "deal_week", "label" => LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK);
                            }
                        }
                        if ($aux_count_1_day > 0) {
                            if (!$filterApi) {
                                $array_filter_deal[] = array("deal_1_day", LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS);
                            } else {
                                $array_filter_deal[] = array("value" => "deal_1_day", "label" => LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS);
                            }
                        }
                        if ($aux_count_2_day > 0) {
                            if (!$filterApi) {
                                $array_filter_deal[] = array("deal_2_day", LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS);
                            } else {
                                $array_filter_deal[] = array("value" => "deal_2_day", "label" => LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS);
                            }
                        }
                        if (count($array_filter_deal) > 0) {
                            $filters[$posFilter]["type"] = ($filterApi ? "filter_valid_for" : "valid_for");
                            $filters[$posFilter]["filters"] = $array_filter_deal;
                            $posFilter++;
                        }

                    }
                }
            }
        }
    }
    
    if (!isset($data_from_cache) && $file_filter_cache) {
        fwrite($file_filter_cache, serialize($data_to_cache));
        fclose($file_filter_cache);
    }
    
    //Prepare data to build box "You Refined By"
    if (is_array($filters) && count($filters)) {
        
        $arrayRefinedBy = array();
        $countArrayRefined = 0;
        
        foreach ($filters as $filter) {
            
            if ($filter["type"] == "category" && $categories) {
                
                $categsArray = explode("-", $categories);

                foreach ($categsArray as $selectedCateg) {

                    $categoryObj = new $categObj($selectedCateg);

                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "categories", $selectedCateg);

                    $arrayRefinedBy[$countArrayRefined]["label"] = $categoryObj->getString("title");
                    $arrayRefinedBy[$countArrayRefined]["link"] = $thisLink;
                    $countArrayRefined++;

                }
                
            } elseif ($filter["type"] == "location" && is_array($nonDefaultLocationsToShow)) {
                
                $nonDefaultLocationsToShow = array_reverse($nonDefaultLocationsToShow);
                
                foreach ($nonDefaultLocationsToShow as $locToShow) {

                    if (${"filter_location_".$locToShow}) {
                            
                        $locationClass = "Location".$locToShow;
                        
                        $locIds = explode("-", ${"filter_location_".$locToShow});
                        
                        foreach ($locIds as $locID) {
                            $locObj = new $locationClass($locID);
                            
                            if ($locObj->getString("name")) {
                            
                                $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_location_".$locToShow, $locObj->getNumber("id"));

                                $arrayRefinedBy[$countArrayRefined]["label"] = $locObj->getString("name");
                                $arrayRefinedBy[$countArrayRefined]["link"] = $thisLink;
                                $countArrayRefined++;
                            
                            }
                        }
                    }
                    
                }
                
            } elseif ($filter["type"] == "deal" && $filter_deal == "yes") {
                                    
                $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_deal", "yes");
                $arrayRefinedBy[$countArrayRefined]["label"] = system_showText(LANG_LABEL_FILTER_DEAL);
                $arrayRefinedBy[$countArrayRefined]["link"] = $thisLink;
                $countArrayRefined++;
                
            } elseif ($filter["type"] == "price" && $filter_price) {
                
                foreach ($aux_filter_price as $auxPrice) {
                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_price", $auxPrice);
                    $arrayRefinedBy[$countArrayRefined]["label"] = $listing_price_symbol.system_showListingPrice($auxPrice);
                    $arrayRefinedBy[$countArrayRefined]["link"] = $thisLink;
                    $countArrayRefined++;
                }
                
            } elseif ($filter["type"] == "rating" && $rating) {

                foreach ($ratingArray as $auxRating) {
                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "rating", $auxRating);
                    $arrayRefinedBy[$countArrayRefined]["label"] = $auxRating." ".($auxRating == 1 ? system_showText(LANG_LABEL_STAR) : system_showText(LANG_LABEL_STARS));
                    $arrayRefinedBy[$countArrayRefined]["link"] = $thisLink;
                    $countArrayRefined++;
                }
                
            } elseif ($filter["type"] == "valid_for" && $filter_valid_for) {
                
                foreach ($filter["filters"] as $filter_valid) {
                    if ($filter_valid_for == $filter_valid[0]) {
                        $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_valid_for", $filter_valid[0]);
                        $arrayRefinedBy[$countArrayRefined]["label"] = system_showText($filter_valid[1]);
                        $arrayRefinedBy[$countArrayRefined]["link"] = $thisLink;
                        $countArrayRefined++;
                    }
                }
                
            }
            
        }

    }
    
?>