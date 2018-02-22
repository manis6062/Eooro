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
	# * FILE: /includes/code/socialbuttons.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos(ACTUAL_MODULE_FOLDER, LISTING_FEATURE_FOLDER) !== false || $signUpListing) {

        $item_facebookbuttons = $listingtemplate_facebook_buttons;
        $item_googlebutton = $listingtemplate_googleplus_button;
        $item_pinterest = $listingtemplate_pinterest_button;
        $signUpListing = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, CLASSIFIED_FEATURE_FOLDER) !== false || $signUpClassified) {
        
        $item_facebookbuttons = $classified_facebook_buttons;
        $item_googlebutton = $classified_googleplus_button;
        $item_pinterest = $classified_pinterest_button;
        $signUpClassified = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, EVENT_FEATURE_FOLDER) !== false || $signUpEvent) {
        
        $item_facebookbuttons = $event_facebook_buttons;
        $item_googlebutton = $event_googleplus_button;
        $item_pinterest = $event_pinterest_button;
        $signUpEvent = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, ARTICLE_FEATURE_FOLDER) !== false || $signUpArticle) {
        
        $item_facebookbuttons = $article_facebook_buttons;
        $item_googlebutton = $article_googleplus_button;
        $item_pinterest = $article_pinterest_button;
        $signUpArticle = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, PROMOTION_FEATURE_FOLDER) !== false || $signUpPromotion) {
        
        $item_facebookbuttons = $deal_facebook_buttons;
        $item_googlebutton = $deal_googleplus_button;
        $item_pinterest = $deal_pinterest_button;
        $signUpPromotion = false;
        
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, BLOG_FEATURE_FOLDER) !== false || $signUpBlog) {

        $item_facebookbuttons = $post_facebook_buttons;
        $item_googlebutton = $post_googleplus_button;
        $item_pinterest = $post_pinterest_button;
        $signUpBlog = false;
        
    }
    
?>