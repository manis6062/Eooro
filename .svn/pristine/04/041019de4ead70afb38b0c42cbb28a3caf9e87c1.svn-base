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
	# * FILE: /includes/views/view_promotion_detail.php
	# ----------------------------------------------------------------------------------------------------
	 
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$promotionDeals = $promotion->getDealInfo();
	
	$dealsDone = $promotionDeals['doneByAmount'] || $promotionDeals['doneByendDate'] ? true : false;
    
    if (DEFAULT_DATE_FORMAT == "m/d/Y") {
		$sd_date = date("m")."/".date("d")."/".date("Y");
		$ed_date = $promotionDeals['timeleft'][1]."/".$promotionDeals['timeleft'][2]."/".$promotionDeals['timeleft'][0];
	} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
		$sd_date = date("d")."/".date("m")."/".date("Y");
		$ed_date = $promotionDeals['timeleft'][2]."/".$promotionDeals['timeleft'][1]."/".$promotionDeals['timeleft'][0];
	}
    
    $sd_timestamp = system_getTimeStamp($sd_date);
    $ed_timestamp = system_getTimeStamp($ed_date);
    $diffdays = system_getDiffDays($sd_timestamp, $ed_timestamp);

	if ($diffdays){
		$format = "dHM";
	} else {
		$format = "HMS";
	}
    $rate_avgDeal = $promotion->getNumber("avg_review");
    
    if ($user){ ?>
		<script type="text/javascript">
			//<![CDATA[
			$(document).ready(function() {
				newDate = new Date(<?=$promotionDeals['timeleft'][0]?>,<?=($promotionDeals['timeleft'][1]-1)?>,<?=$promotionDeals['timeleft'][2]?>,23,59,59);
				$('#timeLeft').countdown({
					until: newDate,
					format:'<?=(THEME_COUNTDOWN_CUSTOM ? "dHMS" : $format)?>',
                    <? if (THEME_COUNTDOWN_CUSTOM) { ?>
                        layout: '<?=($diffdays ? "{dn} {dl} " : "");?>{hnn}:{mnn}:{snn}',
                    <? } ?>
                    pluginStyle: <?=($isMobileDetail ? 'false' : 'true')?>
				});
			});
			//]]>
		</script>
	
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.min.js"></script>
	
		<? if (EDIR_LANGUAGE != "en_us") { ?>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown-<?=EDIR_LANGUAGE?>.js"></script>
		<? } 
	}

	if (!$dealsDone) {
		
		$promotionLink = $promotion->getString("friendly_url");
		
		$linkRedeem = DEFAULT_URL."/popup/popup.php?pop_type=deal_redeem&amp;redeemit=true&amp;nofacebook=true&amp;id=".$promotion->getNumber("id");
		if (sess_getAccountIdFromSession()){
			$account = new Account(sess_getAccountIdFromSession());
			$facebookaccount = false;
			if ($account->getString("facebook_username")){
				$facebookaccount = true;
			}
			unset($account);
		}
	
		if (FACEBOOK_APP_ENABLED == "on") {
			
			setting_get("promotion_force_redeem_by_facebook", $promotion_force_redeem_by_facebook);
			
			$buttomClass = "class=\"button button-facebook\"";
			$buttonText = system_showText(DEAL_REDEEMSHARE);

			if ($user) {
				
                Facebook::getFBInstance($facebook);
                
				$TBLink = DEFAULT_URL."/popup/popup.php?pop_type=deal_redeem&amp;redeemit=true&amp;id=".$promotion->getNumber("id");
				$promotionUrl = PROMOTION_DEFAULT_URL."/".$promotion->getString('friendly_url');
				$urlRedirect = "&action=check_session&type=redeem_deal&item_id=".$promotion->getNumber("id")."&tb_link=".urlencode($TBLink)."&destiny=".urlencode($isListingDetail ? $listing->getFriendlyURL(false, LISTING_DEFAULT_URL) : $promotionUrl);
				
                $params = array(
                  'redirect_uri' => FACEBOOK_REDIRECT_URI."?fb_session=ok".$urlRedirect
                );

                $redeemLink = $facebook->getLoginUrl($params); 
                 
				if ($promotion_force_redeem_by_facebook){
					if (sess_getAccountIdFromSession() && !$facebookaccount) {
                        $linkRedeemClass = "fancy_window_iframe";
						$redeemWFB = $linkRedeem;
						$linkText = system_showText(LANG_LABEL_REDEEM_PRINT);
					} else {
                        $linkRedeemClass = "fancy_window_iframe";
						$redeemWFB = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;act=redeem&amp;type=deal&amp;redeem_item=".$promotion->getNumber("id")."&amp;destiny=".ALIAS_PROMOTION_MODULE."/".urlencode($promotionLink)."&amp;nofacebook=true";
						$linkText = system_showText(LANG_DEAL_DONTUSEFACEBOOK);
					}
				}
			} else {
				$redeemLink = "javascript:void(0);";
				$redeemWFB = "javascript:void(0);";
				$linkText = system_showText(LANG_DEAL_DONTUSEFACEBOOK);
			}
		} else {
			$buttomClass = "class=\"button button-redeem\" id=\"buttonConnect_redeemshare\"";

			if ($user) {
				
				if (sess_getAccountIdFromSession()) {
                    $linkRedeemClass = "fancy_window_iframe";
					$redeemLink = $linkRedeem;
					$buttonText = system_showText(LANG_LABEL_REDEEM_PRINT);
				} else {
                    $linkRedeemClass = "fancy_window_iframe";
					$redeemLink = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;act=redeem&amp;type=deal&amp;redeem_item=".$promotion->getNumber("id")."&amp;destiny=".ALIAS_PROMOTION_MODULE."/".urlencode($promotionLink)."&amp;nofacebook=true";
					$buttonText = system_showText(DEAL_CONNECT_REDEEM);
				}
			} else {
				$redeemLink = "javascript:void(0);";
				$redeemLink = "javascript:void(0);";
				$buttonText = system_showText(DEAL_CONNECT_REDEEM);
			}
		}
	}
	
	$deal_name = $promotion->getString("name");
	
	$deal_value = CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"), false);
	
	$deal_cents = string_substr($promotion->getNumber("dealvalue"),(string_strpos($promotion->getNumber("dealvalue"),".")),3);
	if ($deal_cents == ".00") $deal_cents = "";
	
	$deal_real_value = CURRENCY_SYMBOL.format_money($promotion->getNumber("realvalue"),2);
	
	$deal_left = $promotionDeals['left'];
	
	$deal_sold = $promotionDeals['sold'];
	
	if ($promotion->getNumber("realvalue") > 0){
		$deal_offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
	} else {
		$deal_offer = "100%";
	}
	
	$deal_conditions = $promotion->getString("conditions");
	
	$deal_description = $promotion->getString("long_description");
    
	$deal_summarydescription = $promotion->getString("description");
	
	$imageObj = new Image($promotion->getNumber("image_id"));
	$imageTag = "";
	
	if ($imageObj->imageExists()){
		$imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
		$imageTag .=  $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_PROMOTION_FULL_WIDTH, IMAGE_PROMOTION_FULL_HEIGHT, $promotion->getString("name", false), THEME_RESIZE_IMAGE);
		$imageTag .= "</div>";
        $auxImgPath = $imageObj->getPath();
	} else {
		$imageTag .= "<span class=\"no-image no-link\"></span>";
	}
    
    if (!$isListingDetail) {
	
        $listing = db_getFromDB("listing", "id", db_formatNumber($promotion->getNumber("listing_id")), 1, "", "object", SELECTED_DOMAIN_ID);

        //Prepare location data to rich snippets
        $snippet_address = system_prepareRichSnippet("address", $listing);
        
        $listingtemplate_address = "";
        if ($listing->getString("address")) {
            $listingtemplate_address = nl2br($listing->getString("address", true));
        }

        $listingtemplate_address2 = "";
        if ($listing->getString("address2")) {
            $listingtemplate_address2 = nl2br($listing->getString("address2", true));
        }

        $listingtemplate_phone = "";
        $listingtemplate_phone_aux = "";
        if ($listing->getString("phone")) {
            if ($user) {
                $listingtemplate_phone_aux = $listing->getString("phone", true);
                $listingtemplate_phone .= "<span id=\"phoneLink".$listing->getNumber("id")."\" class=\"controlPhoneShow\"><a rel=\"nofollow\" href=\"javascript:showPhone('".$listing->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
                $listingtemplate_phone .= "<span id=\"phoneNumber".$listing->getNumber("id")."\" class=\"controlPhoneHide\">".$listing->getString("phone", true)."</span>";
            } else {
                $listingtemplate_phone  = $listing->getString("phone", true);
            }
        }

        $linkStyle = "style=\"cursor: pointer;\"";
        if ($user) {
            if ($listing->hasDetail() == "y") {
                $listingDetailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url");
            } else {
                $listingDetailLink = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id")."";
            }
        } else {
            $listingDetailLink = "javascript:void(0);";
            $linkStyle = "style=\"cursor: none;\"";
        }

        $promotionStyle = "";
        if (!$user){
            $promotionStyle = "style=\"cursor:default\"";
        }

        $listingtemplate_image = "";
        $imageObjListing = new Image($listing->getNumber("image_id"));

        if ($imageObjListing->imageExists()) {
            $listingtemplate_image .= "<a href=\"".$listingDetailLink."\" $promotionStyle>";
            $listingtemplate_image .= $imageObjListing->getTag(THEME_RESIZE_IMAGE, SIDEBAR_FEATURED_WIDTH, SIDEBAR_FEATURED_HEIGHT, $listing->getString("title", false), THEME_RESIZE_IMAGE);
            $listingtemplate_image .= "</a>";
        } else {
            $listingtemplate_image .= "<a class=\"no-image\" href=\"".$listingDetailLink."\" $promotionStyle></a>";
        }

        $listingtemplate_complementaryinfo = "";
        $listingtemplate_complementaryinfo = system_itemRelatedCategories(htmlspecialchars($listing->getNumber("id")), "listing", $user);

        if (socialnetwork_writeLink(htmlspecialchars($listing->getNumber("account_id")), "profile", "general_see_profile",false , false, "", false, $user)) {
            $listingtemplate_complementaryinfo .= " ".LANG_BY." ".socialnetwork_writeLink(htmlspecialchars($listing->getNumber("account_id")), "profile", "general_see_profile",false , false, "", false, $user);
        }

        $listingtemplate_email = "";
        if (htmlspecialchars($listing->getString("email"))) {
            $display_email = wordwrap(htmlspecialchars($listing->getString("email")), 30, "<br />", true);
            if ($user){
                $listingtemplate_email = "<a rel=\"nofollow\" href=\"".DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".htmlspecialchars($listing->getNumber("id"))."&amp;receiver=owner\" class=\"fancy_window_tofriend\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
            } else {
                $listingtemplate_email = "<a rel=\"nofollow\" href=\"javascript:void(0);\" style=\"cursor:default\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
            }
        }

        $listingtemplate_url = "";
        $listingtemplate_url_aux = "";
        if (htmlspecialchars($listing->getString("url"))) {
            $display_url = htmlspecialchars($listing->getString("url"));
            if (htmlspecialchars($listing->getString("display_url"))) {
                $display_url = htmlspecialchars($listing->getString("display_url"));
            }
            $display_url_title = $display_url;
            if (THEME_REVIEWS_PROMOTION_SIDEBAR) {
                $display_url = system_showTruncatedText($display_url, 10);
            }
            if ($user) {
                $listingtemplate_url = "<a href=\"".DEFAULT_URL."/listing_reports.php?report=website&amp;id=".htmlspecialchars($listing->getNumber("id"))."\" target=\"_blank\" title=\"$display_url_title\">".$display_url."</a>";
            } else {
                $listingtemplate_url = "<a href=\"javascript:void(0);\" title=\"$display_url_title\" style=\"cursor:default\">".$display_url."</a>";
            }
            $listingtemplate_url_aux = $listing->getString("url");
        }

        $locationsToshow = system_retrieveLocationsToShow();
        $listingtemplate_location = "";
        $locationsParam = system_formatLocation($locationsToshow.", z");
        $listingtemplate_location = $listing->getLocationString($locationsParam, true);

        include(EDIRECTORY_ROOT."/includes/views/icon_promotion.php");

        $deal_icon_navbar = $icon_navbar;
        $icon_navbar = "";

        $deal_category_tree = "";
        $categories = $listing->getCategories(false, false, $listing->getNumber("id"),true);

        if (!$isMobileDetail) {
            /*
            * Google+ Button
            */
            $arrayPaths = array();
            if ($auxImgPath) {
                $arrayPaths[] = $auxImgPath;
            }
            $deal_googleplus_button = share_getGoogleButton($tPreview, $user, false, "", false, $arrayPaths);

            /*
            * Pinterest Button
            */
            $deal_pinterest_button = share_getPinterestButton($auxImgPath, $promotion->getFriendlyURL(false,PROMOTION_DEFAULT_URL), $deal_summarydescription, $deal_name, $tPreview, $user);

            /*
            * Facebook Buttons
            */
            $deal_facebook_buttons = share_getFacebookButton(false, $likeObj, $tPreview, $user);

            if ($categories) {

                $array_categories_obj = array();
                for($i=0;$i<count($categories);$i++){
                    unset($categoryObj);
                    $categoryObj = new ListingCategory($categories[$i]["id"]);
                    $arr_full_path[] = $categoryObj->getFullPath();
                    $array_categories_obj[] = $categoryObj;	
                }

                if ($arr_full_path){
                    $deal_category_tree = system_generateCategoryTree($array_categories_obj, $arr_full_path, "promotion", $user);
                }	
            }

            $deal_review = "";
            $deal_summary_review = "";
            setting_get('commenting_edir', $commenting_edir);
            setting_get("review_promotion_enabled", $review_enabled);
            setting_get("review_listing_enabled", $review_enabled_listing);

            if (($review_enabled == "on" || $review_enabled_listing == "on") && $commenting_edir) {

                if (THEME_REVIEWS_PROMOTION_SIDEBAR && $review_enabled == "on") {

                    $item_type = 'promotion';
                    if($promotion->getNumber("id") > 0){
                        $item_id   = $promotion->getNumber('id');
                        include(INCLUDES_DIR."/views/view_review.php");
                        $deal_summary_review .= $item_review;
                        $item_review = "";
                        if ($reviewsArr) {

                            $lastItemStyle = 0;
                            $numberOfReviews = 3;
                            $reviewMaxSize = 150;

                            $reviewFileName = INCLUDES_DIR."/views/view_review_detail.php";
                            $reviewFileNameTheme = INCLUDES_DIR."/views/view_review_detail_".EDIR_THEME.".php";
                            
                            foreach ($reviewsArr as $each_rate) {
                                if ($each_rate->getString("review")) {
                                    $each_rate->extract();
                                    
                                    if (file_exists($reviewFileNameTheme)) {
                                        include($reviewFileNameTheme);
                                    } else {
                                        include($reviewFileName);
                                    }
                                    
                                    $deal_review .= $item_reviewcomment;
                                    $item_reviewcomment = "";
                                }
                            }
                        }
                    }

                } else {

                    //deal reviews
                    if ($review_enabled == "on") {
                        $promotion_review = "";
                        $item_type = 'promotion';
                        $item_id   = $promotion->getNumber("id");
                        $itemObj   = $promotion;
                        $reviewSummaryInfo = true;
                        $isDetail = true;
                        include(INCLUDES_DIR."/views/view_review.php");
                        $promotion_review .= $item_review;
                        $item_review = "";
                    }

                    //listing reviews
                    if ($review_enabled_listing == "on" && $listing->getNumber("id")) {
                        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
                        if ($levelsWithReview) {
                            if (in_array($listing->getNumber("level"), $levelsWithReview)) {
                                $review_enabled = $review_enabled_listing;
                                $listingReviewDeal = true;
                                $listing_review = "";
                                $item_type = 'listing';
                                $item_id   = $listing->getNumber("id");
                                $itemObj   = $listing;
                                include(INCLUDES_DIR."/views/view_review.php");
                                $listing_review .= $item_review;
                                $item_review = "";
                            }
                        }
                    }

                }

            }

            if (THEME_DEAL_DETAIL_MAP) {

                $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
                $listing_google_maps = "";
                if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on" && $listing->getNumber("id")) {

                    $levelObj = new ListingLevel(true);

                    if ($levelObj->getDetail($listing->getNumber("level")) == "y") {
                        $listingLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url");
                    } else {
                        $listingLink = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
                    }

                    $google_title = "<a href=\"$listingLink\">".$listing->getString("title", false)."</a>";
                    $google_stars = $rate_starsNolink;
                    if ($tPreview) {
                        $google_address = "";
                        $google_address2 = "";
                        $google_location1 = "";
                        $google_location3 = "";
                        $google_location4 = "";
                        $google_zip = "";
                        $google_maptuning = "";
                        $google_mapzoom = "";
                        $google_location_showaddress = "";
                    } else {
                        $google_address = $listing->getString('address');
                        $google_address2 = $listing->getString('address2');
                        $google_location1 = $listing->getLocationString("1", true);
                        $google_location3 = $listing->getLocationString("3", true);
                        $google_location4 = $listing->getLocationString("4", true);
                        $google_zip = $listing->getLocationString("z", true);
                        if ($listing->getString('latitude') && $listing->getString('longitude')){
                            $google_maptuning = $listing->getString('latitude').",".$listing->getString('longitude');
                        }
                        $google_mapzoom = $listing->getString('map_zoom');
                        $google_location_showaddress = $listing->getLocationString("A, 4, 3, 1", true);
                    }
                    $show_html = true;
                    include(INCLUDES_DIR."/views/view_google_maps.php");
                    $listing_google_maps = $google_maps;
                    $google_maps = "";
                }
            }

            $detailFileName = INCLUDES_DIR."/views/view_promotion_detail_code.php";
            $themeDetailFileName = INCLUDES_DIR."/views/view_promotion_detail_code_".EDIR_THEME.".php";

            if (file_exists($themeDetailFileName)){
                include($themeDetailFileName);
            } else {
                include($detailFileName);
            }
        }
    
    }

?>