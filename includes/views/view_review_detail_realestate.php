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
	# * FILE: /includes/views/view_review_detail_realestate.php
	# ----------------------------------------------------------------------------------------------------
	$item_reviewcomment = "";

	if (!$tPreview) {
		if (!$item_type) { 
            $item_type = 'listing';
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

		if ($reviewArea != "profile"){
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql = "SELECT image_id, A.has_profile
				FROM Profile
				LEFT JOIN Account A ON (A.id = account_id)
				WHERE account_id = $member_id";
			$result = $dbObj->query($sql);
			$rowProfile = mysql_fetch_assoc($result);

			if (SOCIALNETWORK_FEATURE == "on") {
				if ($member_id && $rowProfile["has_profile"] == "y") {
					$imgTag = socialnetwork_writeLink($member_id, "profile", "general_see_profile", $rowProfile["image_id"], false, false, "",$user);
				} else {
					$imgTag = "<span class=\"no-image no-link\"></span>";
				}
			}
		}
	} else {
		if (SOCIALNETWORK_FEATURE == "on") {
            $imgTag = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
        } else {
            $imgTag = "<span class=\"no-image no-link\"></span>";
        }
	}
	
	$item_default_url = @constant(string_strtoupper($item_type).'_DEFAULT_URL');
	
	if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_REVIEW_URL_DIVISOR."/") || $reviewArea == "profile"){
		$totalReview = $totalReviewsPage;
	} else {
		$totalReview = $numberOfReviews;
	}
	
	$lastItemStyle++;
					
	if ($lastItemStyle == 1) {
		$itemStyle = "first";
	} elseif ($lastItemStyle == $totalReview) {
		$itemStyle = "last";
	} else {
		$itemStyle = "";
	}

	if ($lastItemStyle == $totalReview && $lastItemStyle == 1) {
		$itemStyle .= " last";
	}

	if ($reviewArea == "profile" && $forceLast) {
		$itemStyle = "last";
	}

    if (string_strpos($url_base, "".MEMBERS_ALIAS."") !== false){
        $item_reviewcomment .= "<div class=\"featured featured-review\">";
    } else {
        $item_reviewcomment .= "<div class=\"featured-item ".$itemStyle."\">";
    }

		if (SOCIALNETWORK_FEATURE == "on" && $reviewArea != "profile") {
			$item_reviewcomment .= "<div class=\"image\">";
			$item_reviewcomment .= $imgTag;
			$item_reviewcomment .= "</div>";
		}
	
		if ($rating) {
			unset($rate_stars);
			for ($x=0 ; $x < 5 ;$x++) {
				if ($rating > $x) $rate_stars .= "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOn.png\" alt=\"Star On\" align=\"bottom\" />";
				else $rate_stars .= "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOff.png\" alt=\"Star Off\" align=\"bottom\" />";
			}
		}
        
		if (!$tPreview) {
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
				$item_reviewcomment .= "<h3><a href=\"".$linkstr."\">";
				$item_reviewcomment .= $itemObj->getString("title");
				$item_reviewcomment .= "</a></h3>";

			}
		}

		$item_reviewcomment .= "<h3>".$review_title."</h3>";
		
		$item_reviewcomment .= "<div class=\"rate\">".$rate_stars."</div>";

		if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_REVIEW_URL_DIVISOR."/") === false && $reviewArea != "profile" && string_strpos($_SERVER['PHP_SELF'], "".SITEMGR_ALIAS."/review") === false && string_strpos($_SERVER['PHP_SELF'], "".MEMBERS_ALIAS."/review") === false) {
			if (!$user) {
				$item_reviewcomment .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_READMORE)."</a>";
			} else {
				$item_reviewcomment .= "<a href=\"".$reviewsLink."\">".system_showText(LANG_READMORE)."</a>";
			}
		}
		
		$item_reviewcomment .= "<p>".((nl2br($review)) ? nl2br($review) : system_showText(LANG_NA))."</p>";
		
		$item_reviewcomment .= "<div class=\"info\">";
		
			if ($reviewArea != "profile"){
				if (string_strpos($_SERVER['PHP_SELF'], SITEMGR_ALIAS."/review/view.php")) {
                    if (string_strpos($_SERVER['PHP_SELF'], "".MEMBERS_ALIAS."/review/view.php")){
                        $item_reviewcomment .= ($reviewer_name) ? "<p>".$reviewer_name."</p>" : "<p>".system_showText(LANG_NA)."</p>";
                    } else {
                        $item_reviewcomment .= ($reviewer_name) ? $reviewer_name : system_showText(LANG_NA);
                    }
				} else {
					if ($member_id) {
						$membersStr = "";
						$membersStr = socialnetwork_writeLink($member_id, "profile", "general_see_profile", false, false, false, '', $user);
						if ($membersStr) {
							$item_reviewcomment .= ($reviewer_name) ? "<p>".system_showText(LANG_BY)." ".$membersStr."</p>" : "<p>".system_showText(LANG_NA)."</p>";
                        } else {
							$item_reviewcomment .= ($reviewer_name) ? "<p>".system_showText(LANG_BY)." ".$reviewer_name."</p>" : "<p>".system_showText(LANG_NA)."</p>";
                        }
					} else {
						if ($tPreview) {
							if (SOCIALNETWORK_FEATURE == "on") {
								$item_reviewcomment .= "<p>".system_showText(LANG_BY)." <a href=\"javascript:void(0);\" style=\"cursor: default;\">".$reviewer_name."</a></p>";
							} else {
								$item_reviewcomment .= "<p>".system_showText(LANG_BY)." ".$reviewer_name."</p>";
							}
						} else {
							$item_reviewcomment .= ($reviewer_name) ? "<p>".system_showText(LANG_BY)." ".$reviewer_name."</p>" : "<p>".system_showText(LANG_NA)."</p>";
						}
					}
				}
			}
			
			$item_reviewcomment .= ($reviewer_location) ? "<p>".$reviewer_location."</p>" : "<p>".system_showText(LANG_NA)."</p>";
			$item_reviewcomment .= "<p>".format_date($added, DEFAULT_DATE_FORMAT)." - ".format_getTimeString($added)."</p>";

			if ($response && ($responseapproved || string_strpos($url_base, SITEMGR_ALIAS))) {
				$item_reviewcomment .= "<div class=\"reply\">";
				$item_reviewcomment .= "<p>". nl2br($response) . "</p>";
				$item_reviewcomment .= "</div>";
		
			}
			
		$item_reviewcomment .= "</div>";
		
	$item_reviewcomment .= "</div>";
?>