<?
unset($aux_item_review);
unset($rate_starsNolink);

if ($user) {

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


} else {

    $review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);

    if ($review_amount > 0) {
        $aux_item_review .= $rate_stars."<a href='javascript:void(0);' style='cursor:default;' class='review-count'>".($hideReviewLabel ? "($review_amount)" : $review_amount." ".$review_str)."</a>";
    } else {
        $aux_item_review .= $rate_stars;
    }


}

if ($user) {

    if ($review_amount > 0) {
        /** Rate it! */
        if (!$reviewSummaryInfo) {
            $aux_item_review .= "<a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class rate-it\">".system_showText(LANG_REVIEWRATEIT)."</a>";
        }
    } elseif (!$reviewBestOf) {
        /** Be the first to review this item */
        $aux_item_review .= "<a rel=\"nofollow\" href=\"".$linkReviewFormPopup."\" class=\"$class\">".system_showText(LANG_REVIEWBETHEFIRST)."</a>";
    }

} else {

    if ($review_amount > 0) {
        if (!$reviewSummaryInfo) {
            $aux_item_review .= "<a href='javascript:void(0);' style='cursor: default'>".system_showText(LANG_REVIEWRATEIT)."</a>";
        }
    } else {
        $aux_item_review .= "<a href='javascript:void(0);' style='cursor: default'>".system_showText(LANG_REVIEWBETHEFIRST)."</a>";
    }
}

if (string_strlen($aux_item_review) > 0) {
    $item_review .= $aux_item_review;
}
?>