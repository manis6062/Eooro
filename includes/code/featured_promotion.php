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
	# * FILE: /includes/code/featured_promotion.php
	# ----------------------------------------------------------------------------------------------------

    if (THEME_FEATURED_DEAL_BIG) {
        $priceClass = "price-tag";
        $contentClass = "deal-feat-big";
        $imageOpenDiv = "<div class=\"deal-image\">";
        $imageCloseDiv = "</div>";
    } else {
        $priceClass = "left";
        $contentClass = "right";
        $imageOpenDiv = "";
        $imageCloseDiv = "";
    }

    $lastItemStyle = 0;
    if (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) {
        $numberOfPromotions = FEATURED_LISTING_DEAL_MAXITEMS;
        $specialItem = FEATURED_LISTING_DEAL_MAXITEMS_SPECIAL;
    } else {
        $numberOfPromotions = FEATURED_PROMOTION_MAXITEMS;
        $specialItem = FEATURED_PROMOTION_MAXITEMS_SPECIAL;
    }

    unset($searchReturn);
	$searchReturn = search_frontPromotionSearch($_GET, "random", true);
    $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".($searchReturn["where_clause"] ? "WHERE ".$searchReturn["where_clause"]."" : "")." ".($searchReturn["group_by"] ? "GROUP BY ".$searchReturn["group_by"] : "")." ".($searchReturn["order_by"] ? "ORDER BY ".$searchReturn["order_by"] : "")." LIMIT ".($numberOfPromotions)."";
    $promotions = db_getFromDBBySQL("promotion", $sql);

	if ($promotions) {

		if (PROMOTION_SCALABILITY_OPTIMIZATION != "on"){
			$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_PROMOTIONS);
			$seeAllTextLink = PROMOTION_DEFAULT_URL."/results.php"; 
        }
        
        $level = new ListingLevel();
        $count = 0;
        $ids_report_lote = "";
        unset($array_show_promotions);
        
        foreach ($promotions as $promotion) {
			
            $ids_report_lote .= $promotion->getString("id").",";
				
            $lastItemStyle++;
            
            $array_show_promotions[$count]["detailLink"] = "".PROMOTION_DEFAULT_URL."/".$promotion->getString("friendly_url");
            
            $array_show_promotions[$count]["deal_price"] = string_substr($promotion->getNumber("dealvalue"), 0, (string_strpos($promotion->getNumber("dealvalue"), ".")));
            $array_show_promotions[$count]["deal_cents"] = string_substr($promotion->getNumber("dealvalue"), (string_strpos($promotion->getNumber("dealvalue"), ".")), 3);
            if ($array_show_promotions[$count]["deal_cents"] == ".00") {
                $array_show_promotions[$count]["deal_cents"] = "";
            }
            if (!$array_show_promotions[$count]["deal_price"] && !$array_show_promotions[$count]["deal_cents"]) {
                $array_show_promotions[$count]["deal_price"] = system_showText(LANG_FREE);
            }
            $array_show_promotions[$count]["realvalue"] = format_money($promotion->getNumber("realvalue"), 2);
            unset($imageObj);
            
            if ($promotion->getNumber("realvalue") > 0) {
                $array_show_promotions[$count]["offer"] = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
            } else {
                $array_show_promotions[$count]["offer"] = "100%";
            }

            $imageObj = new Image($promotion->getNumber((THEME_USE_IMAGE_BIG ? "image_id" : "thumb_id")));
            if ($imageObj->imageExists()) {
                $array_show_promotions[$count]["image_tag"] = $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name", false), THEME_RESIZE_IMAGE);                    
            } else {
                $array_show_promotions[$count]["image_tag"] = "";
            }
            
            $array_show_promotions[$count]["id"]           = htmlspecialchars($promotion->getNumber("id"));
            $array_show_promotions[$count]["account_id"]   = $promotion->getNumber("account_id");
            $array_show_promotions[$count]["title"]        = $promotion->getString("name", true);
            $array_show_promotions[$count]["description"]  = $promotion->getString("description");
            $array_show_promotions[$count]["description_truncated"]  = $promotion->getString("description", true, 130);
            
            $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")), 1, "", "array");
            if ($listing["title"]) {
                if ($level->getDetail($listing["level"]) == "y") {
                    $array_show_promotions[$count]["listing_link"] = "".LISTING_DEFAULT_URL."/".$listing["friendly_url"];
                } else {
                    $array_show_promotions[$count]["listing_link"] = "".LISTING_DEFAULT_URL."/results.php?id=".$listing["id"];
                }
                $array_show_promotions[$count]["listing_title"] = $listing["title"];
                $array_show_promotions[$count]["listing_description"] = $listing["description"];
            }
            
            if ($lastItemStyle == $numberOfPromotions) {
                $itemStyle = "last";
            } elseif ($lastItemStyle == ($specialItem+1)) {
                $itemStyle = "first";
            } else {
                $itemStyle = "";
            }
            
            if ($getListingCateg && LISTING_SCALABILITY_OPTIMIZATION != "on") {
                $array_show_promotions[$count]["categories"] = system_itemRelatedCategories($listing["id"], "deal", true);
            }
            
            $array_show_promotions[$count]["itemStyle"] = $itemStyle;
            
            $count++;
        }
        
        $ids_report_lote = string_substr($ids_report_lote, 0, -1);
        report_newRecord("promotion", $ids_report_lote, PROMOTION_REPORT_SUMMARY_VIEW, true);
	}
?>