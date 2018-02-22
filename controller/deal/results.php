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
	# * FILE: /controller/deal/results.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # MODULE REWRITE
    # ----------------------------------------------------------------------------------------------------
    include(EDIR_CONTROLER_FOLDER."/".PROMOTION_FEATURE_FOLDER."/rewrite.php");

    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	if ($category_id) {
		$catObj = new ListingCategory($category_id);
		if (!$catObj->getString("title")) {
			header("Location: ".PROMOTION_DEFAULT_URL."/");
			exit;
		}
	}
    
	# ----------------------------------------------------------------------------------------------------
	# RESULTS
	# ----------------------------------------------------------------------------------------------------
	$search_lock = false;
	if (PROMOTION_SCALABILITY_OPTIMIZATION == "on") {
		if (!$enable_search_lock) {
			$_GET["id"] = 0;
			$search_lock = true;
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

	$searchReturn = search_frontPromotionSearch($_GET, "promotion_results");    
    $aux_items_per_page = ($_COOKIE["promotion_results_per_page"] ? $_COOKIE["promotion_results_per_page"] : 10);
    $pageObj = new pageBrowsing($searchReturn["from_tables"], ($_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Promotion.name", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Promotion", $searchReturn["group_by"], false, false, $searchReturn["having_clause"]);
	if (!$search_lock) {
        $promotions = $pageObj->retrievePage();
	} else {
        $promotions = false;
	}
	
	/*
	 * Will be used on:
	 * /frontend/results_info.php
	 * /frontend/results_filter.php
	 * /frontend/results_maps.php
     * functions/script_funct.php
	 */
	$aux_module_per_page			= "promotion";
	$aux_module_items				= $promotions; 
	$aux_module_itemRSSSection		= "deal";
    
	/*
	 * Will be used on
	 * /frontend/browsebycategory.php
	 */
	$aux_CategoryObj				= "PromotionCategory";
	$aux_CategoryModuleURL			= PROMOTION_DEFAULT_URL;
	$aux_CategoryNumColumn			= 3;
	$aux_CategoryActiveField		= false;
	

	$paging_url = PROMOTION_DEFAULT_URL."/results.php";

	$array_search_params = array();
    $array_search_params_map = array();

	if ($_GET["url_full"]){
		if ($browsebycategory){
			$paging_url = PROMOTION_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR;
			$aux = str_replace(EDIRECTORY_FOLDER."/".ALIAS_PROMOTION_MODULE."/".ALIAS_CATEGORY_URL_DIVISOR."/", "", $_GET["url_full"]);
		} else if ($browsebylocation){
			$paging_url = PROMOTION_DEFAULT_URL."/".ALIAS_LOCATION_URL_DIVISOR;
			$aux = str_replace(EDIRECTORY_FOLDER."/".ALIAS_PROMOTION_MODULE."/".ALIAS_LOCATION_URL_DIVISOR."/", "", $_GET["url_full"]);
		}

		$parts = explode("/", $aux);

		for ($i = 0; $i < count($parts); $i++) {
			if ($parts[$i]) {
				if ($parts[$i] != "page" && $parts[$i] != "letter" && $parts[$i] != "orderby") {
					$array_search_params[] = "/".urlencode($parts[$i]);
				} else {
					if ($parts[$i] != "page" && $parts[$i] != "letter") {
						$array_search_params[] = "/".$parts[$i]."/".$parts[$i+1];
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
		$paging_url = PROMOTION_DEFAULT_URL."/results.php";

		foreach ($_GET as $name => $value) {
			if ($name != "screen" && $name != "letter" && $name != "url_full") {
				if ( $name == "keyword" || $name == "where" ) {
                    $array_search_params[] = $name."=".urlencode($value);
                } else {
                    $array_search_params[] = $name."=".$value;
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
	$letters_menu		= system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "name", false, true, false, PROMOTION_SCALABILITY_OPTIMIZATION);
	$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, ($_GET["url_full"] ? $page  : $screen), $aux_items_per_page, ($_GET["url_full"] ? false : true));
	
	$user = true;
	
	setting_get('commenting_edir', $commenting_edir);
	setting_get("review_promotion_enabled", $review_enabled);
	$db = db_getDBObject();			
	$sql = "SELECT count(*) as nunberOfReviews FROM Review WHERE item_type = 'promotion' status = 'A'";
	$result = $db->query($sql);
	$result = mysql_fetch_assoc($result);
	$numberOfReviews = $result['nunberOfReviews'];
	
	if ($review_enabled && $commenting_edir && $numberOfReviews){
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY, LANG_PAGING_ORDERBYPAGE_POPULAR, LANG_PAGING_ORDERBYPAGE_RATING);	
	} else {
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY,LANG_PAGING_ORDERBYPAGE_POPULAR);	
	}
	$orderbyDropDown = search_getOrderbyDropDown($_GET, ($paging_url_mobile ? $paging_url_mobile : $paging_url), $orderBy, system_showText(LANG_PAGING_ORDERBYPAGE)." ", "this.form.submit();", $parts, true, false, ($paging_url_mobile ? true : false));
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
    
	$showLetter = true;
	if (!$promotions && !$letter) $showLetter = false;
?>