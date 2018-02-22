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
	# * FILE: /includes/views/view_detail_tabs_contractors.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos(ACTUAL_MODULE_FOLDER, LISTING_FEATURE_FOLDER) !== false || $signUpListing) {

        $item_type = "listing";
        $item_id = $listingtemplate_id;
        $tabReview = $listingtemplate_review;
        $tabVideo = $listingtemplate_video_snippet;
        $signUpListing = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, CLASSIFIED_FEATURE_FOLDER) !== false || $signUpClassified) {
        
        $tabReview = false;
        $tabVideo = false;
        $signUpClassified = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, EVENT_FEATURE_FOLDER) !== false || $signUpEvent) {

        $tabReview = false;
        $tabVideo = $event_video_snippet;
        $signUpEvent = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, ARTICLE_FEATURE_FOLDER) !== false || $signUpArticle) {
        
        $tabReview = $detail_review;
        $tabVideo = false;
        $signUpArticle = false;
        
    }

?>

    <div class="navbar">
        
        <div class="navbar-inner">
            
            <ul class="nav">
                
                <? if ($tabOverview) { ?>
                <li id="tab_overview" class="tab-overview <?=$tabActiveOverview ? "active" : ""?>">
                    <a href="<?=($user ? "#content_overview" : "javascript: void(0);")?>">
                        <?=system_showText(LANG_LABEL_OVERVIEW);?>
                    </a>
                </li>
                <? } ?>
                
                <? if ($tabReview) { ?>
                <li id="tab_review" class="tab-review <?=$tabActiveReview ? "active" : ""?>">
                    <a href="<?=($user ? "#content_review" : "javascript: void(0);")?>">
                        <?=system_showText(LANG_REVIEW_PLURAL);?>
                    </a>
                </li>
                <? } ?>            

                <? if ($tabVideo) { ?>
                <li id="tab_video" class="tab-video <?=$tabActiveVideo ? "active" : ""?>">
                    <a href="<?=($user ? "#content_video" : "javascript: void(0);")?>">
                        <?=system_showText(LANG_LABEL_VIDEO);?>
                    </a>
                </li>
                <? } ?>
                
            </ul>
            
        </div>
        
    </div>