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
	# * FILE: /frontend/socialnetwork/user_favorites.php
	# ----------------------------------------------------------------------------------------------------
	 
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (!$_GET["id"]) {
		$id = sess_getAccountIdFromSession();
	} else {
		$id = $_GET["id"];
	}
    
    $favoritesItems = system_getUserActivities("favorites", $id);
    
    //Max favorites shown per block
    $maxFavorites = 4;

	if (is_array($favoritesItems) && count($favoritesItems)) {
        
        $isFavorites = true;
        $user = true;
        
        $levelListing = new ListingLevel(true);
        $levelClassified = new ClassifiedLevel(true);
        $levelEvent = new EventLevel(true);
        $levelArticle = new ArticleLevel(true);
        $locationManager = new LocationManager();
        
        /**
        * This variable is used on view_listing_summary.php
        */
        if (TWILIO_APP_ENABLED == "on") {
            if (TWILIO_APP_ENABLED_SMS == "on") {
                $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
            } else {
                $levelsWithSendPhone = false;
            }
            if (TWILIO_APP_ENABLED_CALL == "on") {
                $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
            } else {
                $levelsWithClicktoCall = false;
            }
        } else {
            $levelsWithSendPhone = false;
            $levelsWithClicktoCall = false;
        }
        setting_get("commenting_edir", $commenting_edir);
        setting_get("review_listing_enabled", $review_enabled);
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
                
    ?>
        <h2><?=system_showText(LANG_LABEL_FAVORITES);?></h2>

        <div class="list-favorites">

		<? 
            $countItem = 1;
            
            foreach ($favoritesItems as $module => $favorites) {

                if (is_array($favorites)) {
                                        
                    foreach ($favorites as $favorite) {
                        
                        if ($module == "listing") {
                            unset($listing);
                            $listing = new Listing($favorite["id"]);
                            $level = $levelListing;
                            $listing->setLocationManager($locationManager);
                        } elseif ($module == "classified") {
                            $classified = new Classified($favorite["id"]);
                            $level = $levelClassified;
                            $classified->setLocationManager($locationManager);
                        } elseif ($module == "event") {
                            $event = new Event($favorite["id"]);
                            $level = $levelEvent;
                            $event->setLocationManager($locationManager);
                        } elseif($module == "article") {
                            $article = new Article($favorite["id"]);
                            $level = $levelArticle;
                        }

                        include(INCLUDES_DIR."/views/view_{$module}_summary.php");

                        $countItem++;

                    }
                }
			}
            
            if ($countItem > ($maxFavorites + 1)) { ?>
            
            <div class="viewmore">
                <a id="linkMorefavorites" href="javascript:void(0);" onclick="showmore('favorite_', 'linkMorefavorites', <?=$countItem?>, <?=$maxFavorites?>);"><?=system_showText(LANG_VIEWMORE);?></a>
                <input type="hidden" id="favorite_" value="<?=$maxFavorites?>" />
            </div>
            
            <? } ?>

        </div>
        
    <? } ?>