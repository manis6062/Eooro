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
	# * FILE: /includes/code/bestof.php
	# ----------------------------------------------------------------------------------------------------

	/**
     * Get all listing with best reviews
     */
    include(EDIR_CONTROLER_FOLDER."/".LISTING_FEATURE_FOLDER."/results_bestof.php");
    
    unset($array_show_listings);
    
    if ($listings) {
        
        //Aux vars    
        $levelObj = new ListingLevel(true);
        $locationsParam = system_formatLocation(system_retrieveLocationsToShow().", z");
        setting_get('commenting_edir', $commenting_edir);
        setting_get("review_listing_enabled", $review_enabled);
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        
        $i = 0;
        
        foreach ($listings as $listing) {
            
            //Get fields according to level
            unset($array_fields);
            $array_fields = system_getFormFields("Listing", $listing->getNumber("level"));
            
            //Auxiliary class to main image
            if ($i == 0) {
                $img_class = "img-polaroid";
            } else {
                $img_class = "";
            }
            
            //Listing title
            $array_show_listings[$i]["title"] = $listing->getString("title", true, 45);
            $array_show_listings[$i]["title_minor"] = $listing->getString("title", true, 35);
            
            //Detail link
            if ($levelObj->getDetail($listing->getNumber("level")) == "y") {
                $listingDetailLink = $listing->getFriendlyURL(false, LISTING_DEFAULT_URL);
            } else {
                $listingDetailLink = LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id")."#".$listing->getString("friendly_url");
            }
            $array_show_listings[$i]["link"] = $listingDetailLink;
            
            //Main image
            $array_show_listings[$i]["image"] = "";
            if (is_array($array_fields) && in_array("main_image", $array_fields)) {
                 $imageObj = new Image($listing->getNumber("image_id"));
                 if ($imageObj->imageExists()) {
                    $array_show_listings[$i]["image"] .= "<a href=\"".$listingDetailLink."\" class=\"image\">";
                    $array_show_listings[$i]["image"] .= $imageObj->getTag(THEME_RESIZE_IMAGE, "", "", $listing->getString("title"), THEME_RESIZE_IMAGE, false, $img_class);
                    $array_show_listings[$i]["image"] .= "</a>";
                } else {
                    $array_show_listings[$i]["image"] .= "<a href=\"".$listingDetailLink."\" class=\"image\">";
                    $array_show_listings[$i]["image"] .= "<span class=\"no-image\"></span>";
                    $array_show_listings[$i]["image"] .= "</a>";
                }
            } else {
                //Best Of structure needs a "no image", even if there isn't a image set to the listing level
                $array_show_listings[$i]["image"] .= "<a href=\"".$listingDetailLink."\" class=\"image\">";
                $array_show_listings[$i]["image"] .= "<span class=\"no-image\"></span>";
                $array_show_listings[$i]["image"] .= "</a>";
            }
            
            //Description
            $array_show_listings[$i]["description"] = "";
            if ($listing->getString("description") && (is_array($array_fields) && in_array("summary_description", $array_fields))) {
                $array_show_listings[$i]["description"] = htmlspecialchars($listing->getString("description", true, 200));
            }
            
            //Location
            $array_show_listings[$i]["location"] = "";
            $array_show_listings[$i]["location"] = $listing->getLocationString($locationsParam, true);
            
            //Reviews
            $array_show_listings[$i]["review"] = "";
            if ($review_enabled == "on" && $commenting_edir && $levelsWithReview) {
                if (in_array($listing->getNumber("level"), $levelsWithReview)) {
                    $item_type = 'listing';
                    $reviewSummaryInfo = true;
                    $reviewBestOf = true;
                    $item_id = $listing->getNumber("id");
                    include(INCLUDES_DIR."/views/view_review.php");
                    $array_show_listings[$i]["review"] = $aux_item_review;
                }
            }
            
            $i++;
        }

    }
?>