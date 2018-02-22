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
	# * FILE: /frontend/detail_preview.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="content">
        <? include(INCLUDES_DIR."/views/view_{$signUpItem}_detail.php"); ?>
    </div>

    <div class="sidebar">
        
        <?
        if ($signUpItem == "listing") {
        
            $signUpListing = true;
            include(system_getFrontendPath("detail_info.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_maps.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_deals.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_reviews.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_checkin.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            
        } elseif ($signUpItem == "article") {
            
            $signUpArticle = true;
            include(system_getFrontendPath("detail_info.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT));
            
            $signUpArticle = true;
            include(system_getFrontendPath("detail_reviews.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT));
            
            $signUpArticle = true;
            include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT));
        
        } elseif ($signUpItem == "classified") {
        
            $signUpClassified = true;
            include(system_getFrontendPath("detail_info.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT));
            
            $signUpClassified = true;
            include(system_getFrontendPath("detail_maps.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT));
            
        } elseif ($signUpItem == "event") {
        
            $signUpEvent = true;
            include(system_getFrontendPath("detail_info.php", "frontend", false, EVENT_EDIRECTORY_ROOT));
            
            $signUpEvent = true;
            include(system_getFrontendPath("detail_maps.php", "frontend", false, EVENT_EDIRECTORY_ROOT));
        
        } elseif ($signUpItem == "promotion") {
        
            $signUpPromotion = true;
            include(system_getFrontendPath("detail_info.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT));
            
            $signUpPromotion = true;
            include(system_getFrontendPath("detail_listing.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT));
            
            $signUpPromotion = true;
            include(system_getFrontendPath("detail_reviews.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT));
            
            $signUpPromotion = true;
            include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT));
        
        }
        ?>
        
    </div>