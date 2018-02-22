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
    # * FILE: /includes/views/icon_listing.php
    # ----------------------------------------------------------------------------------------------------

	if (is_array($listing)) {
		$aux = $listing;
	} else if (is_object($listing)) {
		$aux = $listing->data_in_array;
	}
	
    $icon_navbar = "";
    $icon_listing_level = $aux["level"];

	$location_map = false;
	if ($aux["latitude"] && $aux["longitude"]) {
        $location_map = $aux["latitude"].",".$aux["longitude"];
	}
	if ($location_map) $location_map = urlencode("$location_map");

    $type = "Listing";
	if ($user) {
        $friend_link = DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".$aux["id"]."&amp;receiver=friend";
        if (sess_getAccountIdFromSession() && !$members) {
			$include_favorites_link = "javascript: void(0);";
			$include_favorites_click = "onclick=\"itemInQuicklist('add', '".sess_getAccountIdFromSession()."', '".$aux["id"]."', 'listing');\"";
		} else {
			$include_favorites_link =  DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=".$_SERVER["REQUEST_URI"]."?".$_SERVER["QUERY_STRING"];
			$includes_favorites_class = "fancy_window_iframe";
		}
        $removeFavoritesDiv = "";
        $removeFavoritesDivClass = "";
		if (sess_getAccountIdFromSession() || $members) {
			$remove_favorites_link = "javascript: void(0);";
			$remove_favorites_click = "onclick=\"itemInQuicklist('remove', '".sess_getAccountIdFromSession()."', '".$aux["id"]."', 'listing');\"";
            if ($members) {
                if (($id == sess_getAccountIdFromSession()) || ($members != "profile")) {
                    $removeFavoritesDivClass = "favoritesGrid";
                    $removeFavoritesDiv = " <div class=\"coverFavorites boxFavorites\">
                                                <span><a rel=\"nofollow\" id=\"favoritesRemove_".$aux["id"]."\" href=\"".$remove_favorites_link."\" ".$remove_favorites_click." ".$remove_favorites_style.">".system_showText(LANG_ICONQUICKLIST_REMOVE)."<img src=\"".DEFAULT_URL."/images/bt_delete.gif\" border=\"0\" alt=\"\" title=\"\"/></a></span>
                                            </div>";
                }
            }
		}
		
		$map_link = "onclick='javascript:window.open(\"http://maps.google.com/maps?q=".$location_map."\",\"popup\",\"\")'";
        $aux_friend_link = $friend_link;
		$friend_link = sess_validateSessionItens("listing", "send_email_to_friend", false, $friend_link);
        
        $fancyiFrame = true;
        if ($aux_friend_link != $friend_link){
            $fancyiFrame = false;
        }

        $claim_link = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_CLAIM_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".ALIAS_LISTING_MODULE."/".ALIAS_CLAIM_URL_DIVISOR."/".$aux["friendly_url"];
		//edited        
		//$claimlistingid = $listing["id"];
        //$claim_link1 = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_CLAIM_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".MEMBERS_ALIAS."/".ALIAS_CLAIM_URL_DIVISOR."/listinglevel1.php?claimlistingid=".$claimlistingid;
		//edited        
		// SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING == "on") {
			if(is_object($levelObj)){
				$listingLevelObj = $levelObj;
			}else{
				$listingLevelObj = new ListingLevel();
			}
            
            if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
                if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE."/".ALIAS_REVIEW_URL_DIVISOR."/") !== false) {
                    $sbmLink = LISTING_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".$aux["friendly_url"];
                    $sbmLinkShare = LISTING_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".ALIAS_SHARE_URL_DIVISOR."/".$aux["friendly_url"];
                } elseif (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE."/".ALIAS_CHECKIN_URL_DIVISOR."/") !== false) {
                    $sbmLink = LISTING_DEFAULT_URL."/".ALIAS_CHECKIN_URL_DIVISOR."/".$aux["friendly_url"];
                    $sbmLinkShare = LISTING_DEFAULT_URL."/".ALIAS_CHECKIN_URL_DIVISOR."/".ALIAS_SHARE_URL_DIVISOR."/".$aux["friendly_url"];
                } elseif (string_strpos($_SERVER['REQUEST_URI'], "review.php")) { //for review page sharing 
                    $forReview = true;
                    $sbmLink = DEFAULT_URL."/review.php?id=".$reviewId; 
                    $sbmLinkShare = DEFAULT_URL."/review.php?id=".$reviewId; 
                    $twitterReview = "href=\"http://twitter.com/share?hashtags=".htmlspecialchars(str_replace(" ", "", $aux["title"]))."&amp;text=".$reviewObj->review."&amp;url=".$sbmLink1."&amp;image=".$image." \" target=\"_blank\"";
                } else {
                    $sbmLink = LISTING_DEFAULT_URL."/".$aux["friendly_url"];
                    $sbmLinkShare = LISTING_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$aux["friendly_url"];
                }
            } else {
				if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE."/".ALIAS_REVIEW_URL_DIVISOR."/") !== false) {
                    $sbmLink = LISTING_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".$aux["friendly_url"];
                    $sbmLinkShare = LISTING_DEFAULT_URL."/".ALIAS_REVIEW_URL_DIVISOR."/".ALIAS_SHARE_URL_DIVISOR."/".$aux["friendly_url"];
				} elseif (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE."/".ALIAS_CHECKIN_URL_DIVISOR."/") !== false) {
                    $sbmLink = LISTING_DEFAULT_URL."/".ALIAS_CHECKIN_URL_DIVISOR."/".$aux["friendly_url"];
                    $sbmLinkShare = LISTING_DEFAULT_URL."/".ALIAS_CHECKIN_URL_DIVISOR."/".ALIAS_SHARE_URL_DIVISOR."/".$aux["friendly_url"];
				} else {
					$sbmLink = LISTING_DEFAULT_URL."/results.php?id=".$aux["id"];
					$sbmLinkShare = LISTING_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$aux["friendly_url"];
				}
            }

           //for sharing 
            $imageObjT = new Image($aux["thumb_id"]);
            $imageObjT->imageExists();
            $listingtemplate_image = $imageObjT->getTag(THEME_RESIZE_IMAGE, IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT, $aux["title"], THEME_RESIZE_IMAGE);
            $image = preg_replace('/.+src="([^"]+)".+/', '${1}', $listingtemplate_image);
            $facebook = "href='https://www.facebook.com/sharer/sharer.php?u=".$sbmLink."'";
            $twitter     = "href=\"http://twitter.com/share?hashtags=".htmlspecialchars(str_replace(" ", "", $aux["title"]))."&amp;text=".htmlspecialchars($aux["seo_description"])."&amp;url=".$sbmLink1."&amp;image=".$image." \" target=\"_blank\"";
            $google      = "href='https://plus.google.com/share?url=".$sbmLink."'";
            if($forReview) $twitter = $twitterReview;
            $linkFacebook = $facebook;
            $linkTwitter = $twitter;

			$friend_style = "";
			$include_favorites_style = "";
			$print_style = "";
			$map_style = "";
			$claim_style = "";
			$socialbookmarking_style = "";

            unset($listingLevelObj);
        }

    } else {

        $friend_link = "javascript:void(0);";
        $include_favorites_link = "javascript:void(0);";
        $print_link = "javascript:void(0);";
        $map_link = "";
        $claim_link = "javascript:void(0);";

		$friend_style = "style=\"cursor:default\"";
        $include_favorites_style = "style=\"cursor:default\"";
        $print_style = "style=\"cursor:default\"";
        $map_style = "style=\"cursor:default\"";
        $promotion_style = "style=\"cursor:default\"";
        $claim_style = "style=\"cursor:default\"";
		$socialbookmarking_style = "style=\"cursor:default\"";

        // SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING == "on") {

            $facebook    = "href=\"javascript:void(0);\" style=\"cursor:default\"";
            $twitter     = "href=\"javascript:void(0);\" style=\"cursor:default\"";
            $google     = "href=\"javascript:void(0);\" style=\"cursor:default\"";
		}
    }

  
	// SOCIAL BOOKMARKING IMAGES
    if (SOCIAL_BOOKMARKING == "on") {
        if( EDIR_THEME === 'review' ){
            $facebook_imgE    	= '<i class="fa fa-facebook"></i>';
            $twitter_imgE     	= '<i class="fa fa-twitter"></i>';
            $google_imgE        = '<i class="fa fa-google-plus"></i>';
            $favorites_imgE     = '<i class="fa fa-heart"></i>';
        }
        else {
        $facebook_imgE    	= "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-facebook.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\"/>";
        $twitter_imgE     	= "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-twitter.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\"/>";
        $google_imgE     	= "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-google.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Google\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Google\"/>";
	
        $favorites_imgE     = "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/iconography/icon-fav.png\" alt=\"".system_showText(LANG_ICONQUICKLIST_ADD)."\" title=\"".system_showText(LANG_ICONQUICKLIST_ADD)."\"/>";
        
		$comments_page		= (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE."/".ALIAS_REVIEW_URL_DIVISOR."/") !== false) ? 1 : 0;
		$checkins_page		= (string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE."/".ALIAS_CHECKIN_URL_DIVISOR."/") !== false) ? 1 : 0;
        }	
        if (THEME_SHARE_ITEMS) {
            $share_icon		= "<li><a rel=\"nofollow\" ".($aux["id"] ? "id=\"link_social_".htmlspecialchars($aux["id"]).$type."\"" : "")." href=\"javascript:void(0);\" ".($user ? "onclick=\"enableSocialBookMarking('".$aux["id"]."', '".$type."', '".DEFAULT_URL."', ".$comments_page.", ".$checkins_page.");\"" : "")." $socialbookmarking_style>".system_showText(string_strtolower(LANG_LABEL_SHARE))."</a></li>";
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
			$links .= "<li><a rel=\"nofollow\" id=\"favoritesRemove_".$aux["id"]."\" href=\"".$remove_favorites_link."\" ".$remove_favorites_click." ".$remove_favorites_style.">".system_showText(LANG_ICONQUICKLIST_REMOVE)."</a></li>";
		}
	} else {
		$links .= "<li><a rel=\"nofollow\" ".($aux["id"] ? " id=\"favorites_".$aux["id"]."\"" : "")." href=\"".$include_favorites_link."\" class=\"".$includes_favorites_class." bg\" ".$include_favorites_click." ".$include_favorites_style.">".(THEME_FAVORITES_ICON ? $favorites_imgE : system_showText(LANG_ICONQUICKLIST_ADD))."</a></li>";
	}
    
    if (is_object($levelObj)) {
        $listingLevelObj = $levelObj;
    } else {
        $listingLevelObj = new ListingLevel();
    }
    
    if (THEME_DETAIL_PRINT && ($listingLevelObj->getDetail($icon_listing_level) == "y") && ($typePreview == "detail")) {
		
		$aux_validate_print = sess_validateSessionItens("listing", "print");
		
		if ($user){
			if ($aux_validate_print){
				$print_link = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=".$_SERVER["REQUEST_URI"]."?".$_SERVER["QUERY_STRING"];
				$print_class = "class=\"fancy_window_iframe\"";		
			} else {
				$print_link = "javascript:window.print();";
			}
		}
		
		$links .= "<li>|</li><li><a rel=\"nofollow\" href=\"".$print_link."\" $print_class $print_style>".system_showText(LANG_ICONPRINT)."</a></li>";	
    }

    if (!THEME_MAPS_NEWBALLOON_STYLE) {
    
        if ($tPreview) {
            if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
                $links .= "<li>|</li><li><a rel=\"nofollow\" href=\"javascript:void(0);\" ".$map_link." ".$map_style.">".system_showText(LANG_ICONMAP)."</a></li>";
            }
        } else {
            if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
                if ((htmlspecialchars($aux["latitude"])) && (htmlspecialchars($aux["longitude"]))) {
                    $links .= "<li>|</li><li><a rel=\"nofollow\" href=\"javascript:void(0);\" ".$map_link." ".$map_style.">".system_showText(LANG_ICONMAP)."</a></li>";
                }
            }
        }
    
    }
	
	if (SOCIAL_BOOKMARKING == "on"){
            if( EDIR_THEME === 'review' ){

                $twitterL = "<li class=\"icon\"><a rel=\"nofollow\" ".$twitter." onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=325,width=600, top=100, left=400');return false;\" class=\"tw bg\">".$twitter_imgE."</a></li>";
		$facebookL = "<li  class=\"icon\"><a rel=\"nofollow\" ".$facebook." onclick=\"javascript:window.open(this.href, 'sharer', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=325,width=600, top=100, left=400');return false;\" class=\"bg fb\">".$facebook_imgE."</a></li>";
		$googleL = "<li class=\"icon\"><a rel=\"nofollow\" ".$google." onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=325,width=600, top=100, left=400');return false;\" class=\"bg gp\">".$google_imgE."</a></li>";

           }
            else {
		$twitterL = "<li class=\"icon\"><a rel=\"nofollow\" ".$twitter." >".$twitter_imgE."</a></li>";
		$facebookL = "<li class=\"icon\"><a rel=\"nofollow\" ".$facebook." >".$facebook_imgE."</a></li>";
        $googleL = "<li class=\"icon\"><a rel=\"nofollow\" ".$google." >".$google_imgE."</a></li>";
                
            }
	}
	
	$likeObj = share_getFacebookButton(true, "", "", "", $sbmLinkShare);
	unset($sbmLink);

	$extraL = ( EDIR_THEME === 'review' ) ? "<ul class=\"social detailSocial\">" : "<ul class=\"share-social\">";
	$extraL .= $twitterL;
	$extraL .= $facebookL;
	$extraL .= (THEME_FAVORITES_ICON ? $links : $share_icon);
	$extraL .= "</ul>";
    $icon_navbar .= $extraL.(!THEME_FAVORITES_ICON ? "<ul class=\"share-actions\">".$links."</ul>" : "");
    
        $extraL1 = ( EDIR_THEME === 'review' ) ? "<ul class=\"social detailSocial\">" : "<ul class=\"share-social\">";
	$extraL1 .= $twitterL;
	$extraL1 .= $facebookL;
	$extraL1 .= $googleL;
	$extraL1 .= "</ul>";
    $share_navbar .= $extraL1.(!THEME_FAVORITES_ICON ? "<ul class=\"share-actions\">".$links."</ul>" : "");
    
    //for reviews
//        $r_extraL = ( EDIR_THEME === 'review' ) ? "<ul class=\"social detailSocial\">" : "<ul class=\"share-social\">";
//	$r_extraL .= $r_twitterL;
//	$r_extraL .= $r_facebookL;
//	$r_extraL .= $r_googleL;
//	$r_extraL .= "</ul>";
//    $r_share_navbar .= $extraL.(!THEME_FAVORITES_ICON ? "<ul class=\"share-actions\">".$links."</ul>" : "");

    
?>
