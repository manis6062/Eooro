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
	# * FILE: /includes/views/view_promotion_summary.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------

    if (!$isMobileSummary) {
        $deal_icon_navbar = "";
        include(EDIRECTORY_ROOT."/includes/views/icon_promotion.php");
        $deal_icon_navbar = $icon_navbar;
    
        $friendly_url = $promotion->getString("friendly_url");

        if ((string_strpos($_SERVER["REQUEST_URI"], "results.php") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_PROMOTION_MODULE."/".ALIAS_CATEGORY_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_PROMOTION_MODULE."/".ALIAS_LOCATION_URL_DIVISOR."/") !== false) && GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") { 
            if ($listingObj && $listingObj->getNumber("id")) {
                if ($listingObj->getString("latitude") && $listingObj->getString("longitude")) {
                    $show_map = true;
                } else {
                    $show_map = false;
                }
            }
        }
    }
    $promotionDistance = "";
    if ($listingObj && $listingObj->getNumber("id")) {
        if (zipproximity_getDistanceLabel($zip, "listing", $listingObj->getNumber("id"), $distance_label, true, $listingObj->data_in_array)) {
            $promotionDistance .= " (".$distance_label.")";
        }
    }

	$deal_price = string_substr($promotion->dealvalue,0,(string_strpos($promotion->dealvalue,".")));
	$deal_cents = string_substr($promotion->dealvalue,(string_strpos($promotion->dealvalue,".")),3);
	if ($deal_cents == ".00") $deal_cents = "";

	if ($promotion->realvalue>0) {
		$offer = round(100-(($promotion->dealvalue*100)/$promotion->realvalue)).'%';
    } else {
        $offer = "100%";
    }
	
	$promotionDeals = $promotion->getDealInfo();

	$sold_out = "";
	if ($promotionDeals['doneByAmount'] || $promotionDeals['doneByendDate']) {
		$sold_out = system_showTruncatedText(system_showText(DEAL_SOLDOUT),10);
    }
	
	$contactObj = new Contact($promotion->account_id);
	
	$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->id), 1, "", "object", SELECTED_DOMAIN_ID);
	
	$listingTitle = "";
    //Get Listing Information
	if ($listing->getString("title")) {
		$listingTitle = $listing->getString("title");
        
        if (THEME_LISTINGINFO_DEAL) {
        
            $listingtemplate_address = "";
            if ($listing->getString("address")) {
                $listingtemplate_address = nl2br($listing->getString("address"));
            }

            $listingtemplate_address2 = "";
            if ($listing->getString("address")) {
                $listingtemplate_address2 = nl2br($listing->getString("address2"));
            }

            $locationsToshow = system_retrieveLocationsToShow();
            $listingtemplate_location = "";

            $locationsParam = system_formatLocation($locationsToshow.", z");

            $listingtemplate_location = $listing->getLocationString($locationsParam, true);

            //Get fields according to level
            unset($array_fields);
            $array_fields = system_getFormFields("Listing", $listing->getNumber("level"));

            $listingtemplate_phone = "";
            if ($listing->getString("phone") && is_array($array_fields) && in_array("phone", $array_fields)) {
                if ($user) {
                    if ($isMobileSummary) {
                        $listingtemplate_phone .= $listing->getString("phone");
                    } else {
                        $listingtemplate_phone .= "<span id=\"phoneLink".$listing->getNumber("id")."\" class=\"show-inline\"><a rel=\"nofollow\" href=\"javascript:showPhone('".$listing->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
                        $listingtemplate_phone .= "<span id=\"phoneNumber".$listing->getNumber("id")."\" class=\"hide\" title=\"".$listing->getString("phone")."\">".system_showTruncatedText($listing->getString("phone"), 30)."</span>";
                    }
                } else {
                    $listingtemplate_phone = system_showTruncatedText($listing->getString("phone"), 30);
                }
            }

            $listingtemplate_fax = "";
            if ($listing->getString("fax") && (is_array($array_fields) && in_array("fax", $array_fields))) {
                if ($user) {
                    $listingtemplate_fax .= "<span id=\"faxLink".$listing->getNumber("id")."\" class=\"show-inline\"><a rel=\"nofollow\" href=\"javascript:showFax('".$listing->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWFAX)."</a></span>";
                    $listingtemplate_fax .= "<span id=\"faxNumber".$listing->getNumber("id")."\" class=\"hide\" title=\"".$listing->getString("fax")."\">".system_showTruncatedText($listing->getString("fax"), 30)."</span>";
                } else {
                    $listingtemplate_fax = system_showTruncatedText($listing->getString("fax"), 30);
                }
            }

            $listingtemplate_url = "";
            if ($listing->getString("url") && (is_array($array_fields) && in_array("url", $array_fields))) {
                $display_url = $listing->getString("url");
                if ($listing->getString("display_url")) {
                    $display_url = $listing->getString("display_url");
                }
                $display_url_title = $display_url;
                $display_url = system_showTruncatedText($display_url, 29);
                if ($user) {
                    if ($isMobileSummary) {
                        $listingtemplate_url = "<a href=\"".$listing->getString("url")."\" target=\"_blank\">".$display_url."</a>";
                    } else {
                        $listingtemplate_url = "<a href=\"".DEFAULT_URL."/listing_reports.php?report=website&amp;id=".$listing->getNumber("id")."\" target=\"_blank\" title=\"$display_url_title\">".$display_url."</a>";
                    }
                } else {
                    $listingtemplate_url = "<a href=\"javascript:void(0);\" title=\"$display_url_title\" style=\"cursor:default\">".$display_url."</a>";
                }
            }

            $listingtemplate_email = "";
            if ($listing->getString("email") && (is_array($array_fields) && in_array("email", $array_fields))) {
                $display_email = wordwrap($listing->getString("email"), 30, "<br />", true);
                if ($user){
                    $listingtemplate_email = "<a rel=\"nofollow\" href=\"".DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".$listing->getNumber("id")."&amp;receiver=owner\" class=\"iframe fancy_window_tofriend\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
                } else {
                    $listingtemplate_email = "<a rel=\"nofollow\" href=\"javascript:void(0);\" style=\"cursor:default\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
                }
            }
        
        }

	}
	
	$listing_link = "";
    $level = new ListingLevel();
	
	if ($user) {
        if ($level->getDetail($listing->getNumber("level")) == "y") {
            $listing_link = DEFAULT_URL."/".ALIAS_LISTING_MODULE."/".$listing->getString("friendly_url");
        } else {
            $listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
        }
	} else {
		$listing_link = "javascript: void(0);";
	}
	
	$imageObj = new Image($promotion->getNumber((THEME_USE_IMAGE_BIG ? "image_id" : "thumb_id")));
	
	$promotionLink = !$user ? "javascript:void(0);" : (($isMobileSummary ? MOBILE_DEFAULT_URL."/".PROMOTION_FEATURE_FOLDER : PROMOTION_DEFAULT_URL)."/".$promotion->getString('friendly_url'));
	$promotionStyle = !$user ? "style=\"cursor:default\"": "";
	$imageTag = "";
    $imagePath = "";
    
	if ($imageObj->imageExists()) {
		
		if ($user){
			$imageTag =  "<a href=\"".$promotionLink."\" class=\"image\">";
			$imageTag .= $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name", false), THEME_RESIZE_IMAGE);
			$imageTag .= "</a>";
            $imagePath = $imageObj->getPath();
		} else {
			$imageTag .= "<div class=\"no-link\">";
			$imageTag .= $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name", false), THEME_RESIZE_IMAGE);
			$imageTag .= "</div>";
		}
	} elseif (!$isMobileSummary) {
		$imageTag = "<a href=\"".$promotionLink."\" class=\"image\">";
		$imageTag .= "<span class=\"no-image\"".(!$user ? "style=\"cursor:default\"" : "")."></span>";
		$imageTag .= "</a>";
	}
	
	$promotion_desc = nl2br($promotion->getString("description"));
	
    if (!$isMobileSummary) {
    
        $promotion_review = "";
        if ($review_enabled == "on" && $commenting_edir) {
            $item_type = 'promotion';
            $item_id   = $promotion->getNumber("id");
            $itemObj   = $promotion;
            $hideReviewLabel = true;
            include(INCLUDES_DIR."/views/view_review.php");
            $promotion_review .= $item_review;
            $item_review = "";
        }

        $summaryFileName = INCLUDES_DIR."/views/view_promotion_summary_code.php";
        $themeSummaryFileName = INCLUDES_DIR."/views/view_promotion_summary_code_".EDIR_THEME.".php";

        if (file_exists($themeSummaryFileName)){
            include($themeSummaryFileName);
        } else {
            include($summaryFileName);
        }
        
    }

?>