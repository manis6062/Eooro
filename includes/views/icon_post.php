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
	# * FILE: /includes/views/icon_post.php
	# ----------------------------------------------------------------------------------------------------


	if ($isDetail){
		
		$icon_navbar = "";
		$type = "Post";
		
		if ($user) {

			$print_style = "";
			$print_link = "javascript:window.print();";
			$friend_link = DEFAULT_URL."/popup/popup.php?pop_type=blog_emailform&amp;id=".$post->getNumber("id")."&amp;receiver=friend";

			// SOCIAL BOOKMARKING
			if (SOCIAL_BOOKMARKING == "on") {

                $sbmLink = BLOG_DEFAULT_URL."/".$post->getString("friendly_url");
                $sbmLinkShare = BLOG_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$post->getString("friendly_url");
				
				$facebook    = "href=\"http://www.facebook.com/sharer.php?u=".$sbmLinkShare."&amp;t=".urlencode($post->getString("title"))."\" target=\"_blank\"";
				$twitter     = "href=\"http://twitter.com/?status=".$sbmLink."\" target=\"_blank\"";

				$detailLink = $sbmLink;
				unset($sbmLink);
				$socialbookmarking_style = "";

			}

		} else {

			$friend_link = "javascript:void(0);\"";
			$print_link = "javascript:void(0);\"";

			$friend_style = "style=\"cursor:default\"";
			$print_style = "style=\"cursor:default\"";
			$socialbookmarking_style = "style=\"cursor:default\"";

			// SOCIAL BOOKMARKING
			if (SOCIAL_BOOKMARKING == "on") {
				$facebook    = "href=\"javascript:void(0);\" style=\"cursor:default\"";
				$twitter     = "href=\"javascript:void(0);\" style=\"cursor:default\"";
			}
		}

		// SOCIAL BOOKMARKING IMAGES
		if (SOCIAL_BOOKMARKING == "on") {
			$facebook_imgE    = "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-facebook.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\" />";
			$twitter_imgE     = "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-twitter.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\" />";
			
            if (THEME_SHARE_ITEMS) {
                $share_icon		  = "<li><a rel=\"nofollow\" id=\"link_social_".$post->getNumber("id").$type."\" href=\"javascript:void(0);\" ".($user ? "onclick=\"enableSocialBookMarking(".$post->getNumber("id").", '".$type."', '".DEFAULT_URL."');\"" : "")." $socialbookmarking_style>".system_showText(string_strtolower(LANG_LABEL_SHARE))."</a></li>";
            }
        }

		$links = "";
		$cFancyBox = "";
        if($user){
            $cFancyBox = "iframe fancy_window_tofriend";
        }

        if (THEME_EMAIL_TOFRIEND) {
            $links .= "<li><a rel=\"nofollow\" href=\"".$friend_link."\" class=\"".$cFancyBox."\" ".$friend_style.">".system_showText(LANG_ICONEMAILTOFRIEND)."</a></li>";
        }
        if (THEME_DETAIL_PRINT) {
            $links .= "<li>|</li><li><a rel=\"nofollow\" href=\"".$print_link."\" $print_style>".system_showText(LANG_ICONPRINT)."</a></li>";
        }

		if (SOCIAL_BOOKMARKING == "on") {
			$twitterL = "<li class=\"icon\"><a rel=\"nofollow\" ".$twitter." >".$twitter_imgE."</a></li>";
			$facebookL = "<li class=\"icon\"><a rel=\"nofollow\" ".$facebook." >".$facebook_imgE."</a></li>";
		}
        
        $likeObj = share_getFacebookButton(true, "", "", "", $sbmLinkShare);
        unset($detailLink);

		$extraL = "<ul class=\"share-social\">";
		$extraL .= $twitterL;
		$extraL .= $facebookL;
		$extraL .= $share_icon;
		$extraL .= "</ul>";


		$icon_navbar = $extraL;
		$icon_navbar .= "<ul class=\"share-actions\">";
		$icon_navbar .= $links;
		$icon_navbar .= "</ul>";
		
	} else {

		$post_id = $post->getString("id");
		include(INCLUDES_DIR."/views/view_comment.php");

		$icon_navbar = "";

		$type = "Post";

		if ($user) {

			$friend_link = DEFAULT_URL."/popup/popup.php?pop_type=blog_emailform&amp;id=".$post->getNumber("id")."&amp;receiver=friend";

			// SOCIAL BOOKMARKING
			if (SOCIAL_BOOKMARKING == "on") {
				$socialbookmarking_style = "";
			}

		} else {

			$friend_link = "javascript:void(0);\"";
			$friend_style = "style=\"cursor:default\"";
			$print_style = "style=\"cursor:default\"";
			$socialbookmarking_style = "style=\"cursor:default\"";

		}

		$links = "";
		$cFancyBox = "";
        if ($user) {
            $cFancyBox = "iframe fancy_window_tofriend";
        }

		if (SOCIAL_BOOKMARKING == "on") {
			$icon_navbar = "<a rel=\"nofollow\" id=\"link_social_".$post->getNumber("id").$type."\" href=\"javascript:void(0);\" ".($user ? "onclick=\"enableSocialBookMarking('".$post->getNumber("id")."', '".$type."', '".DEFAULT_URL."');\"" : "")." $socialbookmarking_style>".system_showText(string_strtolower(LANG_LABEL_SHARE))."</a> | ";

		}
		setting_get("commenting_edir", $commenting_edir);
		setting_get("review_blog_enabled", $review_blog_enabled);
        if (THEME_EMAIL_TOFRIEND) {
            $icon_navbar .= "<a rel=\"nofollow\" href=\"".$friend_link."\" class=\"".$cFancyBox."\" ".$friend_style.">".system_showText(LANG_ICONEMAILTOFRIEND)."</a>";
        }
		if ($commenting_edir && $review_blog_enabled){
			$icon_navbar .= (THEME_EMAIL_TOFRIEND ? " | " : "").$commentsTag;
		}
	}
?>