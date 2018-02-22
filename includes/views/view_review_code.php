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
	# * FILE: /includes/views/view_review_code.php
	# ----------------------------------------------------------------------------------------------------
	
    unset($aux_item_review);
    unset($rate_starsNolink);
    
    $divStars = "
        <div class=\"stars-rating ".($reviewSummaryInfo ? "" : "color-6")."\">
            <div class=\"rate-".(is_numeric($rate_avg) ? $rate_avg : "0")."\"></div>
        </div>
        ";
    
    if ($reviewSummaryInfo) {
        $rate_stars = "<a rel=\"nofollow\" href=\"".($user ? $linkReviewFormPopup : "javascript:void(0);")."\" ".($user ? "class=\"$class star-rating\"" : "class=\"star-rating\"")." ".(!$user ? "style='cursor: default'" : "").">{$divStars}</a>";
    } else {
        $rate_stars = $divStars;
    }
    
    if ($user) {

        $aux_item_review .= "<div class=\"rate-stars\">";

        $review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);

        if (mysql_num_rows($r) > 0) {

            if ($isDetail && ACTUAL_MODULE_FOLDER != PROMOTION_FEATURE_FOLDER) {
                $reviewsLink = "javascript: void(0)";
                $onclickTab = "onclick=\"loadReviews('$item_type', $item_id, 1); showTabDetail('review', true);\"";
            } else {
                $reviewsLink = $item_default_url."/".ALIAS_REVIEW_URL_DIVISOR."/".htmlspecialchars($aux["friendly_url"]);
                $onclickTab = "";
            }

            /** Logged User > (2 Reviews) */
            $aux_item_review .= $rate_stars."<a href='".$reviewsLink."' $onclickTab class='review-count' style='cursor:".($preview ? 'default' : 'pointer')."'>".($hideReviewLabel ? "($review_amount)" : $review_amount." ".$review_str)."</a>";

        } else {

            /** Logged User > (0 Comments ) */
            $aux_item_review .= $rate_stars;
        }

        $aux_item_review .= "</div>";

    } else {
        $aux_item_review .= "<div class=\"rate-stars\">";
        
        $review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);
        
        if ($review_amount > 0) {
            $aux_item_review .= $rate_stars."<a href='javascript:void(0);' style='cursor:default;' class='review-count'>".($hideReviewLabel ? "($review_amount)" : $review_amount." ".$review_str)."</a>";
        } else {
            $aux_item_review .= $rate_stars;
        }

        $aux_item_review .= "</div>";

    }

    if ($user) {

        if ($review_amount > 0) {
            /** Rate it! */
            if (!$reviewSummaryInfo) {
                $aux_item_review .= "<p><a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class rate-it\">".system_showText(LANG_REVIEWRATEIT)."</a></p>";
            }
        } elseif (!$reviewBestOf) {
            /** Be the first to review this item */
            $aux_item_review .= "<p><a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class\">".system_showText(LANG_REVIEWBETHEFIRST)."</a></p>";
        }

    } else {

        $aux_item_review .= "<p>";
        if ($review_amount > 0) {
            if (!$reviewSummaryInfo) {
                $aux_item_review .= "<a href='javascript:void(0);' style='cursor: default'>".system_showText(LANG_REVIEWRATEIT)."</a>";
            }
        } else {
            $aux_item_review .= "<a href='javascript:void(0);' style='cursor: default'>".system_showText(LANG_REVIEWBETHEFIRST)."</a>";
        }
        $aux_item_review .= "</p>";
    }

    if (string_strlen($aux_item_review) > 0) {
        $item_review .= "<div class=\"rate\">".$aux_item_review."</div>";
    }
?>