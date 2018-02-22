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
	# * FILE: /theme/default/frontend/results.php
	# ----------------------------------------------------------------------------------------------------

	$this_items = 0;
    
    $relatedSearch = array();
    $posArray = 0;

	if ($keyword || $where) {

        $orderbyfield = "`title`";
        
        $fieldsFilters = array();
        $locationsToShow = system_retrieveLocationsToShow("array");
        foreach ($locationsToShow as $loc) {
            if (${"filter_location_$loc"}) {
                $fieldsFilters[] = "filter_location_$loc";
            }
        }
        if ($categories) {
            $fieldsFilters[] = "categories";
        }
        if ($filter_deal) {
            $fieldsFilters[] = "filter_deal";
        }
        if ($rating) {
            $fieldsFilters[] = "rating";
        }
        if ($filter_price) {
            $fieldsFilters[] = "filter_price";
        }
        $filterLinkRelated = "";
        if (count($fieldsFilters)) {
            foreach ($fieldsFilters as $filterF) {
                $filterLinkRelated .= "&amp;$filterF=".$$filterF;
            }
        }

		$dbObj = db_getDBObject();

		####################################################################################################
		### LISTING
		####################################################################################################
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "count");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_array($result);
		$listingsRelatedSearch = $row[0];

		if ($listingsRelatedSearch > 0) {
			
			$this_items += $listingsRelatedSearch;
            
            $relatedSearch[$posArray]["link"] = LISTING_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where.$filterLinkRelated;
            $relatedSearch[$posArray]["label"] = system_showText(LANG_MENU_LISTING);
            $relatedSearch[$posArray]["count"] = $listingsRelatedSearch;
            
            if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                $categoriesRelat = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND enabled = 'y' ORDER BY $orderbyfield");
                
                if ($categoriesRelat) {

                    $j = 0;
                    
                    foreach ($categoriesRelat as $category) {

                        $this_category_id = $category->getNumber("id");

                        unset($searchReturn);
                        $_GET["category_id"] = $this_category_id;
                        $searchReturn = search_frontListingSearch($_GET, "count");
                        $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
                        unset($_GET["category_id"]);

                        $result = $dbObj->query($sql);
                        $row = mysql_fetch_array($result);
                        $thislistings = $row[0];

                        if ($thislistings > 0) {
                            
                            $relatedSearch[$posArray]["sub"][$j]["link"] = LISTING_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where."&amp;category_id=".$this_category_id.$filterLinkRelated;
                            $relatedSearch[$posArray]["sub"][$j]["label"] = $category->getString("title");
                            $relatedSearch[$posArray]["sub"][$j]["count"] = $thislistings;
                            $j++;
                            
                        }
                    }
                }
            }
            $posArray++;
		}
		####################################################################################################

		####################################################################################################
		### EVENT
		####################################################################################################
		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontEventSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$eventsRelatedSearch = $row[0];

			if ($eventsRelatedSearch > 0) {
				
				$this_items += $eventsRelatedSearch;
                
                $relatedSearch[$posArray]["link"] = EVENT_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where.$filterLinkRelated;
                $relatedSearch[$posArray]["label"] = system_showText(LANG_MENU_EVENT);
                $relatedSearch[$posArray]["count"] = $eventsRelatedSearch;
				
                if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                    $categoriesRelat = db_getFromDBBySQL("eventcategory", "SELECT * FROM EventCategory WHERE category_id = 0 AND enabled = 'y' ORDER BY $orderbyfield");
                    if ($categoriesRelat) {
                        
                        $j = 0;

                        foreach ($categoriesRelat as $category) {

                            $this_category_id = $category->getNumber("id");

                            unset($searchReturn);
                            $_GET["category_id"] = $this_category_id;
                            $searchReturn = search_frontEventSearch($_GET, "count");
                            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
                            unset($_GET["category_id"]);

                            $result = $dbObj->query($sql);
                            $row = mysql_fetch_array($result);
                            $thisevents = $row[0];

                            if ($thisevents > 0) {
                                
                                $relatedSearch[$posArray]["sub"][$j]["link"] = EVENT_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where."&amp;category_id=".$this_category_id.$filterLinkRelated;
                                $relatedSearch[$posArray]["sub"][$j]["label"] = $category->getString("title");
                                $relatedSearch[$posArray]["sub"][$j]["count"] = $thisevents;
                                $j++;
                                
                            }

                        }
                    }
                }
                $posArray++;
			}

		}
		####################################################################################################

		####################################################################################################
		### CLASSIFIED
		####################################################################################################
		if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontClassifiedSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$classifiedsRelatedSearch = $row[0];

			if ($classifiedsRelatedSearch > 0) {
				
				$relatedSearch[$posArray]["link"] = CLASSIFIED_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where.$filterLinkRelated;
                $relatedSearch[$posArray]["label"] = system_showText(LANG_MENU_CLASSIFIED);
                $relatedSearch[$posArray]["count"] = $classifiedsRelatedSearch;
				
                if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                    $categoriesRelat = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = 0 AND enabled = 'y' ORDER BY $orderbyfield");
                    if ($categoriesRelat) {

                        $j = 0;
                        
                        foreach ($categoriesRelat as $category) {

                            $this_category_id = $category->getNumber("id");

                            unset($searchReturn);
                            $_GET["category_id"] = $this_category_id;
                            $searchReturn = search_frontClassifiedSearch($_GET, "count");
                            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
                            unset($_GET["category_id"]);

                            $result = $dbObj->query($sql);
                            $row = mysql_fetch_array($result);
                            $thisclassifieds = $row[0];

                            if ($thisclassifieds > 0) {
                                
                                $relatedSearch[$posArray]["sub"][$j]["link"] = CLASSIFIED_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where."&amp;category_id=".$this_category_id.$filterLinkRelated;
                                $relatedSearch[$posArray]["sub"][$j]["label"] = $category->getString("title");
                                $relatedSearch[$posArray]["sub"][$j]["count"] = $thisclassifieds;
                                $j++;
                                
                            }

                        }
                    }
                }
                $posArray++;
			}

		}
		####################################################################################################

		####################################################################################################
		### ARTICLE
		####################################################################################################
		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontArticleSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
            $result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$articlesRelatedSearch = $row[0];

			if ($articlesRelatedSearch > 0) {
				
				$this_items += $articlesRelatedSearch;
                
                $relatedSearch[$posArray]["link"] = ARTICLE_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where.$filterLinkRelated;
                $relatedSearch[$posArray]["label"] = system_showText(LANG_MENU_ARTICLE);
                $relatedSearch[$posArray]["count"] = $articlesRelatedSearch;
				
                if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                    $categoriesRelat = db_getFromDBBySQL("articlecategory", "SELECT * FROM ArticleCategory WHERE category_id = 0 AND enabled = 'y' ORDER BY $orderbyfield");
                    if ($categoriesRelat) {

                        $j = 0;
                        
                        foreach ($categoriesRelat as $category) {

                            $this_category_id = $category->getNumber("id");

                            unset($searchReturn);
                            $_GET["category_id"] = $this_category_id;
                            $searchReturn = search_frontArticleSearch($_GET, "count");
                            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
                            unset($_GET["category_id"]);

                            $result = $dbObj->query($sql);
                            $row = mysql_fetch_array($result);
                            $thisarticles = $row[0];

                            if ($thisarticles > 0) {
                                
                                $relatedSearch[$posArray]["sub"][$j]["link"] = ARTICLE_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where."&amp;category_id=".$this_category_id.$filterLinkRelated;
                                $relatedSearch[$posArray]["sub"][$j]["label"] = $category->getString("title");
                                $relatedSearch[$posArray]["sub"][$j]["count"] = $thisarticles;
                                $j++;
                                
                            }

                        }
                    }
                }
                $posArray++;
			}

		}
		####################################################################################################

		####################################################################################################
		### PROMOTION
		####################################################################################################
		if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION) {
            unset($searchReturn);
            $searchReturn = search_frontPromotionSearch($_GET, "count");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_array($result);
            $promotionsRelatedSearch = $row[0];

            if ($promotionsRelatedSearch > 0) {
                
                $this_items += $promotionsRelatedSearch;
                
                $relatedSearch[$posArray]["link"] = PROMOTION_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where.$filterLinkRelated;
                $relatedSearch[$posArray]["label"] = system_showText(LANG_MENU_PROMOTION);
                $relatedSearch[$posArray]["count"] = $promotionsRelatedSearch;
                
                if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                    $categoriesRelat = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND enabled = 'y' ORDER BY $orderbyfield");
                    if ($categoriesRelat) {

                        $j = 0;

                        foreach ($categoriesRelat as $category) {

                            $this_category_id = $category->getNumber("id");

                            unset($searchReturn);
                            $_GET["category_id"] = $this_category_id;
                            $searchReturn = search_frontPromotionSearch($_GET, "count");

                            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
                            unset($_GET["category_id"]);

                            $result = $dbObj->query($sql);
                            $row = mysql_fetch_array($result);
                            $thispromotions = $row[0];

                            if ($thispromotions > 0) {

                                $relatedSearch[$posArray]["sub"][$j]["link"] = PROMOTION_DEFAULT_URL."/results.php?keyword=".$keyword."&amp;where=".$where."&amp;category_id=".$this_category_id.$filterLinkRelated;
                                $relatedSearch[$posArray]["sub"][$j]["label"] = $category->getString("title");
                                $relatedSearch[$posArray]["sub"][$j]["count"] = $thispromotions;
                                $j++;

                            }

                        }
                    }
                }
                $posArray++;
            }
		}
		####################################################################################################

	} ?>

    