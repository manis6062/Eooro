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
	# * FILE: /includes/views/view_checkin_detail.php
	# ----------------------------------------------------------------------------------------------------
	$item_checkincomment = "";
	
	if (!$tPreview) {
		if (!$item_type) $item_type = 'listing';

		$dbObj = db_getDBObject(DEFAULT_DB,true);
		$sql = "SELECT image_id, A.has_profile
			FROM Profile
			LEFT JOIN Account A ON (A.id = account_id)
			WHERE account_id = $member_id";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_assoc($result);

		if (SOCIALNETWORK_FEATURE == "on") {
			if ($member_id && $row["has_profile"] == "y") {
				$imgTag = socialnetwork_writeLink($member_id, "profile", "general_see_profile", $row["image_id"], false, false, "class=\"featuredReviewImage\"",$user);
			} else {
				$imgTag = "<span class=\"no-image no-link\"></span>";
			}
		}
	} else {
		if (SOCIALNETWORK_FEATURE == "on") $imgTag = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
		else $imgTag = "<span class=\"no-image no-link\"></span>";
	}
	
	$item_default_url = @constant(string_strtoupper($item_type).'_DEFAULT_URL');
	
	if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_CHECKIN_URL_DIVISOR."/")) {
		$totalReview = $totalCheckinsPage;
	} else {
		$totalReview = 3;
	}

	$lastItemStyle++;
					
	if($lastItemStyle == 1){
		$itemStyle = "first";
	}elseif($lastItemStyle == $totalReview){
		$itemStyle = "last";
	}else{
		$itemStyle = "";
	}

	$item_checkincomment .= "<div class=\"featured-item ".$itemStyle."\">";

	if (SOCIALNETWORK_FEATURE == "on") {
		$item_checkincomment .= "<div class=\"image\">";

		$item_checkincomment .= $imgTag;

		$item_checkincomment .= "</div>";
	}
    
    if ($member_id) {
        $item_checkincomment .= ($checkin_name) ? "<p>".socialnetwork_writeLink($member_id, "profile", "general_see_profile",false,false,false,'',$user)."</p>" : "";
    } else {
        if ($tPreview) {
            if (SOCIALNETWORK_FEATURE == "on") {
                $item_checkincomment .= "<p><a href=\"javascript:void(0);\" style=\"cursor: default;\">".$checkin_name."</a></p>";
            } else {
                $item_checkincomment .= "<p>".$checkin_name."</p>";
            }
        } else {
            $item_checkincomment .= ($checkin_name) ? "<p>".$checkin_name."</p>" : "";
        }
    }

	$item_checkincomment .= "<p>".format_date($added, DEFAULT_DATE_FORMAT)." - ".format_getTimeString($added)."</p>";
	$item_checkincomment .= ((nl2br($quick_tip)) ? "<p>".nl2br($quick_tip)."</p>" : "<p>".system_showText(LANG_NA));	
	$item_checkincomment .= "</div>";
?>