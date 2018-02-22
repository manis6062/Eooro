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
	# * FILE: /includes/code/top_items.php
	# ----------------------------------------------------------------------------------------------------

    $topItems = array();
    $countItems = 0;

    if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
        $db = db_getDBObject();
        $sql = "SELECT listing_id FROM Listing_FeaturedTemp ORDER BY rand() LIMIT 1";
        $result = $db->query($sql);
        if (mysql_num_rows($result)) {
            $row = mysql_fetch_assoc($result);
            $top_listing_aux = new Listing($row["listing_id"]);
            $top_listing[] = $top_listing_aux;
        }
    } else {
        $sql = "SELECT id, title, description, friendly_url, thumb_id, level FROM Listing_Summary WHERE status = 'A' ORDER BY avg_review DESC, random_number LIMIT 1";
        $top_listing = db_getFromDBBySQL("listing", $sql);
    }

    if ($top_listing) {
        
        $topItems[$countItems]["class"] = "top-rated";
        $topItems[$countItems]["label"] = system_showText(LANG_LABEL_TOP_LISTING);
        $topItems[$countItems]["more"] = DEFAULT_URL."/".ALIAS_BESTOF_URL_DIVISOR."/";
        
        $top_listing = $top_listing[0];
        $levelObj = new ListingLevel();
        
        if ($levelObj->getDetail(htmlspecialchars($top_listing->getNumber("level"))) == "y") {
            $topItems[$countItems]["item"]["link"] = $top_listing->getFriendlyURL(false, LISTING_DEFAULT_URL);
        } else {
            $topItems[$countItems]["item"]["link"] = LISTING_DEFAULT_URL."/results.php?id=".$top_listing->getNumber("id")."#".$top_listing->getString("friendly_url");
        }
        
        $topItems[$countItems]["item"]["title"] = $top_listing->getString("title");
        
        $imageObj = new Image($top_listing->getNumber("thumb_id"));
        if ($imageObj->imageExists()) {
            $topItems[$countItems]["item"]["image"] = $imageObj->getTag(false, "", "", $top_listing->getString("title", false), false);
        } else {
            $topItems[$countItems]["item"]["image"] = "<span class=\"no-image\"></span>";
        }
        
        $topItems[$countItems]["item"]["description"] = $top_listing->getString("description");
        
        $countItems++;
        
    }

    //Featured Deal
    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {
        $searchReturn = search_frontPromotionSearch($_GET, "random", true);
        $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".($searchReturn["where_clause"] ? "WHERE ".$searchReturn["where_clause"] : "")." ".($searchReturn["group_by"] ? "GROUP BY ".$searchReturn["group_by"] : "")." ".($searchReturn["order_by"] ? "ORDER BY ".$searchReturn["order_by"] : "")." LIMIT 1";
        $top_deal = db_getFromDBBySQL("promotion", $sql);

        if ($top_deal) {

            $topItems[$countItems]["class"] = "top-deal";
            $topItems[$countItems]["label"] = system_showText(LANG_LABEL_FEATURED_DEAL);
            $topItems[$countItems]["more"] = PROMOTION_DEFAULT_URL."/";
            
            $top_deal = $top_deal[0];

            $topItems[$countItems]["item"]["link"] = $top_deal->getFriendlyURL(false, PROMOTION_DEFAULT_URL);
            $topItems[$countItems]["item"]["title"] = $top_deal->getString("name");

            $imageObj = new Image($top_deal->getNumber("thumb_id"));
            if ($imageObj->imageExists()) {
                $topItems[$countItems]["item"]["image"] = $imageObj->getTag(false, "", "", $top_deal->getString("name", false), false);
            } else {
                $topItems[$countItems]["item"]["image"] = "<span class=\"no-image\"></span>";
            }

            $topItems[$countItems]["item"]["description"] = $top_deal->getString("description");

            $countItems++;

        }
    }

    //Popular Reviews
    setting_get('commenting_edir', $commenting_edir);
    setting_get('review_listing_enabled', $review_enabled);
    
    if ($review_enabled == "on" && $commenting_edir) {
        
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        
        if ($levelsWithReview !== false) {
            
            $sql = "SELECT review, rating,
                        ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id,
                        ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".title,
                        ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".friendly_url
                    FROM Review
                    INNER JOIN  ".(FORCE_SECOND ? "Listing_Summary" : "Listing")." ON Review.item_id = ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id
                    WHERE item_type = 'listing' AND 
                        approved = 1
                        AND Review.status = 'A' AND 
                        ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".status = 'A' AND 
                        ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".level IN (".implode(',', $levelsWithReview).") ORDER BY `like` DESC, added DESC LIMIT 4";
            
            $dbObj = db_getDBObject();
            $result = $dbObj->query($sql);
            $countReviews = 0;

            if (mysql_numrows($result)) {
                               
                $topItems[$countItems]["class"] = "top-review";
                $topItems[$countItems]["label"] = system_showText(LANG_LABEL_POPULAR_REVIEW);
                
                while ($row = mysql_fetch_assoc($result)) {
                    
                    $topItems[$countItems]["item"][$countReviews]["link"] = LISTING_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".htmlspecialchars($row["friendly_url"]);
                    $topItems[$countItems]["item"][$countReviews]["title"] = $row["title"];
                    $topItems[$countItems]["item"][$countReviews]["description"] = system_showTruncatedText($row["review"], 85);
                    $topItems[$countItems]["item"][$countReviews]["rating"] = $row["rating"];

                    $countReviews++;
                    
                }
                
                $countItems++;
                
            }
        }
    }
  
?>