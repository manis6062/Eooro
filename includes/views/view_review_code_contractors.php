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
	# * FILE: /includes/views/view_review_code_contractors.php
	# ----------------------------------------------------------------------------------------------------
	
    unset($aux_item_review);
    unset($rate_starsNolink);
    
    $divStars = "
        <div class=\"stars-rating ".($reviewSummaryInfo ? "" : "color-6")."\">
            <div class=\"rate-".(is_numeric($rate_avg) ? $rate_avg : "0")."\"></div>
        </div>
        ";
    
    $rate_stars = $divStars;
    
    if ($user) {

        $aux_item_review .= "<div class=\"rate-stars\">";

        $review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);

        if (mysql_num_rows($r) > 0) {

            $reviewsLink = $item_default_url."/".ALIAS_REVIEW_URL_DIVISOR."/".htmlspecialchars($aux["friendly_url"]);
            
            /** Logged User > (2 Reviews) */
            if ($isDetail) {
                $aux_item_review .= $rate_stars."<span class=\"review-count\">".system_showText(LANG_LABEL_BASED_ON)." ".$review_amount." ".$review_str."</span>";
            } else {
                $aux_item_review .= $rate_stars."<a href='".$reviewsLink."' class='review-count' style='cursor:".($preview ? 'default' : 'pointer')."'>"."($review_amount)</a>";
            }

        } else {

            /** Logged User > (0 Comments ) */
            $aux_item_review .= $rate_stars;
        }

        $aux_item_review .= "</div>";

    } else {
        $aux_item_review .= "<div class=\"rate-stars\">";
        
        $review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);
        
        if ($review_amount > 0) {
            
            if ($isDetail) {
                $aux_item_review .= $rate_stars."<span class=\"review-count\">".system_showText(LANG_LABEL_BASED_ON)." ".$review_amount." ".$review_str."</span>";
            } else {
                $aux_item_review .= $rate_stars."<a href='javascript:void(0);' style='cursor:default;' class='review-count'>".($hideReviewLabel ? "($review_amount)" : $review_amount." ".$review_str)."</a>";
            }
            
        } else {
            $aux_item_review .= $rate_stars;
        }

        $aux_item_review .= "</div>";

    }

    if ($user) {

        if ($review_amount > 0) {
            /** Rate it! */
            if ($isDetail) {
                $aux_item_review .= "<small><a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class\">".system_showText(LANG_WRITE_REVIEW)." »</a></small>";
            } else {
                $aux_item_review .= "<p><a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class rate-it\">".system_showText(LANG_REVIEWRATEIT)."</a></p>";
            }
        } elseif (!$reviewBestOf) {
            /** Be the first to review this item */
            if ($isDetail) {
                $aux_item_review .= "<small><a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class\">".system_showText(LANG_REVIEWBETHEFIRST)."</a></small>";
            } else {
                $aux_item_review .= "<p><a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class\">".system_showText(LANG_REVIEWBETHEFIRST)."</a></p>";
            }
        }

    } else {

        if ($isDetail) {
            
            $aux_item_review .= "<small>";
            if ($review_amount > 0) {
                $aux_item_review .= "<a href='javascript:void(0);' style='cursor: default'>".system_showText(LANG_WRITE_REVIEW)." »</a>";
            } else {
                $aux_item_review .= "<a href='javascript:void(0);' style='cursor: default'>".system_showText(LANG_REVIEWBETHEFIRST)."</a>";
            }
            $aux_item_review .= "</small>";
            
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
    }

    if (string_strlen($aux_item_review) > 0) {
        $item_review .= "<div class=\"rate\">".$aux_item_review."</div>";
    }
?>