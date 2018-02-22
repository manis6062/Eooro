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
	# * FILE: /includes/views/view_review_code_realestate.php
	# ----------------------------------------------------------------------------------------------------
	
    unset($aux_item_review);
    
    for ($x = 0; $x < 5; $x++) {
        if (round($rate_avg) > $x) {
            $rate_stars .= "<a rel=\"nofollow\" href=\"".($user ? $linkReviewFormPopup : "javascript:void(0);")."\" ".($user ? "class=\"$class star-rating\"" : "class=\"star-rating\"")." ".(!$user ? "style='cursor: default'" : "")."><img src='".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOn.png' alt='Star On' /></a>";
        } else {
            $rate_stars .= "<a rel=\"nofollow\" href=\"".($user ? $linkReviewFormPopup : "javascript:void(0);")."\" ".($user ? "class=\"$class star-rating\"" : "class=\"star-rating\"")." ".(!$user ? "style='cursor: default'" : "")."><img src='".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOff.png' alt='Star Off' /></a>";
        }
    }

    if ($user) {

        $aux_item_review .= "<div class=\"rate-stars\">";

        $review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);

        if (mysql_num_rows($r) > 0) {

            $reviewsLink = $item_default_url."/".ALIAS_REVIEW_URL_DIVISOR."/".htmlspecialchars($aux["friendly_url"]);

            /** Logged User > (2 Reviews) */
            $aux_item_review .= $rate_stars."<a href='".$reviewsLink."' style='cursor:".($preview?'default':'pointer')."'>(".$review_amount." " . $review_str . ")</a>";

        } else {

            /** Logged User > (0 Comments ) */
            $aux_item_review .= $rate_stars."<span>(".$review_amount." " . $review_str . ")</span>";
        }

        $aux_item_review .= "</div>";

    } else {
        $aux_item_review .= "<div class=\"rate-stars\">";
        $plural = $review_amount == 1 ? false : true;
        if ($review_amount > 0) {
            $aux_item_review .= $rate_stars."<a href='javascript:void(0);' style='cursor: default'>(" . $review_amount . " " . system_showText(($plural ? LANG_REVIEWCOUNT_PLURAL : LANG_REVIEWCOUNT)) . ")</a>";
        } else {
            $aux_item_review .= $rate_stars."<span>(".$review_amount." " . system_showText(($plural ? LANG_REVIEWCOUNT_PLURAL : LANG_REVIEWCOUNT)) . ")</span>";
        }

        $aux_item_review .= "</div>";

    }

    if (string_strlen($aux_item_review) > 0) {
        $item_review .= "<div class=\"rate\">".$aux_item_review."</div>";
    }
?>