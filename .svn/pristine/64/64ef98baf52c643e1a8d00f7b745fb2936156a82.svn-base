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
	# * FILE: /frontend/detail_reviews.php
	# ----------------------------------------------------------------------------------------------------

    if ((ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) || $signUpListing) {
        $moduleMessage = $listingMsg;
        $moduleReviews = $listingtemplate_review;
        $signUpListing = false;
    } elseif ((ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) || $signUpArticle) {
        $moduleMessage = $articleMsg;
        $moduleReviews = $detail_review;
        $signUpArticle = false;
        $levelReview = true;
    } elseif ((ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) || $signUpPromotion) {
        $moduleMessage = "";
        $moduleReviews = $deal_review;
        $signUpPromotion = false;
        $levelReview = true;
    }

	if (!$moduleMessage && !$hideDetail && $review_enabled == "on" && $commenting_edir && $levelReview) {
		
		if ($tPreview || !$user) {
			$reviewsLink = "javascript:void(0);";
			$linkReviewFormPopup = "javascript:void(0);";
			$linkStyle = "style=\"cursor:default;\"";
		}
        ?>
        <div class="pnt-0">
            <h2>
                <span><?=system_showText(LANG_REVIEW_PLURAL)?></span>
                <? if ($review_amount > $numberOfReviews){ ?>
                    <a class="view-more" href="<?=$reviewsLink?>" <?=$linkStyle?>><?=system_showText(LANG_LABEL_VIEW_ALL2)?></a>
                    <span class="split">|</span>
                <? } ?>
                <a rel="nofollow" class="view-more <?=!$tPreview? $class : "";?> rate-it" href="<?=$linkReviewFormPopup?>" <?=$linkStyle?>>
                    <? if($review_amount > 0) {
                        echo system_showText(LANG_REVIEWRATEIT);
                    } ?>
                </a>
            </h2>

            <div class="featured featured-review">
                <? if ($review_amount == 0) { ?>
                    <a rel="nofollow" class="<?=!$tPreview? $class : "";?> rate-it-first" href="<?=$linkReviewFormPopup?>" <?=$linkStyle?>><?=system_showText(LANG_REVIEWBETHEFIRST);?></a>
                <? } else {                    
                    echo $moduleReviews;  
                } ?>
            </div>
        </div>

    <? } ?>