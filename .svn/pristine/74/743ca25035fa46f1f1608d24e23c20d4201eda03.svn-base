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
	# * FILE: /includes/views/view_review_detail_contractors.php
	# ----------------------------------------------------------------------------------------------------
	$item_reviewcomment = "";

	if (!$tPreview) {
		if (!$item_type) {
            $item_type = 'listing';
        }

		if (!$itemObj) {
			if ($item_type == 'listing') {
				$itemObj = new Listing($item_id);
                $ratesLabel = str_replace("[item]", string_strtolower(LANG_LISTING_FEATURE_NAME), LANG_LABEL_REVIEW_RATES);
			} else if ($item_type == 'article') {
				$itemObj = new Article($item_id);
                $ratesLabel = str_replace("[item]", string_strtolower(LANG_ARTICLE_FEATURE_NAME), LANG_LABEL_REVIEW_RATES);
			} else if ($item_type == 'promotion') {
				$itemObj = new Promotion($item_id);
                $ratesLabel = str_replace("[item]", string_strtolower(LANG_PROMOTION_FEATURE_NAME), LANG_LABEL_REVIEW_RATES);
			}
		}

		if ($reviewArea != "profile") {
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql = "SELECT image_id, A.has_profile
				FROM Profile
				LEFT JOIN Account A ON (A.id = account_id)
				WHERE account_id = $member_id";
			$result = $dbObj->query($sql);
			$rowProfile = mysql_fetch_assoc($result);

			if (SOCIALNETWORK_FEATURE == "on") {
				if ($member_id && $rowProfile["has_profile"] == "y") {
					$imgTag = socialnetwork_writeLink($member_id, "profile", "general_see_profile", $rowProfile["image_id"], false, false, "", $user, "img-polaroid");
				} else {
					$imgTag = "<span class=\"no-image no-link\"></span>";
				}
			}
		}
        
        if (!$itemObj) {
            if ($item_type == 'listing') {
                $itemObj = new Listing($item_id);
            } else if ($item_type == 'article') {
                $itemObj = new Article($item_id);
            } else if ($item_type == 'promotion') {
                $itemObj = new Promotion($item_id);
            }
        } 

        if ($show_item) {

            if (!$user) $linkstr = "javascript:void(0)";
            if (string_strpos($url_base, SITEMGR_ALIAS)) {
                $linkstr = $url_base."/".$item_type."/view.php?id=".$item_id;
            } else {
                $linkstr = $item_default_url."/".$itemObj->getString("friendly_url");
            }
            $item_reviewcomment .= "<h3 class=\"review-name\"><a href=\"".$linkstr."\">";
            $item_reviewcomment .= $itemObj->getString("title");
            $item_reviewcomment .= "</a></h3>";

        }
        
	} else {
		if (SOCIALNETWORK_FEATURE == "on") {
            $imgTag = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
        } else {
            $imgTag = "<span class=\"no-image no-link\"></span>";
        }
	}
	
	$item_default_url = @constant(string_strtoupper($item_type).'_DEFAULT_URL');
	
	if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_REVIEW_URL_DIVISOR."/") || $reviewArea == "profile") {
		$totalReview = $totalReviewsPage;
	} else {
		$totalReview = $numberOfReviews;
	}
    
    $rate_stars = "
        <div class=\"stars-rating\">
            <div class=\"rate-".(is_numeric($rating) ? $rating : "0")."\"></div>
        </div>
        ";
        
    $reviewerNameStr = "";
    
    if ($reviewArea != "profile") {
        if (string_strpos($_SERVER['PHP_SELF'], "".SITEMGR_ALIAS."/review/view.php")) {
            $reviewerNameStr .= ($reviewer_name) ? $reviewer_name : "";
        } else {
            if ($member_id) {
                $membersStr = "";
                $membersStr = socialnetwork_writeLink($member_id, "profile", "general_see_profile", false, false, false, '', $user);
                if ($membersStr) {
                    $reviewerNameStr .= ($reviewer_name) ? $membersStr : "";
                } else {
                    $reviewerNameStr .= ($reviewer_name) ? $reviewer_name : "";
                }
            } else {
                if ($tPreview) {
                    if (SOCIALNETWORK_FEATURE == "on") {
                        $reviewerNameStr .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".$reviewer_name."</a>";
                    } else {
                        $reviewerNameStr .= $reviewer_name;
                    }
                } else {
                    $reviewerNameStr .= ($reviewer_name) ? $reviewer_name : "";
                }
            }
        }
    }
    
    $reviewer_location = $reviewer_location ? ", ".$reviewer_location : "";
       
    if (string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS) !== false || string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS) !== false) {
    
        $item_reviewcomment .= 

            "<div class=\"review-item\">
                <div class=\"review-top row-fluid\">

                    <div class=\"pull-left\">
                        $imgTag
                    </div>

                    <div class=\"review-info\">
                        <strong>$reviewerNameStr</strong>
                        <span>".system_showText($ratesLabel)."</span>
                        <div class=\"rate-stars\">
                            $rate_stars
                        </div>
                    </div>
                    <p>".(($review) ? nl2br($review) : system_showText(LANG_NA))."</p>";

        if ($response && ($responseapproved || string_strpos($url_base, SITEMGR_ALIAS))) {
            $item_reviewcomment .= "<div class=\"reply\">";
            $item_reviewcomment .= "<p>".nl2br($response)."</p>";
            $item_reviewcomment .= "</div>";

        }


        $item_reviewcomment .= "

                </div>

                <div class=\"review-bottom row-fluid\">
                    <p>".format_date($added, DEFAULT_DATE_FORMAT)." - ".format_getTimeString($added)."</p>               


                </div>
            </div>";
    
    } else {

        //LIKE & DISLIKE
        if (!$id || $pag_content == "reviews") {
            $auxProfileId = $id;
            $id = $row["rID"];
        }
        $likeStr = "";
        $likeStr = system_getLikeDislikeButton($like_ips, $dislike_ips, $id, $like, $dislike, ($divReviewsName ? $divReviewsName : "ratings_"), $user);

        $item_reviewcomment .= 

            "<div class=\"review-item\">
                <div class=\"review-top row-fluid\"> 

                    <div>
                        <div class=\"rate-stars\">
                            $rate_stars
                        </div>
                        <strong>$reviewerNameStr$reviewer_location</strong>".format_date($added, DEFAULT_DATE_FORMAT)."
                    </div>
                    <p>".(($review) ? nl2br($review) : system_showText(LANG_NA))."</p>";

        if ($response && ($responseapproved || string_strpos($url_base, SITEMGR_ALIAS))) {
            $item_reviewcomment .= "<div class=\"reply\">";
            $item_reviewcomment .= "<p>".nl2br($response)."</p>";
            $item_reviewcomment .= "</div>";

        }


        $item_reviewcomment .= "

                </div>

                <div class=\"review-bottom row-fluid\">
             
                    <p>".system_showText(LANG_LABEL_REVIEW_HELPFUL)."</p>

                    <p class=\"stars-rate\" id=\"".($divReviewsName ? $divReviewsName : "ratings_")."$id\">
                        $likeStr
                    </p>
                    
                </div>
            </div>";
        
        if ($pag_content == "reviews") {
            $id = $auxProfileId;
        }
    
    }
?>