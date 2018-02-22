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
	# * FILE: /includes/code/featured_listing.php
	# ----------------------------------------------------------------------------------------------------
/*
	$numberOfListings = ($numberItemsMobile ? $numberItemsMobile : FEATURED_LISTING_MAXITEMS);
	$lastItemStyle = 0;
	$specialItem = FEATURED_LISTING_MAXITEMS_SPECIAL;

    $level = implode(",", system_getLevelDetail("ListingLevel"));

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Listing_Summary.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY ".($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".$numberOfListings."";
        $random_listings = db_getFromDBBySQL("listing", $sql, "array");
	}

	if ($random_listings) {

		if (LISTING_SCALABILITY_OPTIMIZATION != "on"){
			$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_LISTINGS);
			$seeAllTextLink = LISTING_DEFAULT_URL."/results.php"; 
        }
        
        $count = 0;

        $ids_report_lote = "";
        unset($array_show_listings);

        foreach ($random_listings as $listing) {
			
            $ids_report_lote .= $listing["id"].",";
				
            $lastItemStyle++;
            
            if ($isMobileSummary) {
                $array_show_listings[$count]["detailLink"] = "".MOBILE_DEFAULT_URL."/".LISTING_FEATURE_FOLDER."/".$listing["friendly_url"];
            } else {
                $array_show_listings[$count]["detailLink"] = "".LISTING_DEFAULT_URL."/".$listing["friendly_url"];
            }
            
            unset($imageObj);
            
            $imageObj = new Image((THEME_USE_IMAGE_BIG ? $listing["image_id"] : $listing["thumb_id"]));
            if ($imageObj->imageExists()) {
                $array_show_listings[$count]["image_tag"] = $imageObj->getTag(true, IMAGE_FEATURED_LISTING_WIDTH, IMAGE_FEATURED_LISTING_HEIGHT, $listing["title"], true);
                $array_show_listings[$count]["image_path"] = $imageObj->getPath();
            } else {
                $array_show_listings[$count]["image_tag"] = "";
                $array_show_listings[$count]["image_path"] = "";
            }
                            
            $array_show_listings[$count]["id"]              = $listing["id"];
            $array_show_listings[$count]["account_id"]      = $listing["account_id"];
            $array_show_listings[$count]["title"]           = htmlspecialchars($listing["title"], ENT_NOQUOTES);
            $array_show_listings[$count]["title_truncated"] = system_showTruncatedText($listing["title"], 30);
            $array_show_listings[$count]["description"] = htmlspecialchars($listing["description"], ENT_NOQUOTES);
            $array_show_listings[$count]["description_truncated"] = system_showTruncatedText($listing["description"], 130);
            
            if ($getAddress) {
                $array_show_listings[$count]["address"] = system_getItemAddressString("Listing", $listing["id"]);
            }
            
            if (LISTING_SCALABILITY_OPTIMIZATION != "on") {
                $array_show_listings[$count]["categories"] = system_itemRelatedCategories($listing["id"], "listing", true);
                $name = socialnetwork_writeLink($listing["account_id"], "profile", "general_see_profile");
                if ($name) {
                    $array_show_listings[$count]["author_string"] = " ".system_showText(LANG_BY)." ".$name;
                }
            }

            if ($lastItemStyle == $numberOfListings) {
                $itemStyle = "last";
            } elseif ($lastItemStyle == ($specialItem+1)) {
                $itemStyle = "first";
            } else {
                $itemStyle = "";
            }
            $array_show_listings[$count]["itemStyle"] = $itemStyle;
            
            $count++;
        }
        
        $ids_report_lote = string_substr($ids_report_lote, 0, -1);
		report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);
	}
*/?>


<?
    include(system_getFrontendPath("recent_reviews.php", "frontend"));
?>