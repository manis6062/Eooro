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
	# * FILE: /includes/views/view_detail_tabs.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos(ACTUAL_MODULE_FOLDER, LISTING_FEATURE_FOLDER) !== false || $signUpListing) {

        $item_type = "listing";
        $item_id = $listingtemplate_id;
        $tabReview = $listingtemplate_review;
        $tabMenu = (THEME_LISTING_MENU ? $listingtemplate_attachment_file : false);
        $tabVideo = $listingtemplate_video_snippet;
        $tabDeal = $hasDeal;
        $signUpListing = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, CLASSIFIED_FEATURE_FOLDER) !== false || $signUpClassified) {
        
        $tabReview = false;
        $tabMenu = false;
        $tabVideo = false;
        $tabDeal = false;
        $signUpClassified = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, EVENT_FEATURE_FOLDER) !== false || $signUpEvent) {

        $tabReview = false;
        $tabMenu = false;
        $tabVideo = $event_video_snippet;
        $signUpEvent = false;
        $tabDeal = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, ARTICLE_FEATURE_FOLDER) !== false || $signUpArticle) {
        
        $tabReview = $detail_review;
        $tabMenu = false;
        $tabVideo = false;
        $signUpArticle = false;
        $tabDeal = false;
        
    }

?>

    <ul class="tabs nav nav-tabs">
        
        <li id="tab_overview" class="tab-overview active">
            <a href="javascript:void(0);" <?=((($tabReview || $tabVideo || $tabMenu || $hasDeal) && $user) ? "onclick=\"showTabDetail('overview');\"" : "")?>>
                <?=system_showText(LANG_LABEL_OVERVIEW);?>
            </a>
        </li>
        
        <? if ($tabReview) { ?>
        <li id="tab_review" class="tab-review">
            <a href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"loadReviews('$item_type', $item_id, 1, 'tab'); showTabDetail('review');\"");?>>
                <?=system_showText(LANG_REVIEW_PLURAL);?>
            </a>
        </li>
        <? } ?>
        
        <? if ($tabMenu) { ?>
        <li id="tab_menu" class="tab-menu">
            <a href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"showTabDetail('menu');\"");?>>
                <?=system_showText(LANG_LABEL_MENU);?>
            </a>
        </li> 
        <? } ?>
        
        <? if ($tabVideo) { ?>
        <li id="tab_video" class="tab-video">
            <a href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"showTabDetail('video');\"");?>>
                <?=system_showText(LANG_LABEL_VIDEO);?>
            </a>
        </li>
        <? } ?>
        
        <? if ($tabDeal) { ?>
        <li id="tab_deal" class="tab-deal" >
            <a href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"showTabDetail('deal');\"");?>>
                <?=system_showText(LANG_PROMOTION_FEATURE_NAME);?>
            </a>
        </li>
        <? } ?>
        
    </ul>