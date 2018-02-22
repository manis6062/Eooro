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
	# * FILE: /includes/views/icon_article.php
	# ----------------------------------------------------------------------------------------------------

    $icon_navbar = "";
    $icon_article_level = $article->getNumber("level");

    $type = "Article";
	if ($user) {

		$friend_link = DEFAULT_URL."/popup/popup.php?pop_type=article_emailform&amp;id=".$article->getNumber("id")."&amp;receiver=friend";
		if (sess_getAccountIdFromSession() && !$members) {
			$include_favorites_link = "javascript: void(0);";
			$include_favorites_click = "onclick=\"itemInQuicklist('add', '".sess_getAccountIdFromSession()."', '".$article->getNumber("id")."', 'article');\"";
		} else {
			$include_favorites_link =  DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=".$_SERVER["REQUEST_URI"]."?".$_SERVER["QUERY_STRING"];
			$includes_favorites_class = "fancy_window_iframe";
		}
        $removeFavoritesDiv = "";
        $removeFavoritesDivClass = "";
		if (sess_getAccountIdFromSession() || $members) {
			$remove_favorites_link = "javascript: void(0);";
			$remove_favorites_click = "onclick=\"itemInQuicklist('remove', '".sess_getAccountIdFromSession()."', '".$article->getNumber("id")."', 'article');\"";
            if ($members) {
                if (($id == sess_getAccountIdFromSession()) || ($members != "profile")) {
                    $removeFavoritesDivClass = "favoritesGrid";
                    $removeFavoritesDiv = " <div class=\"coverFavorites boxFavorites\">
                                                <span><a rel=\"nofollow\" id=\"favoritesRemove_".$article->getNumber("id")."\" href=\"".$remove_favorites_link."\" ".$remove_favorites_click." ".$remove_favorites_style.">".system_showText(LANG_ICONQUICKLIST_REMOVE)."<img src=\"".DEFAULT_URL."/images/bt_delete.gif\" border=\"0\" alt=\"\" title=\"\"/></a></span>
                                            </div>";
                }
            }
		}
		if (sess_validateSessionItens("article", "print")){
			$print_link = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=".$_SERVER["REQUEST_URI"]."?".$_SERVER["QUERY_STRING"];
			$print_class = "class=\"fancy_window_iframe\"";		
		} else {
			$print_link = "javascript:window.print();";
		}
        
		$aux_friend_link = $friend_link;
        $friend_link = sess_validateSessionItens("article", "send_email_to_friend", false, $friend_link);
        
        $fancyiFrame = true;
        if ($aux_friend_link != $friend_link){
            $fancyiFrame = false;
        }

        // SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING == "on") {

            $articleLevelObj = new ArticleLevel();
            if ($articleLevelObj->getDetail($icon_article_level) == "y") {
                if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ARTICLE_MODULE."/".ALIAS_REVIEW_URL_DIVISOR."/") !== false) {
                    $sbmLink = ARTICLE_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".$article->getString("friendly_url");
                    $sbmLinkShare = ARTICLE_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".ALIAS_SHARE_URL_DIVISOR."/".$article->getString("friendly_url");
                } else {
                    $sbmLink = ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url");
                    $sbmLinkShare = ARTICLE_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$article->getString("friendly_url");
                }
            } else {
				if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ARTICLE_MODULE."/".ALIAS_REVIEW_URL_DIVISOR."/") !== false) {
                    $sbmLink = ARTICLE_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".$article->getString("friendly_url");
                    $sbmLinkShare = ARTICLE_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".ALIAS_SHARE_URL_DIVISOR."/".$article->getString("friendly_url");
				} else {
					$sbmLink = ARTICLE_DEFAULT_URL."/results.php?id=".$article->getNumber("id");
					$sbmLinkShare = ARTICLE_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$article->getString("friendly_url");
				}
            }
			
			$facebook    = "href=\"http://www.facebook.com/sharer.php?u=".$sbmLinkShare."&amp;t=".urlencode($article->getString("title"))."\" target=\"_blank\"";
            $twitter     = "href=\"http://twitter.com/?status=".$sbmLink."\" target=\"_blank\"";
            $linkFacebook = $facebook;
            $linkTwitter = $twitter;

			unset($articleLevelObj);
            $claim_style = "";
			$socialbookmarking_style = "";
        }

	} else {

		$friend_link = "javascript:void(0);";
		$include_favorites_link = "javascript:void(0);";
		$remove_favorites_link = "javascript:void(0);";
		$print_link = "javascript:void(0);";

		$friend_style = "style=\"cursor:default\"";
        $include_favorites_style = "style=\"cursor:default\"";
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
        $facebook_imgE    	= "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/icon-share-facebook.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\"/>";
        $twitter_imgE     	= "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/icon-share-twitter.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\"/>";
        $favorites_imgE     = "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/icon-fav.png\" alt=\"".system_showText(LANG_ICONQUICKLIST_ADD)."\" title=\"".system_showText(LANG_ICONQUICKLIST_ADD)."\"/>";
	
		$comments_page		= (string_strpos($_SERVER['REQUEST_URI'], ALIAS_ARTICLE_MODULE."/".ALIAS_REVIEW_URL_DIVISOR."/") !== false) ? 1 : 0;
        
        if (THEME_SHARE_ITEMS) {
            $share_icon     = "<li><a rel=\"nofollow\" ".($article->getNumber("id") ? "id=\"link_social_".htmlspecialchars($article->getNumber("id")).$type."\"" : "")." href=\"javascript:void(0);\" ".($user ? "onclick=\"enableSocialBookMarking('".$article->getNumber("id")."', '".$type."', '".DEFAULT_URL."', ".$comments_page.");\"" : "")." $socialbookmarking_style>".system_showText(string_strtolower(LANG_LABEL_SHARE))."</a></li>";
        }
	}

	$links = "";
	$cFancyBox = "";
	if ($user) {
		$cFancyBox = ($fancyiFrame ? "iframe fancy_window_tofriend" : "fancy_window_iframe");
	}

    if (THEME_EMAIL_TOFRIEND) {
        $links .= "<li><a rel=\"nofollow\" href=\"".$friend_link."\" class=\"".$cFancyBox."\" ".$friend_style.">".system_showText(LANG_ICONEMAILTOFRIEND)."</a></li><li>|</li>";
    }
	if ($members) {
		if (($id == sess_getAccountIdFromSession()) || ($members != "profile")) {
			$links .= "<li><a rel=\"nofollow\" id=\"favoritesRemove_".$article->getNumber("id")."\" href=\"".$remove_favorites_link."\" ".$remove_favorites_click." ".$remove_favorites_style.">".system_showText(LANG_ICONQUICKLIST_REMOVE)."</a></li>";
		}
	}else {
		$links .= "<li><a rel=\"nofollow\" ".($article->getNumber("id") ? "id=\"favorites_".$article->getNumber("id")."\"" : "")." href=\"".$include_favorites_link."\" class=\"".$includes_favorites_class."\" ".$include_favorites_click." ".$include_favorites_style.">".(THEME_FAVORITES_ICON ? $favorites_imgE : system_showText(LANG_ICONQUICKLIST_ADD))."</a></li>";
	}
	$level = new ArticleLevel();
	if (THEME_DETAIL_PRINT && ($level->getDetail($article->getNumber("level")) == "y") &&  ($typePreview == "detail")) {
		$links .= "<li>|</li><li><a rel=\"nofollow\" href=\"".$print_link."\" $print_class $print_style>".system_showText(LANG_ICONPRINT)."</a></li>";
	}
	
	if (SOCIAL_BOOKMARKING == "on"){
		$twitterL = "<li class=\"icon\"><a rel=\"nofollow\" ".$twitter." >".$twitter_imgE."</a></li>";
		$facebookL = "<li class=\"icon\"><a rel=\"nofollow\" ".$facebook." >".$facebook_imgE."</a></li>";
	}
	
	$likeObj = share_getFacebookButton(true, "", "", "", $sbmLinkShare);
	unset($sbmLink);

	$extraL = "<ul class=\"share-social\">";
	$extraL .= $twitterL;
	$extraL .= $facebookL;
	$extraL .= (THEME_FAVORITES_ICON ? $links : $share_icon);
	$extraL .= "</ul>";

    $icon_navbar .= $extraL.(!THEME_FAVORITES_ICON ? "<ul class=\"share-actions\">".$links."</ul>" : "");

?>
