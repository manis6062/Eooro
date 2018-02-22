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
	# * FILE: /includes/code/related_listings.php
	# ----------------------------------------------------------------------------------------------------

    //Check if it's a free listing
    $levelPrice = $levelObj->getPrice($listingtemplate_level);
    
    if ($levelPrice == "0.00") {
        
        $dbMain = db_getDBObject(DEFAULT_DB, false);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        //Get highest paid level
        $sql = "SELECT value FROM ListingLevel WHERE detail = 'y' AND active = 'y' AND price > 0 AND theme = '".EDIR_THEME."' ORDER BY value LIMIT 1";
        $rowLevel = mysql_fetch_assoc($dbObj->query($sql));
        
        if ($rowLevel["value"] > 0 && is_array($categories)) {
            
            $categStr = "";
            foreach ($categories as $categRel) {
                $categStr .= $categRel["id"]."-";
            }
            $categStr = string_substr($categStr, 0, -1);
            $arrayRelated = array();
            $arrayRelated["categories"] = $categStr;
            $searchReturnRelated = search_frontListingSearch($arrayRelated, "listing_results");
            $sql = "SELECT ".$searchReturnRelated["select_columns"]." FROM ".$searchReturnRelated["from_tables"]." WHERE ".($searchReturnRelated["where_clause"] ? $searchReturnRelated["where_clause"]." AND" : "")." (Listing_Summary.level IN (".$rowLevel["value"].")) ".($searchReturnRelated["group_by"] ? "GROUP BY ".$searchReturnRelated["group_by"] : "")." ORDER BY ".($searchReturnRelated["order_by"] ? $searchReturnRelated["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".($maxRelated ? $maxRelated : 3);
            $related_listings = db_getFromDBBySQL("listing", $sql, "array");
            unset($arrayRelated);
            
            if (is_array($related_listings) && count($related_listings) > 0) {
            
                $arrayRelated = array();
                $countRelated = 0;
                
                setting_get("commenting_edir", $commenting_edir);
                setting_get("review_listing_enabled", $review_enabled);
                $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
                
                foreach ($related_listings as $related_listing) {
                    
                    $arrayRelated[$countRelated]["title"] = $related_listing["title"];

                    $imageObj = new Image((THEME_USE_IMAGE_BIG ? $related_listing["image_id"] : $related_listing["thumb_id"]));
                    if ($imageObj->imageExists()) {
                        $arrayRelated[$countRelated]["image_tag"] = $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_FEATURED_LISTING_WIDTH, IMAGE_FEATURED_LISTING_HEIGHT, $related_listing["title"], THEME_RESIZE_IMAGE);
                    } else {
                        $arrayRelated[$countRelated]["image_tag"] = "";
                    }

                    $arrayRelated[$countRelated]["description"] = htmlspecialchars($related_listing["description"], ENT_NOQUOTES);

                    $arrayRelated[$countRelated]["detailLink"] = LISTING_DEFAULT_URL."/".$related_listing["friendly_url"];
                    
                    $arrayRelated[$countRelated]["avg_review"] = "";
                    $arrayRelated[$countRelated]["review_link"] = "";
                    $arrayRelated[$countRelated]["total_reviews"] = "";
                    
                    if ($review_enabled == "on" && $commenting_edir && $levelsWithReview && in_array($related_listing["level"], $levelsWithReview)) {
                        $arrayRelated[$countRelated]["avg_review"] = $related_listing["avg_review"];
                        $arrayRelated[$countRelated]["review_link"] = LISTING_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".$related_listing["friendly_url"];
                        
                        $sqlCountReview = "SELECT count(id) AS total FROM Review WHERE item_type = 'listing' AND item_id = ".$related_listing["id"]." AND review IS NOT NULL AND review != '' AND approved = '1' AND status = 'A'";
                        $rowCountReview = mysql_fetch_assoc($dbObj->query($sqlCountReview));
                        $arrayRelated[$countRelated]["total_reviews"] = $rowCountReview["total"]." ".($rowCountReview["total"] == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL));
                    }
                    
                    $arrayRelated[$countRelated]["class"] = (!$countRelated ? "first" : "last");

                    $countRelated++;
                }
                
            }

        }
    }
    
?>